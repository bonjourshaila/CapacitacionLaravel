@extends('layouts.layout')
@section('content')
<div class="row">
    <section class="content">
        <div class="col-md-8 col-md-offset-2">
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Error!</strong> Revise los campos obligatorios.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if(Session::has('success'))
            <div class="alert alert-info">
                {{Session::get('success')}}
            </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Editar empleado</h3>
                </div>
                <div class="panel-body">
                    <div class="table-container">
                        <form method="POST" action="{{ route('empleado.update',$empleado->id) }}" role="form">
                            {{ method_field('PUT') }}
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="input-group-prepend col-md-4">
                                        <span class=" col-md-12">Nombre</span>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="nombre" id="nombre" class="form-control input-sm"
                                            value="{{$empleado->nombre}}">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="input-group-prepend col-md-4">
                                        <span class=" col-md-12">Puesto</span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="puesto" id="puesto" class="form-control input-sm"
                                            value="{{$empleado->puesto}}">
                                    </div>
                                </div>

                            </div>




                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="input-group-prepend col-md-4">
                                        <span class=" col-md-12">Email</span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="email" id="email" class="form-control input-sm"
                                            value="{{$empleado->email}}">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="input-group-prepend col-md-4">
                                        <span class=" col-md-12">Edad</span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="edad" id="edad" class="form-control input-sm"
                                            value="{{$empleado->edad}}">
                                    </div>
                                </div>

                            </div>





                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="input-group-prepend col-md-4">
                                        <span class=" col-md-12">Antigüedad</span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="antiguedad" id="antiguedad"
                                            class="form-control input-sm" value="{{$empleado->antiguedad}}">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="input-group-prepend col-md-4">
                                        <span class=" col-md-12">Sueldo</span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="sueldo" id="sueldo" class="form-control input-sm"
                                            value="{{$empleado->sueldo}}">
                                    </div>
                                </div>

                            </div>



                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="input-group-prepend col-md-6">
                                        <span class=" col-md-12">Modeda del sueldo</span>
                                    </div>
                                    <div class="form-group">
                                        <select name="moneda_sueldo" id="moneda_sueldo" class="form-control">
                                            @foreach($arrayCurrencies as $c)
                                            @if($c == $empleado->moneda_sueldo)
                                            <option value="{{$c}}" selected>{{$c}}</option>
                                            @else
                                            <option value="{{$c}}">{{$c}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        <!-- <input type="text" name="moneda_sueldo" id="moneda_sueldo" class="form-control input-sm" value="{{$empleado->moneda_sueldo}}"> -->
                                    </div>
                                </div>


                            </div>

                            <div class="row">

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <input type="submit" value="Actualizar" class="btn btn-success btn-block">
                                    <a href="{{ route('empleado.index') }}" class="btn btn-info btn-block">Atrás</a>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
    @endsection