@php
    use Carbon\Carbon;
@endphp

@extends('layouts.master')

@section('content')

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearHijoModal">
        Agregar
    </button>
    <table class="table mt-2">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Nombre Completo</th>
                <th>Fecha de Nacimiento</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hijos as $h)
                <tr>
                    <td>{{$h->id}}</td>
                    <td>{{$h->nombres}} {{$h->apellidos}}</td>
                    <td>{{$h->fecha_nacimiento}}</td>
                    <td>
                        <a href="#" onclick="detallesVacuna({{$h->id}})" class="btn btn-primary">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="#" onclick="detallesHijoVacunas({{$h->id}})" class="btn btn-warning">
                            <i class="fa fa-pencil"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal -->
  <div class="modal fade" id="crearHijoModal" tabindex="-1" aria-labelledby="crearHijoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="crearHijoModalLabel">Agregar hijo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('hijo.create')}}" method="POST">
            <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="">Nombres</label>
                        <input type="text" name="nombres" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Apellidos</label>
                        <input type="text" name="apellidos" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Fecha de Nacimiento</label>
                        <input type="date" name="fecha_nacimiento" id="" class="form-control">
                    </div>
                    <input type="hidden" name="created_at" value="{{Carbon::now()}}">
                    <input type="hidden" name="updated_at" value="{{Carbon::now()}}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Crear</button>
            </div>
        </form>
      </div>
    </div>
  </div>


  <div class="modal fade" id="detallesHijoModal" tabindex="-1" aria-labelledby="detallesHijoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="detallesHijoModalLabel">Detalles</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="">
                <div class="form-group">
                    <label for="nombre_det">Nombre Completo:</label>
                    <input type="text" id="nombres_det" class="form-control" aria-describedby="helpId" disabled>
                </div>

                <div class="form-group">
                    <label for="periodo_aplicacion_det">Fecha nacimiento:</label>
                    <input type="text" id="fecha_nacimiento_det" class="form-control" aria-describedby="" disabled>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="setVacunasHijoModal" tabindex="-1" aria-labelledby="setVacunasHijoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="setVacunasHijoModalLabel">Detalles</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" method="POST">
                <input type="hidden" name="id_hijos" id="id_hijos">
                @foreach ($vacunas as $v)
                <div class="form-inline">
                    <div class="form-group ml-2">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="vacuna_id_"{{$v->id}}>
                            <label class="custom-control-label" for="vacuna_id_"{{$v->id}}>{{$v->nombre}}</label>
                        </div>
                    </div>
                    <div class="form-group ml-4">
                        <label for="" class="form-label mr-1">Fecha aplicacion vacuna</label>
                        <input type="date" class="form-control" name="fecha_aplicacion" placeholder="Fecha aplicacion">
                    </div>
                </div>

                @endforeach
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
<script>
    const elemsDetalles = {
            nombres: document.getElementById('nombres_det'),
            fecha_nacimiento: document.getElementById('fecha_nacimiento_det'),
        };
    const url_detalles_vacuna = "{{route('hijo.search')}}";
    const url_detalles_hijos_vacuna = "{{route('hijo.search-vacunas')}}";
    function detallesVacuna(id){
        fetch(url_detalles_hijos_vacuna + "?id="+id, {
            method: 'GET',
        }).then(res => res.json())
        .then(
            response => setVacunaDataModal(response)
        );
    }
    function setVacunaDataModal(data){
        console.log(data);
        elemsDetalles.nombres.value = data.nombres + " " + data.apellidos;
        elemsDetalles.fecha_nacimiento.value = data.fecha_nacimiento;
        $('#detallesHijoModal').modal('show');
    }
    function detallesHijoVacunas(id){
        $('#setVacunasHijoModal').modal('show');
        /*fetch(url_detalles_hijos_vacuna + "?id="+id, {
            method: 'GET',
        }).then(res => res.json())
        .then(
            response => setDetallesHijosVacuna(response)
        );*/
    }

    function setDetallesHijosVacuna(data){
        console.log(data);
    }
</script>

@endsection
