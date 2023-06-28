@extends('layouts.admin')

@section('title', 'gluke | Dashboard')

@section('content')

<div class="container d-flex justify-content-between align-items-center">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Dashboard') }}
    </h2>

    <div>
        <span class="small" id="date">  </span>
        <span style="font-size: 0.7rem" id="time">  </span>
    </div>
</div>

<div class="container">
    <h2 class="fs-1"> Hello {{ $name }}! </h2>

    <div class="fs-5"> You have <a class="text-decoration-none text-white" href="{{ route('admin.projects.index') }}"> <strong> {{$projectsN}} projects </strong> </a> in the database.</div> <div class="fs-5"> If you want to add more go to the <a class="text-decoration-none text-white" href="{{ route('admin.projects.create') }}"> <strong> Create Page. </strong> </a> </div>

    
</div>

@endsection

<script>
// real time date and time
const zeroFill = n => {
	return ('0' + n).slice(-2);
}
const interval = setInterval(() => {
    const now = new Date();
    const date = zeroFill(now.getUTCDate()) + ' / ' + zeroFill((now.getMonth() + 1)) + ' / ' + String(now.getFullYear()).slice(-2);
    const time = zeroFill(now.getHours()) + ':' + zeroFill(now.getMinutes());
    document.getElementById('date').innerHTML = date;
    document.getElementById('time').innerHTML = time;
}, 1000);
</script>

   
