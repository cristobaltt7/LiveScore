@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

<div class="container-fluid py-4">
    <div class="row">
        {{-- Contenido principal --}}
        <div class="col-lg-9 ms-lg-2">
            <h2 class="text-white mb-4 text-center"><i class="bi bi-newspaper"></i> Noticias del Fútbol Español</h2>

            <!-- 🔍 Buscador -->
            <div class="mb-4 text-center">
                <input type="text" id="searchInput" class="form-control d-inline-block w-50" placeholder="Buscar noticias por título...">
            </div>

            <div id="newsContainer" class="row row-cols-1 row-cols-md-3 g-4"></div>

            <div class="text-center mt-4">
                <button id="loadMoreBtn" class="btn btn-outline-light px-4 py-2">Cargar más noticias</button>
            </div>
        </div>

        {{-- Sidebar derecho --}}
        <div class="col-lg-3">
            @include('layouts.news-sidebar')
        </div>
    </div>
</div>

@endsection


@section('scripts')
<script src="{{ asset('js/news.js') }}"></script>
@endsection

