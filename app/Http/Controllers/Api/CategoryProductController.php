<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Resources\CategoryProductCollection;
use App\Http\Resources\ProductCollection;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\User;

class CategoryProductController extends BaseController
{
    /**
     * Product api
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return CategoryProduct::datatable([
            'fields' => [
                "category_products.id" => 'id',
                "category_products.name" => 'name',
                "category_products.created_at" => 'created_at',
            ],
            'searchable' => [
                'operator' => 'like',
                'fields' => [
                    'name'
                ]
            ],
            'orders' => [
                ['sort' => 'asc', 'field' => 'created_at']
            ]
        ], CategoryProductCollection::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return CategoryProduct::create($request->all());
    }

    public function update(Request $request)
    {
        $categoryProduct = CategoryProduct::findOrFail($request->get('id'));
        return $categoryProduct->update($request->all());
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $categoryProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return CategoryProduct::destroy($request->get('id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $categoryProduct
     * @return \Illuminate\Http\Response
     */
    public function destroyMany(Request $request)
    {
        foreach ($request->get('id') as $id) {
            CategoryProduct::destroy($id);
        }

        return true;
    }
}
