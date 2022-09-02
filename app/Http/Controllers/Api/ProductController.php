<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Resources\ProductCollection;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class ProductController extends BaseController
{
    /**
     * Product api
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Product::datatable([
            'fields' => [
                "products.id" => 'id',
                "products.name" => 'name',
                "products.category_id" => 'category_id',
                "products.description" => 'description',
                "products.image" => 'image',
                "products.price" => 'price',
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
        ], ProductCollection::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Product::create($request->all());
    }

    public function update(Request $request)
    {
        $product = Product::findOrFail($request->get('id'));
        return $product->update($request->all());
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return Product::destroy($request->get('id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroyMany(Request $request)
    {
        foreach ($request->get('id') as $id) {
            Product::destroy($id);
        }

        return true;
    }
}
