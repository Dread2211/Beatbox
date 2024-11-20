const shuffleButton = document.getElementById('aleatorio');
const previousButton = document.getElementById('saltear-atras');
const nextButton = document.getElementById('saltear-adelante');

// Variables para toggle repetir
const loopButton = document.getElementById('repetir');
let iconLoop = document.getElementById('repetir-icon');
let pathLoop = iconLoop.querySelectorAll('path');

// Variables para toggle play pause
const playPauseButton = document.getElementById('playPause');
let iconPP = document.getElementById('playPauseIcon');
let pathI = iconPP.querySelector('path');

// Constantes de la barra de progreso
const progressBar = document.getElementById('barra-progreso');
const progressContainer = document.getElementById('contenedor-barra-progreso');

const audio = new Audio();

let userData = {
    songs: [], 
    currentSong: null,
    songCurrentTime: 0
};

console.log(userData);

function loadSongs() {
    fetch('backend/canciones.php')
    .then(response => {
        if (response.ok) {
            console.log(response.status);
            return response.json();
        }
        throw new Error("Error " + response.status + " al llamar al API: " + response.statusText);
    })
    .then(data => {
        if (data.allSongs) {
            userData.songs = [...data.allSongs].map(song => ({
                ...song,
                id: Number(song.id)
            }));
            console.log('Canciones cargadas:', userData.songs);
            originalOrder = [...userData.songs];
        } else {
            console.error('Formato de datos inesperado:', data);
        }
    })
    .catch(error => console.error('Error al cargar el archivo JSON: ', error));
}

loadSongs();
console.log(userData.songs);

/* CREA EL <LI> QUE APARECERA EN LA LISTA DE REPRODUCCION/PLAYLIST */
const renderSongs = (array) => {
    const visibleSongs = array.filter(song => song.state !== 'eliminado');
    // console.log('Canciones que se renderizan (visible): ', visibleSongs);
    const songsHTML = visibleSongs.map((song) => {
        return `<li id= "song-${song.id}" class="playlist-song">
        <button class="playlist-song-info btn song" onclick="playSong(${song.id})">
        <span class="playlist-song-img"><img src="${song.img}" alt="Imagen del Album" style="max-width: 50px"></span>
        <span class="playlist-song-title">${song.title}</span>
        <span class="playlist-song-artist">${song.artist}</span>
        <span class="playlist-song-duration">${song.duration}</span>
        </button>
        <button class="playlist-song-delete btn borrar" onclick="deleteSong(${song.id})" aria-label="Delete ${song.title}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
            </svg>
        </button>
        </li>`;
    }).join("");

    const playlistSongs = document.getElementById('playlist-songs');
    if (playlistSongs) {
        playlistSongs.innerHTML = songsHTML;
    }
};

/* RECUPERA EL INDEX DE LA CANCION ACTUAL */
const getCurrentSongIndex = () => {
    return userData?.songs.indexOf(userData?.currentSong);
};

// Función para actualizar la barra de progreso
const updateProgressBar = () => {
    if (audio.duration) {
        // Calcula el porcentaje de progreso
        const percentage = (audio.currentTime / audio.duration) * 100;
        const clampedPercentage = Math.min(percentage, 100);
        progressBar.style.width = `${clampedPercentage}%`;
        progressContainer.setAttribute('aria-valuenow', clampedPercentage);
    }
};

function setProgress(e) {
    const width = this.clientWidth;
    const clickX = e.offsetX;
    const duration = audio.duration;
    
    if (duration) {
        audio.currentTime = (clickX / width) * duration;

        if (audio.paused) {
            userData.songCurrentTime = audio.currentTime;
        }
    } 
}

setInterval(updateProgressBar, 1000);

// Funcion que muestra los minutos exactos en los cuales esta la pista de audio
const currentTimeMinutes = () => {
    const currentMinutes = document.getElementById('current-time');
    if (audio.duration) {
        const time = audio.currentTime;
        const minutes = Math.floor(time / 60);
        const seconds = Math.floor(time % 60);
        const formattedSeconds = seconds < 10 ? `0${seconds}` : seconds;
        currentMinutes.textContent = `${minutes}:${formattedSeconds}`;
    }
}

const handleVolumeChange = () => {
    const volumeDisplay = document.getElementById('volume');
    const sliderVolume = document.getElementById('volume-slider');
    // El slider tiene valores entre 0 y 100, los convertimos a una escala de 0 a 1
    const volumeValue = sliderVolume.value / 100;
    // Asignar el volumen al audio
    audio.volume = volumeValue;
    
    volumeDisplay.textContent = `${Math.floor(audio.volume * 100)}`;
};

////////// COMENTAR
const hideSong = () => {
    const currentSongIndex = getCurrentSongIndex();
    const currentSong = userData?.songs[currentSongIndex];

    for (let i = 0 ; i <= currentSongIndex ; i++) {
        userData.songs[i].state = 'eliminado';
        console.log(userData.songs[i].state);
    }
}

/* REPRODUCIR LA CANCION */
const playSong = (id) => {
    id = Number(id);
    console.log('Trying to play song with id:', id);
    let song = userData?.songs.find((song) => song.id === id );

    if (!song) {
        console.error(`Song with id ${id} not found in userData.songs`, userData?.songs);
        return; // Salir de la función si no se encuentra la canción
    }

    audio.src = song.src;
    audio.title = song.title;
    
    if (userData?.currentSong === null || userData?.currentSong.id !== song.id) {
        audio.currentTime = 0;
    } else {
        audio.currentTime = userData?.songCurrentTime || 0;
    }

    userData.currentSong = song;
    hideSong();
    if (currentView) {
        if (currentView === 'continuacion') {
            mostrarContenido('continuacion');
        }
        if (currentView === 'letra') {
            mostrarContenido('letra');
        }
    }
    
    playPauseButton.classList.add('btn-pause', "playing");
    playPauseButton.classList.remove('btn-play','pausado');
    iconPP.classList.replace("bi-play-fill", "bi-pause-fill");
    pathI.setAttribute("d", "M5.5 3.5A1.5 1.5 0 0 1 7 5v6a1.5 1.5 0 0 1-3 0V5a1.5 1.5 0 0 1 1.5-1.5m5 0A1.5 1.5 0 0 1 12 5v6a1.5 1.5 0 0 1-3 0V5a1.5 1.5 0 0 1 1.5-1.5");
    setPlayerDisplay();
    setPlayButtonAccessibleText();
    
    audio.play();
    audio.addEventListener('timeupdate', updateProgressBar);
    audio.addEventListener('timeupdate', currentTimeMinutes);
    document.getElementById('volume-slider').addEventListener('input', handleVolumeChange);
    document.getElementById('total-time').textContent = `${song.duration}`;
};

/* PAUSAR LA CANCION */
const pauseSong = () => {
    userData.songCurrentTime = audio.currentTime;
    playPauseButton.classList.remove("playing");
    playPauseButton.classList.add('pausado');
    audio.pause();
};

function togglePlayPause() {
    if (audio.paused) {
        if (userData?.currentSong === null) {
            playSong(userData?.songs[0].id)
        }else{
            playSong(userData?.currentSong.id)
        }
    }else{
        iconPP.classList.replace("bi-pause-fill", "bi-play-fill");
        pathI.setAttribute("d", "m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393");
        playPauseButton.classList.add('btn-play');
        playPauseButton.classList.remove('btn-pause');
        pauseSong();
    }
}

/* SALTEAR A LA SIGUIENTE CANCION */
const playNextSong = () => {
    if (userData?.currentSong === null) {
        pauseSong();
    }else{
        const currentSongIndex = getCurrentSongIndex();
        const nextSong = userData?.songs[currentSongIndex + 1];
        if (nextSong) {
            playSong(nextSong.id);
        }
    }
};

/* SALTEAR A LA ANTERIOR CANCION */
const playPreviousSong = () => {
    if (userData?.currentSong === null) {
        return
    }
    const currentSongIndex = getCurrentSongIndex();
    const currentSong = userData.songs[currentSongIndex];

        if (currentSongIndex > 0) {
            const previousSong = userData?.songs[currentSongIndex - 1];
            if (previousSong) {
                currentSong.state = 'visible';
                playSong(previousSong.id);
            } 
        } else {
            console.log('No previous song available.');
        }
    
};

// FUNCION SHUFFLE
let originalOrder = [...userData.songs];
let isSorted = false;
const shuffle = () => {
    const currentSongIndex = getCurrentSongIndex();
    const [currentSongItem] = userData.songs.splice(currentSongIndex, 1);
    console.log('Índice de la canción actual:', currentSongIndex);

    if (isSorted) {
        userData.songs = [...originalOrder];
        shuffleButton.style.color = '#FFFFFF';
        isSorted = false;
        console.log('Restablecido al orden original:', userData.songs);

    } else {
        userData?.songs.sort(() => Math.random() - 0.5);
        userData?.songs.unshift(currentSongItem);
        shuffleButton.style.color = '#d5a6bd';
        console.log('Canciones mezcladas:', userData.songs);
        isSorted = true;
        console.log('Orden original: ', originalOrder);
    }
    renderSongs(userData?.songs);
}

const deleteSong = (id) => {
    if (userData?.currentSong?.id == id) {
        userData.currentSong = null;
        userData.songCurrentTime = 0;
        pauseSong();
        setPlayerDisplay();
    }

    userData.songs = userData?.songs.filter((song) => song.id !== id);
    renderSongs(userData?.songs);
    setPlayButtonAccessibleText();
};

const setPlayerDisplay = () => {
    const playingSong = document.getElementById('titulo-cancion');
    const songArtist = document.getElementById('artista-cancion');
    const imgAlbum = document.getElementById('imagen-album')
    const currentTitle = userData?.currentSong?.title;
    const currentArtist = userData?.currentSong?.artist;
    const currentAlbum = userData?.currentSong?.img;

    playingSong.textContent = currentTitle ? currentTitle : "";
    songArtist.textContent = currentArtist ? currentArtist : "";
    imgAlbum.src = currentAlbum ? currentAlbum : "";
};

const setPlayButtonAccessibleText = () => {
    const song = userData?.currentSong || userData?.songs[0]; 
    playPauseButton.setAttribute("aria-label", song?.title ? `Play ${song.title}` : "Play" );
};

let loopState = 0;

// Asignacion de Eventos
playPauseButton.addEventListener('click', togglePlayPause);
nextButton.addEventListener("click", playNextSong);
previousButton.addEventListener("click", playPreviousSong);
shuffleButton.addEventListener('click', shuffle);
progressContainer.addEventListener('click', setProgress);

loopButton.addEventListener('click', () => {
    loopState = (loopState + 1) % 3;
    if (loopState === 1) {
        audio.loop = false;
        loopButton.classList.add('btn-loop-playlist');
        loopButton.classList.remove('btn-desactivado', 'btn-loop-song');
        iconLoop.classList.replace('bi-repeat-1', 'bi-repeat');

        // Si hay más de un path, remover el segundo
        if (iconLoop.querySelectorAll('path').length > 1) {
            iconLoop.querySelectorAll('path')[1].remove();
        }
        pathLoop[0].setAttribute('d', 'M11 5.466V4H5a4 4 0 0 0-3.584 5.777.5.5 0 1 1-.896.446A5 5 0 0 1 5 3h6V1.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192m3.81.086a.5.5 0 0 1 .67.225A5 5 0 0 1 11 13H5v1.466a.25.25 0 0 1-.41.192l-2.36-1.966a.25.25 0 0 1 0-.384l2.36-1.966a.25.25 0 0 1 .41.192V12h6a4 4 0 0 0 3.585-5.777.5.5 0 0 1 .225-.67Z');

        loopButton.style.color = '#ffb5d7';

    } else if (loopState === 2) {
        audio.loop = true;
        loopButton.classList.add('btn-loop-song');
        loopButton.classList.remove('btn-desactivado', 'btn-loop-playlist');

        iconLoop.classList.replace('bi-repeat', 'bi-repeat-1');
        pathLoop[0].setAttribute('d', 'M11 4v1.466a.25.25 0 0 0 .41.192l2.36-1.966a.25.25 0 0 0 0-.384l-2.36-1.966a.25.25 0 0 0-.41.192V3H5a5 5 0 0 0-4.48 7.223.5.5 0 0 0 .896-.446A4 4 0 0 1 5 4zm4.48 1.777a.5.5 0 0 0-.896.446A4 4 0 0 1 11 12H5.001v-1.466a.25.25 0 0 0-.41-.192l-2.36 1.966a.25.25 0 0 0 0 .384l2.36 1.966a.25.25 0 0 0 .41-.192V13h6a5 5 0 0 0 4.48-7.223Z');

        // Agregar el segundo path
        const newPath = document.createElementNS('http://www.w3.org/2000/svg', 'path');
        newPath.setAttribute('d', 'M9 5.5a.5.5 0 0 0-.854-.354l-1.75 1.75a.5.5 0 1 0 .708.708L8 6.707V10.5a.5.5 0 0 0 1 0z');
        iconLoop.appendChild(newPath);
        loopButton.style.color = '#ffb5d7';

    } else {
        audio.loop = false;
        loopButton.classList.add('btn-desactivado');
        loopButton.classList.remove('btn-loop-playlist', 'btn-loop-song');
         iconLoop.classList.replace('bi-repeat-1', 'bi-repeat');

         // Remover el segundo path si existe
         if (iconLoop.querySelectorAll('path').length > 1) {
             iconLoop.querySelectorAll('path')[1].remove();
         }
         pathLoop[0].setAttribute('d', 'M11 5.466V4H5a4 4 0 0 0-3.584 5.777.5.5 0 1 1-.896.446A5 5 0 0 1 5 3h6V1.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192m3.81.086a.5.5 0 0 1 .67.225A5 5 0 0 1 11 13H5v1.466a.25.25 0 0 1-.41.192l-2.36-1.966a.25.25 0 0 1 0-.384l2.36-1.966a.25.25 0 0 1 .41.192V12h6a4 4 0 0 0 3.585-5.777.5.5 0 0 1 .225-.67Z');
 
        loopButton.style.color = '#FFFFFF';
    }
    console.log(loopState);
});


audio.addEventListener("ended", () => {
    const currentSongIndex = getCurrentSongIndex();
    const nextSongExists = (userData.songs.length -1 > currentSongIndex) ? true : false;

    audio.currentTime = 0;
    progressBar.style.width = '0%';
    progressContainer.setAttribute('aria-valuenow', 0);
    audio.removeEventListener('timeupdate', updateProgressBar);

    if (loopState === 0) {
        console.log('ended' , loopState)
        if (nextSongExists) {
            playNextSong();
        }
        else{
            userData.currentSong = null;
            userData.songCurrentTime = 0;
            pauseSong();
            setPlayerDisplay();
            setPlayButtonAccessibleText();
        }

    } else if (loopState === 1) {
        console.log('ended' , loopState)
        if (nextSongExists) {
            playNextSong();
        } else {
            userData?.songs.forEach((song) => song.state = 'visible'); 
            playSong(userData.songs[0].id);
        }
    }
});



























