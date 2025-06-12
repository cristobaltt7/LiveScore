// Renderiza la formación inicial del equipo sobre el campo, muestra un selector editable de alineación
// y genera una tabla con la plantilla completa del equipo, incluyendo sus datos y estadísticas.
function renderFormation(players) {
    const container = document.getElementById("formationPlayers");
    const fullSquadContainer = document.getElementById("fullSquadContainer");
    const lineupSelector = document.getElementById("lineupSelector") || createLineupSelector();
    container.innerHTML = "";
    fullSquadContainer.innerHTML = "";
    lineupSelector.innerHTML = "";

    // Ocultar buscador
    const search = document.getElementById('searchContainer');
    if (search) search.style.display = 'none';

    // Coordenadas para cada posicion en la formación 4-3-3
    const positions = {
        GK: [{ x: 10, y: 50 }],
        DF: [
            { x: 25, y: 20 }, { x: 25, y: 40 }, { x: 25, y: 60 }, { x: 25, y: 80 }
        ],
        MF: [
            { x: 45, y: 30 }, { x: 45, y: 50 }, { x: 45, y: 70 }
        ],
        FW: [
            { x: 70, y: 25 }, { x: 70, y: 50 }, { x: 70, y: 75 }
        ]
    };

    // Agrupa jugadores según su posición
    const grouped = {
        GK: players.filter(p => /goalkeeper/i.test(p.position)),
        DF: players.filter(p => /back|defend/i.test(p.position)),
        MF: players.filter(p => /midfield/i.test(p.position)),
        FW: players.filter(p => /forward|wing|striker|attack/i.test(p.position))
    };

    // Renderiza los jugadores iniciales en el campo
    const currentLineup = {};
    for (const role in positions) {
        grouped[role] = grouped[role].sort(() => 0.5 - Math.random());
        const coords = positions[role];
        const selected = grouped[role].slice(0, coords.length);
        selected.forEach((player, i) => {
            const pos = coords[i];
            const div = document.createElement("div");
            div.className = `player-marker ${role.toLowerCase()}`;
            div.style.left = `${pos.x}%`;
            div.style.top = `${pos.y}%`;
            div.innerHTML = `
                <div class="player-number">${role}</div>
                <div class="player-name">${player.name}</div>
            `;
            container.appendChild(div);
            currentLineup[`${role}${i + 1}`] = player.name;
        });
    }

    // Crea una tabla editable para cambiar el once inicial
    const table = document.createElement('table');
    table.className = 'table table-sm table-dark table-bordered text-white';
    table.innerHTML = `
        <thead><tr><th>Posición</th><th>Jugador</th></tr></thead>
        <tbody>
            ${Object.entries(currentLineup).map(([pos, name]) => `
                <tr>
                    <td>${pos}</td>
                    <td>
                        <select class="form-select form-select-sm bg-dark text-white" data-pos="${pos}">
                            ${players.map(p => `<option value="${p.name}" ${p.name === name ? 'selected' : ''}>${p.name}</option>`).join('')}
                        </select>
                    </td>
                </tr>
            `).join('')}
        </tbody>
    `;
    lineupSelector.appendChild(table);

    // Botón para actualizar el once en el campo
    const buttonContainer = document.createElement('div');
    buttonContainer.className = "text-center mt-3";

    const updateBtn = document.createElement('button');
    updateBtn.textContent = "Actualizar once";
    updateBtn.className = "btn btn-outline-light px-4 py-2 fw-bold";
    updateBtn.onclick = () => {
        const newLineup = {};
        lineupSelector.querySelectorAll('select').forEach(sel => {
            newLineup[sel.dataset.pos] = sel.value;
        });
        renderCustomLineup(newLineup, players, positions);
    };

    buttonContainer.appendChild(updateBtn);
    lineupSelector.appendChild(buttonContainer);

    // Muestra la plantilla completa del equipo en una tabla
    const plantillaHtml = `
        <div class="table-responsive animate__animated animate__fadeInUp mt-4">
            <table id="playersTable" class="table table-dark table-striped table-bordered table-hover rounded shadow">
                <thead class="table-success text-center">
                    <tr>
                        <th>Nombre</th>
                        <th>Edad</th>
                        <th>Posición</th>
                        <th>Nacionalidad</th>
                        <th>Contrato</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                    ${players.map(player => `
                        <tr class="text-center align-middle">
                            <td>${player.name}</td>
                            <td>${player.age || 'N/D'}</td>
                            <td>${player.position || 'N/D'}</td>
                            <td>${Array.isArray(player.nationality) ? player.nationality.join(', ') : player.nationality || 'N/D'}</td>
                            <td>${player.contract || 'N/D'}</td>
                            <td data-order="${player.marketValue ?? 0}">${formatValue(player.marketValue)}</td>
                        </tr>
                    `).join('')}
                </tbody>
            </table>
        </div>
    `;
    fullSquadContainer.innerHTML = plantillaHtml;

    // Inicializa la tabla con DataTables para orden y búsqueda
    $.fn.dataTable.ext.type.order['locale-compare-asc'] = (a, b) => a.localeCompare(b, 'es', { sensitivity: 'base' });
    $.fn.dataTable.ext.type.order['locale-compare-desc'] = (a, b) => b.localeCompare(a, 'es', { sensitivity: 'base' });

    setTimeout(() => {
        $('#playersTable').DataTable({
            columnDefs: [
                { targets: 0, type: 'locale-compare' },
                { targets: 5, type: 'num' }
            ],
            language: {
                search: "Buscar:",
                info: "",
                zeroRecords: "No se encontraron jugadores",
            },
            responsive: true,
            paging: false,
            lengthChange: false,
            pageLength: 30,
            ordering: true
        });
    }, 100);
}

// Renderiza el once personalizado según la selección del usuario
function renderCustomLineup(lineup, players, positions) {
    const container = document.getElementById("formationPlayers");
    container.innerHTML = "";
    for (const role in positions) {
        positions[role].forEach((pos, i) => {
            const playerName = lineup[`${role}${i + 1}`];
            const player = players.find(p => p.name === playerName);
            if (!player) return;
            const div = document.createElement("div");
            div.className = `player-marker ${role.toLowerCase()}`;
            div.style.left = `${pos.x}%`;
            div.style.top = `${pos.y}%`;
            div.innerHTML = `
                <div class="player-number">${role}</div>
                <div class="player-name">${player.name}</div>
            `;
            container.appendChild(div);
        });
    }
}

// Crea el contenedor del selector de alineación si no existe
function createLineupSelector() {
    const div = document.createElement("div");
    div.id = "lineupSelector";
    div.className = "mb-4";
    document.querySelector(".selected-team-container").appendChild(div);
    return div;
}

// Formatea el valor numérico en euros con separador de miles
function formatValue(num) {
    if (!num || isNaN(num)) return 'N/D';
    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + " €";
}
