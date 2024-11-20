
function toggleLike() {
    let button = document.getElementById('me-gusta');
    let icon = document.getElementById('me-gusta-icon');

    if (icon.classList.contains('bi-heart')) {
        icon.outerHTML = `<svg id="me-gusta-icon" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
            </svg>` ;

        button.classList.remove('btn-me-gusta');
        button.classList.add('btn-me-gusta-fill');

        button.style.color = "#b4a7d6";

    }else{
        icon.outerHTML = `<svg id="me-gusta-icon" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
            </svg>`;

        button.classList.remove('btn-me-gusta-fill');
        button.classList.add('btn-me-gusta');

        button.style.color = "white";

    }
}


function toggleAgregar() {
    let button = document.getElementById('agregar');
    let icon = document.getElementById('agregar-icon');

    if (icon.classList.contains('bi-plus-circle')) {
        icon.outerHTML = `<svg id="agregar-icon" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
            </svg>`

        button.classList.remove('btn-agregar');
        button.classList.add('btn-agregar-fill');

        button.style.color = "#b4a7d6";

    }else{
        icon.outerHTML = `<svg id="agregar-icon" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
            </svg>`

        button.classList.remove('btn-agregar-fill');
        button.classList.add('btn-agregar');
        
        button.style.color = "white";
    }
}