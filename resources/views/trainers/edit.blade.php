@extends('layouts.app')

@section('title', 'Trainer Edit')

@section('content')
    <form class="form-group" method="POST" action="/trainers/{{$trainer->slug}}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="">Nombre</label>
            <input type="text" name="name" value="{{$trainer->name}}" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Avatar</label>
            <input type="file" name="avatar">
        </div>
        <div class="form-group">
            <label for="">Descripcion</label>
            <input type="text" name="description" value="{{$trainer->description}}" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
@endsection
