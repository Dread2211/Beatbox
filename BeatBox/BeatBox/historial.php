<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BeatBox</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/historial.css">
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


  <div class="container total">
    <div class="dropdown tiempo">
        <button id="dropdownButton" class="btn dropdown-toggle" onclick="tiempo()" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        Hoy
        </button>
        <ul id="dropdownMenu" class="dropdown-menu dropdown-menu-dark">
        <li><a class="dropdown-item" onclick="tiempo('hoy')" id="hoy">Hoy</a></li>
        <li><a class="dropdown-item" onclick="tiempo('semana')" id="semana">Hace una semana</a></li>
        <li><a class="dropdown-item" onclick="tiempo('mes')" id="mes">Hace un mes</a></li>
        <li><a class="dropdown-item" onclick="tiempo('plus-mes')" id="plus">Más de un mes</a></li>
        </ul>
    </div>

   
    <div id="lista-historial" class="container historial">
        <div class="row orden" style="flex-direction: row;">
            <span class="opc">Imagen</span>
            <span class="opc">Titulo</span>
            <span class="opc">Artista</span>
            <span class="opc">Album</span>
            <span class="opc">Duracion</span>
            <span class="opc">Favorito</span>
            <span class="opc">#</span>
        </div>
        
        <div class="separador" style="background-color: aliceblue; height: 1px;"></div>

        <div class="row">
            <ul id="historial-songs" class="historial-songs-list">
                <li id="song-${song.id}" class="historial-song">
                    <button class="historial-song-info btn song">
                        <!--<span class="historial-song-img"><img src="${song.img}" alt="Imagen del Album" style="max-width: 50px"></span>
                        <span class="historial-song-title">${song.title}</span>
                        <span class="historial-song-artist">${song.artist}</span>
                        <span class="historial-song-album">${song.album}</span>
                        <span class="historial-song-duration">${song.duration}</span>-->
    
                        <span class="historial-song-img"><img src="img/ghost.jpeg" alt="Imagen del Album" width="60" height="60" style="border-radius: 5px;"></span>
                        <span class="historial-song-title">Ghost Choir</span>
                        <span class="historial-song-artist">Louie Zong</span>
                        <span class="historial-song-album">Ghosts</span>
                        <span class="historial-song-duration">2:33</span>
                    </button>


                    <div class="historial-botones d-flex text-center" style="flex: 1; align-items: center; justify-content: space-around;">
                      <div class="col d-flex justify-content-center">
                        <button type="button" id="me-gusta" onclick="toggleLike()" class="btn ctrl btn-me-gusta">
                        <svg id="me-gusta-icon" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                          <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                        </svg>
                      </button></div>

                      <div class="col d-flex justify-content-center"><button type="button" id="three-dots" class="btn ctrl btn-three-dots" style="text-align: right;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                          <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/>
                        </svg>
                      </button></div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    
  </div>

<script src="JS/user.js"></script>  
<script src="JS/dropdownTiempo.js"></script>
<script src="JS/botonesControl.js"></script>
<script src="JS/offset.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>