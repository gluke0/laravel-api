@extends('layouts.admin')

@section('title', 'gluke | Project')

@section('content')
    <div class="container frosted">
        <h1 class="text-uppervase"> {{ $project -> title }} </h1>

        <div>
            <div class="card-body p-3">
                <p class="card-text"><p class="card-text"> <img class="img-fluid" src="{{asset('storage/' . $project->image)}}" alt=""> </p> </p>
                <p class="card-text"><strong> Description: </strong> {{ $project->description }} </p>

                @if ($project->technologies && count($project->technologies) > 0)
                    <p class="card-text"><strong> Technology: </strong> 
                        @foreach ($project->technologies as $elem)
                            {{ $elem->name }}
                        @endforeach
                    </p>
                @else
                    <p class="card-text"><strong> Technology: </strong> <span class="text-danger"> Project techology has not been declared </span></p>
                @endif

                {{-- this is possible because of the controller and the relationship created in the Project+Category.php files --}}
                {{-- <p class="card-text"><strong> Category: </strong> {{ $project->category->name }} </p> --}}

                @if ($project->category != null)
                    <p class="card-text"><strong> Category: </strong> {{ $project->category->name }}</p>
                @else
                    <p class="card-text"><strong> Category: </strong> <span class="text-danger"> This project has no category </span></p>
                @endif
                @if ($project->link != null)
                    <p class="card-text"><a target=”_blank” href="{{ $project->link }}"> source code </a></p>
                @else
                    <p class="card-text"> <span class="text-danger"> This project has no download link </span></p>
                @endif
            </div>
        </div>
        <div class="mt-5">
            <a href=" {{ route( 'admin.projects.edit', $project ) }} " class="btn btn-warning text-danger text-uppercase"><strong> edit</strong></a>
        </div>
        <div class="mt-2">
            <form action="{{route('admin.projects.destroy', $project)}}" method="POST">

            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger text-uppercase text-warning" onclick="return confirm('Are you sure you want to delete {{$project -> title }}')"> <strong> delete </strong> </button>

            </form>
        </div>
</div>
@endsection
