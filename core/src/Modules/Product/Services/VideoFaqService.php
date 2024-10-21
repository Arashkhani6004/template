<?php
namespace Rahweb\CmsCore\Modules\Product\Services;

use Rahweb\CmsCore\Modules\Faq\Entities\Faq;
use Rahweb\CmsCore\Modules\General\Helper\FileManager;
use Rahweb\CmsCore\Modules\Product\DTO\VideoFaqDTO;
use Rahweb\CmsCore\Modules\Product\Entities\Brand;
use Rahweb\CmsCore\Modules\Product\Entities\Video;

class VideoFaqService
{
    public function create(VideoFaqDTO $DTO)
    {

        foreach ($DTO->getVideos() as $video){
           if ($video['video_id'] == null){
               Video::create([
                  'code'=>$video['code'],
                  'product_id'=>$DTO->getProductId(),
               ]);
           }
           else{
               $check = Video::findOrFail($video['video_id']);
               $check->update([
                   'code'=>$video['code'],
               ]);
           }
        }
        foreach ($DTO->getFaqs() as $faq){
            if ($faq['faq_id'] == null){
                Faq::create([
                    'question'=>$faq['question'],
                    'answer'=>$faq['answer'],
                    'faqable_id'=>$DTO->getProductId(),
                    'faqable_type'=>'Rahweb\CmsCore\Modules\Product\Entities\Product',
                ]);
            }
            else{
                $check = Faq::findOrFail($faq['faq_id']);
                $check->update([
                    'question'=>$faq['question'],
                    'answer'=>$faq['answer'],
                ]);
            }
        }


    }

    public function deleteVideo(int $id): void
    {
        $video = Video::findOrFail($id);
        $video->delete();
    }
    public function deleteFaq(int $id): void
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();
    }





}
