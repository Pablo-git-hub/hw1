
/*function rimuoviBottoneSig(event) {
const bott=event.currentTarget;

bott_sig.classList.add("delete-bott");
   
}
function rimuoviBottoneLog(event) {
	const bott=event.currentTarget;
bott_log.classList.add("delete-bott");
   
}*/
//non funzionaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
const bott_log=document.querySelector("#bott_login");
const bott_sig=document.querySelector("#bott_sig");
//bott_log.classList.add("delete-bott");
bott_log.remove();
bott_sig.remove();

console.log("prova"); 

const links=document.querySelectorAll("#griglia a");
for(let link of links){
        console.log(link);
        link.href="ricette.php";
        }
//mettere in mettilink.js
/*const images=document.querySelector("img");
images.addEventListener('click',ApriRicetta);
function ApriRicetta(event) {
        const img=event.currentTarget;
        window.location.href("home_session.php");
}
*/
/*const images=document.querySelector("img");
images.addEventListener('click',mettilink);
{
        */






function onJsonAuth(json) {
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
const array_img=[];
const  links= document.querySelectorAll('#griglia a');
  for(let recipe of recipes) {
     array_id[i]=recipe.id;
     array_img[i]=recipe.image;
for(let link of links){
  if(link.src===array_img[i]){
    link.addEventListener("click", function(event) {
  inviaJson(event,array_id[i]);
});    
  }
       
}
 i++;
      }


}

function onResponse(response) {
    if(response.ok){
        console.log("sei response");
        return response.json();
    }
    return null;
}
/*function mandaDati(event,array) {
    console.log("provaaaaaaaaaaaaaaaaa");
    event.preventDefault();
    
        const id = encodeURIComponent(array);
        console.log("Il cibo della ricerca è: " + id);

        //location.href = "3fetch_food.php?query="+testo;

        fetch("ricette.php?query=" + id).then(onResponse).then(onJson);
     
}*/


 function searchAuth(event) {
    console.log("provaaaaaaaaaaaaaaaaa");
    event.preventDefault();
    const contenuto = document.querySelector("#content").value;
    if (contenuto) {
        const testo = encodeURIComponent(contenuto);

        //location.href = "3fetch_food.php?query="+testo;

        fetch("3fetch_food.php?query=" + testo).then(onResponse).then(onJsonAuth);
     
    }
    return 0;
}

const form_auth = document.querySelector('form');
form_auth.addEventListener('submit', searchAuth);

 const array_id=[];



 function InviaJson(json,array) {
  const formData = new FormData();
  formData.append('array', JSON.stringify(array));

  fetch('ricette.php', {
    method: 'POST',
    body: formData
  })
  .then(response => {
    if (response.ok) {
      console.log('Dati inviati con successo');
    } else {
      console.error('Errore durante l\'invio dei dati.');
    }
  })
  .catch(error => {
    console.error('Si è verificato un errore:', error);
  });
}


