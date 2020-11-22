<?php


namespace App\Repositories;


use App\Models\Localization;
use Illuminate\Database\Eloquent\Model;

class LocalizationRepository extends CoreRepository
{

    public function getModel(): Model
    {
        return Localization::getModel();
    }
}
