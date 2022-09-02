<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CategoryProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fields = ['id', 'name', 'created_at', 'action'];
        $fieldsToArray = collect($fields)->toArray();
        $fieldsToJson = collect($fields)->map(function ($query) {
            return ["data" => $query];
        })->toJson();

        return view('pages.category.index', compact('fieldsToJson', 'fieldsToArray'));
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
        return $this->getResponse('category_product', 'GET', $request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('pages.category.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:category_products,name',
        ]);

        $response =  $this->getResponse('category_product/create', 'POST', $request);
        if ($response) {
            return redirect()->route('category.index')
                ->with('success', __('create new category successfuly'))
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
        $category = CategoryProduct::findOrFail($id);
        return view('pages.category.form', compact('category'));
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
        $request->merge(['id' => $id]);
        $this->validate($request, [
            'name' => 'required|unique:category_products,name',
        ]);

        $response =  $this->getResponse('category_product/update', 'PUT', $request);
        if ($response) {
            return redirect()->route('category.index')
                ->with('success', __('update category successfuly'))
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
        $response = $this->getResponse('category_product/destroy', 'DELETE', $request);

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
        $response = $this->getResponse('category_product/destroyMany', 'DELETE', $request);

        if ($response) {
            return response()->json(['success' => true]);
        }
    }
}
