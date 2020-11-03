@php
    use Carbon\Carbon;
@endphp
@extends('layouts.master')

@section('content')
    <div class="container">
        <h3>Detalles de: {{$hijo->nombres}} {{$hijo->apellidos}}</h3>
        <div class="row mt-2">
            @foreach ($vacunas as $v)
        <div class="col mt-2">
            <div class="card" >
            <img src="{{$v->url_detalles}}" class="card-img-top" alt="foto-vacuna">
                <div class="card-body">
                    <h2>{{$v->nombre}}</h2>
                    <p class="card-text">
                        {{$v->descripcion}}
                    </p>
                    <p>
                        CURA: {{ $v->cura }}
                    </p>
                    @if ($v->fecha_aplicacion != null)
                        <span class="badge badge-success">Aplicada el: {{ $v->fecha_aplicacion }}</span>
                    @else
                        <span class="badge badge-danger">Vacuna atrasada</span>
                    @endif
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary btn-lg btn-block">Más detalles</a>
                </div>
              </div>
        </div>
        @endforeach
        </div>
    </div>
@endsection
