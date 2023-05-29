
  


  /*function ValidazioneCredeziali(event) {
    event.preventDefault();
   
  if(form.nome.value.length==0 ||
    form.cognome.value.length== 0||
    form.username.value.length==0 ||
    form.password.value.length==0  ||
    form.email.value.length==0 
    )
    alert("Attenzionecompletare tutti i campi.");
  else{
    return 0;
  }

}*/
/*minimo 8 caratteri massimo 32*/
function jsonCheckEmail(json) {
 if(/*formStatus.email=*/!json.exists){
  //entreremo nel if solo se l'email non è già presente nel database
  document.querySelector("#container_email").classList.remove("class_error");
 } 
else{
 /* document.querySelector("container_email span").textContent="L'email inserita è già presente";*/
  document.querySelector("container_email").classList.add("class_error"); 
}
 
}
function jsonCheckUsername(json) {
  if(/*formStatus.username=*/!json.exists){
    document.querySelector('#container_username').classList.remove('class_error');
  }
  else{
  document.querySelector('#container_username span').textContent="L'username inserito è già presente";
  document.querySelector('#container_username').classList.add('class_error');  
  }
  
}
function onResponse(response){
  if(response.ok){
    return response.json;
  }
  return null;
}
function check_username(event)
{	
  const input=document.querySelector("#container_username input");
  	
	if(!/^[a-zA-Z0-9_)]{8,20}$/.test(input.value)){
	input.parentNode.querySelector('span').textContent="L'username non deve contenere caratteri speciali ad eccezione del underscore '_' \n"+
	"e deve essere almeno 8 caratteri, massimo 20.";
	input.parentNode.classList.add("class_error");
  /*formStatus.username=false;*/
	}
	else{
  	
    fetch("check_user.php?q="+encodeURIComponent(input.value)).then(onResponse).then(jsonCheckUsername);
	}
}

function check_nome(event) 
{
  	const input=event.currentTarget;
  	if(/*formStatus[input.nome]=*//^[a-zA-Z]+$/.test(input.value)){
  	//input.querySelector("span").textContent="Il nome puo contenere solo lettere.";
  	input.parentNode.classList.remove("class_error");
  	}
  	else{
  	input.parentNode.classList.add("class_error");
  	}
}

function check_cognome(event) {
	console.log("prova")
  const input=event.currentTarget;
  if(/*formStatus[input.cognome]=*//^[a-zA-Z]+$/.test(input.value)){
  	input.parentNode.classList.remove("class_error");
  }
  else{
  	input.parentNode.classList.add("class_error");
  }
}



function check_email(event){
const input=document.querySelector('#container_email input');
if(!/^[a-zA-Z0-9.-]+\@[a-zA-Z0-9_-]+?(?:\.[a-zA-Z]{2,6})$/.test(String(input.value).toLowerCase())){
document.querySelector('#container_email span').textContent="Indirizzo email non valido."
document.querySelector('#container_email span').classList.add("class_error");
/*formStatus.email=false; */
}
else{
document.querySelector('#container_email').classList.remove("class_error");
}
fetch("check_email.php?q="+encodeURIComponent(String(input.value).toLowerCase())).then(onResponse).then(jsonCheckEmail);
}


function check_password(event) {
 const input=document.querySelector("#container_password input");
 if(/*formStatus[input.password]=*//^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!#$%£%&?@])(?=.*[a-zA-Z0-9]).{8,}$/.test(input.value))
 {
  document.querySelector("#container_password").classList.remove("class_error");
 }
 else{
  document.querySelector("#container_password").classList.add("class_error");
 }
}

function check_confermapassword(event){
  const input=document.querySelector("#container_confermapassword input");
  if(/*formStatus.conferma_password=*/input.value===document.querySelector("#container_password input").value){
    document.querySelector("#container_confermapassword").classList.remove("class_error");
  }
  else{
    document.querySelector("#container_confermapassword").classList.add("class_error");
  }
}



//const formStatus = {'upload': true};
const form=document.querySelector('form');
/*const input_cognome=document.querySelector("#container_cognome input");*/
const input_nome=document.querySelector("#container_nome input");
const input_username=document.querySelector("#container_username input");
const img_pass=document.querySelector('#occhiopass');
const img_conf=document.querySelector('#occhioconf');
/*form.addEventListener('submit',ValidazioneCredeziali);*/
/*input_name.addEventListener('focusout',check_name);*/
/*input_username.addEventListener('focusout',check_username);*/
document.querySelector("#container_nome input").addEventListener('blur',check_nome);
document.querySelector("#container_cognome input").addEventListener('blur',check_cognome);
document.querySelector("#container_username input").addEventListener('blur',check_username);
document.querySelector("#container_email input").addEventListener('blur',check_email);
document.querySelector("#container_password input").addEventListener('blur',check_password);
document.querySelector("#container_confermapassword input").addEventListener('blur',check_confermapassword);

img_pass.addEventListener('click',MostraNascondiPassword);
img_conf.addEventListener('click',MostraNascondiConfermaPassword);


//function check_uploadimg() {}

function MostraNascondiPassword(event) {
  
 const img_occhio=event.currentTarget;
if(form.password.type==="password"){
  
    form.password.type="text";
    img_pass.src="show_1.png";
  } 
  else {
    form.password.type="password";
    img_pass.src="hide_1.png";
  }
}


function MostraNascondiConfermaPassword(event) {

 const img_occhio=event.currentTarget;
if(form.conferma_password.type==="password"){
  
    form.conferma_password.type="text";
    img_conf.src="show_1.png";
  } 
  else {
    form.conferma_password  .type="password";
    img_conf.src="hide_1.png";
  }
}







