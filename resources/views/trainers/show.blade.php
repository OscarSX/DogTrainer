@extends('layouts.app')

@section('title', 'Trainer')

@section('content')
    @include('common.success')

    <img style="height: 200px; width:200px; margin:20px;" class="card-img-top rounded-circle mx-auto d-block" src="/images/{{$trainer->avatar}}" alt="Card image cap">
    <div class="text-center">
        <h5 class="card-title">{{$trainer->name}}</h5>
        <p>{{$trainer->description}}</p>
        <a href="/trainers/{{$trainer->slug}}/edit" class="btn btn-primary">Editar</a>

        <form class="form-group" method="POST" action="/trainers/{{$trainer->slug}}" enctype="multipart/form-data">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
    </div>
@endsection
