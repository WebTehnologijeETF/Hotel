<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HEAD>
<META http-equiv="Content-Type" content="text/html; charset=utf-8">

<link rel="stylesheet" type="text/css" href="stil2.css">
<script src="javascript.js"></script>

<TITLE>Double Infinity Hotel</TITLE>
</HEAD>

<body>
<div id="zaglavlje">

<h1>
<br><br>
 Double Infinity Hotel
    </h1>
 

</div>


<?php

function jeliprazno($data)
{
  $data = trim($data);
  $data=htmlentities($data);
  return $data;

}

session_start();



?>
<?php
 $veza = new PDO("mysql:dbname=doubleinfinityhotel;host=localhost;charset=utf8", "zana", "1ZanA1");
     $veza->exec("set names utf8");
     $naslovi = $veza->prepare("SELECT naslov from novosti ");
     $naslovi2=$veza->prepare("SELECT naslov from novosti ");
     $naslovi2->execute();
     $naslovi->execute();
     $admini=$veza->prepare("SELECT username from administratori ");
     $admini->execute();
     $tekstpromijeni="";
    $autorpromijeni="";
     $idpromijeni="";
     $naslovpromijeni="";
     $slikapromijeni="";
      $userpromijeni= $passpromijeni=$emailpromijeni="";

     
if ($_SERVER["REQUEST_METHOD"]=="POST" && (isset($_POST['dodajnovost'])))
 {
   
   
    $naslov=jeliprazno($_POST["naslov"]);
  $tekst=jeliprazno($_POST["tekst"]);
  $autor=jeliprazno($_POST["autor"]);
  $slika=jeliprazno($_POST["slika"]);


$unos = $veza->prepare("INSERT INTO novosti SET naslov=?, tekst=?, autor=?, slika=? ");
$unos->execute(array($naslov,$tekst,$autor,$slika));



 }
if ($_SERVER["REQUEST_METHOD"]=="POST" && (isset($_POST['prikazinovost'])))
 {
    
   $naslovp=jeliprazno($_POST["naslov"]);
   echo $naslovp;
  
  

$unos = $veza->prepare("SELECT * FROM novosti where naslov=?");
$unos->execute(array($naslovp));

foreach ($unos as $n)

{     
     $tekstpromijeni=$n['tekst'];
    $autorpromijeni=$n['autor'];
     $idpromijeni=$n['id'];

     $naslovpromijeni=$n['naslov'];
     $slikapromijeni=$n['slika'];

}



 }
if ($_SERVER["REQUEST_METHOD"]=="POST" && (isset($_POST['promijeninovost'])))
 {
   $idpromijeni=jeliprazno($_POST['pomocna']);
  
   $naslovp=jeliprazno($_POST['naslov']);
   $tekstp=jeliprazno($_POST['tekst']);
   $autorp=jeliprazno($_POST['autor']);
   $slikap=jeliprazno($_POST['slika']);
  

$unos = $veza->prepare("UPDATE novosti SET naslov=?, tekst=?, autor=?, slika=? where id=?");
$unos->execute(array($naslovp,$tekstp,$autorp,$slikap,$idpromijeni));





 }

 if ($_SERVER["REQUEST_METHOD"]=="POST" && (isset($_POST['izbrisinovost'])))
 {
   $idpromijeni=jeliprazno($_POST['pomocna']);
   
 

$unos = $veza->prepare("DELETE FROM novosti where id=?");
$unos->execute(array($idpromijeni));




 }

if ($_SERVER["REQUEST_METHOD"]=="POST" && (isset($_POST['prikaziadmin'])))
 {
    
   $user=jeliprazno($_POST["admini"]);

  echo "usrname".$user;
  

$unosad = $veza->prepare("SELECT * FROM administratori where username=?");
$unosad->execute(array($user));

foreach ($unosad as $n)

{     
     $userpromijeni=$n['username'];
    $passpromijeni=$n['password'];
     $emailpromijeni=$n['email'];

    

}
 echo "Userpromijeni".$userpromijeni;
}
 
if ($_SERVER["REQUEST_METHOD"]=="POST" && (isset($_POST['promijeniadminbutton'])))
 {

 
   $usernamepr=jeliprazno($_POST['admini']);

   $usernovi=jeliprazno($_POST['userna']);
   $pasnovi=jeliprazno($_POST['pass']);
   $emailnovi=jeliprazno($_POST['email']);
   
  
  

$unos = $veza->prepare("UPDATE administratori SET username=?, password=?, email=? where username=?");
$unos->execute(array($usernovi,$pasnovi,$emailnovi,$usernamepr));




 }

if ($_SERVER["REQUEST_METHOD"]=="POST" && (isset($_POST['izbrisiadminbutton'])))
 {

 	
   $usernamepr=jeliprazno($_POST['admini']);

   if($usernamepr!=$_SESSION['username']){
  
  

$unos = $veza->prepare("DELETE FROM administratori   where username=?");
$unos->execute(array($usernamepr)); 

}


 }
if ($_SERVER["REQUEST_METHOD"]=="POST" && (isset($_POST['odjavise'])))
{

 session_unset();
 header('Location: index.php');

}



?>
<div id="ulogovani">Ulogovani ste kao : <?php echo $_SESSION['username']?>
<form action="adminpanel.php" method="POST">
<input id="odjavisebutton" type="submit" name="odjavise" value="Odjavi se">
</form>
</div>
<h5>Novosti</h5>
<hr>

<form id="formadodajnovost" action="adminpanel.php" method="POST" >

<legend id="dodavanjelegend">Dodavanje novosti</legend>
<label for ="naslov"> Naslov:</label>
<input type="text" name="naslov" ><br><br>
<label for ="tekst"> Tekst:</label>
<input type="text" name="tekst" ><br><br>
<label for="autor" > Autor:  </label>
<input type="text" name="autor" ><br><br>
<label for="slika" > Slika:  </label>
<input type="text" name="slika" ><br><br>
<input type="hidden" name="pomocna" value=""?> 

&nbsp;&nbsp;<input type="submit" value="Dodaj novost" name="dodajnovost" id="dodajnovost"></form>



<form id="formpn" action="adminpanel.php" method="POST" >
<legend id="dodavanjelegend">Promjena/brisanje novosti</legend>
<label for ="naslov" id="izaberinovost"> &nbsp;&nbsp;Izabrite novost:</label>
<select name="naslov"  >
<?php
foreach ($naslovi as $n)

{

if($n['naslov']==$naslovpromijeni)
echo  "<option value=\"".$n['naslov']."\" selected=\"selected\">".$n['naslov']."</option>";	
else
echo  "<option value=\"".$n['naslov']."\">".$n['naslov']."</option>";
  


}
	
  
?>
</select>
<input type="submit" value="Prikazi novost" name="prikazinovost" id="odjavisebutton"><br><br>
<label for ="promijeninaslov"> Naslov:</label>
<input type="text" name="promijeninaslov" value="<?php echo $naslovpromijeni ?>" ><br><br>
<label for ="tekst"> Tekst:</label>
<input type="text" name="tekst" value="<?php echo $tekstpromijeni ?>" ><br><br>
<label for="autor" >Autor:  </label>
<input type="text" name="autor" value="<?php echo $autorpromijeni ?>" ><br><br>
<label for="slika" > Slika:  </label>
<input type="text" name="slika" value="<?php echo $slikapromijeni ?>"><br><br>
<input type="hidden" name="pomocna" value="<?php echo $idpromijeni ?>"?>

&nbsp;&nbsp;<input type="submit" value="Promijeni novost" name="promijeninovost" id="dodajnovost"><br><br>
<input type="submit" value="Izbrisi novost" name="izbrisinovost" id="dodajnovost">
</form>




<hr>
<h5>Komentari</h5>
<form id="formbrisikomentare" action="adminpanel.php" method="POST" >
<legend id="dodavanjelegend">Uređivanje komentara</legend>
<label for="izbornovosti" id="izaberinovost">Izaberite novost:</label>
<select name="izbornovosti">
<?php

foreach ($naslovi2 as $n)

{


echo  "<option value=\"".$n['naslov']."\">".$n['naslov']."</option>";
  


}
 ?>
</select>
<input type="submit" value="Prikaži komentare" name="prikazikomentare" id="odjavisebutton"><br><br>
</form>
<hr>



<?php
if ($_SERVER["REQUEST_METHOD"]=="POST" && (isset($_POST['prikazikomentare'])))
 {
 	$idn="";
    $naslovk=jeliprazno($_POST['izbornovosti']);
    $unoss = $veza->prepare("SELECT * FROM novosti where naslov=?");
$unoss->execute(array($naslovk));
foreach ($unoss as $id)
	{$idn=$id['id'];}

$unosx = $veza->prepare("SELECT id,novost,tekst, autor,email, UNIX_TIMESTAMP(vrijeme) vrijeme2 FROM komentar WHERE novost=? order by vrijeme asc");
$unosx->execute(array($idn));

foreach ($unosx as $koment ) 

             print "<div class=\"pozicijakom\"><p class=\"tekstkoment\"> ".$koment['tekst']." </p><br><small class=\"smalkoment\" > Objavio/la :".$koment['autor']."</small><small class=\"smalkoment\">&nbsp;&nbsp;&nbsp;".$koment['email']."</small><br><small class=\"smalkoment\" > ".date("d.m.Y. (h:i)", $koment['vrijeme2'])." </small><br><hr id=\"hrkoment\">
        <form action=\"adminpanel.php\" method=\"POST\"> <input type=\"submit\" name=\"izbrisik\" value=\"Izbrisi komentar\"><input type=\"hidden\" name=\"pomocna\" value=\"". $koment['novost']."\">
        <input type=\"hidden\" name=\"pomocna2\" value=\"". $koment['id']."\"></form></div><hr>";
            }

if ($_SERVER["REQUEST_METHOD"]=="POST" && (isset($_POST['izbrisik'])))
 { 
   $idnovosti=$_POST["pomocna"];
   $idkomentara=$_POST["pomocna2"];
              
 	$unos = $veza->prepare("DELETE FROM komentar where novost=? AND id=?");
$unos->execute(array($idnovosti, $idkomentara));

 	
            }


if ($_SERVER["REQUEST_METHOD"]=="POST" && (isset($_POST['dodajadminbutton'])))
 {
   
  
   
  $user=jeliprazno($_POST["usern"]);
  $pas=jeliprazno($_POST["pass"]);
  $em=jeliprazno($_POST["email"]);
  


$unos = $veza->prepare("INSERT INTO administratori SET username=?, password=?, email=? ");
$unos->execute(array($user,md5($pas),$em)); 


}




?>

<h5>Administatori</h5>
<form id="adminforma1" action="adminpanel.php" method="POST">
<legend id="dodavanjelegend">Dodavanje administratora</legend>
<label for="usern">Korisničko ime:</label>
<input type="text" name="usern">
<label for="pass">Sifra:</label>
<input type="text" name="pass">
<label for="email">Email:</label>
<input type="text" name="email"><br><br>
<input type="submit" name="dodajadminbutton" value="Dodaj adminitratora" id="dodajnovost">

</form>


<form id="adminforma1" action="adminpanel.php" method="POST">
<legend id="dodavanjelegend">Promjena/brisanje administratora</legend>
<label for="admini" id="izaberinovost">Izaberite adminstratora:</label>
<select name="admini"  >
<?php
foreach ($admini as $n)

{

if($n['username']==$userpromijeni)
echo  "<option value=\"".$n['username']."\" selected=\"selected\">".$n['username']."</option>";	
else
echo  "<option value=\"".$n['username']."\">".$n['username']."</option>";
  


} ?>
</select>
<input type="submit" name="prikaziadmin" value="Prikazi adminitratora" id="odjavisebutton">
<label for="userna">Korisničko ime:</label>
<input type="text" name="userna" value="<?php echo $userpromijeni ?>">
<label for="pass">Sifra:</label>
<input type="text" name="pass" value="<?php echo $passpromijeni ?>">
<label for="email">Email:</label>
<input type="text" name="email" value="<?php echo $emailpromijeni ?>"><br><br>
<input type="submit" name="promijeniadminbutton" value="Spasi promjene" id="dodajnovost"><br><br>
<input type="submit" name="izbrisiadminbutton" value="Izbrisi administratora" id="dodajnovost">
</form>
<hr>


<br><br>
<footer><p> 2015 Double infinity Hotel-All rights reserved.</p>
  
   
</footer>   