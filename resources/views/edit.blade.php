@extends('master')

@section('content')

    <div class="container">
        <div class="row  my-5">
            <div class="col-5 offset-4">
                <a href="{{ route('todo#detail', $todo['id'])}} ">
                    <button class="btn btn-primary my-3">go back</button>
                </a>
                <form action="{{ route('todo#update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$todo['id']}}">
                    <input value="{{old('title', $todo['title'])}}" name="title" type="text" class="form-control my-3" value="{{ $todo['title']}}">
                    @error('title')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                    
                    <textarea  name="description"  cols="30" rows="10" class="form-control my-3">{{old('description', $todo['description'])}}</textarea>
                    @error('description')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                    @if ($todo->image === null)
                    <img src="{{asset('storage/bb.png' )}}" class="img-thumbnail" alt="">
                    @else
                        <img src="{{asset('storage/'.$todo->image )}}" class="img-thumbnail" alt="">
                    @endif
                    <div class="form-group mb-4">
                        <label for="">Image</label>
                        <input  type="file" name="image" class="form-control " >  
                        @error('image')
                        <span class="text-danger">{{$message}}</span>
                         @enderror                    
                    </div>

                    <a href="{{route('todo#edit',$todo['id'])}}">
                        <button class="btn btn-primary my-3 float-end">Update</button>
                    </a>
                </form>
                   
            </div>
        </div>
    </div>
    
@endsection