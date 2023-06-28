@extends('layouts.admin')

@section('title', 'gluke | Edit')

@section('content')
<div class="container">
    <h1 class="text-uppercase"> edit <span class="text-white"> {{ $project->title }} </span> </h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action=" {{ route('admin.projects.update', $project) }} " method="POST" class="row" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="form-group mt-3">
            <label for="input-title" class="form-label text-white">Title:</label>
            <input type="text" id="input-title" class="form-control" name="title" placeholder="title" autofocus value="{{old('title') ?? $project->title}}">
        </div>
        <div class="form-group mt-3">
            @foreach ($technologies as $tech)
                <div class="form-check @error ('technologies') is-invalid @enderror">
                    @if($errors->any())
                        <input class="form-check-input" type="checkbox" name="technologies[]" value="{{$tech->id}}" id="techology-checkbox-{{$tech->id}}" {{in_array($tech->id, old('technologies, []')) ? 'checked' : '' }}>
                    @else
                        <input class="form-check-input" type="checkbox" name="technologies[]" value="{{$tech->id}} "id="techology-checkbox-{{$tech->id}}"  {{($project->technologies->contains($tech)) ? 'checked' : '' }}>
                    @endif
                        <label for="techology-checkbox-{{$tech->id}}" class="form-check-label"> {{ $tech->name }} </label>
                </div>   
            @endforeach
            @error('technologies')
            
            <div>
                {{$message}}
            </div>

            @enderror
        </div>
        <div>
            <label for="input-categories" class="form-label text-white">Categories:</label>
            <select name="category_id" id="input-category" class="form-control">
                <option value=""> choose a category </option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}"  {{old('category_id', $project->category_id) == $category->id ? 'selected' : ''}} >{{$category->name}}</option>

                    {{-- <option value="{{$category->id}}"  @selected(old('category_id') == $category_id)>{{$category->name}}</option> 
                    shorter version but need to check why it doesn't work--}}

                @endforeach
            </select>
        </div>
        <div class="form-group mt-3">
            <label for="input-description" class="form-label text-white">Description:</label>
            <textarea id="input-description" class="form-control" name="description" cols="35" rows="3">
                {{old('description') ?? $project->description}}
            </textarea>
        </div>
        <div class="form-group mt-3">
            <label for="input-link" class="form-label text-white">Download Link:</label>
            <input type="text" id="input-link" class="form-control" name="link" placeholder="link" value="{{old('link') ?? $project->link}}">
        </div>
        <div class="form-group mt-3">
            <label for="input-image" class="form-label text-white">Image:</label>
            <input type="file" id="input-image" class="form-control" name="image" placeholder="image link" value="{{old('image') ?? $project->image}}"> 
        </div>
        <button type="submit" class="btn btn-primary btn-outline-light my-4 col-2 mx-auto text-uppercase" onclick="return confirm('Are you sure you want to edit {{$project -> title }}')"><strong> modify </strong></button>
    </form>
</div>
@endsection
