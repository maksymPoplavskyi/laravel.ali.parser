<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductLocalization extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'product_localization';

    public $timestamps = false;

    protected $fillable = [
      'product_id', 'lang', 'value'
    ];
}
