// document.addEventListener('DOMContentLoaded', function() {
//     const progressBar = document.getElementById('barra-progreso');
//     const progressBarContainer = document.getElementById('contenedor-barra-progreso');
//     audio.currentTime = userData?.songCurrentTime;
    
//     function updateProgress() {
//         if (audio.duration) {
//             const percent = (audio.currentTime / userData?.songs?.duration) * 100;
//             progressBar.style.width = percent + '%';
//         }
//     }

//     audio.addEventListener('loadedmetadata', () => {
//         audio.addEventListener('timeupdate', updateProgress);
//     })

// });




const progressBar = document.getElementById('barra-progreso');
const progressContainer = document.getElementById('contenedor-barra-progreso');

// Función para actualizar la barra de progreso
const updateProgressBar = () => {
    if (audio.duration) {
        // Calcula el porcentaje de progreso
        const percentage = (audio.currentTime / audio.duration) * 100;
        progressBar.style.width = `${percentage}%`;
        progressContainer.setAttribute('aria-valuenow', percentage);
    }
};