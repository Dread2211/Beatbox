
    // URL del endpoint que devuelve las canciones
    const apiUrl = 'backend/canciones.php';

    // Contenedor donde se agregarán las tarjetas
    const songContainer = document.getElementById('song-container');

    async function loadSongs() {
        try {
            const response = await fetch(apiUrl);
            const data = await response.json();
    
            if (data.allSongs && data.allSongs.length > 0) {
                data.allSongs.forEach(song => {
                    const songCard = document.createElement('div');
                    songCard.classList.add('col');
                    songCard.innerHTML = `
                        <div class="card h-100" data-id="${song.id}" onclick="playSongFromCard(${song.id}, '${song.title}', '${song.img}')">
                            <img src="${song.img}" alt="${song.title}" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">${song.title}</h5>
                            </div>
                        </div>
                    `;
                    songContainer.appendChild(songCard);
                });
            } else {
                songContainer.innerHTML = '<p>No hay canciones disponibles en este momento.</p>';
            }
        } catch (error) {
            console.error('Error al cargar las canciones:', error);
            songContainer.innerHTML = '<p>Error al cargar las canciones.</p>';
        }
    }
    

    // Cargar las canciones cuando se cargue la página
document.addEventListener('DOMContentLoaded', loadSongs);


const playSongFromCard = (id, title, img, artist) => {
    // Cambiar los datos del footer
    document.getElementById('titulo-cancion').textContent = title;  // Cambiar el título de la canción
    document.getElementById('artista-cancion').textContent = artist;
    document.querySelector('#playerFooter img').src = img;

    // Mostrar el footer si está oculto
    const footer = document.getElementById('playerFooter');
    if (footer.classList.contains('hidden')) {
        footer.classList.remove('hidden');
    }

    // Llamar a la función que reproduce la canción
    playSong(id);
};


    