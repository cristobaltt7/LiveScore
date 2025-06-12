@extends('layouts.app')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    {{-- Términos --}}
    <div class="container py-5 text-white">
        <h1 class="mb-4">Términos y Condiciones</h1>
        <p>Este es un texto de los términos y condiciones de uso del sitio LiveScore.</p>
        <ul>
            <li>No nos hacemos responsables por errores en los datos.</li>
            <li>El contenido es únicamente informativo.</li>
            <li>El uso del sitio implica la aceptación de estos términos.</li>
            <li>Los usuarios deben respetar las normas de convivencia.</li>
        </ul>
        <p class="mt-4">Última actualización: junio 2025.</p>
    </div>
@endsection