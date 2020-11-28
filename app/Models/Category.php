<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'categories';

    public $timestamps = 'false';

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function categoryLocalization()
    {
        return $this->hasMany(CategoryLocalization::class);
    }
}
