<?php


//https://api.spoonacular.com/recipes/complexSearch?query=pasta&maxFat=25&number=2
$query = $_GET['query'];
                                
if($query == null){
$error="Per effettuare la ricerca è neccessario fornire il nome dell'ingrediente.";
header('Content_Type: application/json');
echo json_encode($error);
}
  else{
    /*$conn=mysqli_connect($dbconfin['host'],$dbconfin['user'],$dbconfin['password'],$dbconfin['name']);*/
    $query = $_GET['query'];
  $apiKey = '2df21b99f68e4509bb534f275fe844d5';
  $url = "https://api.spoonacular.com/food/search?apiKey=".$apiKey."&query=".$query."&number=10";
  $ch = curl_init();
    
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($ch);
  curl_close($ch);

  header('Content_Type: application/json');
  echo json_encode($response);
  }



  ?>