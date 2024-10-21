<?php

namespace Rahweb\CmsCore\Modules\Service\Services;

use Rahweb\CmsCore\Modules\General\Helper\FileManager;
use Rahweb\CmsCore\Modules\General\Helper\FileUploader;
use Rahweb\CmsCore\Modules\General\Helper\MakeTree;
use Rahweb\CmsCore\Modules\Service\DTO\ServiceDTO;
use Rahweb\CmsCore\Modules\Service\Entities\Service;

class ServiceManager
{
    protected $serviceEntity;

    public function __construct(Service $serviceEntity)
    {
        $this->serviceEntity = $serviceEntity;
    }
    public static function findAll($query = [], $format = true, $except_id = null)
    {
        $services = Service::query();
        if ($except_id) {
            $services->where('id', '<>', $except_id);
        }
        if (isset($query['first_page'])) {
            $services->firstPage();
        }
        if (isset($query['layout'])) {
            $services->where('show_in_layout',1);
        }
        if (isset($query['list'])) {
            $services->whereNull('parent_id');
        }
        if (isset($query['related'])) {
            $services->where('parent_id',$query['parent_id']);
        }
        if (isset($query['blog'])) {
            $services->whereHas('blogs', function ($query2) use ($query) {
                $query2->where("blog_id", $query['specific_id']);
            });
        }

        $services = $services->orderby('id', 'DESC')->get();

        if ($format) {
            return self::formatServices($services->toArray());
        } else {
            return $services;
        }
    }
    public static function findOne($url)
    {
        return Service::where('url',$url)->firstOrFail();
    }

    public static function formatServices($services, $paginate = 50)
    {
        if (!empty($services) && count($services) > 0) {
            MakeTree::getData($services);
            $services = MakeTree::GenerateArray(array('paginate' => $paginate));
        }
        return $services;
    }

    public function create(ServiceDTO $serviceDTO): void
    {
        $image = null;
        if ($serviceDTO->getImage()) {
            $uploader = new FileUploader($serviceDTO->getImage(), "uploads/service");
            $uploader->setExtensions(["jpeg", "webp", "png", "jpg"]);
            $uploader->setSizes(["big" => [1200, 515]]);
            $image = $uploader->upload();
        }

        $header_image = $serviceDTO->getHeaderImage() ?
            FileManager::upload($serviceDTO->getHeaderImage(), "service")
            : null;

        Service::create([
            'title' => $serviceDTO->getTitle(),
            'description' => $serviceDTO->getDescription(),
            'url' => $serviceDTO->getUrl(),
            'parent_id' => $serviceDTO->getParentId(),
            'image' => $image,
            'show_in_first_page' => $serviceDTO->isShowInFirstPage(),
            'show_in_layout' => $serviceDTO->isShowInLayout(),
            'short_description' => $serviceDTO->getShortDescription(),
            'phone_number' => $serviceDTO->getPhoneNumber(),
            'header_image' => $header_image,
        ]);
    }

    public function update(int $id, ServiceDTO $serviceDTO): void
    {
        $service = Service::findOrFail($id);
        $image = $service->getRawOriginal('image');
        if ($serviceDTO->getImage()) {
            $uploader = new FileUploader($serviceDTO->getImage(), "uploads/service");
            $uploader->setExtensions(["jpeg", "webp", "png", "jpg"]);
            $uploader->setSizes(["big" => [1200, 515]]);
            $image = $uploader->upload();
        }

        $header_image = $serviceDTO->getHeaderImage() ?
            FileManager::upload($serviceDTO->getHeaderImage(), "service")
            : $service->getRawOriginal('header_image');
        $service->update([
            'title' => $serviceDTO->getTitle(),
            'description' => $serviceDTO->getDescription(),
            'url' => $serviceDTO->getUrl(),
            'parent_id' => $serviceDTO->getParentId(),
            'image' => $image,
            'show_in_first_page' => $serviceDTO->isShowInFirstPage(),
            'show_in_layout' => $serviceDTO->isShowInLayout(),
            'short_description' => $serviceDTO->getShortDescription(),
            'phone_number' => $serviceDTO->getPhoneNumber(),
            'header_image' => $header_image,
        ]);
    }

    public function getServiceIdsRecursive($service, &$services, $addToServices = true)
    {
        if ($addToServices) {
            $services[] = $service->id;
        }
        if ($service->children->isNotEmpty()) {
            foreach ($service->children as $child) {
                $this->getServiceIdsRecursive($child, $services);
            }
        }
    }

    public function deleteOne(int $id): void
    {
        $service = Service::findOrFail($id);

        //delete image
        if ($service->image) {
            FileManager::delete("service/small/" . $service->getRawOriginal('image'));
            FileManager::delete("service/big/" . $service->getRawOriginal('image'));
        }

        if ($service->header_image) {
            FileManager::delete("service/" . $service->getRawOriginal('header_image'));
        }

        //update children
        $services = [];
        $this->getServiceIdsRecursive($service, $services, false);
        $changes = Service::whereIn('id', $services)->get();
        foreach ($changes as $change) {
            $change->update([
                'parent_id' => null,
            ]);
        }
        //delete itself
        $service->delete();
    }

    public function deleteRoot(int $id)
    {
        $service = Service::findOrFail($id);

        //delete image
        if ($service->image) {
            FileManager::delete("service/small/" . $service->getRawOriginal('image'));
            FileManager::delete("service/big/" . $service->getRawOriginal('image'));
        }
        if ($service->header_image) {
            FileManager::delete("service/" . $service->getRawOriginal('header_image'));
        }

        //delete children
        $services = [];
        $this->getServiceIdsRecursive($service, $services, false);
        $children = Service::whereIn('id', $services)->get();
        foreach ($children as $child) {
            if ($child->image) {
                FileManager::delete("service/small/" . $child->getRawOriginal('image'));
                FileManager::delete("service/big/" . $child->getRawOriginal('image'));
            }
            if ($child->header_image) {
                FileManager::delete("service/" . $child->getRawOriginal('header_image'));
            }
            $child->delete();
        }
        //delete itself
        $service->delete();
    }

    public function findInFirstPage($paginate = 6)
    {
        return Service::firstPage()->take($paginate)->get();
    }

    public function findParents()
    {
        return Service::orderBy('id', 'DESC')->whereNull('parent_id')->get();
    }
}
