@extends('layouts.app')

@section('content')

    <div class="container py-5">

        <div class="d-flex justify-content-center align-items-center flex-column">
            <div>
                {{-- it contains the link to go back to home --}}
                <a href="{{url('/') }}"><img class="" src="{{Vite::asset('storage/app/public/img/logo-work.png')}}" alt="logo gluke"></a>
            </div>

            <h1 class="display-5 fw-bold">
            Welcome
            </h1>

            <p class="col-md-8 fs-4 text-center">website is currently under construction</p>
        </div>
    </div>


@endsection