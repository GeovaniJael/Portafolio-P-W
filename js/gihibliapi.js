const randomMovieBtn = document.getElementById("pelirandom");
const titulo = document.getElementById("titulo");
const director = document.getElementById("director");
const productor = document.getElementById("productor");
const descripcion   = document.getElementById("descripcion");
const imagen = document.getElementById("movie-image");
const personajes = document.getElementById("personajes").querySelector("tbody");
const modal = document.getElementById("details-modal");
const placeholderImage = "https://via.placeholder.com/300x400?text=Studio+Ghibli";
function clearCharactersTable() {
    personajes.innerHTML = "";
}
randomMovieBtn.addEventListener("click", () => {
    fetch("https://ghibliapi.vercel.app/films")
        .then(response => response.json())
        .then(movies => {
            const randomMovie = movies[Math.floor(Math.random() * movies.length)];
            displayMovieDetails(randomMovie);
            loadCharactersForMovie(randomMovie);
        })
        .catch(console.error);
});
function displayMovieDetails(movie) {
    titulo.innerText = movie.title;
    director.innerText = movie.director;
    productor.innerText = movie.producer;
    descripcion.innerText = movie.description;
    imagen.src = movie.image || placeholderImage;
}
function loadCharactersForMovie(movie) {
    clearCharactersTable();
    const charactersUrls = movie.people.filter(url => url !== "https://ghibliapi.vercel.app/people/"); // Ignorar personajes sin datos
    if (charactersUrls.length === 0) {
        const row = document.createElement("tr");
        row.innerHTML = `<td colspan="3">No hay personajes disponibles para esta película.</td>`;
        personajes.appendChild(row);
        return;
    }
    Promise.all(charactersUrls.map(url => fetch(url).then(res => res.json())))
        .then(characters => {
            characters.forEach(character => {
                // Si 'species' es una URL, hacemos una solicitud adicional
                let speciesText = character.species || "Desconocida"; // Valor por defecto si no hay especie
                if (speciesText.startsWith("https://ghibliapi.vercel.app/species/")) {
                    // Hacemos una solicitud para obtener el nombre de la especie
                    fetch(speciesText)
                        .then(res => res.json())
                        .then(speciesData => {
                            speciesText = speciesData.name || "Desconocida"; // Usamos el nombre de la especie
                            addCharacterRow(character, speciesText);
                        })
                        .catch(console.error);
                } else {
                    addCharacterRow(character, speciesText); // Si no es una URL, solo mostramos el texto
                }
            });
        })
        .catch(console.error);
}

// Función para agregar la fila a la tabla
function addCharacterRow(character, speciesText) {
    const row = document.createElement("tr");
    row.innerHTML = `
        <td>${character.name}</td>
        <td>${character.age || "N/A"}</td>
        <td>${speciesText}</td>
    `;
    personajes.appendChild(row);
}

