let titulo = document.getElementById("titulo");
console.log(titulo.textContent);
titulo.style.color = "red";

let parrafos =document.getElementsByTagName("p");
console.log(parrafos);
Array.from(parrafos).forEach((el,idx) => {
    el.innerText = "Texto " + (idx +1);
})

let parrafos2 = document.getElementsByClassName("parrafo");
console.log(parrafos2[1].textContent);
parrafos2[1].style.backgroundColor ="greenyellow";
parrafos2[1].innerHTML = "<strong>Nuevo Parrafo</strong>"


let parrafo = document.querySelector(".parrafo");
console.log(parrafo.textContent);
parrafo.className = "nuevo-parrafo";

let parrafo = document.createElement("p");
parrafo.innerText= "Nuevo Parrafo";
document.body.appendChild(parrafo);

let h1 =document.querySelector("h1");
let hr = document.createElement("hr");
let nuevoParrafo = document.createElement("p");

document.body.insertBefore(nuevoParrafo, h1);
document.body.insertAfter(hr,nuevoParrafo);

let parrafo = document.createElement("p")
parrafo.innerText = "Este parrafo tioene un emoji👻";
document.body.appendChild(parrafo);

console.log(parrafo);

 h1 = document.querySelector("h1");
h1.innerText = "Título dinamico"
 hr = document.createElement("hr");

parrafo.prepend(h1);
parrafo.prepend(hr);

let parrafo = document.querySelector("p");
let padre_parrafo = parrafo.parentElement;
console.log(padre_parrafo);

let lista = documet.createElement("ol");
for (let i = 1; 1 <= 5; i++){
    let item = document.createElement("li");
    item.innerText = `Elemento ${i}`;
    lista.appendChild(item);
}

padre_parrafo.appendChild(lista);