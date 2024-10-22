<?php

namespace Rahweb\CmsCore\Modules\General\Helper;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;

class FileManager
{

    public static function upload(UploadedFile $file, $folder = null, $filename = null)
    {
        $random_name = TextHelper::random_str(5) . time();
        $filename = !is_null($filename) ? $filename : $random_name;
        $webp_filename = $filename . ".webp";
        $base_folder = strlen(config('setting.base_upload_folder')) > 0 ? config('setting.base_upload_folder') . "/uploads" : "uploads";

        if (!File::isDirectory("$base_folder")) {
            File::makeDirectory(public_path("$base_folder"),0755,true);
        }
        if (!File::isDirectory("$base_folder/$folder")) {
            File::makeDirectory(public_path("$base_folder/$folder"));
        }

        $img = new ImageManager();
        $img->make($file)
            ->encode('webp', 90)
            ->save("$base_folder/$folder/$webp_filename");
        return $webp_filename;
    }
    public static function uploadRaw(UploadedFile $file, $folder = null, $filename = null)
    {
        $random_name = TextHelper::random_str(5) . time();
        $filename = !is_null($filename) ? $filename : $random_name;
        $final_name = $filename . ".".$file->getClientOriginalExtension();
        $base_folder = strlen(config('setting.base_upload_folder')) > 0 ? config('setting.base_upload_folder') . "/uploads" : "uploads";

        if (!File::isDirectory("$base_folder")) {
            File::makeDirectory(public_path("$base_folder"),0755,true);
        }
        if (!File::isDirectory("$base_folder/$folder")) {
            File::makeDirectory(public_path("$base_folder/$folder"));
        }

        $file->move("$base_folder/$folder", $final_name);
        return $final_name;
    }

    public static function delete($file_path): void
    {
        $base_folder = strlen(config('setting.base_upload_folder')) > 0 ? config('setting.base_upload_folder') . "/uploads" : "uploads";
        File::delete(public_path($base_folder . '/' . $file_path));
    }

    public static function serveFile(string $file_path, string $notfound_path = 'assets/notfounds/default.jpg')
    {
        $base_upload_folder = config('setting.base_upload_folder');
        $base_serve_folder = config('setting.base_serve_folder');
//        \Log::info($base_upload_folder . '/' . $file_path);
        return match (true) {
            is_dir(public_path($base_upload_folder . '/' . $file_path)) => asset($notfound_path),
            file_exists(public_path($base_upload_folder . '/' . $file_path)) => asset(trim("$base_serve_folder/$file_path", '/')),
            default => asset($notfound_path),
        };
    }
}
