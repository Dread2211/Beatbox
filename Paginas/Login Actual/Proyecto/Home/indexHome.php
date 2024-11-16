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
    <link rel="stylesheet" href="styleHome.css">
    <link rel="icon" href="img/icon.png">
</head>
<body>
  <!-- Barra de navegación -->
  <nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <!-- Icono del usuario con menú desplegable -->
      <div class="d-flex align-items-center">
        <img src="img/usuario.png" alt="User" class="rounded-circle user-icon" data-bs-toggle="dropdown" aria-expanded="false">
        <ul class="dropdown-menu dropdown-menu-dark">
          <li><a class="dropdown-item" href="#">Perfil</a></li>
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
        <div class="d-flex align-items-center" style="margin-left: 50px;">
        <a class="navbar-brand d-none d-lg-block mx-3" href="indexHome.html" title="Inicio"><img src="img/casa.png" alt="Inicio" width="30" height="30"></a>
        <a class="navbar-brand d-none d-lg-block mx-3" href="../Explorar/indexExp.html" title="Explorar"><img src="img/brujula.png" alt="Explorar" width="30" height="30"></a>
        <a class="navbar-brand d-none d-lg-block mx-3" href="#" title="Historial"><img src="img/historial.png" alt="historial" width="30" height="30"></a>
      </div>
      <!-- Búsqueda -->
      <form class="d-flex justify-content-center flex-grow-1 mx-5">
        <input class="form-control me-2" style="width: 70%; background-color: #FFF2CC;" type="search" placeholder="Artistas, canciones, podcast...." aria-label="Search">
        <button class="btn btn-outline-custom" type="submit">Buscar</button>
      </form>
      <!-- Logotipo de BeatBox -->
      <span class="navbar-brand d-none d-lg-block mx-3" style="font-size: 25px;">
        <img src="img/icon.png" alt="BeatBox Logo" width="45" height="45" class="d-inline-block align-top">
        BeatBox
      </span>
      <!-- Botón de Offcanvas(menú) -->
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation" style="margin-left: 50px;">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Offcanvas para el menú desplegable -->
      <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel" >
        <div class="offcanvas-header">
          <img src="img/carpetas.png" alt="Offcanvas Icon" class="offcanvas-icon" style="margin-right: 5px;">
          <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">PlayList</h5>
          <button type="button" class="btn-close btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <a id="add-playlist-btn" href="#" style="margin: -10px 0px 5px 15px;" 
          class="<?php echo isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true ? '' : 'd-none'; ?>">
            <img src="img/mas.png" width="25" height="25" alt="Más">
        </a>
        <div class="separador" style="margin-top: 0px; margin-bottom: 1%"></div>
        <div class="offcanvas-body">
          <!--Card de Me Gusta-->
          <a href="#" class="card text-bg-dark mb-3 custom-card">
            <div class="row g-0 h-100">
              <div class="col col-md-4 d-flex align-items-center justify-content-center">
                <img src="img/corazon.png" class="img-fluid rounded" alt="Playlist Image" style="width: 50px; height: 50px;">
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

  <div class="separador fixed-top" style="z-index: 900; margin-top: 80px;"></div>
  
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
    <h4 class="titulo">Recientes</h4>
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
    <!--Sección 6-->
    <h4 class="titulo">Descubrimientos Semanales</h4>
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


  <!-- Modal Iniciar Sesión -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="loginModalLabel">Iniciar Sesión</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="loginForm" action="inicio_sesion.php" method="POST">
            <label for="usuario" class="form-label">Nombre de usuario</label>
            <input type="text" name="usuario" id="usuario" required class="form-control">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" name="password" id="password" required class="form-control">
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
          <form id="registerForm" action="registrar.php" method="POST">
            <div class="row">
              <div class="col-md-6">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" name="name" id="name" required class="form-control">
              </div>
              <div class="col-md-6">
                <label for="usuario" class="form-label">Nombre de usuario</label>
                <input type="text" name="usuario" id="usuario" required class="form-control">
              </div>
            </div>
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" id="telefono" required class="form-control">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" name="email" id="email" required class="form-control">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" name="password" id="password" required class="form-control">
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

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> 
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  
  <!-- JavaScript del Iniciar Sesión, Registrarse, error y éxito -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const loginForm = document.getElementById('loginForm');

      if (loginForm) {
        loginForm.addEventListener('submit', async (e) => {
          e.preventDefault();
          const formData = new FormData(loginForm);

          try {
            const response = await fetch(loginForm.action, {
              method: 'POST',
              body: formData
            });

            if (response.ok) {
              const data = await response.json();

              if (data.status === 'success') {
                // Cierra el modal de inicio de sesión
                const loginModal = bootstrap.Modal.getInstance(document.getElementById('loginModal'));
                if (loginModal) {
                  loginModal.hide();
                }

                // Mostrar modal de éxito
                const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                document.getElementById('successMessage').textContent = data.message;
                successModal.show();

                // Actualiza los botones tras un inicio de sesión exitoso
                document.getElementById('loginButton').classList.add('d-none');
                document.getElementById('logoutForm').classList.remove('d-none');
              } else {
                // Mostrar modal de error
                showErrorModal(data.message);
              }
            } else {
              showErrorModal('Error al procesar la solicitud. Inténtelo nuevamente.');
            }
          } catch (error) {
            console.error('Error de red:', error);
            showErrorModal('Error de red. Inténtelo nuevamente.');
          }
        });
      }

      const registerForm = document.getElementById('registerForm'); // Asegúrate de que este ID sea correcto

      if (registerForm) {
        registerForm.addEventListener('submit', async (e) => {
          e.preventDefault();
          const formData = new FormData(registerForm);

          try {
            const response = await fetch(registerForm.action, {
              method: 'POST',
              body: formData
            });

            if (response.ok) {
              const data = await response.json();

              if (data.status === 'success') {
                // Cierra el modal de registro
                const registerModal = bootstrap.Modal.getInstance(document.getElementById('registerModal')); 
                if (registerModal) {
                  registerModal.hide(); // Cerrar el modal de registro
                }

                // Mostrar modal de éxito si el registro fue exitoso
                const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                document.getElementById('successMessage').textContent = data.message; // Mensaje personalizado
                successModal.show();

                // Opcional: Limpiar el formulario después de registro exitoso
                registerForm.reset();
              } else {
                // Mostrar modal de error si hubo un problema
                showErrorModal(data.message);
              }
            } else {
              showErrorModal('Error al procesar la solicitud. Inténtelo nuevamente.');
            }
          } catch (error) {
            console.error('Error de red:', error);
            showErrorModal('Error de red. Inténtelo nuevamente.');
          }
        });
      }

      // Función para mostrar el modal de error
      function showErrorModal(message) {
        const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
        document.getElementById('errorMessage').textContent = message;
        errorModal.show();
      }

      // Función para actualizar los botones de inicio/cierre de sesión
      function updateButtons(loggedIn) {
        const loginButton = document.getElementById('loginButton');
        const logoutButton = document.getElementById('logoutButton');
        if (loginButton && logoutButton) {
          if (loggedIn) {
            loginButton.classList.add('d-none');
            logoutButton.classList.remove('d-none');
          } else {
            loginButton.classList.remove('d-none');
            logoutButton.classList.add('d-none');
          }
        }
      }

      // Verifica el estado de la sesión al cargar la página
      checkSessionStatus();
    });

  </script>

  <!-- Javascript de la PlayList "Card de Me gusta" -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Variable con la cantidad de canciones
      var cantidadCanciones =   0;
      // Actualizar el contenido del elemento con el ID song-count-value
      document.getElementById("song-count-value").textContent = cantidadCanciones;
    });
  </script>

  <!-- Javascript para las PlayLists creadas -->
  <script>
    let playlistCount = 0;

    // Obtener el botón y el contenedor donde se agregarán las nuevas playlists
    const addPlaylistBtn = document.getElementById('add-playlist-btn');
    const playlistContainer = document.getElementById('playlist-container');

    // Función para crear una nueva playlist
    function addPlaylist() {
      playlistCount++;

      // Crear el card de la nueva playlist
      const newPlaylist = document.createElement('a');
      newPlaylist.href = '#';
      newPlaylist.className = 'card text-bg-dark mb-3 card-custom';

      const rowDiv = document.createElement('div');
      rowDiv.className = 'row g-0 h-100';

      const colImgDiv = document.createElement('div');
      colImgDiv.className = 'col col-md-4 d-flex align-items-center justify-content-center';

      const img = document.createElement('img');
      img.src = 'img/play.png';
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
      optionsButton.innerHTML = '<img src="img/menu.png" width="20" height="20" alt="Options">';

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
      
      // Agregar la nueva playlist al contenedor de playlists
      playlistContainer.appendChild(newPlaylist);

      // Mostrar/ocultar menú de opciones
      optionsButton.addEventListener('click', function(e) {
        e.preventDefault();
        optionsMenu.style.display = optionsMenu.style.display === 'none' ? 'block' : 'none';
      });

      // Cerrar el menú cuando se hace clic fuera
      document.addEventListener('click', function(e) {
        // Si el clic no es en el menú ni en el botón, cerrar el menú
        if (!optionsMenu.contains(e.target) && !optionsButton.contains(e.target)) {
            optionsMenu.style.display = 'none';
        }
      });

      // Cambiar nombre de la playlist
      const renameButton = optionsMenu.querySelector('.rename-playlist');
      renameButton.addEventListener('click', function() {
        const newName = prompt('Ingresa el nuevo nombre para la playlist:', title.textContent);
        if (newName) {
          title.textContent = newName;
        }
        optionsMenu.style.display = 'none';
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
  </script>

</body>
</html>