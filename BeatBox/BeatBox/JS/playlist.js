

const renderSongsList = (array) => {
    const songsHTML = array.map((song) => {
        return `<li id="song-${song.id}" class="album-song">
        <div class="row align-items-center" id="album-song-info">
            <div class="col-1 text-center" id="numero-posicion">1</div>
            <div class="col-2 text-center" id="album-song-img">
                <img src="${song.img}" alt="Imagen del Album" style="max-width: 60px;">
            </div>
            <div class="col-2 text-center" id="album-song-title">${song.title}</div>
            <div class="col-2 text-center" id="album-song-artist">${song.artist}</div>
            <div class="col-2 text-center" id="fecha-agregado">24/10/2024</div>
            <div class="col-1 text-center">
              <button type="button" id="me-gusta" onclick="toggleLike()" class="btn ctrl agregar-cancion">
                <svg id="me-gusta-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                  <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                </svg>
              </button>
            </div>
            <div class="col-1 text-center" id="album-song-duration">${song.duration}</div>
            <div class="col-1 text-center">
              <button type="button" id="opciones" class="btn ctrl" >
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                  <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/>
                </svg>
              </button>
            </div>
        </div>
    </li>`;
    })
}



/* ORGANIZAR LA PLAYLIST DE FORMA ALFABETICA */
const sortSongs = () => {
    userData?.songs.sort((a, b) => {
        if(a.title < b.title){
            return -1;
        }
        if(a.title > b.title){
            return 1;
        }
        return 0;
    });
    return userData?.songs
};

/* REMARCAR LA CANCION QUE SE ESTA REPRODUCIENDO */
// recien se utiliza cuando se cree el html de playlist NO EN LA LISTA DE REPRODUCCION
const highlightCurrentSong = () => {
    const playlistSongElements = document.querySelectorAll('.playlist-song');
    id = userData?.currentSong?.id
    const songToHighlight = document.getElementById(`song-${userData?.currentSong?.id}`);
    playlistSongElements.forEach((songEl)=>{
        songEl.removeAttribute("aria-current");

        if (songToHighlight) {
            songToHighlight.setAttribute("aria-current", "true");
        }
    });
};

// highlightCurrentSong();
