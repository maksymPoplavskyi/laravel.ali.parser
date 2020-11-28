<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryLocalization extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'category_localization';

    public $timestamps = false;

    protected $fillable = [
        'category_id', 'localization_name', 'category_name'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
