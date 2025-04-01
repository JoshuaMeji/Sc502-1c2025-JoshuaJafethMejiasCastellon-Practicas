$(document).ready(function() {
    console.log('Se cargó la página y estoy usando jQuery');

    function obtenerPersonajeAleatorio() {
        $.ajax({
            url: 'https://api.disneyapi.dev/character',
            method: 'GET',
            success: function(data) {
                if (!data.data || data.data.length === 0) {
                    alert('No se encontraron personajes.');
                    return;
                }

                const personajeAleatorio = data.data[Math.floor(Math.random() * data.data.length)];

                $('#character-name').text(personajeAleatorio.name || 'Desconocido');
                $('#character-height').text((personajeAleatorio.height || 'N/A') + ' cm');
                $('#character-mass').text((personajeAleatorio.mass || 'N/A') + ' kg');
                $('#character-hair-color').text(personajeAleatorio.hair_color || 'N/A');
                $('#character-skin-color').text(personajeAleatorio.skin_color || 'N/A');
                $('#character-eye-color').text(personajeAleatorio.eye_color || 'N/A');
                $('#character-birth-year').text(personajeAleatorio.birth_year || 'N/A');
                $('#character-gender').text(personajeAleatorio.gender || 'N/A');
                $('#character-films').text(
                    personajeAleatorio.films && personajeAleatorio.films.length > 0
                        ? personajeAleatorio.films.join(', ')
                        : 'Sin películas asociadas.'
                );
                $('#character-image').attr('src', personajeAleatorio.imageUrl || 'https://via.placeholder.com/150');

                if (personajeAleatorio.homeworld) {
                    $.ajax({
                        url: personajeAleatorio.homeworld,
                        method: 'GET',
                        success: function(homeworldData) {
                            $('#homeworld').text(homeworldData.name || 'Desconocido');
                        },
                        error: function() {
                            $('#homeworld').text('Desconocido');
                        }
                    });
                } else {
                    $('#homeworld').text('Desconocido');
                }

                $('#character-template').show();
            },
            error: function() {
                alert('Error al obtener los datos del personaje.');
            }
        });
    }

    obtenerPersonajeAleatorio();

    $('#add-character').click(function() {
        obtenerPersonajeAleatorio();
    });
});
