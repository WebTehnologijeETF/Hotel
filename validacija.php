<?php
$varijabla='proba';
$grad=$name=$email=$poruka=$telefon=$postanskibroj="";
$namee=$emaile=$porukae=$telefone=$postanskibroje="";
$drzave=$drzavee="";
$validnedrzave=array("BiH", "Hrvatska", "Srbija") ;
$drzava="a";
$validno=true;

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
 if (($_POST["grad"])!="")
 {
$grad=jeliprazno($_POST["grad"]);

 }
  

  if (($_POST["ime"])=="")
  {  $namee="Morate unijeti ime!";
  $validno=false;
  }
  else 
  {
 $name = jeliprazno($_POST["ime"]);
 if (empty($name))
 {
  $namee="Unijeli ste samo razmake!";
  $validno=false;
 }  
  }
if (($_POST["email"])=="")
 {
  $emaile="Morate unijeti email";
  $validno=false;
 }
 else {
 $email=jeliprazno($_POST["email"]);
 if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
  $emaile="Morate unijeti validan email!";
  $validno=false;
    }  
      }
     if (($_POST["poruka"])=="") {
     $porukae="Morate unijeti poruku!";
     $validno=false;
     }
     else{
     $poruka=jeliprazno($_POST["poruka"]);
     if(empty($poruka))
     {
     $porukae="Unijeli ste praznu poruku!";
     $validno=false;
     }
   }

 
  
$drzava=($_POST["drzave"]);
 if (!in_array($drzava, $validnedrzave)){
 $validno=false;
 $drzavee="Unijeli ste nevalidnu državu!";
    }
  
 if(($_POST["telefon"])!="")
 { 
  $telefon=$_POST["telefon"] ;
  if (!preg_match("/^[0-9]{2}[1-9][-]?[0-9]{3}[-]?[0-9]{3}$/",$telefon))
    {$telefone="Telefon može sadrzavati samo brojeve!";
     $validno=false;
    }

 }

 if(($_POST["pbroj"])!="")
 {
  
 $postanskibroj=($_POST["pbroj"]);
 if(!preg_match("/^[0-9]{5}$/", $postanskibroj))
 {
 $postanskibroje="Unesite validan poštanski broj" ;
 $validno=false;
 }
 }
}

function jeliprazno($data)
{
  $data = trim($data);
  $data=htmlentities($data);
  return $data;

}



?>