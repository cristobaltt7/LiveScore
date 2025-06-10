
@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

<div class="container py-4">
    <h2 class="text-white mb-4 text-center"><i class="bi bi-newspaper"></i> Noticias de Fútbol Español</h2>

    <!-- 🔍 Buscador -->
    <div class="mb-4 text-center">
        <input type="text" id="searchInput" class="form-control d-inline-block w-50" placeholder="Buscar noticias por título...">
        <button id="searchBtn" class="btn btn-outline-light mt-2">Buscar</button>
    </div>

    <div id="newsContainer" class="row row-cols-1 row-cols-md-3 g-4"></div>

    <div class="text-center mt-4">
        <button id="loadMoreBtn" class="btn btn-outline-light px-4 py-2">Cargar más noticias</button>
    </div>
</div>
@endsection

@section('scripts')
<script>
let currentPage = 1;
let modoBusqueda = false;

function renderArticles(articles, append = true) {
    const container = document.getElementById('newsContainer');
    if (!append) container.innerHTML = ''; // Borra si no se desea añadir

    if (articles.length === 0) {
        container.innerHTML = `<p class="text-white text-center w-100">No se encontraron noticias.</p>`;
        return;
    }

    articles.forEach(article => {
        const div = document.createElement('div');
        div.className = "col";
        div.innerHTML = `
            <div class="card h-100 bg-dark text-white border-light shadow-sm">
                ${article.image ? `
                    <div class="ratio ratio-16x9">
                        <img src="${article.image}" class="card-img-top object-fit-cover" alt="Imagen" style="object-fit: cover;">
                    </div>` : ''}
                <div class="card-body d-flex flex-column">
                    <h6 class="card-title fw-bold small">${article.title}</h6>
                    <p class="card-text small flex-grow-1">${article.description ?? ''}</p>
                </div>
                <div class="card-footer bg-transparent text-end">
                    <a href="${article.url}" target="_blank" class="btn btn-sm btn-outline-light">Leer más</a>
                </div>
            </div>
        `;
        container.appendChild(div);
    });
}

function cargarNoticias() {
    if (modoBusqueda) return;

    fetch(`/noticias/fetch?page=${currentPage}`)
        .then(res => res.json())
        .then(data => {
            renderArticles(data.articles);
            currentPage++;
        })
        .catch(err => {
            console.error(err);
            alert('Error al cargar noticias');
        });
}

function buscarNoticias() {
    const termino = document.getElementById('searchInput').value.trim();
    if (!termino) return;

    modoBusqueda = true;
    currentPage = 1;

    fetch(`/noticias/search?q=${encodeURIComponent(termino)}`)
        .then(res => res.json())
        .then(data => {
            renderArticles(data.articles, false);
            document.getElementById('loadMoreBtn').disabled = true;
        })
        .catch(err => {
            console.error(err);
            alert('Error al buscar noticias');
        });
}

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('loadMoreBtn').addEventListener('click', cargarNoticias);
    document.getElementById('searchBtn').addEventListener('click', buscarNoticias);

    cargarNoticias(); // Primera carga automática
});
</script>
@endsection
