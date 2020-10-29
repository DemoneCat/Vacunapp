<?php

namespace App\Repo\Vacuna;

use App\Models\Vacuna;
use App\Repo\BaseRepository;

class VacunaRepository extends BaseRepository{
    public function getModel()
    {
        return new Vacuna;
    }

}
