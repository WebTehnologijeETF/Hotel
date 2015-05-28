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





   <div id="meni">
		<ul>
		<li><a onclick="otvori('index.php')">Naslovnica</a></li>
		<li><a onclick="otvori('sobe.html')">Sobe</a></li>
		<li><a onclick="otvorisubmeni('submeni')" onmouseout="zatvorielement()"  >Restoran</a>
          <ul id="submeni" onmouseover="drzisubmeni()" >
            <li id="stavka1"  onclick="otvori('restoran.html')"   onmouseover="promijenipozadinu('stavka1', '#380000')" onmouseout="vratibojupozadine('stavka1', 'black')"><a href="#">Specijalne ponude</a></li>
        	<li id="stavka2" onclick="otvori('proizvodi.html')" onmouseover="promijenipozadinu('stavka2', '#380000')" onmouseout="vratibojupozadine('stavka2', 'black')" ><a href="#">Proizvodi </a></li>
        	<li id="stavka3" onmouseover="promijenipozadinu('stavka3', '#380000')" onmouseout="vratibojupozadine('stavka3', 'black')"><a href="#">Radno vrijeme </a></li>
        </ul>

		</li>
		<li><a onclick="otvori('kontakt.html')">Kontakt </a></li>
		</ul>
        <br><br> <br>

   </div>
  
   <div id="dobrodosli">
   <img class="sn" src="hoteloutside.jpg" alt="Slika"  >
   <img class="sn" src="luster.jpg" alt="Slika" height="32%" width="24%">
   <img class="sn" src="stolicepozadina.jpg" alt="Slika" height="32%" width="24%">
   
   <img class="sn" src="gardenr.jpeg" alt="Slika" height="32%" width="24%" >


   </div>
   <?php
include ('login2.php');
?>
   
  
<h5>Novosti</h5>
<hr>

    <?php
     $veza = new PDO("mysql:dbname=doubleinfinityhotel;host=localhost;charset=utf8", "zana", "1ZanA1");
     $veza->exec("set names utf8");
     $rezultat = $veza->query("select id, naslov,slika, tekst, UNIX_TIMESTAMP(datum) vrijeme2, autor from novosti order by datum desc");
      
     if (!$rezultat) {
          $greska = $veza->errorInfo();
          print "SQL greška: " . $greska[2];
          exit();
     }
if ($_SERVER["REQUEST_METHOD"]=="POST" && (isset($_POST['komentarsubmit'])))
{
  $id=$_POST["pomocna"];
  $tekst=$_POST["tekst"];
  $autor=$_POST["autor"];
  $email=$_POST["email"];


$unos = $veza->prepare("INSERT INTO komentar SET novost=?, tekst=?, autor=?, email=? ");
$unos->execute(array($id,$tekst,$autor,$email));
unset($_GET['novosti']);

}
  
     

         if (isset($_GET['novost'])) {
         
      foreach($rezultat as $v)
      {
        if ($v['id']==$_GET['novost']){
           print "<div id=\"novostdiv\"><h6>".$v['naslov']."</h6> <img class=\"novost\" src=\"".$v['slika']."\" alt=\"slika\" ><p class=\"novostx\">".$v['tekst']."</p><small class=\"objava\"> Objavio/la :".$v['autor']."</small><small class=\"objava\"> &nbsp;&nbsp;   ".date("d.m.Y. ", $v['vrijeme2'])."</small><br></div><br><br><br>";
           print "<hr><h5>Komentari:</h5>";
            $k=$veza->prepare( "SELECT tekst, autor,email, UNIX_TIMESTAMP(vrijeme) vrijeme2 FROM komentar WHERE novost=? order by vrijeme asc") ;
            $k->bindValue(1, $v['id'], PDO::PARAM_INT) ;
              $k->execute();
            $brojkomentara = $k->rowCount();
         if($brojkomentara==0){
            print "<p class=\"tekstkoment\">Nema komentara!</p><br>";}
            else
            {
             
             foreach ($k as $koment ) 

             print "<div class=\"pozicijakom\"><p class=\"tekstkoment\"> ".$koment['tekst']." </p><br><small class=\"smalkoment\" > Objavio/la :".$koment['autor']."</small><small class=\"smalkoment\">&nbsp;&nbsp;&nbsp;".$koment['email']."</small><br><small class=\"smalkoment\" > ".date("d.m.Y. (h:i)", $koment['vrijeme2'])." </small><br><hr id=\"hrkoment\"></div>";
            }

          }

      }
     ?>
    <form id="formakomentar" action="index.php" method="POST" >

<label for ="tekst"> &nbsp;&nbsp;Tekst:</label>
<input type="text" name="tekst" ><br><br>
<label for="autor" > &nbsp;&nbsp;&nbsp;&nbsp;Autor:  </label>
<input type="text" name="autor" ><br><br>
<label for="email" > &nbsp;&nbsp;&nbsp;&nbsp;Email:  </label>
<input type="text" name="email" ><br><br>
<input type="hidden" name="pomocna" value=<?php echo $_GET['novost'] ?> />

&nbsp;&nbsp;<input type="submit" value="Komentarisi" name="komentarsubmit"></form>
<br><br><br><br><br><hr>

     <?php
     } 
     else {

       foreach ($rezultat as $novost) {
        
          print "<div id=\"novostdiv\"><h6>".$novost['naslov']."</h6> <img class=\"novost\" src=\"".$novost['slika']."\" alt=\"slika\" ><p class=\"novostx\">".$novost['tekst']."</p><small class=\"objava\"> Objavio/la :".$novost['autor']."</small><small class=\"objava\"> &nbsp;&nbsp;   ".date("d.m.Y. ", $novost['vrijeme2'])."</small><br></div><br><br><br>";
         $k=$veza->prepare( "SELECT * FROM komentar WHERE novost=?") ;
         $k->bindValue(1, $novost['id'], PDO::PARAM_INT) ;
              $k->execute();
          $brojkomentara = $k->rowCount();
         // if($brojkomentara==0){
           // print "<p>Nema komentara!</p><br>";}
            //else
            //{
              print "<p class=\"komentar\">Ova novost sadrži ukupno <a href=\"index.php?novost=" . $novost['id'] . "\">".$brojkomentara." komentara</a>. </p><br><br><br><hr>";
             
             //foreach ($k as $koment ) 

             //print "<p> ".$koment['tekst']." </p><small>".$koment['autor']."</small><small> ".$koment['vrijeme']." </small><br>";
            //}
     
       }

     }

    
    ?>
   
  </body>
</html>
<br><br>
<footer><p> 2015 Double infinity Hotel-All rights reserved.</p>
    <form id="admin" action="index.php" method="POST" >
     Admin:
<input type="text" name="username" >
 Sifra:
<input type="text" name="password" >
<input type="submit" name="ulogujse" value="Prijavi se">
</footer>   
</BODY>
</HTML>


