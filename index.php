<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HEAD>
<META http-equiv="Content-Type" content="text/html; charset=utf-8">

<link rel="stylesheet" type="text/css" href="stil2.css">
<script src="javascript.js"></script>

<TITLE>Double Infinity Hotel</TITLE>
</HEAD>

<body onload=ucitajnovosti()>
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
            <li id="stavka1"  onclick="otvori('restoran.html')"   onmouseover="promijenipozadinu('stavka1', '#380000')" onmouseout="vratibojupozadine('stavka1', 'black')"><a href="#">O restoranu</a></li>
        	
        </ul>

		</li>
		<li><a onclick="otvori('kontakt.html')">Kontakt </a></li>
		</ul>
        <br><br> <br>

   </div>
  
   <div id="dobrodosli">
   <img class="sn" id="slika1" src="hoteloutside.jpg" alt="Slika"  >
   <img class="sn" id="slika2" src="luster.jpg" alt="Slika" height="32%" width="24%">
   <img class="sn" id="slika3" src="stolicepozadina.jpg" alt="Slika" height="32%" width="24%">
   
   <img class="sn" id="slika4" src="gardenr.jpeg" alt="Slika" height="32%" width="24%" >


   </div>
   <?php
include ('login2.php');
?>
   
  
<h5>Novosti</h5>
<hr>
<p id="polje"></p>

   
   
  </body>
</html>
<br><br>
<?php echo  "<p id=\"pogresanlogin\">$greska</p>?>" ?>

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


