
 const data = {
  name: [
    {
      name_value: ""
    }
  ],
  desc: [
    {
      desc_value: ""
    }
  ],
  image: [
    {
      image_value: ""
    }
  ]
};

 const preferiti = {
  name:"" ,
  image:""
};
function onJson(json) {
    /*ESEMPIO JSON.parse():
const json = '{"result":true, "count":42}';
const obj = JSON.parse(json);

console.log(obj.count);
// Expected output: 42

console.log(obj.result);
// Expected output: true*/
    const oggetto=JSON.parse(json);
    const object=oggetto.searchResults;
    console.log(object[0].results);
    const recipes=object[0].results;
   //devo accedere al campo nome
  //  const raccolta=document.querySelector("#griglia");
    //nota prima #griglia era album

 /* if(object[0].results.length == 0){
    const errore = document.createElement("h1"); 
    const messaggio = document.createTextNode("Nessun risultato!"); 
    errore.appendChild(messaggio); 
    raccolta.appendChild(errore);
  }*/

 
let i=0;

let imgs=document.querySelectorAll("img");


  for(let recipe of recipes) {
    array_rec[i]=recipe.image;
     array_name[i]=recipe.name;
     array_desc[i]=recipe.content;

data.name[0].name_value = array_name[i];
data.image[0].image_value = array_rec[i];
data.desc[0].dec_value = array_desc[i];
   



     i++;
  
      }
      console.log(array_rec[i]);
i=0;

console.log(data);

const labels=document.querySelectorAll(".etichetta");
for(let label of labels){

label.textContent=array_name[i];
i++
}
i=0;
for(let img of imgs){
        console.log(img);
        img.src=array_rec[i];
        preferiti.name=array_name[i];
preferiti.image=array_rec[i];
if(img.src!==""){
    img.classList.remove("img_json")
    
}
  img.addEventListener('click',showModal);  
  
    i++;
      // raccolta.appendChild(img); 
     }
     
    const lista=document.querySelector("#griglia");
     lista.classList.remove("img_json");

}


function onResponse(response) {
    if(response.ok){
        console.log("sei response");
        return response.json();
    }
    return null;
}
function search(event) {
    console.log("provaaaaaaaaaaaaaaaaa");
    event.preventDefault();
    const contenuto = document.querySelector("#content").value;
    if (contenuto) {
        err.classList.remove("errore_span");
        const testo = encodeURIComponent(contenuto);
        console.log("Il cibo della ricerca è: " + testo);

        //location.href = "3fetch_food.php?query="+testo;

        fetch("3fetch_food.php?query=" + testo).then(onResponse).then(onJson);
     
    } else {
        err.classList.add("errore_span");
        
    }
}
const err = document.querySelector("#mess_err span");
const form = document.querySelector('form');
form.addEventListener('submit', search);



/*const links=document.querySelectorAll("#griglia a");
links.addEventListener('submit',serchLog);

function serchLog(event) {
    event.preventDefault();
    

}*/

const bott_log=document.querySelector("#bott_login");
const bott_sig=document.querySelector("#bott_sig");
//bott_log.classList.add("delete-bott");
bott_log.remove();
bott_sig.remove();

const img = document.querySelectorAll('img');

function showModal(event) {

  // Previene l'azione predefinita del clic sull'immagine
  event.preventDefault();

  // Ottieni l'URL dell'immagine cliccata
  const imageURL = event.target.src;

  // Crea l'elemento modale
  const modal = document.createElement('div');
  const botton = document.createElement('div'); 
  botton.classList.add('botton_close');
  const  botton_pref=document.createElement('div');
  botton_pref.classList.add('btn_pref');
  botton.textContent="X";
  botton_pref.textContent="★";

const div_testo=document.createElement('div');
div_testo.classList.add('stile_testo');
const div_elementi=document.createElement("div");
div_elementi.classList.add("div-elem");
const container_close=document.createElement("div");
container_close.classList.add('close-bott');

const container_pref=document.createElement("div");
container_pref.classList.add('pref-bott');   
   
container_close.appendChild(botton);
container_pref.appendChild(botton_pref);
div_elementi.appendChild(container_close)
div_elementi.appendChild(container_pref);

  // Crea l'elemento immagine all'interno della modale
  const modalImg = document.createElement('img');
  modalImg.src = imageURL;

div_elementi.appendChild(modalImg);

modal.classList.add('modale-stile');


// Aggiungi la modale al documento
  document.body.appendChild(modal);

  // Aggiungi un gestore di eventi per chiudere la modale quando si fa clic su di essa
   
    const imgs=document.querySelectorAll("img");
for(let i=0; i< array_rec.length; i++){
if (imageURL===array_rec[i]){
    preferiti.name=array_name[i];
    preferiti.image=array_rec[i];

    //div_testo.textContent=array_desc[i];
    //div_elementi.appendChild(div_testo);
    
    console.log(div_testo.textContent);
    botton_pref.addEventListener("click",inviaDati);
}

}
  modal.appendChild(div_elementi);
  botton.addEventListener('click', closeModal);
  document.body.classList.add('no-scroll');
}




function closeModal(event) {
  // Rimuovi la modale dal documento
  const mod = document.querySelector('.modale-stile');
    const bott = document.querySelector('.botton_close');
    const container=document.querySelector(".close-bott");
    const div=document.querySelector(".div-elem");
  mod.remove();
  div.remove();
  container.remove();
    document.body.classList.remove('no-scroll');
}


//funzione salva nei preferiti
// Ottieni tutti gli elementi <li> che contengono le foto
function saveDataToDatabase(data) {
  fetch("preferiti.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify(data)
  })
  .then(function(response) {
    if (response.ok) {
      console.log("Dati salvati correttamente nel database.");
    } else {
      console.error("Errore durante il salvataggio dei dati nel database.");
    }
  })
  .catch(function(error) {
    console.error("Errore durante l'invio dei dati al backend:", error);
  });
}


const array_name = [];
const array_rec = [];
const array_desc = [];
function inviaDati(event) {
   const bott=event.currentTarget;
   saveDataToDatabase(preferiti);  
}

