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
    <link rel="stylesheet" href="css/player.css">
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

  
<!--Contendedor-->
<div class="container">
  <div class="row principal">

    <!--Reproductor-->
    <div class="col-md-5" id="col-izquierda">
      <div class="row d-flex primer">
        <!--Boton Like-->
        <div class="col align-self-end">
          <button type="button" id="me-gusta" onclick="toggleLike()" class="btn ctrl btn-me-gusta">
            <svg id="me-gusta-icon" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
              <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
            </svg>
          </button>
        </div>

        <!--Imagen album-->
        <div class="col">
          <div class="card izq text-center" style="width: 20rem; height: fit-content;">
          <img id="imagen-album" src="" class="card-img-top" alt="Portada del album" style="max-width: 20rem;">
          </div> <!--Cierra Card -->
        </div>

        <!--Boton agregar-->
        <div class="col align-self-end">
          <button type="button" id="agregar" onclick="toggleAgregar()" class="btn ctrl btn-agregar">
            <svg id="agregar-icon" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
              <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
            </svg>
          </button>
        </div>
      </div> <!--Cierra row primer-->

      <div class="row" id="audio-player">
        <!--Muestra el titulo de la cancion y el autor-->
        <div class="display-cancion-artista"> 
          <a href="#" style="font-weight: bold; display: block; max-width: fit-content; justify-content: center; margin-top: 2px; font-size: 19px;" id="titulo-cancion"></a>
          <a href="#" style="font-size: 16px; opacity: 0.6;" id="artista-cancion"></a>
        </div>

        <!--Botones que controlan la cancion-->
        <div class="botones-control" style="margin-top: 5px;">
          <!-- Aleatorio  -->
          <button type="button" id="aleatorio" class="btn ctrl btn-aleatorio" >
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-shuffle" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M0 3.5A.5.5 0 0 1 .5 3H1c2.202 0 3.827 1.24 4.874 2.418.49.552.865 1.102 1.126 1.532.26-.43.636-.98 1.126-1.532C9.173 4.24 10.798 3 13 3v1c-1.798 0-3.173 1.01-4.126 2.082A9.6 9.6 0 0 0 7.556 8a9.6 9.6 0 0 0 1.317 1.918C9.828 10.99 11.204 12 13 12v1c-2.202 0-3.827-1.24-4.874-2.418A10.6 10.6 0 0 1 7 9.05c-.26.43-.636.98-1.126 1.532C4.827 11.76 3.202 13 1 13H.5a.5.5 0 0 1 0-1H1c1.798 0 3.173-1.01 4.126-2.082A9.6 9.6 0 0 0 6.444 8a9.6 9.6 0 0 0-1.317-1.918C4.172 5.01 2.796 4 1 4H.5a.5.5 0 0 1-.5-.5"/>
              <path d="M13 5.466V1.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192m0 9v-3.932a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192"/>
            </svg>
          </button>

          <!-- Saltear Atras  -->
          <button type="button" id="saltear-atras" class="btn ctrl btn-saltear-atras">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-skip-start-fill" viewBox="0 0 16 16">
              <path d="M4 4a.5.5 0 0 1 1 0v3.248l6.267-3.636c.54-.313 1.232.066 1.232.696v7.384c0 .63-.692 1.01-1.232.697L5 8.753V12a.5.5 0 0 1-1 0z"/>
            </svg>
          </button>

          <!-- Play Pause  -->
          <button type="button" id="playPause" class="btn ctrl btn-play">
            <svg id="playPauseIcon" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-play-fill" viewBox="0 0 16 16">
              <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
            </svg>
          </button>

          <!-- Saltear Adelante  -->
          <button type="button" id="saltear-adelante" class="btn ctrl btn-saltear-adelante">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-skip-end-fill" viewBox="0 0 16 16">
              <path d="M12.5 4a.5.5 0 0 0-1 0v3.248L5.233 3.612C4.693 3.3 4 3.678 4 4.308v7.384c0 .63.692 1.01 1.233.697L11.5 8.753V12a.5.5 0 0 0 1 0z"/>
            </svg>
          </button>

          <!-- Repetir  -->
          <button type="button" id="repetir" class="btn ctrl btn-desactivado">
            <svg id="repetir-icon" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-repeat" viewBox="0 0 16 16">
              <path d="M11 5.466V4H5a4 4 0 0 0-3.584 5.777.5.5 0 1 1-.896.446A5 5 0 0 1 5 3h6V1.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192m3.81.086a.5.5 0 0 1 .67.225A5 5 0 0 1 11 13H5v1.466a.25.25 0 0 1-.41.192l-2.36-1.966a.25.25 0 0 1 0-.384l2.36-1.966a.25.25 0 0 1 .41.192V12h6a4 4 0 0 0 3.585-5.777.5.5 0 0 1 .225-.67Z"/>
            </svg>
          </button>
        </div>
        
        <div class="row justify-content-center">
          <!--Muestra en que minuto esta la cancion de forma visual-->
          <div class="progress" id="contenedor-barra-progreso" role="progressbar" aria-label="cancion-visual" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div id="barra-progreso" class="progress-bar"></div>
          </div> <!--Cierra Progress -->
        </div>
        
        <div class="row d-flex align-items-center mx-3" style="padding: 0 5px;">
          <!--Muestra en que minuto esta la cancion con numeros y el tiempo total-->
          <div class="col" style="text-align: left;"><span id="current-time">0:00 </span> / <span id="total-time"> 0:00</span></div>

          <div class="col d-flex justify-content-end align-items-center">
            <div class="slidecontainer">
              <button type="button" id="icono-volumen" class="btn ctrl btn-sonido-on" style="display: flex; align-items: center;" >
                <svg id="volume-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-volume-up-fill" viewBox="0 0 16 16">
                  <path d="M11.536 14.01A8.47 8.47 0 0 0 14.026 8a8.47 8.47 0 0 0-2.49-6.01l-.708.707A7.48 7.48 0 0 1 13.025 8c0 2.071-.84 3.946-2.197 5.303z"/>
                  <path d="M10.121 12.596A6.48 6.48 0 0 0 12.025 8a6.48 6.48 0 0 0-1.904-4.596l-.707.707A5.48 5.48 0 0 1 11.025 8a5.48 5.48 0 0 1-1.61 3.89z"/>
                  <path d="M8.707 11.182A4.5 4.5 0 0 0 10.025 8a4.5 4.5 0 0 0-1.318-3.182L8 5.525A3.5 3.5 0 0 1 9.025 8 3.5 3.5 0 0 1 8 10.475zM6.717 3.55A.5.5 0 0 1 7 4v8a.5.5 0 0 1-.812.39L3.825 10.5H1.5A.5.5 0 0 1 1 10V6a.5.5 0 0 1 .5-.5h2.325l2.363-1.89a.5.5 0 0 1 .529-.06"/>
                </svg>
              </button>
  
              <input type="range" min="0" max="100" value="30" class="slider" id="volume-slider">

              <p id="volume">30</p>
            </div>
          </div>
        </div>
      </div> <!--Cierra row audio player-->
    </div> <!--Cierra Columna -->


    <div class="col-md-4 d-none d-sm-block" id="col-derecha">
      <div class="card-body der">

        <!--Botones de opciones-->
        <div class="card-title">
          <div class="row d-flex justify-content-between">
            <div class="col-sm-4 d-flex justify-content-center"><button type="button" class="btn opciones" onclick="mostrarContenido('continuacion')" id="continuacion">A continuación</button></div>
            <div class="col-sm-4 d-flex justify-content-center"><button type="button" class="btn opciones" onclick="mostrarContenido('letra')" id="letras">Letra</button></div>
            <div class="col-sm-4 d-flex justify-content-center"><button type="button" class="btn opciones" onclick="mostrarContenido('contenido')" id="contenido">Contenido</button></div>
            <div class="separador"></div>
          </div><!--Cierra row-->
        </div>
        
        <div class="card-text" style="width: 100%;">
          <div class="row d-flex justify-content-center" id="mostrar-contenido"></div>
        </div>
      </div> <!--Cierra Card -->
    </div><!--Cierra Columna -->
  </div> <!--Cierra row-->
</div> <!--Cierra contenedor-->


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> 
<script src="JS/botonesControl.js"></script>
<script src="JS/audio.js"></script> 
<script src="JS/contenido.js"></script>
<script src="JS/offset.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vibrant.js/1.0.0/Vibrant.min.js"></script>
</body>
</html>

