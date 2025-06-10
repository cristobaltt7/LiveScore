<div id="sidebar-news-container">
    <div class="text-white mb-2">Cargando noticias...</div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    fetch('/noticias/fetch')
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('sidebar-news-container');
            container.innerHTML = '';

            data.articles.slice(0, 5).forEach(article => {
                const publishedAt = new Date(article.publishedAt);
                const timeAgo = timeSince(publishedAt);
                const views = Math.floor(Math.random() * (3000 - 900 + 1)) + 900;

                const html = `
                    <div class="news-item mb-4 text-white border-bottom pb-3">
                        <div class="d-flex">
                            <img src="${article.image || 'https://via.placeholder.com/80x80/333/fff?text=NEWS'}" 
                                 alt="Noticia" width="80" height="80" class="me-2 rounded">
                            <div class="flex-grow-1">
                                <h6 class="mb-1">
                                    <i class="bi bi-newspaper"></i> ${truncate(article.title, 40)}
                                </h6>
                                <p class="mb-1 small">${truncate(article.description || '', 60)}</p>
                                <small class="text-muted">
                                    <i class="bi bi-clock"></i> ${timeAgo} • 
                                    <i class="bi bi-eye"></i> ${views} visitas
                                </small>
                                <div class="text-end mt-1">
                                    <a href="${article.url}" target="_blank" class="btn btn-sm btn-outline-light">Ver más</a>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                container.insertAdjacentHTML('beforeend', html);
            });
        })
        .catch(error => {
            console.error("Error al cargar noticias:", error);
            document.getElementById('sidebar-news-container').innerHTML =
                '<p class="text-danger">No se pudieron cargar las noticias.</p>';
        });

    function truncate(text, maxLength) {
        return text.length > maxLength ? text.substring(0, maxLength - 3) + '...' : text;
    }

    function timeSince(date) {
        const seconds = Math.floor((new Date() - date) / 1000);
        let interval = Math.floor(seconds / 31536000);
        if (interval >= 1) return interval + " año" + (interval > 1 ? "s" : "") + " atrás";
        interval = Math.floor(seconds / 2592000);
        if (interval >= 1) return interval + " mes" + (interval > 1 ? "es" : "") + " atrás";
        interval = Math.floor(seconds / 86400);
        if (interval >= 1) return interval + " día" + (interval > 1 ? "s" : "") + " atrás";
        interval = Math.floor(seconds / 3600);
        if (interval >= 1) return interval + " hora" + (interval > 1 ? "s" : "") + " atrás";
        interval = Math.floor(seconds / 60);
        if (interval >= 1) return interval + " minuto" + (interval > 1 ? "s" : "") + " atrás";
        return "Justo ahora";
    }
});
</script>
