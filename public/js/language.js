document.addEventListener('DOMContentLoaded', function() {
  // Diccionario de traducciones
  const translations = {
    'en': {
      'language': 'Language',
      'home': 'Home',
      'football': 'Football',
      'sports': 'Sports',
      'news': 'News',
      'followed_team': 'Followed Team',
      'followed_players': 'Followed Players',
      'theme_settings': 'Theme Settings',
      'light': 'Light',
      'dark': 'Dark',
      'search_matches': 'Search for matches...',
      'all_matches': 'All Matches',
      'view_calendar': 'View Calendar',
      'recent_results': 'Recent Results - La Liga',
      'standings': 'Standings - La Liga',
      'trending_news': 'Trending News',
      'links': 'Links',
      'competitions': 'Competitions',
      'no_results': 'No results available',
      'api_error': 'Could not load results (API Error)',
      'no_standings': 'Standings not available'
    },
    'es': {
      'language': 'Idioma',
      'home': 'Inicio',
      'football': 'Fútbol',
      'sports': 'Deportes',
      'news': 'Noticias',
      'followed_team': 'Equipo Seguido',
      'followed_players': 'Jugadores Seguidos',
      'theme_settings': 'Configuración de Tema',
      'light': 'Claro',
      'dark': 'Oscuro',
      'search_matches': 'Buscar partidos...',
      'all_matches': 'Todos los Partidos',
      'view_calendar': 'Ver Calendario',
      'recent_results': 'Resultados Recientes - La Liga',
      'standings': 'Clasificación - La Liga',
      'trending_news': 'Noticias Destacadas',
      'links': 'Enlaces',
      'competitions': 'Competiciones',
      'no_results': 'No hay resultados disponibles',
      'api_error': 'No se pudieron cargar los resultados (Error de API)',
      'no_standings': 'Clasificación no disponible'
    },
    'fr': {
      'language': 'Langue',
      'home': 'Accueil',
      'football': 'Football',
      'sports': 'Sports',
      'news': 'Actualités',
      'followed_team': 'Équipe Suivie',
      'followed_players': 'Joueurs Suivis',
      'theme_settings': 'Paramètres du Thème',
      'light': 'Clair',
      'dark': 'Sombre',
      'search_matches': 'Rechercher des matchs...',
      'all_matches': 'Tous les Matchs',
      'view_calendar': 'Voir Calendrier',
      'recent_results': 'Résultats Récents - La Liga',
      'standings': 'Classement - La Liga',
      'trending_news': 'Actualités Tendances',
      'links': 'Liens',
      'competitions': 'Compétitions',
      'no_results': 'Aucun résultat disponible',
      'api_error': 'Impossible de charger les résultats (Erreur API)',
      'no_standings': 'Classement non disponible'
    }
  };

  // Función para cambiar el idioma
  function changeLanguage(lang) {
    // Actualizar el atributo lang del HTML
    document.documentElement.lang = lang;
    
    // Traducir todos los elementos con data-translate
    document.querySelectorAll('[data-translate]').forEach(element => {
      const key = element.getAttribute('data-translate');
      if (translations[lang] && translations[lang][key]) {
        element.textContent = translations[lang][key];
      }
    });
    
    // Traducir placeholders
    const searchInputs = document.querySelectorAll('input[type="text"]');
    searchInputs.forEach(input => {
      if (input.placeholder.includes('Search')) {
        input.placeholder = translations[lang]['search_matches'] || input.placeholder;
      }
    });
    
    // Guardar preferencia de idioma
    localStorage.setItem('preferredLanguage', lang);
  }

  // Manejar cambio de idioma desde el selector
  const languageSelector = document.querySelector('.language-selector');
  if (languageSelector) {
    languageSelector.addEventListener('change', function() {
      changeLanguage(this.value);
    });
  }

  // Cargar idioma preferido al inicio
  const preferredLanguage = localStorage.getItem('preferredLanguage') || 'es';
  if (languageSelector) {
    languageSelector.value = preferredLanguage;
  }
  changeLanguage(preferredLanguage);
});