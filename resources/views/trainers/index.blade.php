@extends('layouts.app')

@section('title', 'Trainers')

@section('content')
    @include('common.success')

    <div class="row">
        @foreach ($trainers as $trainer)
            <div class="col-sm">
                <div class="card text-center" style="width: 18rem; margin-top:70px;">
                    <img style="height: 150px; width:150px; margin:20px;" class="card-img-top rounded-circle mx-auto display-block" src="/images/{{$trainer->avatar}}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{$trainer->name}}</h5>
                        <p class="card-text">{{$trainer->description}}</p>
                        <!--<a href="/trainers/{{$trainer->id}}" class="btn btn-primary">Ver más...</a>-->
                        <a href="/trainers/{{$trainer->slug}}" class="btn btn-primary">Ver más...</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
