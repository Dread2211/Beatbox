let currentView = '';

function mostrarContenido(tipo) {
    const mostrar = document.getElementById('mostrar-contenido');
    const currentSongIndex = getCurrentSongIndex();
    const currentSong = userData?.songs[currentSongIndex];
    
    let contenido = '';
    currentView = tipo;

    if (tipo === 'continuacion') {
        contenido = `           
            <!--Display Lista de Reproduccion-->
            <ul id="playlist-songs" class="playlist-songs-list">
            </ul>
            `;

        document.getElementById('continuacion').classList.add("funcionando");
        mostrar.innerHTML = contenido;
        renderSongs(userData?.songs);
    }

    if (tipo === 'letra') {
        let formtLyric = currentSong.lyric.replace(/,,/g , "<br />");

        if(formtLyric){
            contenido = `<p id="song-lyric">${formtLyric}</p>`;
            mostrar.innerHTML = contenido;
        }else{
            contenido = `<p style="font-size: x-large;">No se encontro letra...</p>`
        }
    }

    if (tipo === 'contenido') {
        contenido = `<span> En proceso! </span>`;
        mostrar.innerHTML = contenido;
    }
}



