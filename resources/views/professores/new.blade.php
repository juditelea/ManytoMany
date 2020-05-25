@extends('layouts.template')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h2>Adicionar Professor</h2>
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
            <form action="{{route('professor.store')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome..." value="{{old('nome')}}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email..." value="{{old('email')}}"
                           required>
                </div>
                <div class="form-group">
                    <label for="modalidade">Modalidade:</label>
                    <select multiple name="modalidade[]" id="modalidade" class="form-control" required>
                        <option value="" selected disabled>SELECIONE</option>
                        @if(!empty($modalidades))
                            @foreach($modalidades as $m)
                                <option value="{{$m->id}}">{{$m->nome}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Adicionar</button>

            </form>
        </div>
    </div>
@endsection