@extends('layouts.template')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h2>Modalidades</h2>
            <a href="{{ route('modalidade.create') }}" class="btn btn-primary">Cadastrar</a>
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
            <table class="table table-responsive table-hover">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Horário</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($modalidades as $m)
                        <tr>
                            <td>{{$m->nome}}</td>
                            <td>{{$m->horario}}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{route('modalidade.edit',[$m->id])}}" class="btn btn-warning">Editar</a>
                                     <form action="{{route('modalidade.destroy',[$m->id])}}" method="post">
                                        {{csrf_field()}}{{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger">Excluir</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection