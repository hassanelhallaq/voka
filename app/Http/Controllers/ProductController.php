<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\product\StoreProductRequest;
use App\Models\Branch;
use App\Models\ProductCategory;
use App\Models\Product;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media as ModelsMedia;
use Spatie\MediaLibrary\Models\Media;

class ProductController extends Controller
{
    public function index()
    {
        $product_categories = ProductCategory::with(
            ['Product']
        )->orderBy('category_status', 'desc')->get();
        $product_categories_count = ProductCategory::orderBy('category_status', 'desc')->count();

        return view('dashboard.product.index', compact(
            'product_categories',
            'product_categories_count'
        ));
    }

    public function create()
    {
        $branches =  Branch::all();
        return view('dashboard.product.create', compact('branches'));
    }

    public function store(StoreProductRequest $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->calories = $request->calories;
        $product->quantity_stock = $request->quantity_stock;
        $product->name_english = $request->name_english;
        $product->description = $request->desc_arabic;
        $product->description_english = $request->desc_english;
        $product->price = $request->price;
        $isSave = $product->save();
        $product->branches()->attach($request->branch_id);

        if ($request->hasFile('avatar')) {
            $file = $request->avatar;
            $imageName = time() . '_' . $product->id . '.' . $file->getClientOriginalExtension();
            $product->addMedia($file)->usingFileName($imageName)->toMediaCollection('product');
        }
        if ($isSave) {
            toastr()->success('product created successfully.');
        } else {
            toastr()->error('product created unsuccessfully.');
        }
        return redirect()->back();
    }

    public function show($id)
    {
        $product = Product::find($id);
        $product->delete();
        toastr()->success('product deleteed successupdatefully.');
        return redirect()->back();
    }


    public function edit($id)
    {
        $product =  Product::find($id);
        $branches =  Branch::all();

        return view('dashboard.product.edit', compact('product', 'branches'));
    }

    public function update(StoreProductRequest $request, $id)
    {
        $product =   Product::find($id);
        $product->name = $request->name;
        $product->calories = $request->calories;
        $product->quantity_stock = $request->quantity_stock;
        $product->name_english = $request->name_english;
        $product->description = $request->desc_arabic;
        $product->description_english = $request->desc_english;
        $product->price = $request->price;
        $isSave = $product->save();
        if ($request->hasFile('avatar')) {
            ModelsMedia::where('model_id', $id)->where('model_type', 'App\Models\Product')->delete();
            $file = $request->avatar;
            $imageName = time() . '_' . $product->id . '.' . $file->getClientOriginalExtension();
            $product->addMedia($file)->usingFileName($imageName)->toMediaCollection('product');
        }
        if ($isSave) {
            $product->branches()->detach();
            $product->branches()->attach($request->branch_id);

            toastr()->success('product updateed successupdatefully.');
        } else {
            toastr()->error('product updateed unsuccessfully.');
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

    public function ajaxProductBranches(Request $request)
    {
        $brnachId = $request->id;
        $products = Product::with('branches')->whereHas('branches', function ($q) use ($brnachId) {
            $q->where('branch_id', $brnachId);
        })->get();
        return response()->json($products);
    }
}
