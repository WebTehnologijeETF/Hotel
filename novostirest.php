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

function rest_getbyname($request, $data)
{
$naslovp=$data['naslov'];
 $veza = new PDO("mysql:dbname=doubleinfinityhotel;host=localhost;charset=utf8", "zana", "1ZanA1");
 $veza->exec("set names utf8");   
$unos = $veza->prepare("SELECT * FROM novosti where naslov=?");
$unos->execute(array($naslovp));

print "{ \"novost\": " . json_encode($unos->fetchAll()) . "}";

}



function rest_getall($request, $data) { 


//UNIX_TIMESTAMP(datum)

$veza = new PDO("mysql:dbname=doubleinfinityhotel;host=localhost;charset=utf8", "zana", "1ZanA1");
     $veza->exec("set names utf8");
     $rezultat = $veza->query("SELECT novosti.id,novosti.naslov,novosti.slika, novosti.tekst, novosti.datum, novosti.autor,COUNT(komentar.id) AS 'broj' FROM novosti LEFT JOIN komentar ON novosti.id=komentar.novost GROUP BY novosti.id ORDER BY datum desc");
      

     if (!$rezultat) {
          $greska = $veza->errorInfo();
          print "SQL greška: " . $greska[2];
          exit();
     }



print "{ \"novosti\": " . json_encode($rezultat->fetchAll()) . "}";


         

         




}
function rest_post($request, $data) {
     $veza = new PDO("mysql:dbname=doubleinfinityhotel;host=localhost;charset=utf8", "zana", "1ZanA1");
     $veza->exec("set names utf8");
 $naslov=jeliprazno($data["naslov"]);
  $tekst=jeliprazno($data["tekst"]);
  $autor=jeliprazno($data["autor"]);
  $slika=jeliprazno($data["slika"]);



$unos = $veza->prepare("INSERT INTO novosti SET naslov=?, tekst=?, autor=?, slika=? ");
$unos->execute(array($naslov,$tekst,$autor,$slika));
 }
function rest_delete($request, $data) { 

  
  $naslovk= jeliprazno($data["naslov"]);
  
  
     $veza = new PDO("mysql:dbname=doubleinfinityhotel;host=localhost;charset=utf8", "zana", "1ZanA1");
     $veza->exec("set names utf8");

    $unoss = $veza->prepare("SELECT * FROM novosti where naslov=?");
$unoss->execute(array($naslovk));
foreach ($unoss as $id)
    {$idn=$id['id'];}


   
 

$unos = $veza->prepare("DELETE FROM novosti where id=?");
$unos->execute(array($idn));
$unos=$veza->prepare("DELETE FROM komentar where novost=?");
$unos->execute(array($idn));

}
function rest_put($request, $data) {
     $veza = new PDO("mysql:dbname=doubleinfinityhotel;host=localhost;charset=utf8", "zana", "1ZanA1");
     $veza->exec("set names utf8");

    $idpromijeni=jeliprazno($data['pomocna']);
    
  
   $naslovp=jeliprazno($data['naslov']);
   $tekstp=jeliprazno($data['tekst']);
   $autorp=jeliprazno($data['autor']);
   $slikap=jeliprazno($data['slika']);
  

$unos = $veza->prepare("UPDATE novosti SET naslov=?, tekst=?, autor=?, slika=? where id=?");
$unos->execute(array($naslovp,$tekstp,$autorp,$slikap,$idpromijeni));







 }
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
        if (isset($_GET['naslov'])){
        zag(); $data = $_GET; rest_getbyname($request, $data);}
      else {
       zag(); $data = $_GET; rest_getall($request, $data);

     } 


        break;
    case 'DELETE':
        zag();  $data = $_REQUEST; rest_delete($request, $data); break;
    default:
        header("{$_SERVER['SERVER_PROTOCOL']} 404 Not Found");
        rest_error($request); break;
}
?>