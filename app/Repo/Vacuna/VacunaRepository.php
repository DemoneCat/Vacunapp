<?php

namespace App\Repo\Vacuna;

use App\Models\Vacuna;
use App\Repo\BaseRepository;
use Illuminate\Support\Facades\DB;

class VacunaRepository extends BaseRepository{
    public function getModel()
    {
        return new Vacuna;
    }
    public function getHijosVacunas($id_hijo){
        $data = DB::table('hijos')
        ->join('hijos_vacunas', 'hijos_vacunas.id_hijos', 'hijos.id')
        ->join('vacunas', 'vacunas.id', 'hijos_vacunas.id_vacunas')
        ->where('hijos.id', $id_hijo)
        ->select('vacunas.*',
        /*'vacunas.periodo_aplicacion_meses',
        'vacunas.cura',*/
        'hijos_vacunas.fecha_aplicacion as fecha_aplicacion')
        ->get();
        return $data;
    }
}
