let button = document.getElementById('dropdownButton');

function tiempo(tipo) {

    if (tipo === 'hoy'){
        button.textContent = 'Hoy';
    }

    if (tipo === 'semana'){
        button.textContent = 'Hace una semana';
    }

    if (tipo === 'mes'){
        button.textContent = 'Hace un mes';
    }

    if (tipo === 'plus-mes'){
        button.textContent = 'Hace más de un mes';
    }

}