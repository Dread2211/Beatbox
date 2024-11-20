<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BeatBox</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/playlist.css">
    <link rel="stylesheet" href="css/navBar.css">
    <link rel="icon" href="NBimg/icon.png">
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

        <a id="add-playlist-btn" href="#" style="margin: -10px 0px 5px 15px;" 
          class="<?php echo isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true ? '' : 'd-none'; ?>">
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



<div class="container">
    <!-- Imagen y titulo -->
    <div class="row primera align-items-center justify-content-space-around">
        <div class="col" style="max-width: fit-content; margin: 15px">
            <img id="imagen-playlist" src="img/obsesionario.jpeg" class="card-img-top" alt="Portada de la playlist" width="250" height="250" style="border-radius: 7px;">
        </div>

        <div class="col titulos ml-4 justify-content-center align-items-center">
          <h1 id="playlist-titulo" style="font-size: 3em; font-weight: bolder;">Nombre de Playlist/Album</h1>
          <p id="creador" class="subtitulo" style="font-size: 120%;">Creador de la lista</p>
          <span id="cantidad" class="subtitulo">Cantidad de canciones</span> • <span id="fecha-creacion" class="subtitulo">dd/mm/aaaa</span>
        </div>
    </div>


    <!-- Botones -->
    <div class="row segunda">
      <div class="col segunda">
        <button type="button" id="playPause" class="btn ctrl btn-play">
          <svg id="playPauseIcon" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-play-fill" viewBox="0 0 16 16">
            <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
          </svg>
        </button>
  
        <button type="button" id="aleatorio" class="btn ctrl btn-aleatorio" >
          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-shuffle" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M0 3.5A.5.5 0 0 1 .5 3H1c2.202 0 3.827 1.24 4.874 2.418.49.552.865 1.102 1.126 1.532.26-.43.636-.98 1.126-1.532C9.173 4.24 10.798 3 13 3v1c-1.798 0-3.173 1.01-4.126 2.082A9.6 9.6 0 0 0 7.556 8a9.6 9.6 0 0 0 1.317 1.918C9.828 10.99 11.204 12 13 12v1c-2.202 0-3.827-1.24-4.874-2.418A10.6 10.6 0 0 1 7 9.05c-.26.43-.636.98-1.126 1.532C4.827 11.76 3.202 13 1 13H.5a.5.5 0 0 1 0-1H1c1.798 0 3.173-1.01 4.126-2.082A9.6 9.6 0 0 0 6.444 8a9.6 9.6 0 0 0-1.317-1.918C4.172 5.01 2.796 4 1 4H.5a.5.5 0 0 1-.5-.5"/>
            <path d="M13 5.466V1.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192m0 9v-3.932a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192"/>
          </svg>
        </button>
  
        <button type="button" id="me-gusta" onclick="toggleLike()" class="btn ctrl btn-me-gusta">
          <svg id="me-gusta-icon" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
          </svg>
        </button>
      </div>

      <div class="col segunda">
        <div class="input-group">
          <input class="form-control rounded-end" type="search" placeholder="Artistas, canciones" aria-label="Search">
          <button class="btn ctrl" type="submit" style="width: fit-content; background-color: transparent;">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16" >
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
            </svg>
          </button>
        </div>
  
        <button type="button" id="opciones" class="btn ctrl" >
          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
            <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/>
          </svg>
        </button>
      </div>
    </div>

    <div class="row album-song-header">
      <div class="col-1 text-center">#</div>
      <div class="col-2 text-center">-</div>
      <div class="col-2 text-center">Título</div>
      <div class="col-2 text-center">Artista</div>
      <div class="col-2 text-center">Fecha Agregada</div>
      <div class="col-1 text-center">-</div>
      <div class="col-1 text-center"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
        <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
      </svg></div>
      <div class="col-1 text-center">-</div>
    </div>

    <ul id="album-songs" class="album-songs-list">
      <li id="song-${song.id}" class="album-song">
          <div class="row align-items-center" id="album-song-info">
              <div class="col-1 text-center" id="numero-posicion">1</div>
              <div class="col-2 text-center" id="album-song-img">
                  <img src="img/the-fame.jpeg" alt="Imagen del Album" style="max-width: 60px;">
              </div>
              <div class="col-2 text-center" id="album-song-title">Poker Face</div>
              <div class="col-2 text-center" id="album-song-artist">Lady Gaga</div>
              <div class="col-2 text-center" id="fecha-agregado">24/10/2024</div>
              <div class="col-1 text-center">
                <button type="button" id="me-gusta" onclick="toggleLike()" class="btn ctrl agregar-cancion">
                  <svg id="me-gusta-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                  </svg>
                </button>
              </div>
              <div class="col-1 text-center" id="album-song-duration">03:43</div>
              <div class="col-1 text-center">
                <button type="button" id="opciones" class="btn ctrl" >
                  <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                    <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/>
                  </svg>
                </button>
              </div>
          </div>
      </li>

      <li id="song-${song.id}" class="album-song">
        <div class="row align-items-center" id="album-song-info">
            <div class="col-1 text-center" id="numero-posicion">1</div>
            <div class="col-2 text-center" id="album-song-img">
                <img src="img/the-fame.jpeg" alt="Imagen del Album" style="max-width: 60px;">
            </div>
            <div class="col-2 text-center" id="album-song-title">Poker Face</div>
            <div class="col-2 text-center" id="album-song-artist">Lady Gaga</div>
            <div class="col-2 text-center" id="fecha-agregado">24/10/2024</div>
            <div class="col-1 text-center">
              <button type="button" id="me-gusta" onclick="toggleLike()" class="btn ctrl agregar-cancion">
                <svg id="me-gusta-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                  <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                </svg>
              </button>
            </div>
            <div class="col-1 text-center" id="album-song-duration">03:43</div>
            <div class="col-1 text-center">
              <button type="button" id="opciones" class="btn ctrl" >
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                  <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/>
                </svg>
              </button>
            </div>
        </div>
    </li>
  </ul>
</div>





<script src="JS/audio.js"></script> 
<script src="JS/offset.js"></script>

</body>
</html>



