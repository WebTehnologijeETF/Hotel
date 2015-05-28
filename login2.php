<?php

function jeliprazno($data)
{
  $data = trim($data);
  $data=htmlentities($data);
  return $data;

}

session_start();
if(isset($_POST['ulogujse']) ){

//pritisnut button
	//situacija 1. 
	//admin unosi sifru ispravnu
if(!isset($_SESSION['username']))
{


	$username = jeliprazno($_REQUEST['username']);
    $password=jeliprazno($_REQUEST['password']);
    if(empty($username) || empty($password)) echo "Molim vas unesite i ime i password!";
    else{
    $veza = new PDO("mysql:dbname=doubleinfinityhotel;host=localhost;charset=utf8", "zana", "1ZanA1");
     $veza->exec("set names utf8");
      $upit = $veza->prepare("SELECT * FROM administratori WHERE username=? and password=md5(?)");
   $upit->execute(array($username, $password));
   $broj=$upit->rowCount();

if ($broj==1)
{
	$_SESSION['username']=$username;
	$_SESSION['password']=$password;

      echo "logovani ste kao ".$_SESSION['username'];
       header('Location: adminpanel.php');
  }

else echo "Unijeli ste neispravnu sifru!";
  } }
     // session_unset();
} 
 ?>


<?php
//header('Location: sobe.html');
?>




