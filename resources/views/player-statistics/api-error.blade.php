@extends('layouts.app')

@section('content')

    <!-- Contenedor principal -->
    <div class="container text-white text-center mt-5">

        <!-- Mensaje dinámico recibido desde el controlador -->
        <h3>{{ $message }}</h3>

        <!-- Botón para volver a la página anterior -->
        <a href="{{ url()->previous() }}" class="btn btn-outline-light mt-3">← Volver</a>
    </div>
@endsection