<?php

namespace App\Repo\Hijo;

use App\Models\Hijo;
use App\Repo\BaseRepository;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\DB;

class HijoRepository extends BaseRepository{
    public function getModel()
    {
        return new Hijo;
    }
    public function getAllByUser($id_user){
        return $this->getModel()->where('id_user', $id_user)->paginate(5);
    }
    public function createHijosVacunas($vacunas, $fechas_aplicacion, $id_hijos){
        $iterable = array_combine($vacunas, $fechas_aplicacion);
        foreach($iterable as $vacuna => $fecha){
            DB::table('hijos_vacunas')
            ->insert([
                'id_hijos' => $id_hijos,
                'id_vacunas' => $vacuna,
                'fecha_aplicacion' => $fecha,
                'created_at' => Carbon::now()->toDateString(),
                'updated_at' => Carbon::now()->toDateString()
            ]);
        }

    }
    public function getVacunasByHijo($id_hijo){
        $data = DB::table('hijos')
        ->join('hijos_vacunas', 'hijos_vacunas.id_hijos', 'hijos.id')
        ->join('vacunas', 'vacunas.id', 'hijos_vacunas.id_vacunas')
        ->where('hijos.id', $id_hijo)
        ->select('vacunas.nombre',
        'vacunas.periodo_aplicacion_meses',
        'vacunas.cura',
        'hijos_vacunas.fecha_aplicacion')
        ->get();
        return $data;
    }
}
