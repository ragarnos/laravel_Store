<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\Contracts\FileStorageServiceContract;
use App\Services\FileStorageService;
use App\Services\ImagesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{

    public function index()
    {
        $products = Product::with('category')->paginate(10);

        return view('admin/products/index', compact('products'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('admin/products/create', compact('categories'));
    }


    public function store(CreateProductRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $images = $data['images'] ?? [];
            $category = Category::find($data['category']);
            $product = $category->products()->create($data); // category_id
            ImagesService::attach($product, 'imageasfasfs', $images);

            DB::commit();

            return redirect()->route('admin.products.index')
                ->with('status', "The product #{$product->id} was successfully created!");
        } catch (\Exception $e) {
            DB::rollBack();
            logs()->warning($e);
            return redirect()->back()->with('warn', 'Oops smth wrong. See logs')->withInput();
        }
    }


    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin/products/edit', compact('product', 'categories'));
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}