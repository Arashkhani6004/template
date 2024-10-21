<?php

namespace Rahweb\CmsCore\Modules\General\Http\Controllers;

use Rahweb\CmsCore\Modules\General\Helper\FileManager;
use Rahweb\CmsCore\Modules\Product\Entities\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminController
{
    public function dashboard(Request $request)
    {
        return view('CmsCore::dashboard.index');
    }

    public function ckeditor()
    {
        return view('CmsCore::ckeditor');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            if(strtolower($request->file('upload')->getClientOriginalExtension()) == "gif"){
                $fileName = FileManager::uploadRaw($request->file('upload'), "content");
            }else{
                $fileName = FileManager::upload($request->file('upload'), "content");
            }

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = FileManager::serveFile(
                'uploads/content/' . $fileName, 'assets/notfounds/default.jpg'
            );

            $msg = 'تصویر با موفقیت بارگذاری شد.';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }

    public function removeImage(Request $request)
    {
        $model = $request->get('model');
        $column = $request->get('name');
        $id = $request->get('id');

        $x = $model::findOrFail($id);

        $x->update([
            $column => null
        ]);
        return Redirect::back()->with('success', 'تصویر با موفقیت حذف شد');

    }

    public function deleteImage(Request $request)
    {
        $model = $request->get('model');
        $id = $request->get('id');
        if ($model == "Rahweb\CmsCore\Modules\Product\Entities\Image") {
            $image = $model::findOrFail($id);
            $model::destroy($id);
            $product = Product::findOrFail($image->product_id);
            if ($image->image == $product->image) {


                $product->update(
                    [
                        'image' => count($product->images) > 0 ? @$product->images[0]->image : null
                    ]
                );
            }

        } else {
            $model::destroy($id);
        }


        return Redirect::back()->with('success', 'تصویر با موفقیت حذف شد');

    }

    public function setThumb(Request $request)
    {
        $model = $request->get('model');
        $id = $request->get('id');
        $product = Product::findOrFail($request->get('product_id'));
        foreach ($product->images as $img) {
            $img->update([
                'thumbnail' => 0
            ]);
        }
        $thumb = $model::findOrFail($id);
        $thumb->update([
            'thumbnail' => 1
        ]);
        $product->update(
            [
                'image' => $thumb['image']
            ]
        );


        return Redirect::back()->with('success', 'تصویر با موفقیت حذف شد');

    }

    public function sortImage(Request $request)
    {
        if ($request->get('update') == "update") {
            $model = $request->get('model');
            $count = 1;
            if ($request->get('update') == 'update') {
                foreach ($request->get('arrayorder') as $idval) {

                    $sort = $model::find($idval);
                    $sort->sort = $count;
                    $sort->save();
                    $count++;
                }
                echo 'با موفقیت ذخیره شد.';
            }
        }

    }

    public function cropper(Request $request)
    {
//        dd($request->all());
        return view('CmsCore::components.cropper.cropper');
    }
}
