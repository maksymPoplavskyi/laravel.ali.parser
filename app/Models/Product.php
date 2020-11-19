<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'products';

    public $timestamps = true;

    protected $fillable = [
        'category_id',
        'description',
        'old_price', 'price', 'sales',
        'img_url',
        'order_count', 'stock_availability',
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
