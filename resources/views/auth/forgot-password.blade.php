@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

<!-- Contenedor principal -->
<div class="container py-5 text-white">
    <h2 class="mb-4 text-center"><i class="bi bi-question-circle"></i> Recuperar contraseña</h2>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card bg-dark">
        <div class="card-body">
            
        <!-- Formulario para verificar y restablecer contraseña -->
            <form method="POST" action="{{ route('password.verify') }}">
                @csrf

                <div class="mb-3">
                    <label class="text-white">Correo electrónico</label>
                    <input type="email" name="email" class="form-control bg-secondary text-white border-0" required value="{{ old('email') }}">
                </div>

                <div class="mb-3">
                    <label class="text-white">Respuesta a tu pregunta secreta</label>
                    <input type="text" name="secret_answer" class="form-control bg-secondary text-white border-0" required>
                </div>

                <div class="mb-3">
                    <label class="text-white">Nueva contraseña</label>
                    <input type="password" name="new_password" class="form-control bg-secondary text-white border-0" required>
                </div>

                <div class="mb-3">
                    <label class="text-white">Confirmar nueva contraseña</label>
                    <input type="password" name="new_password_confirmation" class="form-control bg-secondary text-white border-0" required>
                </div>

                <button type="submit" class="btn btn-success w-100">Restablecer contraseña</button>
            </form>
        </div>
    </div>
</div>
@endsection
