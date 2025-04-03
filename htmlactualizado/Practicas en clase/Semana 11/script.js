$(document).ready(function() {
    console.log('Se cargó la página y estoy usando jQuery');
});

function obtenerPersonajeAleatorio() {
    $.ajax({
        url: 'https://api.disneyapi.dev/character',
        method: 'GET',
        success: function(data) {
            if (!data.data || data.data.length === 0) {
                alert('No se encontraron personajes.');
                return;
            }

            console.log(data.data);

            $('#personajes').empty();

            $(data.data).each(function(index, personaje) {
                const personajeCard = `
                    <div class="col-sm-12 col-md-4 mt-3" id="character-template-${index}">
                        <div class="card" style="width: 350px;">
                            <img src="${personaje.imageUrl}" class="card-img-top" alt="${personaje.name}">
                            <div class="card-body">
                                <h5 class="card-title">${personaje.name}</h5>
                                <p class="card-text">Aliados: ${personaje.allies}</p>
                                <p class="card-text">Enemigos: ${personaje.enemies}</p>
                                <p class="card-text">Altura: ${personaje.height}</p>
                                <p class="card-text">Peso: ${personaje.mass}</p>
                                <p class="card-text">Color de cabello: ${personaje.hairColor}</p>
                                <p class="card-text">Color de piel: ${personaje.skinColor}</p>
                                <p class="card-text">Color de ojos: ${personaje.eyeColor}</p>
                                <p class="card-text">Año de nacimiento: ${personaje.birthYear}</p>
                                <p class="card-text">Mundo de origen: ${personaje.homeworld}</p>
                                <p class="card-text">Películas: ${personaje.films}</p>
                            </div>
                        </div>
                    </div>
                `;

                $('#personajes').append(personajeCard);
            });
        },
        error: function() {
            alert('Error al obtener los datos del personaje.');
        }
    });
}
