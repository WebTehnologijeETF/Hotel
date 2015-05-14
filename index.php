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
 $dir = "novosti";
 $a = scandir($dir);
 $niztekstova=array();

 

for ($i=0; $i < count($a); $i++) { 
  if($a[$i]==".." || $a[$i]==".") continue;
   $linije=array();
  $file=fopen("novosti\\".$a[$i], "r") or die ("Ne moze se učitati!");
   while(! feof($file))
  {
   $linije[]=fgets($file);
  }
  $niztekstova[]=$linije;
   fclose($file);  
}
  
  for ($i=0; $i<count($niztekstova); $i++){
       for($j=0; $j<count($niztekstova); $j++)
  { 
       if(strtotime($niztekstova[$i][0])<  strtotime($niztekstova[$j][0]))   
       {
         $pomocna=$niztekstova[$i][0]; 
         $niztekstova[$i][0]=$niztekstova[$j][0];
         $niztekstova[$j][0]=$pomocna;


       }
      
  }

  for ($i=0; $i<count($niztekstova); $i++) {
       for($j=0; $j<count($niztekstova[$i]); $j++){

        echo $niztekstova[$i][$j];
        echo "<br>";

      }
  
   


}
  }

  
?>
   
</BODY>
</HTML>


