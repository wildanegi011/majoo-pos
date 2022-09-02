<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fields = ['id', 'product', 'category', 'price', 'action'];
        $fieldsToArray = collect($fields)->toArray();
        $fieldsToJson = collect($fields)->map(function ($query) {
            return ["data" => $query];
        })->toJson();

        return view('pages.product.index', compact('fieldsToJson', 'fieldsToArray'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listProduct(Request $request)
    {
        $products = $this->getResponse('listProduct', 'GET', $request);
        return view('welcome', compact('products'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatable(Request $request)
    {
        $search = $request->get('search')['value'] ? $request->get('search')['value'] : null;
        $request->merge(["query" => ["keywords" => $search]]);
        return $this->getResponse('product', 'GET', $request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $category =  $this->getResponse('category_product', 'GET', $request);
        return view('pages.product.form', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge(['image' => $request->session()->get('images')]);
        $this->validate($request, [
            'name' => 'required|unique:products,name',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
        ]);

        $response =  $this->getResponse('product/create', 'POST', $request);
        if ($response) {
            return redirect()->route('product.index')
                ->with('success', __('create new product successfuly'))
                ->with('title', __('Successfuly'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $category =  $this->getResponse('category_product', 'GET', $request);
        return view('pages.product.form', compact('product', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->merge(['id' => $id, 'image' => $request->session()->get('images')]);
        $this->validate($request, [
            'name' => 'required|unique:products,name,' . $id,
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
        ]);

        $response =  $this->getResponse('product/update', 'PUT', $request);
        if ($response) {
            return redirect()->route('product.index')
                ->with('success', __('update product successfuly'))
                ->with('title', __('Successfuly'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $request->merge(['id' => $id]);
        $response = $this->getResponse('product/destroy', 'DELETE', $request);

        if ($response) {
            return response()->json(['success' => true]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroyMany(Request $request)
    {
        $response = $this->getResponse('product/destroyMany', 'DELETE', $request);

        if ($response) {
            return response()->json(['success' => true]);
        }
    }
    public function upload(Request $request)
    {
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $request->session()->put('images', 'images/' . $filename);
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
}
