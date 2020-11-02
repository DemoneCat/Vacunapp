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
        $data = $request->except('_token');
        $this->VacunaRepo->create($data);
        return back();
    }
    public function searchVacuna(Request $request){
        $vacuna = $this->VacunaRepo->find($request->id);
        return response()->json($vacuna);
    }
}
