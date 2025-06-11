@extends('layouts.app')

@section('content')

  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

<div class="container">
    <h3>Usuarios registrados</h3>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="GET" class="mb-3">
        <input type="text" name="search" class="form-control" placeholder="Buscar por nombre..." value="{{ $search }}">
    </form>

    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $u)
            <tr>
                <td>{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
                <td>
                    <form action="{{ route('admin.users.update', $u) }}" method="POST" class="d-flex align-items-center">
                        @csrf
                        @method('PUT')
                        <select name="role" class="form-select form-select-sm me-2">
                            <option value="user" {{ $u->role === 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ $u->role === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        <button type="submit" class="btn btn-sm btn-success">Actualizar rol</button>
                    </form>
                </td>
                <td>
                    <a href="{{ route('admin.users.show', $u) }}" class="btn btn-sm btn-primary mb-1">Ver</a>
<form onsubmit="return confirmarEliminacion(this)" method="POST" action="{{ route('admin.users.destroy', $u) }}" class="form-eliminar d-inline">
    @csrf
    @method('DELETE')
    <div class="confirmar-eliminar" style="display: none;">
        <input type="text" name="confirm" placeholder="Escribe ELIMINAR" class="form-control form-control-sm mt-1">
        <div class="text-danger mt-1 error-confirm"></div>
    </div>
    <button type="button" class="btn btn-sm btn-danger btn-mostrar-confirm">Eliminar</button>
</form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
document.querySelectorAll('.btn-mostrar-confirm').forEach(btn => {
    btn.addEventListener('click', () => {
        const form = btn.closest('form');
        const confirmDiv = form.querySelector('.confirmar-eliminar');
        confirmDiv.style.display = 'block';
        btn.style.display = 'none';
    });
});

function confirmarEliminacion(form) {
    const input = form.querySelector('input[name="confirm"]');
    const errorDiv = form.querySelector('.error-confirm');

    if (input.value !== 'ELIMINAR') {
        errorDiv.textContent = 'Debes escribir "ELIMINAR" en mayúsculas para confirmar.';
        return false;
    }

    return true;
}
</script>
<script>
document.querySelectorAll('.btn-mostrar-confirm').forEach(btn => {
    btn.addEventListener('click', () => {
        const form = btn.closest('form');
        const confirmDiv = form.querySelector('.confirmar-eliminar');
        confirmDiv.style.display = 'block';
        btn.style.display = 'none';
    });
});

function confirmarEliminacion(form) {
    const input = form.querySelector('input[name="confirm"]');
    const errorDiv = form.querySelector('.error-confirm');

    if (input.value !== 'ELIMINAR') {
        errorDiv.textContent = 'Debes escribir "ELIMINAR" en mayúsculas para confirmar.';
        return false;
    }

    return true;
}
</script>


@endsection
