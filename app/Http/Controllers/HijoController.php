<?php

namespace App\Http\Controllers;

use App\Http\Requests\HijoCreate;
use App\Repo\Hijo\HijoRepository;
use App\Repo\Vacuna\VacunaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HijoController extends Controller
{
    protected $hR, $vR;
    public function __construct(HijoRepository $hR, VacunaRepository $vR)
    {
        $this->hR = $hR;
        $this->vR = $vR;
    }
    public function index(Request $request){
        $hijos = $this->hR->getAllByUser(Auth::id());
        $vacunas = $this->vR->getAll();
        return view('hijo.index')->with(compact([
            'hijos',
            'vacunas'
        ]));
    }
    public function createHijo(HijoCreate $request){
        $request->request->add(['id_user' => 1]);
        $data = $request->except('_token');
        $this->hR->create($data);
        return back();
    }
    public function searchHijo(Request $request){
        $hijo = $this->hR->find($request->id);
        return response()->json($hijo);
    }
    public function searchVacunasHijo(Request $request){
        $vacunas = $this->hR->getVacunasByHijo($request->id);
        return response()->json($vacunas);
    }
    public function createHijoVacunas(Request $request){
        $this->hR->createHijosVacunas($request->vacuna_id, $request->fecha_aplicacion, $request->id_hijos);
        return back();
    }


}
