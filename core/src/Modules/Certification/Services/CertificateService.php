<?php
namespace Rahweb\CmsCore\Modules\Certification\Services;

use Rahweb\CmsCore\Modules\General\Helper\FileManager;
use Rahweb\CmsCore\Modules\General\Helper\FileUploader;
use Rahweb\CmsCore\Modules\Certification\DTO\CertificateDTO;
use Rahweb\CmsCore\Modules\Certification\Entities\Certificate;

class CertificateService
{

    public function create(CertificateDTO $certificateDTO)
    {
        $image = null;
        if ($certificateDTO->getImage()) {
            $uploader = new FileUploader($certificateDTO->getImage(), "uploads/certificate");
            $uploader->setExtensions(["jpeg", "webp", "png", "jpg"]);
            $uploader->setSizes(["big" => [300, 300]]);
            $image = $uploader->upload();
        }
        Certificate::create([
            'title' => $certificateDTO->getTitle(),
            'show_in_first_page' => $certificateDTO->getShowInFirstPage(),
            'image' => $image,
        ]);

    }
    public function update(int $id, CertificateDTO $certificateDTO)
    {
        $gallery = Certificate::findOrfail($id);
        $image = $gallery->getRawOriginal('image');
        if ($certificateDTO->getImage()) {
            $uploader = new FileUploader($certificateDTO->getImage(), "uploads/certificate");
            $uploader->setExtensions(["jpeg", "webp", "png", "jpg"]);
            $uploader->setSizes(["big" => [300, 300]]);
            $image = $uploader->upload();
        }
        $gallery->update([
            'title' => $certificateDTO->getTitle(),
            'show_in_first_page' => $certificateDTO->getShowInFirstPage(),
            'image' => $image,
        ]);
    }
    public function destroy(int $id)
    {
        Certificate::destroy($id);
    }
    //clientSide
    public static function findAll($query, $limit = 10)
    {
        $data = Certificate::query();
        if (isset($query['first_page'])) {
            $data->firstPage();
        }
        return $data->take($limit)->get();
    }
}
