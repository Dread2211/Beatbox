document.addEventListener("DOMContentLoaded", function() {
  // Variable con la cantidad de canciones
  var cantidadCanciones = 0;
  // Actualizar el contenido del elemento con el ID song-count-value
  document.getElementById("song-count-value").textContent = cantidadCanciones;
});


let playlistCount = 0;

// Obtener el botón y el contenedor donde se agregarán las nuevas playlists
const addPlaylistBtn = document.getElementById('add-playlist-btn');
const playlistContainer = document.getElementById('playlist-container');

// Función para crear una nueva playlist
function addPlaylist() {
  playlistCount++;
  const nombrePlaylist = 'Playlist ' + playlistCount;

  // Crear el card de la nueva playlist
  const newPlaylist = document.createElement('a');
  newPlaylist.href = '#';
  newPlaylist.className = 'card text-bg-dark mb-3 card-custom';

  const rowDiv = document.createElement('div');
  rowDiv.className = 'row g-0 h-100';

  const colImgDiv = document.createElement('div');
  colImgDiv.className = 'col col-md-4 d-flex align-items-center justify-content-center';

  const img = document.createElement('img');
  img.src = 'NBimg/play.png';
  img.className = 'img-fluid rounded';
  img.alt = 'Playlist Image';
  img.style.width = '40px';
  img.style.height = '40px';

  colImgDiv.appendChild(img);

  const colTextDiv = document.createElement('div');
  colTextDiv.className = 'col-md-6 d-flex align-items-center';

  const cardBody = document.createElement('div');
  cardBody.className = 'card-body';

  const title = document.createElement('h6');
  title.className = 'card-title';
  title.textContent = 'Playlist ' + playlistCount;

  const songCount = document.createElement('p');
  songCount.className = 'card-text';
  songCount.style.fontSize = '12px';
  songCount.textContent = '0 Canciones';

  cardBody.appendChild(title);
  cardBody.appendChild(songCount);
  colTextDiv.appendChild(cardBody);

  const colOptionsDiv = document.createElement('div');
  colOptionsDiv.className = 'col-md-2 d-flex align-items-center justify-content-center';

  // Crear botón de opciones
  const optionsButton = document.createElement('button');
  optionsButton.className = 'btn btn-img';
  optionsButton.style.border = 'none';
  optionsButton.innerHTML = '<img src="NBimg/menu.png" width="20" height="20" alt="Options">';

  // Crear menú de opciones
  const optionsMenu = document.createElement('div');
  optionsMenu.className = 'options-menu';
  optionsMenu.style.display = 'none';
  optionsMenu.style.position = 'absolute';
  optionsMenu.style.background = '#333';
  optionsMenu.style.borderRadius = '5px';
  optionsMenu.style.padding = '10px';
  optionsMenu.innerHTML = `
    <button class="btn btn-outline-light btn-sm rename-playlist">Cambiar nombre</button>
    <button class="btn btn-outline-light btn-sm delete-playlist">Eliminar</button>
    <button class="btn btn-outline-light btn-sm close-menu">Cerrar</button>
  `;

  colOptionsDiv.appendChild(optionsButton);
  colOptionsDiv.appendChild(optionsMenu);

  rowDiv.appendChild(colImgDiv);
  rowDiv.appendChild(colTextDiv);
  rowDiv.appendChild(colOptionsDiv);

  newPlaylist.appendChild(rowDiv);

    // Enviar datos al servidor
    fetch('backend/guardar_playlist.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
          nombre: nombrePlaylist,
          cantidad_canciones: 0, // Por defecto
        }),
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error('Error al guardar la playlist.');
          }
          return response.json();
        })
        .then((data) => {
          if (data.success) {
            console.log('Playlist guardada con ID:', data.playlist_id);
            newPlaylist.dataset.playlistId = data.playlist_id; // Guardar el ID en el elemento
          } else {
            console.error(data.error);
          }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
  
  // Agregar la nueva playlist al contenedor de playlists
  playlistContainer.appendChild(newPlaylist);

  // Mostrar/ocultar menú de opciones
  optionsButton.addEventListener('click', function(e) {
    e.preventDefault();
    optionsMenu.style.display = optionsMenu.style.display === 'none' ? 'block' : 'none';
  });

  // Cerrar el menú cuando se hace clic fuera
  document.addEventListener('click', function(e) {
    if (!optionsMenu.contains(e.target) && !optionsButton.contains(e.target)) {
        optionsMenu.style.display = 'none';
    }
  });

  // Cambiar nombre de la playlist
  const renameButton = optionsMenu.querySelector('.rename-playlist');
  renameButton.addEventListener('click', function() {
      const renameModal = new bootstrap.Modal(document.getElementById('renameModal'));
      renameModal.show();

      const guardar = document.getElementById('guardarNombre');
      guardar.onclick = function() {
          const newName = document.getElementById('newPlaylistName').value;
          if (newName) {
              title.textContent = newName;

              const playlistId = newPlaylist.dataset.playlistId;

            // Enviar solicitud al backend para actualizar el nombre
            fetch('backend/actualizar_nombre_playlist.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    playlist_id: playlistId,
                    nuevo_nombre: newName,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        console.log('Nombre de la playlist actualizado.');
                    } else {
                        console.error('Error al actualizar el nombre:', data.error);
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                });

          }
          renameModal.hide();
          document.getElementById('newPlaylistName').value = '';
      };
  });

  // Eliminar la playlist
  const deleteButton = optionsMenu.querySelector('.delete-playlist');
  deleteButton.addEventListener('click', function() {
    newPlaylist.remove();
  });

  // Botón cerrar el menú
  const closeButton = optionsMenu.querySelector('.close-menu');
  closeButton.addEventListener('click', function() {
    optionsMenu.style.display = 'none';
  });
}

// Asignar el evento click al botón "más"
addPlaylistBtn.addEventListener('click', function(e) {
  e.preventDefault();
  addPlaylist();
});



document.addEventListener("DOMContentLoaded", function () {
    const playlistContainer = document.getElementById("playlist-container");
  
    // Función para crear una playlist en el DOM
    function createPlaylistCard(playlist) {
      const newPlaylist = document.createElement("a");
      newPlaylist.href = "#";
      newPlaylist.className = "card text-bg-dark mb-3 card-custom";
      newPlaylist.dataset.playlistId = playlist.id; // ID de la playlist
  
      const rowDiv = document.createElement("div");
      rowDiv.className = "row g-0 h-100";
  
      const colImgDiv = document.createElement("div");
      colImgDiv.className =
        "col col-md-4 d-flex align-items-center justify-content-center";
  
      const img = document.createElement("img");
      img.src = "NBimg/play.png";
      img.className = "img-fluid rounded";
      img.alt = "Playlist Image";
      img.style.width = "40px";
      img.style.height = "40px";
  
      colImgDiv.appendChild(img);
  
      const colTextDiv = document.createElement("div");
      colTextDiv.className = "col-md-6 d-flex align-items-center";
  
      const cardBody = document.createElement("div");
      cardBody.className = "card-body";
  
      const title = document.createElement("h6");
      title.className = "card-title";
      title.textContent = playlist.nombre;
  
      const songCount = document.createElement("p");
      songCount.className = "card-text";
      songCount.style.fontSize = "12px";
      songCount.textContent = `${playlist.cantidad_canciones} Canciones`;
  
      cardBody.appendChild(title);
      cardBody.appendChild(songCount);
      colTextDiv.appendChild(cardBody);
  
      const colOptionsDiv = document.createElement("div");
      colOptionsDiv.className =
        "col-md-2 d-flex align-items-center justify-content-center";
  
      // Botón de opciones
      const optionsButton = document.createElement("button");
      optionsButton.className = "btn btn-img";
      optionsButton.style.border = "none";
      optionsButton.innerHTML =
        '<img src="NBimg/menu.png" width="20" height="20" alt="Options">';
  
      colOptionsDiv.appendChild(optionsButton);
      rowDiv.appendChild(colImgDiv);
      rowDiv.appendChild(colTextDiv);
      rowDiv.appendChild(colOptionsDiv);
  
      newPlaylist.appendChild(rowDiv);
      playlistContainer.appendChild(newPlaylist);
    }
  
    // Obtener playlists desde el backend
    fetch("backend/obtener_playlists.php")
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          data.playlists.forEach((playlist) => {
            createPlaylistCard(playlist);
          });
        } else {
          console.error("Error al cargar playlists:", data.error);
        }
      })
      .catch((error) => {
        console.error("Error en la solicitud:", error);
      });
  });
  