const form = document.getElementById("search-form");
const nombreTxt = document.getElementById("pokemon-name");
const pokedexId = document.getElementById("pokemon-id");
const typesList = document.getElementById("pokemon-types");
const image = document.getElementById("pokemon-image");
const statsTxt = document.getElementById("pokemon-stats");
const abilitiesTxt = document.getElementById("pokemon-abilities");
const soundButton = document.getElementById("pokemon-sound");
const errorMessage = document.getElementById("error-message");
function clearResults() {
    nombreTxt.innerText = "";
    pokedexId.innerText = "";
    typesList.innerHTML = "";
    image.setAttribute("src", "");
    statsTxt.innerText = "";
    abilitiesTxt.innerText = "";
    soundButton.disabled = true;
    errorMessage.innerText = "";
}
form.addEventListener("submit", (event) => {
    event.preventDefault();
    const pokemonName = document.getElementById("pokemon-name-input").value.toLowerCase();
    fetch(`https://pokeapi.co/api/v2/pokemon/${pokemonName}`)
        .then((response) => {
            if (!response.ok) throw new Error(`Pokémon "${pokemonName}" no encontrado`);
            return response.json();
        })
        .then((pokemon) => {
            clearResults();
            nombreTxt.innerText = pokemon.name;
            pokedexId.innerText = `#${pokemon.id}`;
            const lista = document.createElement("ul");
            pokemon.types.forEach((tipo) => {
                const item = document.createElement("li");
                item.innerText = tipo.type.name;
                item.classList.add(`type-${tipo.type.name}`); // Clase para estilo
                lista.appendChild(item);
            });
            typesList.appendChild(lista);
            image.setAttribute("src", pokemon.sprites.front_shiny);
            const statsList = pokemon.stats.map(stat => `${stat.stat.name}: ${stat.base_stat}`).join(", ");
            statsTxt.innerText = statsList;
            const abilitiesList = pokemon.abilities.map(ability => ability.ability.name).join(", ");
            abilitiesTxt.innerText = abilitiesList;
            const soundUrl = `https://play.pokemonshowdown.com/audio/cries/${pokemon.name.toLowerCase()}.mp3`;
            soundButton.disabled = false;
            soundButton.onclick = () => {
                const audio = new Audio(soundUrl);
                audio.play();
            };
        })
        .catch((error) => {
            clearResults();
            errorMessage.innerText = error.message;
            console.error(error);
        });
});
