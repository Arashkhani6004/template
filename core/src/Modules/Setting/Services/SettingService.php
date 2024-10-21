<?php

namespace Rahweb\CmsCore\Modules\Setting\Services;

use Rahweb\CmsCore\Modules\General\Helper\FileManager;
use Rahweb\CmsCore\Modules\General\Helper\NumberHelper;
use Rahweb\CmsCore\Modules\General\Helper\TestImage;
use Rahweb\CmsCore\Modules\Setting\Entities\Setting;
use Illuminate\Support\Facades\Redirect;

class SettingService
{
    public static function findAll($keys = [])
    {
        $setting = Setting::query();
        if (count($keys) > 0) {
            $setting->whereIn('key', $keys);
        }
        return $setting->get();
    }

    public static function getFormatSettings($query=[])
    {
        $data = self::findAll($query);
        $settings = [];
        $keysToCheck = ['video_cover'];

        foreach ($data as $row) {
            $fileUrl = null;
            if (in_array($row->key, $keysToCheck) && @$row->value != null) {
                if (file_exists('uploads/setting/' . @$row->value)) {
                    $fileUrl = config('cms-assistant.public-base-url') . '/uploads/setting/' . @$row->value;
                }
            }
            $settings[$row->key] = match ($row->type) {
                "input_file" => self::fileFormat($row),
                "input_file_about" => self::fileFormat($row),
                "array" => self::arrayFormat($row->value),
                "array_files" => self::arrayFileFormat($row->value),
                "work_hours" => self::jsonFormat($row->value),
                "menu" => self::jsonFormat($row->value),
                default => $row->value,
            };
            if (in_array($row->key, $keysToCheck)) {
                $settings[$row->key] = $fileUrl;
            }
        }
        return $settings;
    }

    public static function jsonFormat($value)
    {
        return json_decode($value, true);
    }

    public static function arrayFormat($value): array
    {
        return $value ?  explode(",", $value) : [];
    }

    public static function arrayFileFormat($value): array
    {
        $files = self::arrayFormat($value);
        $files_format = [];
        foreach ($files as $row) {
            $files_format[] = self::fileFormat($row);
        }
        return $files_format;
    }

    public static function fileFormat($value)
    {
        $image = "default.jpg";
        if (@$value['options']['image']) {
            $image = $value['options']['image'];
        }
        return FileManager::serveFile(
            'uploads/setting/' . $value['value'], 'assets/notfounds/' . $image
        );
    }

    public function update($request)
    {
        //موارد تکست یا آرایه هایی که نیاز به تغییر ندارند
        $arrays = $request->get('array', []);
        $text = $request->get('text', []);
        $ckeditor = $request->get('ckeditor', []);
        $textarea = $request->get('textarea', []);
        $combinedArray = array_merge($arrays, $text, $ckeditor, $textarea);
        foreach ($combinedArray as $key2 => $array) {

            Setting::where('key', $key2)->first()
                ->update([
                    'value' => strlen(NumberHelper::persian2LatinDigit($array)) != 0 ? NumberHelper::persian2LatinDigit($array)  : null
                ]);
        }


        //تنظیمات منو
        $menu_data = $request->get('menu_data') ? $request->get('menu_data') : [];
        Setting::firstOrCreate(['type' => "menu"])->update(
            [
                'value' => strlen(NumberHelper::persian2LatinDigit($menu_data)) != 0 ? NumberHelper::persian2LatinDigit($menu_data)  : null
            ]
        );

        // ساعت کاری سالن
        $work_hours = $request->get('work_hours');
        $data_array = [];
        foreach ($work_hours as $key => $value) {
            $from = $work_hours[$key]['from'];
            $to = $work_hours[$key]['to'];
            if (($from < 0 || $from > 24) || ($to < 0 || $to > 24)) {
                return Redirect::back()->with('error', ' ساعت کاری وارد شده نا معتبر است');
            }
            if ($from > $to) {
                return Redirect::back()->with('error', ' مقدار "از" بزرگتر از مقدار "تا" است');
            }
            $data_array[$key] = [
                'from' => $from,
                'to' => $to,
            ];
        }
        Setting::where('key', 'work_hours')->first()->update(
            [
                'value' => $data_array
            ]
        );
//چک باکس ها
        $checkboxes = Setting::where('type', 'checkbox')->get();
        foreach ($checkboxes as $checkbox) {
            $checkbox->update([
                'value' => @$request->get('checkbox')[$checkbox['key']] != null ? 1 : 0
            ]);
        }
        $input = $request->all();

        //فایل هایی که بصورت مولتیپل اضافه میشن
        if (@$input['array_files']) {
            foreach ($input['array_files'] as $key4 => $array_files) {
                $fileNames = [];
                foreach ($array_files as $key5 => $array_file) {
                    if (!TestImage::is_image($array_file)) {
                        return Redirect::back()->with('error', ' تصویر وارد شده نا معتبر است');
                    }
                    $fileNameArray = FileManager::upload($array_file, "setting");
                    $fileNames[] = $fileNameArray;
                }
                Setting::where('key', $key4)->first()->update([
                    'value' => implode(',', $fileNames),
                ]);
            }
        }

        //فایل هایی که بصورت تکی اضافه میشن
        if (@$input['input_file']) {
            foreach ($input['input_file'] as $key3 => $input_file) {
                if (!TestImage::is_image($input_file)) {
                    return Redirect::back()->with('error', ' تصویر وارد شده نا معتبر است');
                }
                $fileName = FileManager::upload($input_file, "setting");
                Setting::where('key', $key3)->first()
                    ->update([
                        'value' => $fileName
                    ]);
            }
        }

        //فایل هایی که برای درباره ما اضافه میشن
        if (@$input['input_file_about']) {
            foreach ($input['input_file_about'] as $key4 => $input_file_about) {
                if (!TestImage::is_image($input_file_about)) {
                    return Redirect::back()->with('error', ' تصویر وارد شده نا معتبر است');
                }
                $fileNameAbout = FileManager::upload($input_file_about, "setting");
                Setting::where('key', $key4)->first()
                    ->update([
                        'value' => $fileNameAbout
                    ]);
            }
        }


    }
}
