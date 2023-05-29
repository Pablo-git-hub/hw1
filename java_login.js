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
document.querySelector("#container_username input").addEventListener('blur',check_username);
document.querySelector("#container_password input").addEventListener('blur',check_password);


img_pass.addEventListener('click',MostraNascondiPassword);



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






