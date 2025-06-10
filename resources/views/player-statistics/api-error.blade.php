@extends('layouts.app')

@section('content')
<div class="container text-white text-center mt-5">
    <h3>{{ $message }}</h3>
    <a href="{{ url()->previous() }}" class="btn btn-outline-light mt-3">← Volver</a>
</div>
@endsection
