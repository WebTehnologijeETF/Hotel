<!DOCTYPE html>
<html>
<HEAD>
<META http-equiv="Content-Type" content="text/html; charset=utf-8">
<script src="javascript.js"></script>

<link rel="stylesheet" type="text/css" href="stil2.css">
<TITLE>Double Infinity Hotel</TITLE>
</HEAD>
<body>
<div id="zaglavlje">

<h1>
<br><br>
 Double Infinity Hotel
    </h1>
 

</div>

<?php include 'validacija.php';?>






   <div id="meni">
		<ul>
		<li><a onclick="otvori('index.html')">Naslovnica</a></li>
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

<br><br><br>


<?php
  if($validno){
  echo '<div class="potvrda"><p>Provjerite da li ste ispravno popunili formu </p> ';
  echo '<p>Ime i prezime : '."$name".'<br>
           Email: '."$email".'<br>';
           if ($telefon!="")
  echo      'Telefon: '."$telefon".'<br>';
           if($drzava!="")
  echo      'Drzava: '.".$drzava" .'<br>' ;
           if($grad!="")   
  echo      'Grad:'."$grad".'<br>';
  echo      'Poruka: '."$poruka".'</p>';
  echo '<p>Da li ste sigurni da želite poslati ove podatke?</p>';
  echo '<input type="submit" value="Siguran sam"/><br>';
  echo '<p>Ako ste pogrešno popunili formu, možete ispod prepraviti unesene podatke:</p></div>';
   }
       
 ?>
<br><br><br>

<form id="kontakt" method="post" action="kontak2.php"  target="_self">
<fieldset id="okvirforme">
<legend>Kontaktirajte nas! </legend>

<label for ="ime">Ime i prezime: </label> <input onchange="provjeriime()" type="text"  id ="ime" name="ime" placeholder="Unesite ime i prezime" size="55" value="<?php echo htmlspecialchars($name);?>" style=/> 

<img id= '<?php if ($namee=="Morate unijeti ime!" || $namee=="Unijeli ste samo razmake!") echo "error52"; else echo "error1"; ?>' src="error5.png"  />
<label for="email" id="lemail">Email: </label><input onchange="provjeriemail()"    type="text" id="email" name="email" placeholder="ime@hotmail.com" value="<?php echo htmlspecialchars($email);?>"  size="55" /> 
<img id= '<?php if ($emaile=="Morate unijeti email" || $emaile=="Morate unijeti validan email!") echo "error22"; else echo "error2"; ?>' src="error5.png"   />
<label for="telefon" id="tel" >Telefon: </label> <input type="tel" name="telefon"  id="telefon"  onchange="provjeritelefon()" placeholder="xxx- xxx-xxx" value="<?php echo htmlspecialchars($telefon);?>" size="55"  />
<img id='<?php if ($telefone=="Telefon može sadrzavati samo brojeve!") echo "error52"; else echo "error3"; ?>'  src="error5.png"  />
<label for="drzave"  >Država</label>
<select id="drzave" name="drzave" onchange="provjerigrad()" value="<?php echo htmlspecialchars($drzava);?>">

  <option value="BiH" selected >BiH</option>
  <option value="Hrvatska">Hrvatska</option>
  <option value="Srbija">Srbija</option>
  
</select>
<img id='<?php if ($drzavee=="Unijeli ste nevalidnu državu!") echo "errornovi"; else echo "error3"; ?>' src="error5.png">

<label for="grad"  >Grad: </label>
<input  onchange="provjerigradservis2()"   type="text" id="grad" name="grad" value="<?php echo htmlspecialchars($grad);?>"size="55">
<img id="error5" src="error5.png" />
<label for="pbroj">Poštanski broj:</label><input onchange="provjerigradservis()" type="text" id="pbroj" name="pbroj" value="<?php echo htmlspecialchars($postanskibroj);?>" size="55">
<img id='<?php if ($postanskibroje=="Unesite validan poštanski broj") echo "error52"; else echo "error5"; ?>' src="error5.png" />

<label for="poruka">Poruka: </label> <input  onchange="provjeriporuku()"  type="text" id="poruka" name="poruka" value="<?php echo htmlspecialchars($poruka);?>" size="55" placeholder="Upišite vašu poruku"   />
<img id='<?php if ($porukae=="Morate unijeti poruku!" || $porukae=="Unijeli ste praznu poruku!") echo "error52"; else echo "error5"; ?>' src="error5.png" />
<input type="submit" value="Posalji!" id="posalji" size="51" />
<button type="reset" value="Reset" id="reset">Reset</button>

<p id="greska">Ovdje će biti poruka o grešci! </p>




</fieldset> 
</form>

