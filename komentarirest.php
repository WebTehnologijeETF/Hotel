<?php
function zag() {
    header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
    header('Content-Type: text/html');
    header('Access-Control-Allow-Origin: *');
}

function jeliprazno($data)
{
  $data = trim($data);
  $data=htmlentities($data);
  return $data;

}
function rest_get($request, $data) { 
$idvijesti =htmlEntities($data['novost'], ENT_QUOTES);



$veza = new PDO("mysql:dbname=doubleinfinityhotel;host=localhost;charset=utf8", "zana", "1ZanA1");
$veza->exec("set names utf8");

$upit = $veza->prepare("SELECT * FROM komentar WHERE novost=?");
$upit->bindValue(1, $idvijesti, PDO::PARAM_INT);



$upit->execute();

print "{ \"komentari\": " . json_encode($upit->fetchAll()) . "}";



}
function rest_post($request, $data) {

 
  $id=jeliprazno($data["novost"]);

  $tekst=jeliprazno($data["tekst"]);
  $autor=jeliprazno($data["autor"]);
  $email=jeliprazno($data["email"]);

$veza = new PDO("mysql:dbname=doubleinfinityhotel;host=localhost;charset=utf8", "zana", "1ZanA1");
$veza->exec("set names utf8");

$unos = $veza->prepare("INSERT INTO komentar SET novost=?, tekst=?, autor=?, email=? ");
$unos->execute(array($id,$tekst,$autor,$email));

 }
function rest_delete($request, $data) { 




}
function rest_put($request, $data) { }
function rest_error($request) { }

$method  = $_SERVER['REQUEST_METHOD'];
$request = $_SERVER['REQUEST_URI'];

switch($method) {
    case 'PUT':
        parse_str(file_get_contents('php://input'), $put_vars);
        zag(); $data = $put_vars; rest_put($request, $data); break;
    case 'POST':
        zag(); $data = $_POST; rest_post($request, $data); break;
    case 'GET':
        zag(); $data = $_GET; rest_get($request, $data); break;
    case 'DELETE':
        zag(); rest_delete($request); break;
    default:
        header("{$_SERVER['SERVER_PROTOCOL']} 404 Not Found");
        rest_error($request); break;
}
?>