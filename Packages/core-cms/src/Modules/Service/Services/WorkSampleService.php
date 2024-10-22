<?php

namespace Rahweb\CmsCore\Modules\Service\Services;

use Rahweb\CmsCore\Modules\General\Helper\FileUploader;
use Rahweb\CmsCore\Modules\Service\Entities\Service;
use Rahweb\CmsCore\Modules\Service\DTO\WorkSampleDTO;
use Rahweb\CmsCore\Modules\Service\Entities\WorkSample;
use Rahweb\CmsCore\Modules\Service\Entities\WorkSampleImage;

class WorkSampleService
{
    public function create(WorkSampleDTO $workSampleDTO): void
    {

        $work_sample = WorkSample::create([
            'title' => $workSampleDTO->getTitle(),
            'description' => $workSampleDTO->getDescription(),
            'short_description' => $workSampleDTO->getShortDescription(),
            'show_in_first_page' => $workSampleDTO->getShowInFirstPage(),
            'double_image' => $workSampleDTO->getDoubleImage(),
            'has_page' => $workSampleDTO->getHasPage(),
            'url' => $workSampleDTO->getUrl(),
        ]);
        //relations
        $work_sample->services()->attach($workSampleDTO->getServices());

        if ($workSampleDTO->getDoubleImage() == 0) {
            foreach ($workSampleDTO->getImage() as $key => $item) {
                $image = null;
                if ($item) {
                    $uploader = new FileUploader($item, "uploads/work-sample");
                    $uploader->setExtensions(["jpeg", "webp", "png", "jpg"]);
                    $uploader->setSizes([
                        "big" => [1000, 1000],
                        "medium" => [500, 500],
                        "small" => [75, 75],
                    ]);
                    $image = $uploader->upload();
                }
                WorkSampleImage::create([
                    'image' => $image,
                    'work_sample_id' => $work_sample->id,
                ]);
            }
        } else {
            $after_image = null;
            if ($workSampleDTO->getAfterImage()) {
                $uploader = new FileUploader($workSampleDTO->getAfterImage(), "uploads/work-sample");
                $uploader->setExtensions(["jpeg", "webp", "png", "jpg"]);
                $uploader->setSizes([
                    "big" => [1000, 1000],
                    "medium" => [500, 500],
                    "small" => [75, 75],
                ]);
                $after_image = $uploader->upload();
            }
            $before_image = null;
            if ($workSampleDTO->getBeforeImage()) {
                $uploader = new FileUploader($workSampleDTO->getBeforeImage(), "uploads/work-sample");
                $uploader->setExtensions(["jpeg", "webp", "png", "jpg"]);
                $uploader->setSizes([
                    "big" => [1000, 1000],
                    "medium" => [500, 500],
                    "small" => [75, 75],
                ]);
                $before_image = $uploader->upload();
            }
            WorkSampleImage::create([
                'image' => $before_image,
                'before_image' => 1,
                'work_sample_id' => $work_sample->id,
                'thumbnail' => $workSampleDTO->getThumbnail(),
            ]);
            WorkSampleImage::create([
                'image' => $after_image,
                'before_image' => 0,
                'work_sample_id' => $work_sample->id,
                'thumbnail' => $workSampleDTO->getThumbnail(),
            ]);
        }
    }

    public function update(int $id, WorkSampleDTO $workSampleDTO): void
    {
        $work_sample = WorkSample::findOrFail($id);
        $work_sample->update([
            'title' => $workSampleDTO->getTitle(),
            'description' => $workSampleDTO->getDescription(),
            'short_description' => $workSampleDTO->getShortDescription(),
            'show_in_first_page' => $workSampleDTO->getShowInFirstPage(),
            'double_image' => $workSampleDTO->getDoubleImage(),
            'has_page' => $workSampleDTO->getHasPage(),
            'url' => $workSampleDTO->getUrl(),
        ]);
        //relations
        $work_sample->services()->sync($workSampleDTO->getServices());
        if ($workSampleDTO->getDoubleImage() == 0) {
            foreach ($workSampleDTO->getImage() as $key => $item) {
                $image = null;
                if ($item) {
                    $uploader = new FileUploader($item, "uploads/work-sample");
                    $uploader->setExtensions(["jpeg", "webp", "png", "jpg"]);
                    $uploader->setSizes([
                        "big" => [1000, 1000],
                        "medium" => [500, 500],
                        "small" => [75, 75],
                    ]);
                    $image = $uploader->upload();
                }
                WorkSampleImage::create([
                    'image' => $image,
                    'work_sample_id' => $work_sample->id,
                ]);
            }
        } else {
            $after_image = null;
            if ($workSampleDTO->getAfterImage() != null) {
                $uploader = new FileUploader($workSampleDTO->getAfterImage(), "uploads/work-sample");
                $uploader->setExtensions(["jpeg", "webp", "png", "jpg"]);
                $uploader->setSizes([
                    "big" => [1000, 1000],
                    "medium" => [500, 500],
                    "small" => [75, 75],
                ]);
                $after_image = $uploader->upload();
                if ($work_sample->AfterImg != null){
                    $work_sample->AfterImg->update([
                        'image' => $after_image,
                        'before_image' => 0,
                        'work_sample_id' => $work_sample->id,
                        'thumbnail' => $workSampleDTO->getThumbnail(),
                    ]);
                }else{
                    WorkSampleImage::create([
                        'image' => $after_image,
                        'before_image' => 0,
                        'work_sample_id' => $work_sample->id,
                        'thumbnail' => $workSampleDTO->getThumbnail(),
                    ]);
                }

            }
            $before_image = null;
            if ($workSampleDTO->getBeforeImage() != null) {
                $uploader = new FileUploader($workSampleDTO->getBeforeImage(), "uploads/work-sample");
                $uploader->setExtensions(["jpeg", "webp", "png", "jpg"]);
                $uploader->setSizes([
                    "big" => [1000, 1000],
                    "medium" => [500, 500],
                    "small" => [75, 75],
                ]);
                $before_image = $uploader->upload();
                if ($work_sample->beforeImg != null){
                $work_sample->beforeImg->update([
                    'image' => $before_image,
                    'before_image' => 1,
                    'work_sample_id' => $work_sample->id,
                    'thumbnail' => $workSampleDTO->getThumbnail(),
                ]);

            }else{
                WorkSampleImage::create([
                    'image' => $before_image,
                    'before_image' => 1,
                    'work_sample_id' => $work_sample->id,
                    'thumbnail' => $workSampleDTO->getThumbnail(),
                ]);
            }

        }
        }
    }

    public function destroy(int $id)
    {
        WorkSample::destroy($id);
    }

    //clientSide
    public function findInFirstPage($paginate = 6)
    {
        return WorkSample::firstPage()->take($paginate)->get();
    }

    public static function findAll($query = [], $limit = null, $except_id = null)
    {
        $data = WorkSample::query();
        if (isset($query['first_page'])) {
            $data->firstPage();
        }
        if ($except_id) {
            $data->where('id', '<>', $except_id);
        }
        if (isset($query['related'])) {
            $data->whereHas('services', function ($query2) use ($query) {
                $query2->where("service_id", $query['specific_id']);
            });

        }
        if ($limit != null) {

            return $data->take($limit)->orderBy('id', 'DESC')->get();
        } else {

            return $data->orderBy('id', 'DESC')->get();
        }

    }

    public static function findPaginate($query = [], $limit = null)
    {
        $data = WorkSample::query();
        if (isset($query['first_page'])) {
            $data->firstPage();
        }
        if (isset($query['related'])) {
            $service = Service::find($query['specific_id']);
            $service_array = [];

            // Add the specific ID to the array
            $service_array[] = $query['specific_id'];

            // Iterate over the children of the service
            foreach ($service->children as $child) {
                // Add the child ID to the array
                $service_array[] = $child['id'];

                // Check if the child has its own children and add their IDs
                if (count($child->children) > 0) {
                    foreach ($child->children as $row) {
                        $service_array[] = $row['id'];
                    }
                }
            }

            // Modify the query to filter by the collected service IDs
            $data->whereHas('services', function ($query2) use ($service_array) {
                $query2->whereIn('service_id', $service_array);
            });
            $limit = $data->count();
        }


        if ($limit != null) {
            return $data->orderBy('id', 'DESC')->paginate($limit);
        } else {
            return $data->orderBy('id', 'DESC')->get();
        }


    }

    public static function findOne($url)
    {
        return WorkSample::where('url', $url)->firstOrFail();

    }
}
