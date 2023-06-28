@extends('layouts.admin')

@section('title', 'gluke | Projects')

@section('content')
    <div class="container">
        <h1 class="text-uppervase"> my projects </h1>

        @if (Session::has('success'))
            <div>
                {!! Session::get('success') !!}
            </div>
        @endif
    </div>
    <div class="container">
        <button class="text-uppercase btn btn-primary"><a class="text-uppercase text-white text-decoration-none" href="{{ route('admin.projects.create') }}">add project</a></button>
        @forelse ($projects as $elem)
        <div>
            <div class="card-body card p-3">
                
                <p class="card-text"><strong> Title: </strong> {{ $elem->title }} </p>

                <p class="card-text"> <img class="img-fluid" src="{{asset('storage/' . $elem->image)}}" alt=""> </p>

                @if ($elem->technologies && count($elem->technologies) > 0)
                    <p class="card-text"><strong> Technology: </strong> 
                        @foreach ($elem->technologies as $item)
                            {{$item->name}}
                        @endforeach
                    </p>
                @else
                    <p class="card-text"><strong> Technology: </strong> <span class="text-danger"> Project techology has not been declared </span></p>
                @endif

                <p> <a class="text-decoration-none" href="{{ route('admin.projects.show', $elem) }}"> More </a></p>
            </div>
            
        @empty
            
        @endforelse
    </div>
@endsection
