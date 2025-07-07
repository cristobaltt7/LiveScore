## LiveScore

**LiveScore** es una pagina web que ofrece resultados deportivos de la Liga Española, información de equipos españoles, goleadores y noticias actualizadas. 

Ofrece una **funcionalidad innovadora** que permite al usuario **crear su propio once ideal** de cualquier equipo, seleccionando a los jugadores sobre un campo de fútbol en formación 4-3-3.

## APIs utilizadas

LiveScore obtiene sus datos en tiempo real a través de tres APIs principales:

- **[Football-Data.org](https://www.football-data.org/)**: API gratuita que proporciona información básica como equipos (nombre y escudo), tabla de clasificación de La Liga y máximos goleadores.

- **[Transfermarkt API](https://transfermarkt-api.fly.dev/)**: API no oficial que ofrece información muy detallada sobre clubes, jugadores, plantillas, biografías, estadísticas, historial de lesiones, logros, escudos históricos, entre otros. Al ser una API gratuita y no oficial, presenta errores de servidor ocasionales.

- **[GNews](https://gnews.io/)**: API de noticias utilizada para mostrar artículos relacionados con el fútbol español. El plan gratuito permite 100 solicitudes al día.

## Estructura de la base de datos

<img src="img/bd.png">
