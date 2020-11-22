<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localization extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'localizations';

    public $timestamps = false;

    protected $keyType = 'string';

}
