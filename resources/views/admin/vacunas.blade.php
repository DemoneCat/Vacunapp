@php
    use Carbon\Carbon;
@endphp

@extends('layouts.master')

@section('content')

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearVacunaModal">
        Agregar
    </button>
    <table class="table mt-2">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Aplicacion (Meses)</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vacunas as $v)
                <tr>
                    <td>{{$v->id}}</td>
                    <td>{{$v->nombre}}</td>
                    <td>{{$v->periodo_aplicacion_meses}}</td>
                    <td>
                        <a href="#" onclick="detallesVacuna({{$v->id}})" class="btn btn-primary">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="#" class="btn btn-warning">
                            <i class="fa fa-pencil"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal -->
  <div class="modal fade" id="crearVacunaModal" tabindex="-1" aria-labelledby="crearVacunaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="crearVacunaModalLabel">Crear vacuna</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('vacuna.crear')}}" method="post">
        <div class="modal-body">
                @csrf
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" name="nombre" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">¿Cuando se aplica? (Meses)</label>
                    <input type="number" name="periodo_aplicacion_meses" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Descripcion</label>
                    <textarea name="descripcion" id="descripcionVacuna" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="">¿Qué cura?</label>
                    <input type="text" name="cura" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Url para más detalles</label>
                    <input type="text" name="url_detalles" class="form-control">
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


  <div class="modal fade" id="detallesVacunaModal" tabindex="-1" aria-labelledby="detallesVacunaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="detallesVacunaModalLabel">Detalles</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="">
                <div class="form-group">
                    <label for="nombre_det">Nombre:</label>
                    <input type="text" id="nombre_det" class="form-control" aria-describedby="helpId" disabled>
                </div>

                <div class="form-group">
                    <label for="periodo_aplicacion_det">Periodo de aplicacion: (Meses)</label>
                    <input type="text" id="periodo_aplicacion_det" class="form-control" aria-describedby="" disabled>
                </div>
                <div class="form-group">
                    <label for="descripcion_det">Descripción:</label>
                    <input type="text" id="descripcion_det" class="form-control" aria-describedby="" disabled>
                </div>
                <div class="form-group">
                    <label for="cura_det">¿Qué Cura?</label>
                    <input type="text" id="cura_det" class="form-control" aria-describedby="" disabled>
                </div>
                <div class="form-group">
                    <label for="url_detalles_det">Url para detalles:</label>
                    <a href="#" id="url_detalles_det">Enlace</a>
                </div>
                <div class="form-group">
                    <label for="created_at_det">Agregada al sistema el:</label>
                    <input type="text" id="created_at_det" class="form-control" aria-describedby="" disabled>
                </div>
                <div class="form-group">
                    <label for="updated_at_det">Última actualización:</label>
                    <input type="text" id="updated_at_det" class="form-control" aria-describedby="" disabled>
                </div>
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
            nombre: document.getElementById('nombre_det'),
            periodo_aplicacion_meses: document.getElementById('periodo_aplicacion_det'),
            descripcion: document.getElementById('descripcion_det'),
            cura: document.getElementById('cura_det'),
            url_detalles: document.getElementById('url_detalles_det'),
            created_at: document.getElementById('created_at_det'),
            updated_at: document.getElementById('updated_at_det')
        };
    const url_detalles_vacuna = "{{route('vacuna.search')}}";
    function detallesVacuna(id){
        fetch(url_detalles_vacuna + "?id="+id, {
            method: 'GET',
        }).then(res => res.json())
        .then(
            response => setVacunaDataModal(response)
        );
    }
    function setVacunaDataModal(data){
        elemsDetalles.nombre.value = data.nombre;
        elemsDetalles.periodo_aplicacion_meses.value = data.periodo_aplicacion_meses;
        elemsDetalles.descripcion.value = data.descripcion;
        elemsDetalles.cura.value = data.cura;
        elemsDetalles.url_detalles.setAttribute('href', data.url_detalles);
        elemsDetalles.created_at.value = data.created_at;
        elemsDetalles.updated_at.value = data.updated_at;

        $('#detallesVacunaModal').modal('show');
    }
</script>

@endsection
