<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libraries\Ultilities;
use App\Models\Banners;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    //
    public function store(Request $request, Banners $banners)
    {
        try {
            if($request->hasFile('album')){
                $files = $request->file('album');
                $deliBannersAr = [];
                foreach($files as $file){
                    $name = Ultilities::uploadFile($file);
                    $deliBannersAr[] = [
                        'image'=>$name,
                    ];
                }
                $banners->insert($deliBannersAr);
                return back()
                ->with([
                    'alert-type' => 'success', 'message' => __('Lưu hình ảnh thành công')
                ]);
            }
            return back()
            ->with(['alert-type' => 'error', 'message' => __('Không có hình ảnh')])
            ->withInput();
        } catch (\Exception $e) {
                return back()
            ->with('exception', $e->getMessage())
            ->with(['alert-type' => 'error', 'message' => __('Lưu hình ảnh thất bại')])
            ->withInput();
        }
    }

    public function destroyBanner(Request $request, Banners $banners)
    {
        $banners->where('id', $request->id)->delete();
    }
}
