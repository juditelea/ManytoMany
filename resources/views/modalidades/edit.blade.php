@extends('layouts.template')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h2>Alterar Modalidade</h2>
            <ul class="nav">
                <li class="nav-item"><a href="{{route('modalidade.index')}}">Listar Modalidades</a> </li>
            </ul>
            @if(session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <form action="{{route('modalidade.update',[$mod->id])}}" method="post">
                {{csrf_field()}}
                {{method_field('PUT')}}
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome..." value="{{$mod->nome}}" required>
                </div>
                <div class="form-group">
                    <label for="horario">Horário:</label>
                    <input type="text" name="horario" id="horario" class="form-control" placeholder="Horário..." value="{{$mod->horario}}"
                            required>
                </div>
                <button type="submit" class="btn btn-primary">Alterar</button>

            </form>
        </div>
    </div>
@endsection