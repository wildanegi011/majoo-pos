<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Svknd\Datatable\Traits\KTDatatable;
use Svknd\Laravel\Traits\Models\Uuid;

class CategoryProduct extends Model
{
    use HasFactory, KTDatatable, Uuid;

    protected $fillable = [
        'name',
    ];
}
