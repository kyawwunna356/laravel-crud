@extends('master')

@section('content')
    <div class="container">
        <div class="row mt-3">
            <div class="col-5">
                
                @if (session('todoCreated'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong> {{session('todoCreated')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif

                @if (session('todoDeleted'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong> {{session('todoDeleted')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                    
                
                <form action="{{ route('todo#insert')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="">title</label>
                        <input  type="text" name="title" value="{{old('title')}}" class="form-control @error('title') is-invalid @enderror" placeholder="write a todoTitle">
                        @error('title')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="">description</label>
                        <textarea  name="description"  class="form-control @error('description') is-invalid @enderror" id="" cols="30" rows="10" placeholder="">{{old('description')}}</textarea>
                        @error('description')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="">Image</label>
                        <input  type="file" name="image" class="form-control " >  
                        @error('image')
                        <span class="text-danger">{{$message}}</span>
                         @enderror                    
                    </div>
                   
                    
                    <button class="btn btn-primary">Create a todos</button>
                    
                </form>
            </div>
            <div class="col-7">
                <form class="d-flex mt-4 ">
                    <input value="@php
                        if(isset($_REQUEST['searchKey'])){
                            echo $_REQUEST['searchKey'];
                        } else 
                            echo '';
                    @endphp" type="text" class="inline-block form-control d-inline-block mr-3" name="searchKey" placeholder="search">
                    <button class="btn btn-outline-danger d-inline-block ">search</button>
                </form>
                @foreach ($todos as $todo)
                <div class="card shadow-sm border-0 my-3">
                    <div class="card-body">
                        <h5>{{ $todo['title']}}</h5>
                        <hr>
                        <p> {{ Str::words($todo['description'], 30, '...') }} </p>
                        <p>Price - <span>{{ $todo->price }}</span></p>
                        <p>address - <span>{{ $todo->address }}</span></p>
                        <p>rating - <span>{{ $todo->rating }}</span></p>
                        <div class="float-end">
                            <a href={{route('todo#delete',$todo['id'])}}>
                                <button class="btn btn-danger">delete</button>
                            </a>

                            <a href={{route('todo#detail',$todo['id'])}}>
                                <button class="btn btn-primary">detail</button>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
                {{$todos->links()}}
                {{-- {{$todos->extends(request())->links()}} --}}
            </div>
        </div>
    </div>
@endsection