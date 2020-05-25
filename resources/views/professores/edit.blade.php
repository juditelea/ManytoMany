@extends('layouts.template')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h2>Alterar Professor</h2>
            <ul class="nav">
                <li class="nav-item"><a href="{{route('professor.index')}}">Listar Professores</a> </li>
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
            <form action="{{route('professor.update',[$prof->id])}}" method="post">
                {{csrf_field()}}
                {{method_field('PUT')}}
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome..." value="{{$prof->nome}}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email..." value="{{$prof->email}}"
                           required>
                </div>
                <div class="form-group">
                    <label for="modalidade">Modalidade:</label>
                    <select multiple name="modalidade[]" id="modalidade" class="form-control" required>
                        @if(!empty($modalidades))
                            @foreach($modalidades as $m)
                                @if(in_array($m->id,$prof->modalidadeArray()))
                                    <option value="{{$m->id}}" selected>{{$m->nome}}</option>
                                @else
                                    <option value="{{$m->id}}">{{$m->nome}}</option>
                                @endif
                            @endforeach
                        @endif
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Alterar</button>

            </form>
        </div>
    </div>
@endsection