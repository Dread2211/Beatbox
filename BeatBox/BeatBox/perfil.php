<?php
  session_start();
  $usuario = $_SESSION['usuario'];
  $nombre = $_SESSION['nombre'];
  $uniqueUsername = "@" . strtolower($usuario);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/navBar.css">
    <link rel="stylesheet" href="css/perfil.css">
    <link rel="icon" href="NBimg/icon.png">
    <title>BeatBox</title>
</head>
<body>
    <!-- Barra de navegación -->
  <nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <!-- Icono del usuario con menú desplegable -->
      <div class="d-flex align-items-center">
        <img src="NBimg/usuario.png" id="foto-usuario" alt="User" class="rounded-circle user-icon" data-bs-toggle="dropdown" aria-expanded="false">
        <ul class="dropdown-menu dropdown-menu-dark">
          <li><a class="dropdown-item" href="perfil.php">Perfil</a></li>
          <li><a class="dropdown-item" href="#">Biblioteca</a></li>
          <li><a class="dropdown-item" href="#">Configuración</a></li>
          <li><a class="dropdown-item" href="#">Ayuda</a></li>
          <li><hr class="dropdown-divider"></li>
          <li class="d-flex justify-content-center">
            <form id="logoutForm" action="logout.php" method="POST" class="<?php echo (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) ? '' : 'd-none'; ?>">
              <button id="logoutButton" type="submit" class="btn btn-outline-custom2">Cerrar Sesión</button>
            </form>
            <a id="loginButton" class="btn btn-outline-custom2 <?php echo (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) ? 'd-none' : ''; ?>" data-bs-toggle="modal" data-bs-target="#loginModal">Iniciar Sesión</a>
          
          </li>
        </ul>
      </div>
      <!-- Enlaces de navegación con tooltip -->
      <div class="d-flex align-items-center " style="margin-left: 50px;">
        <a class="navbar-brand d-none d-lg-block mx-3" href="home.php" title="Inicio" style="color: #b4a7d6;"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
          <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z"/>
          <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z"/>
        </svg></a>
        <a class="navbar-brand d-none d-lg-block mx-3" href="explorar.php" title="Explorar" style="color: #d5a6bd;"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-compass" viewBox="0 0 16 16">
          <path d="M8 16.016a7.5 7.5 0 0 0 1.962-14.74A1 1 0 0 0 9 0H7a1 1 0 0 0-.962 1.276A7.5 7.5 0 0 0 8 16.016m6.5-7.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0"/>
          <path d="m6.94 7.44 4.95-2.83-2.83 4.95-4.949 2.83 2.828-4.95z"/>
        </svg></a>
        <a class="navbar-brand d-none d-lg-block mx-3" href="historial.php" title="Historial" style="color: #ffb5d7;"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-hourglass-split" viewBox="0 0 16 16">
          <path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z"/>
        </svg></a>
      </div>
      <!-- Búsqueda -->
      <form class="d-flex justify-content-center flex-grow-1 mx-3 mx-md-5">
        <input class="form-control me-2" style="width: 70%; background-color: #FFF2CC;" type="search" placeholder="Artistas, canciones, podcast...." aria-label="Search">
        <button class="btn btn-outline-custom" type="submit">Buscar</button>
      </form>
      <!-- Logotipo de BeatBox -->
      <span class="navbar-brand d-none d-lg-block mx-3" style="font-size: 25px;">
        <img src="NBimg/icon.png" alt="BeatBox Logo" width="45" height="45" class="d-inline-block align-center">
        BeatBox
      </span>
      <!-- Botón de Offcanvas(menú) -->
      <button class="navbar-toggler mx-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation" style="margin-left: 50px;">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Offcanvas para el menú desplegable -->
      <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel" >
        <div class="offcanvas-header">
          <img src="NBimg/carpetas.png" alt="Offcanvas Icon" class="offcanvas-icon" style="margin-right: 5px;">
          <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">PlayList</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close" style="background-color: transparent;"></button>
        </div>
        <a id="add-playlist-btn" href="#" style="margin: -10px 0px 5px 15px;" class="<?php echo isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true ? '' : 'd-none'; ?>">
            <img src="NBimg/mas.png" width="25" height="25" alt="Más">
        </a>

        <div class="separador" style="margin-top: 0px; margin-bottom: 1%"></div>
        <div class="offcanvas-body">
          <!--Card de Me Gusta-->
          <a href="#" class="card text-bg-dark mb-3 custom-card">
            <div class="row g-0 h-100">
              <div class="col col-md-4 d-flex align-items-center justify-content-center">
                <img src="NBimg/corazon.png" class="img-fluid rounded" alt="Playlist Image" style="width: 50px; height: 50px;">
              </div>
              <div class="col-md-8 d-flex align-items-center">
                <div class="card-body">
                  <h6 class="card-title">Tus Me Gusta</h6>
                  <p id="song-count" class="card-text" style="font-size: 12px;"><span id="song-count-value">0</span> Canciones</p>
                </div>
              </div>
            </div>
          </a>

          <!--Cards de PlayList creadas-->
          <div id="playlist-container"></div>
          
        </div>
      </div>
    </div>
  </nav> 

<div class="separador nav fixed-top" style="z-index: 900;"></div>
<!--CIERRA NAVBAR-->



<div class="full-container">
    <div class="card perfil">
      <div class="row g-0">
        <div class="col-md-4 d-flex justify-content-center align-items-center position-relative">
            <div class="perfil-circulo">
              <div class="lapiz-perfil"></div>
              <div class="icono-lapiz">
                <img src="NBimg/lapiz.png" alt="Editar" class="imagen-perfil" onclick="uploadImage()">
              </div>
            </div>
          </div>
          <div class="col-md-8 d-flex align-items-center">
        <div class="card-body perfil-body">
          <h1 class="username-perfil"><?php echo $nombre ?></h1>
          <p class="username-unico"><?php echo $uniqueUsername ?></p>
          
          <table class="table table-borderless table-perfil">
            <thead>
              <tr>
                <th>Publicaciones</th>
                <th>Seguidores</th>
                <th>Seguidos</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td id="publicaciones">0</td>
                <td id="seguidores">0</td>
                <td id="seguidos">0</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      </div>
    </div>
  </div>

  <div class="play-circulo-container">
    <a href="#" class="play-circulo"><img src="NBimg/play.png" alt="Play" class="play-usuario-img"></a>
  </div>
  
  <h4 class="titulo-perfil">Mis PlayLists</h4>

  <div class="playlist-perfil">
    <button id="add-playlist-perfil" class="play-card">
        <div class="card-body">
            <img src="NBimg/mas.png" alt="Más" class="play-icon">
        </div>
    </button>

    <div id="playlist-perfil-container"></div>
  </div>



  <!-- Modal para cambiar el nombre de la playlist -->
  <div class="modal" id="renameModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="renameModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="renameModalLabel">Cambiar nombre de la Playlist</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="text" id="newPlaylistName" class="form-control" placeholder="Nuevo nombre">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-custom" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-outline-custom" id="guardarNombre">Guardar cambios</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> 
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

  <!--Script para subir imagen-->
  <script>
    function uploadImage() {
        const input = document.createElement('input');
        input.type = 'file';
        input.accept = 'image/*';
        input.onchange = (event) => {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const profileCircle = document.querySelector('.empty-profile');
                    profileCircle.style.backgroundImage = `url(${e.target.result})`;
                    profileCircle.style.backgroundSize = 'cover';
                    profileCircle.style.backgroundPosition = 'center';
                };
                reader.readAsDataURL(file);
            }
        };
        input.click();
    }
  </script>

  <script>
let playlistCount = 0;

// Obtener el contenedor de las playlists y el botón de "añadir"
const addPlaylistBtn = document.getElementById('add-playlist-perfil');
const playlistContainer = document.getElementById('playlist-perfil-container');

document.addEventListener("DOMContentLoaded", function () {


  // Función para crear una playlist en el DOM con el mismo estilo y comportamiento que `addPlaylist`
  function createPlaylistCard(playlist) {
    const newPlaylist = document.createElement('a');
    newPlaylist.href = '#';
    newPlaylist.className = 'card play-card mb-3'; // Estilo consistente
    newPlaylist.dataset.playlistId = playlist.id;

    const bodyCard = document.createElement('div');
    bodyCard.className = 'card-body text-center position-relative';

    const titleContainer = document.createElement('div');
    titleContainer.className = 'playlist-title-container';

    const title = document.createElement('h6');
    title.className = 'card-title mb-0';
    title.textContent = playlist.nombre;

    const songCount = document.createElement('p');
    songCount.className = 'card-text mb-0';
    songCount.style.fontSize = '12px';
    songCount.textContent = `${playlist.cantidad_canciones} Canciones`;

    titleContainer.appendChild(title);
    titleContainer.appendChild(songCount);
    bodyCard.appendChild(titleContainer);
    newPlaylist.appendChild(bodyCard);

    const optionsButton = document.createElement('button');
    optionsButton.className = 'btn btn-img position-absolute';
    optionsButton.style.top = '10px';
    optionsButton.style.right = '10px';
    optionsButton.style.border = 'none';
    optionsButton.innerHTML = '<img src="NBimg/menu.png" width="20" height="20" alt="Options">';
    newPlaylist.appendChild(optionsButton);

    const optionsMenu = document.createElement('div');
    optionsMenu.className = 'options-menu';
    optionsMenu.style.display = 'none';
    optionsMenu.style.position = 'absolute';
    optionsMenu.style.background = '#333';
    optionsMenu.style.borderRadius = '5px';
    optionsMenu.style.padding = '10px';
    optionsMenu.style.top = '-50px';
    optionsMenu.style.right = '0px';
    optionsMenu.innerHTML = `
      <button class="btn btn-outline-light btn-sm rename-playlist" style="margin-bottom: 10px;">Cambiar nombre</button>
      <button class="btn btn-outline-light btn-sm delete-playlist">Eliminar</button>
      <button class="btn btn-outline-light btn-sm close-menu">Cerrar</button>
    `;
    newPlaylist.appendChild(optionsMenu);

    // Agregar eventos al botón de opciones
    optionsButton.addEventListener('click', function (e) {
      e.preventDefault();
      optionsMenu.style.display = optionsMenu.style.display === 'none' ? 'block' : 'none';
    });

    // Cerrar el menú cuando se hace clic fuera
    document.addEventListener('click', function (e) {
      if (!optionsMenu.contains(e.target) && !optionsButton.contains(e.target)) {
        optionsMenu.style.display = 'none';
      }
    });

    // Cambiar nombre de la playlist
    const renameButton = optionsMenu.querySelector('.rename-playlist');
    renameButton.addEventListener('click', function () {
      const renameModal = new bootstrap.Modal(document.getElementById('renameModal'));
      renameModal.show();

      const saveButton = document.getElementById('guardarNombre');
      saveButton.onclick = function () {
        const newName = document.getElementById('newPlaylistName').value;
        if (newName) {
          title.textContent = newName;

          // Enviar solicitud al backend para actualizar el nombre
          fetch('backend/actualizar_nombre_playlist.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
              playlist_id: playlist.id,
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
    deleteButton.addEventListener('click', function () {
      fetch('backend/eliminar_playlist.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
          playlist_id: playlist.id,
        }),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            newPlaylist.remove();
            console.log('Playlist eliminada.');
          } else {
            console.error('Error al eliminar playlist:', data.error);
          }
        })
        .catch((error) => {
          console.error('Error:', error);
        });
    });

    // Botón para cerrar el menú
    const closeButton = optionsMenu.querySelector('.close-menu');
    closeButton.addEventListener('click', function () {
      optionsMenu.style.display = 'none';
    });

    // Agregar la playlist al contenedor
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

// Asignar el evento click al botón "más"
addPlaylistBtn.addEventListener('click', function (e) {
  e.preventDefault();
  addPlaylist();
});

</script>


</body>
</html>