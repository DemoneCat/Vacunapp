<?php

namespace App\Http\Controllers;

use App\Models\Vacuna;
use App\Repo\Vacuna\VacunaRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;


//Controlador que administra las vacunas
class AdminController extends Controller
{
    protected $VacunaRepo;
    public function __construct(VacunaRepository $vr)
    {
        $this->VacunaRepo = $vr;
    }
    public function index(Request $request){
        $vacunas = $this->VacunaRepo->getAll();
        return view('admin.vacunas')->with(compact([
            'vacunas'
        ]));
    }
    public function createVacunas(Request $request){
        $vacunaInstance = new Vacuna;
        $data = $request->only($vacunaInstance->getFillable());
        $vacunaInstance->fill($data);
        $this->VacunaRepo->create($vacunaInstance);

        return back();
        /*
        $vacunaInstance->nombre = $request->nombre;
        $vacunaInstance->periodo_aplicacion_meses = $request->periodo_aplicacion_meses;
        $vacunaInstance->descripcion = $request->descripcion;
        $vacunaInstance->cura = $request->cura;
        $vacunaInstance->url_detalles = $request->url_detalles;
        $vacunaInstance->created_at = Carbon::now();
        $vacunaInstance->updated_at = Carbon::now();*/
    }
}
