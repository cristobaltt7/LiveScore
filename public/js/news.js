let currentPage = 1;
let modoBusqueda = false;

// Muestra las noticias en el contenedor. Si append es false, reemplaza el contenido existente
function renderArticles(articles, append = true) {
    const container = document.getElementById('newsContainer');
    if (!append) container.innerHTML = '';

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

// Carga noticias desde el backend por página y las muestra
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

// Realiza una búsqueda de noticias por término y muestra los resultados
function buscarNoticias() {
    const termino = document.getElementById('searchInput').value.trim();
    if (!termino) return;

    modoBusqueda = true;
    currentPage = 1;

    fetch(`/noticias/search?q=${encodeURIComponent(termino)}`)
        .then(res => res.json())
        .then(data => {
            renderArticles(data.articles, false);
            const loadBtn = document.getElementById('loadMoreBtn');
            if (loadBtn) loadBtn.disabled = true;
        })
        .catch(err => {
            console.error(err);
            alert('Error al buscar noticias');
        });
}

// Configura los eventos al cargar el DOM: cargar noticias, buscar con Enter y cargar más con botón
document.addEventListener('DOMContentLoaded', function () {
    const loadBtn = document.getElementById('loadMoreBtn');
    const input = document.getElementById('searchInput');

    cargarNoticias();

    if (input) {
        input.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') buscarNoticias();
        });
    }

    if (loadBtn) {
        loadBtn.addEventListener('click', cargarNoticias);
    }
});
