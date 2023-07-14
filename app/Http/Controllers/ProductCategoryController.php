<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Http\Requests\ProductCategory\StoreProductCategoryRequest;
use Spatie\MediaLibrary\MediaCollections\Models\Media as ModelsMedia;
use Spatie\MediaLibrary\Models\Media;

class ProductCategoryController extends Controller
{
    public function index()
    {
    }

    public function create()
    {
        return view('dashboard.category.create');
    }

    public function store(StoreProductCategoryRequest $request)
    {

        $productCategory = new ProductCategory();
        $productCategory->category_name = $request->category_name;
        $productCategory->category_name_english = $request->category_name_english;
        $productCategory->category_order = $request->category_order;
        $productCategory->category_status = $request->category_status;
        $isSave = $productCategory->save();
        if ($request->hasFile('avatar')) {
            $file = $request->avatar;
            $imageName = time() . '_' . $productCategory->id . '.' . $file->getClientOriginalExtension();
            $productCategory->addMedia($file)->usingFileName($imageName)->toMediaCollection('category_image');
        }
        if ($isSave) {
            toastr()->success('category created successfully.');
        } else {
            toastr()->error('category created unsuccessfully.');
        }
        return redirect()->back();
    }

    public function show($id)
    {
        $productCategory = ProductCategory::find($id);
        $productCategory->delete();
        toastr()->success('category deleteed successupdatefully.');
        return redirect()->back();
    }


    public function edit($id)
    {
        $productCategory =   ProductCategory::find($id);
        return view('dashboard.category.edit', compact('productCategory'));
    }

    public function update(StoreProductCategoryRequest $request, $id)
    {
        $productCategory =   ProductCategory::find($id);
        $productCategory->category_name = $request->category_name;
        $productCategory->category_name_english = $request->category_name_english;
        $productCategory->category_order = $request->category_order;
        $productCategory->category_status = $request->category_status;
        $isSave = $productCategory->save();
        if ($request->hasFile('avatar')) {
            ModelsMedia::where('model_id', $id)->where('model_type', 'App\Models\ProductCategory')->delete();
            $file = $request->avatar;
            $imageName = time() . '_' . $productCategory->id . '.' . $file->getClientOriginalExtension();
            $productCategory->addMedia($file)->usingFileName($imageName)->toMediaCollection('category_image');
        }

        if ($isSave) {
            toastr()->success('category updateed successupdatefully.');
        } else {
            toastr()->error('category updateed unsuccessfully.');
        }
        return redirect()->back();
    }


    public function destroy($locale, $product_category_id)
    {
        $productCategory = ProductCategory::find($product_category_id);
        $productCategory->delete();
        toastr()->error('category deleteed unsuccessfully.');
        return redirect()->back();
    }
}
