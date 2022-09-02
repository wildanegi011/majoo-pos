<?php

namespace App\Models;

use App\Http\Resources\ProductCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Svknd\Datatable\Traits\KTDatatable;
use Svknd\Laravel\Traits\Models\Uuid;

class Product extends Model
{
    use HasFactory, KTDatatable, Uuid;

    protected $fillable = [
        'name',
        'category_id',
        'description',
        'image',
        'price',
    ];

    public function category()
    {
        return $this->belongsTo(CategoryProduct::class, 'category_id');
    }
}
