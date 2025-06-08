@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar jugador</h2>

    <form method="POST" action="{{ route('squads.update', $squad->id) }}">
        @csrf @method('PUT')
        
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ $squad->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Posición</label>
            <input type="text" name="position" class="form-control" value="{{ $squad->position }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Número</label>
            <input type="text" name="number" class="form-control" value="{{ $squad->number }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Foto (URL)</label>
            <input type="text" name="photo" class="form-control" value="{{ $squad->photo }}">
        </div>

        <button class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
