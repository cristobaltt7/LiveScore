<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Plantilla Equipo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f0f0;
            margin: 0;
            padding: 20px;
            text-align: center;
        }
        .field {
            position: relative;
            width: 600px;
            height: 900px;
            margin: 0 auto;
            background: url('/images/football_field.jpg') no-repeat center center;
            background-size: cover;
            border: 2px solid #333;
            border-radius: 10px;
        }
        .player {
            position: absolute;
            width: 100px;
            height: 30px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 5px;
            line-height: 30px;
            font-size: 14px;
            font-weight: bold;
            color: #000;
            cursor: default;
            user-select: none;
        }
        /* Posiciones básicas en 4-3-3 */
        .goalkeepers { top: 850px; left: 250px; }
        .defenders .player:nth-child(1) { top: 700px; left: 50px; }
        .defenders .player:nth-child(2) { top: 720px; left: 180px; }
        .defenders .player:nth-child(3) { top: 720px; left: 420px; }
        .defenders .player:nth-child(4) { top: 700px; left: 550px; }
        
        .midfielders .player:nth-child(1) { top: 500px; left: 100px; }
        .midfielders .player:nth-child(2) { top: 480px; left: 250px; }
        .midfielders .player:nth-child(3) { top: 500px; left: 400px; }
        
        .forwards .player:nth-child(1) { top: 250px; left: 100px; }
        .forwards .player:nth-child(2) { top: 230px; left: 300px; }
        .forwards .player:nth-child(3) { top: 250px; left: 500px; }

        h1 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Plantilla del Equipo (4-3-3)</h1>

    <div class="field" id="field">
        <div class="goalkeepers"></div>
        <div class="defenders"></div>
        <div class="midfielders"></div>
        <div class="forwards"></div>
    </div>

    <script>
        const teamId = "{{ $teamId }}";

        async function loadSquad() {
            try {
                const res = await fetch(`/football/team/${teamId}/squad`);
                if (!res.ok) throw new Error('No se pudo cargar la plantilla');
                const data = await res.json();

                // Vaciar contenedores
                document.querySelector('.goalkeepers').innerHTML = '';
                document.querySelector('.defenders').innerHTML = '';
                document.querySelector('.midfielders').innerHTML = '';
                document.querySelector('.forwards').innerHTML = '';

                // Insertar jugadores según posición
                data.squad.goalkeepers.forEach(player => {
                    addPlayer('goalkeepers', player);
                });
                data.squad.defenders.forEach(player => {
                    addPlayer('defenders', player);
                });
                data.squad.midfielders.forEach(player => {
                    addPlayer('midfielders', player);
                });
                data.squad.forwards.forEach(player => {
                    addPlayer('forwards', player);
                });

            } catch (error) {
                alert(error.message);
            }
        }

        function addPlayer(positionClass, player) {
            const container = document.querySelector(`.${positionClass}`);
            const div = document.createElement('div');
            div.classList.add('player');
            div.textContent = player.name || 'Jugador';
            container.appendChild(div);
        }

        loadSquad();
    </script>
</body>
</html>
