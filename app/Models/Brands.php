<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Brands extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'brands';
    protected $fillable = ['brand_name', 'image', 'status'];
   
}
