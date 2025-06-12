@extends('layouts.app')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    {{-- Privacidad --}}
    <div class="container py-5 text-white">
        <h1 class="mb-4">Política de Privacidad</h1>
        <p>Este es un texto de la política de privacidad del sitio LiveScore.</p>
        <ul>
            <li>No compartimos tus datos con terceros.</li>
            <li>Tu información está protegida bajo estándares de seguridad.</li>
            <li>Puedes solicitar la eliminación de tus datos en cualquier momento.</li>
        </ul>
        <p class="mt-4">Última actualización: junio 2025.</p>
    </div>
@endsection