@extends('master')

@section('content')

    <div class="container">
        <div class="row  my-5">
            <div class="col-5 offset-4">
                <a href="{{ route('todo#create')}} ">
                    <button class="btn btn-primary my-3">go back</button>
                </a>
                <h1 class="mb-3">{{ $todo['title']}}</h1>
                <p>{{$todo->created_at->format('j-M-Y')}}</p>
                <h5>{{ $todo['description']}}</h5>
                @if ($todo->image === null)
                    <img src="{{asset('storage/bb.png' )}}" class="img-thumbnail" alt="">
                @else
                    <img src="{{asset('storage/'.$todo->image )}}" class="img-thumbnail" alt="">
                @endif
                <a href="{{ route('todo#edit',$todo['id'])}}">
                    <button class="btn btn-primary my-3 float-end">Edit</button>
                </a>
            </div>
        </div>
    </div>
    
@endsection