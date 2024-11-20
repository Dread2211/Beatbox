<?php
  session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/navBar.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/footer.css">
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
          <li><a class="dropdown-item" href="player.php">Reproductor</a></li>
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

  <div class="container mt-4">
    <div class="botones">
      <div class="d-flex">
        <button type="button" class="btn btn-outline-custom1">TOP</button>
        <button type="button" class="btn btn-outline-custom1">LIVES</button>
        <button type="button" class="btn btn-outline-custom1">PODCAST</button>
        <button type="button" class="btn btn-outline-custom1">RECOMENDADOS</button>
      </div>
    </div>
    <!--Sección 1-->
    <!-- Sección 1 -->
    <h4 class="titulo">Recientes</h4>
    <div class="row row-cols-1 row-cols-md-5 g-4" id="song-container">
        <!-- Las tarjetas de canciones se generarán aquí dinámicamente -->
    </div>

    <!--Sección 2-->
    <h4 class="titulo">Porque Escuchaste Este Género</h4>
    <div class="row row-cols-1 row-cols-md-5 g-4">
      <div class="col">
        <div class="card h-100">
          <img src="#" alt="cancion" class="card-img-top" id="img-cancion">
          <div class="card-body">
            <h5 class="card-title" id="titulo-cancion">Canción 1</h5>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <img src="#" alt="cancion" class="card-img-top" id="img-cancion">
          <div class="card-body">
            <h5 class="card-title" id="titulo-cancion">Canción 2</h5>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <img src="#" alt="cancion" class="card-img-top" id="img-cancion">
          <div class="card-body">
            <h5 class="card-title" id="titulo-cancion">Canción 3</h5>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <img src="#" alt="cancion" class="card-img-top" id="img-cancion">
          <div class="card-body">
            <h5 class="card-title" id="titulo-cancion">Canción 4</h5>
          </div>
        </div>
      </div>
      <div class="col">
        <a href="#" class="h-100 d-flex flex-column justify-content-center align-items-center text-center btn btn-outline-custom">
          Más
        </a>
      </div>
    </div>
    <!--Sección 3-->
    <h4 class="titulo">Lo Más Escuchado</h4>
    <div class="row row-cols-1 row-cols-md-5 g-4">
      <div class="col">
        <div class="card h-100">
          <img src="#" alt="cancion" class="card-img-top" id="img-cancion">
          <div class="card-body">
            <h5 class="card-title" id="titulo-cancion">Canción 1</h5>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <img src="#" alt="cancion" class="card-img-top" id="img-cancion">
          <div class="card-body">
            <h5 class="card-title" id="titulo-cancion">Canción 2</h5>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <img src="#" alt="cancion" class="card-img-top" id="img-cancion">
          <div class="card-body">
            <h5 class="card-title" id="titulo-cancion">Canción 3</h5>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <img src="#" alt="cancion" class="card-img-top" id="img-cancion">
          <div class="card-body">
            <h5 class="card-title" id="titulo-cancion">Canción 4</h5>
          </div>
        </div>
      </div>
      <div class="col">
        <a href="#" class="h-100 d-flex flex-column justify-content-center align-items-center text-center btn btn-outline-custom">
          Más
        </a>
      </div>
    </div>
    <!--Sección 4-->
    <h4 class="titulo">Lanzamientos Recientes</h4>
    <div class="row row-cols-1 row-cols-md-5 g-4">
      <div class="col">
        <div class="card h-100">
          <img src="#" alt="cancion" class="card-img-top" id="img-cancion">
          <div class="card-body">
            <h5 class="card-title" id="titulo-cancion">Canción 1</h5>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <img src="#" alt="cancion" class="card-img-top" id="img-cancion">
          <div class="card-body">
            <h5 class="card-title" id="titulo-cancion">Canción 2</h5>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <img src="#" alt="cancion" class="card-img-top" id="img-cancion">
          <div class="card-body">
            <h5 class="card-title" id="titulo-cancion">Canción 3</h5>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <img src="#" alt="cancion" class="card-img-top" id="img-cancion">
          <div class="card-body">
            <h5 class="card-title" id="titulo-cancion">Canción 4</h5>
          </div>
        </div>
      </div>
      <div class="col">
        <a href="#" class="h-100 d-flex flex-column justify-content-center align-items-center text-center btn btn-outline-custom">
          Más
        </a>
      </div>
    </div>
    <!--Sección 5-->
    <h4 class="titulo">Artistas Destacados</h4>
    <div class="row row-cols-1 row-cols-md-5 g-4">
      <div class="col">
        <div class="card h-100">
          <img src="#" alt="cancion" class="card-img-top" id="img-cancion">
          <div class="card-body">
            <h5 class="card-title" id="titulo-cancion">Canción 1</h5>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <img src="#" alt="cancion" class="card-img-top" id="img-cancion">
          <div class="card-body">
            <h5 class="card-title" id="titulo-cancion">Canción 2</h5>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <img src="#" alt="cancion" class="card-img-top" id="img-cancion">
          <div class="card-body">
            <h5 class="card-title" id="titulo-cancion">Canción 3</h5>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <img src="#" alt="cancion" class="card-img-top" id="img-cancion">
          <div class="card-body">
            <h5 class="card-title" id="titulo-cancion">Canción 4</h5>
          </div>
        </div>
      </div>
      <div class="col">
        <a href="#" class="h-100 d-flex flex-column justify-content-center align-items-center text-center btn btn-outline-custom">
          Más
        </a>
      </div>
    </div>
  </div>

  <!-- <button id="playButton">Reproducir canción</button> -->

  <footer id="playerFooter" class="hidden">
    <div class="player d-flex flex-row justify-content-between w-100 px-3 py-1 z-100 align-items-center fixed-bottom" style="background-color: black; height: 80px; column-gap: 10px; color: white;">
      <div class="col col-footer custom-col d-flex">
        <img src="img/Pleasex3.jpeg" alt="Song img" width="60" height="60" style="border-radius: 15%;">
        <div class="display-artista-cancion">
          <a href="#" style="font-size: 15px; font-weight: 500; margin-top: 4px;" id="titulo-cancion"></a>
          <a href="#" style="opacity: 0.6; font-size: 14px;" id="artista-cancion"></a>
        </div>
        <button type="button" id="me-gusta" onclick="toggleLike()" class="btn ctrl btn-me-gusta fixed-right" style="align-items: center; border: none;">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
          </svg>
        </button>
      </div>

      <div class="col controles">
        <div class="row player">
          <div class="reproductor">
            <!-- ALEATORIO -->
            <button type="button" id="aleatorio" class="btn ctrl btn-aleatorio" >
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-shuffle" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M0 3.5A.5.5 0 0 1 .5 3H1c2.202 0 3.827 1.24 4.874 2.418.49.552.865 1.102 1.126 1.532.26-.43.636-.98 1.126-1.532C9.173 4.24 10.798 3 13 3v1c-1.798 0-3.173 1.01-4.126 2.082A9.6 9.6 0 0 0 7.556 8a9.6 9.6 0 0 0 1.317 1.918C9.828 10.99 11.204 12 13 12v1c-2.202 0-3.827-1.24-4.874-2.418A10.6 10.6 0 0 1 7 9.05c-.26.43-.636.98-1.126 1.532C4.827 11.76 3.202 13 1 13H.5a.5.5 0 0 1 0-1H1c1.798 0 3.173-1.01 4.126-2.082A9.6 9.6 0 0 0 6.444 8a9.6 9.6 0 0 0-1.317-1.918C4.172 5.01 2.796 4 1 4H.5a.5.5 0 0 1-.5-.5"/>
                <path d="M13 5.466V1.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192m0 9v-3.932a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192"/>
              </svg>
            </button>
  
            <!-- SALTEAR ATRAS -->
            <button type="button" id="saltear-atras" class="btn ctrl btn-saltear-atras">
              <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-skip-start-fill" viewBox="0 0 16 16">
                <path d="M4 4a.5.5 0 0 1 1 0v3.248l6.267-3.636c.54-.313 1.232.066 1.232.696v7.384c0 .63-.692 1.01-1.232.697L5 8.753V12a.5.5 0 0 1-1 0z"/>
              </svg>
            </button>
  
            <!-- REPRODUCIR / PAUSAR -->
            <button type="button" id="playPause" class="btn ctrl btn-play" onclick="togglePlayPause()">
              <svg id="playPauseIcon" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-play-fill" viewBox="0 0 16 16">
                <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
              </svg>
            </button>
  
            <!-- SALTEAR ADELANTE -->
            <button type="button" id="saltear-adelante" class="btn ctrl btn-saltear-adelante">
              <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-skip-end-fill" viewBox="0 0 16 16">
                <path d="M12.5 4a.5.5 0 0 0-1 0v3.248L5.233 3.612C4.693 3.3 4 3.678 4 4.308v7.384c0 .63.692 1.01 1.233.697L11.5 8.753V12a.5.5 0 0 0 1 0z"/>
              </svg>
            </button>
  
            <!-- REPETIR CANCION / LISTA -->
            <button type="button" id="repetir" onclick="toggleRepetir()" class="btn ctrl btn-desactivado">
              <svg id="repetir-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-repeat desactivado" viewBox="0 0 16 16">
                <path d="M11 5.466V4H5a4 4 0 0 0-3.584 5.777.5.5 0 1 1-.896.446A5 5 0 0 1 5 3h6V1.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192m3.81.086a.5.5 0 0 1 .67.225A5 5 0 0 1 11 13H5v1.466a.25.25 0 0 1-.41.192l-2.36-1.966a.25.25 0 0 1 0-.384l2.36-1.966a.25.25 0 0 1 .41.192V12h6a4 4 0 0 0 3.585-5.777.5.5 0 0 1 .225-.67Z"/>
              </svg>
            </button>
          </div>
        </div>

        <div class="row player" style="flex-wrap: nowrap; margin: 0; padding: 0;">
          <div class="col" style="max-width: fit-content;"><span id="current-time">0:00</span></div>

          <div class="col">
            <div class="progress" id="barra-progreso" role="progressbar" aria-label="cancion-visual" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="height: 5px; margin: 5px;">
              <div class="progress-bar w-100" style="background-color: #ffb5d7;"></div>
            </div> <!--Cierra Progress -->
          </div>

          <div class="col" style="max-width: fit-content;"><span id="total-time">0:00</span></div>
        </div>
      </div>

      <div class="col custom-col d-flex justify-content-end">
        <div class="slidecontainer">
          <input type="range" min="1" max="100" value="30" class="slider" id="volume">
          <svg id="volume-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-volume-up-fill" viewBox="0 0 16 16">
            <path d="M11.536 14.01A8.47 8.47 0 0 0 14.026 8a8.47 8.47 0 0 0-2.49-6.01l-.708.707A7.48 7.48 0 0 1 13.025 8c0 2.071-.84 3.946-2.197 5.303z"/>
            <path d="M10.121 12.596A6.48 6.48 0 0 0 12.025 8a6.48 6.48 0 0 0-1.904-4.596l-.707.707A5.48 5.48 0 0 1 11.025 8a5.48 5.48 0 0 1-1.61 3.89z"/>
            <path d="M8.707 11.182A4.5 4.5 0 0 0 10.025 8a4.5 4.5 0 0 0-1.318-3.182L8 5.525A3.5 3.5 0 0 1 9.025 8 3.5 3.5 0 0 1 8 10.475zM6.717 3.55A.5.5 0 0 1 7 4v8a.5.5 0 0 1-.812.39L3.825 10.5H1.5A.5.5 0 0 1 1 10V6a.5.5 0 0 1 .5-.5h2.325l2.363-1.89a.5.5 0 0 1 .529-.06"/>
          </svg>
        </div>
      </div>
    </div>
  </footer>

 <!-- Modal Iniciar Sesión -->
 <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="loginModalLabel">Iniciar Sesión</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="loginForm" action="backend/inicio_sesion.php" method="POST">
            <label for="usuario" class="form-label">Nombre de usuario</label>
            <input type="text" name="usuario" id="usuario1" required class="form-control">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" name="password" id="password1" required class="form-control">
          </form>
        </div>
        <div class="modal-footer d-flex flex-column align-items-center">
          <button type="submit" form="loginForm" class="btn btn-outline-custom mb-1">Iniciar Sesión</button>
          <button type="button" class="btn btn-link p-0 m-0" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#registerModal">¿No tienes cuenta? Regístrate</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Registrarse -->
  <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="registerModalLabel">Registrarse</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="registerForm" action="backend/registrar.php" method="POST">
            <div class="row">
              <div class="col-md-6">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" name="name" id="name" required class="form-control">
              </div>
              <div class="col-md-6">
                <label for="usuario" class="form-label">Nombre de usuario</label>
                <input type="text" name="usuario" id="usuario2" required class="form-control">
              </div>
            </div>
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" id="telefono" required class="form-control">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" name="email" id="email" required class="form-control">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" name="password" id="password2" required class="form-control">
          </form>
        </div>
        <div class="modal-footer d-flex flex-column align-items-center">
          <button type="submit" form="registerForm" class="btn btn-outline-custom">Registrarse</button>
          <button type="button" class="btn btn-link p-0 m-0" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#loginModal">¿Tenés cuenta? Iniciá Sesión</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal de error -->
  <div class="modal" id="errorModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" style="color: white; background-color: #721c24; border: 2px solid #f5c6cb;">
        <div class="modal-header">
          <h5 class="modal-title" id="errorModalLabel">Error</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p id="errorMessage"></p>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal de éxito -->
  <div class="modal" id="successModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="successModalLabel">Éxito</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p id="successMessage"></p>
        </div>
      </div>
    </div>
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

<script src="JS/sesion.js"></script>
<script src="JS/offset.js"></script>
<script src="JS/mostrar_cards.js"></script>
<script src="JS/audio.js"></script>

<script>
  document.getElementById('playButton').addEventListener('click', function () {
    const footer = document.getElementById('playerFooter');
    const audio = document.getElementById('audioPlayer');
    
    // Muestra el footer si está oculto
    footer.classList.remove('hidden');
    
    // Reproduce la canción
    audio.play();
});
</script>


</body>
</html>