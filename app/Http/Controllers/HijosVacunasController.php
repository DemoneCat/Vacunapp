<?php

namespace App\Http\Controllers;

use App\Repo\Vacuna\VacunaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HijosVacunasController extends Controller
{
    protected $vR;
    public function __construct(VacunaRepository $vR)
    {
        $this->vR = $vR;
    }
    public function index(Request $request){
        $vacunas = $this->vR->getHijosVacunas($request->id_hijo);
        $hijo = DB::table('hijos')->where('id', $request->id_hijo)->first();
        return view('hijo.hijo_detalles')->with(compact([
            'vacunas',
            'hijo'
        ]));
    }
}
