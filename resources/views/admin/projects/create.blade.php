@extends('layouts.admin')

@section('title', 'gluke | Create')

@section('content')
<div class="container">
    <h1 class="text-uppercase"> add a project </h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action=" {{ route('admin.projects.store') }} " method="POST" enctype="multipart/form-data" class="row">

        @csrf

        <div class="form-group mt-3">
            <label for="input-title" class="form-label text-white">Title:</label>
            <input type="text" id="input-title" class="form-control" name="title" placeholder="title" autofocus>
        </div>
        <div class="form-group mt-3">
            @foreach ($technologies as $tech)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="technologies[]" value="{{$tech->id}}">
                    <label for="techology-checkbox-{{$tech->id}}" class="form-check-label"> {{ $tech->name }} </label>
                </div>   
            @endforeach
        </div>
        <div>
            <label for="input-categories" class="form-label text-white">Categories:</label>
            <select name="category_id" id="input-category" class="form-control">
                <option value=""> choose a category </option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mt-3">
            <label for="input-description" class="form-label text-white">Description:</label>
            <textarea id="input-description" class="form-control" name="description" cols="35" rows="3">
            </textarea>
        </div>
        <div class="form-group mt-3">
            <label for="input-link" class="form-label text-white">Download Link:</label>
            <input type="text" id="input-link" class="form-control" name="link" placeholder="link">
        </div>
        <div class="form-group mt-3">
            <label for="input-image" class="form-label text-white">Image:</label>
            <input type="file" id="input-image" class="form-control" name="image" placeholder="image link"> 
        </div>
        <button type="submit" class="btn btn-primary btn-outline-light my-4 col-2 mx-auto text-uppercase"><strong> add </strong></button>
    </form>

</div>
@endsection
