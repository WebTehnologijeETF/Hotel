var element;
var brojac;

function ucitajtabelu() {


var podaci=new XMLHttpRequest();
podaci.onreadystatechange=function()


{
        if (podaci.readyState == 4 && podaci.status == 200)
        {   
          
            var tekst=JSON.parse(podaci.responseText) ;
            
            
            var tabela=document.getElementById("tabela1") ;
            while(tabela.rows.length > 1) {
                  tabela.deleteRow(1);

          }
            for(var i=0; i<tekst.length; i++)
            {
                var red=tabela.insertRow();     
                var cell1 = red.insertCell(0);
                var cell2 = red.insertCell(1);
                var cell3 = red.insertCell(2);
                var cell4 = red.insertCell(3);


               cell1.innerHTML = tekst[i].id;
               cell2.innerHTML = tekst[i].naziv;
               cell3.innerHTML = tekst[i].slika;
               cell4.innerHTML = tekst[i].opis;

              


            }
            
          
            

        }
    }

 
podaci.open("GET", "http://zamger.etf.unsa.ba/wt/proizvodi.php?brindexa=16102", true);
    podaci.send();

}


function izmjeniproizvod()
{

var idd=document.getElementById("idpb").value;
var nazivv=document.getElementById("nazivb").value ;

var opiss=document.getElementById("opisb").value ;

var slikaa=document.getElementById("pslikab").value ;

var proizvod={id:idd, naziv:nazivv, opis:opiss, slika:slikaa};

var objekt= new XMLHttpRequest();
    objekt.onreadystatechange = function(event) {
        if (objekt.readyState == 4 && objekt.status == 200)
        {
            event.preventDefault();
        }
    }
    objekt.open("POST", "http://zamger.etf.unsa.ba/wt/proizvodi.php?brindexa=16102", true);
    objekt.setRequestHeader("Content-type","application/x-www-form-urlencoded");
   objekt.send("akcija=promjena&proizvod=" + JSON.stringify(proizvod)); 




}



function dodajproizvod()
{
  
var nazivv=document.getElementById("naziv").value ;

var opiss=document.getElementById("opis").value ;

var slikaa=document.getElementById("pslika").value ;



var proizvod={naziv:nazivv, opis:opiss, slika:slikaa};

var objekt= new XMLHttpRequest();
    objekt.onreadystatechange = function(event) {
        if (objekt.readyState == 4 && objekt.status == 200)
        {
            event.preventDefault();
        }
    }
    objekt.open("POST", "http://zamger.etf.unsa.ba/wt/proizvodi.php?brindexa=16102", true);
    objekt.setRequestHeader("Content-type","application/x-www-form-urlencoded");
   objekt.send("akcija=dodavanje&proizvod=" + JSON.stringify(proizvod)); 



}

function izbrisiproizvod()
{

var idd = document.getElementById("idp").value;
  
  var proizvod = {
        id: idd
    }; 

var objekt= new XMLHttpRequest();
    objekt.onreadystatechange = function(event) {
        if (objekt.readyState == 4 && objekt.status == 200)
        {
            event.preventDefault();
        }
    }

objekt.open("POST", "http://zamger.etf.unsa.ba/wt/proizvodi.php?brindexa=16102", true);
    objekt.setRequestHeader("Content-type","application/x-www-form-urlencoded");
   objekt.send("akcija=brisanje&proizvod=" + JSON.stringify(proizvod)); 



} 






function provjerigradservis2() {



var grad1=document.getElementById("grad").value;

var pbroj1=document.getElementById("pbroj").value;
if(pbroj1!="") {

var ajax = new XMLHttpRequest();
ajax.onreadystatechange = function()
{// Anonimna funkcija

if(ajax.readyState == 4 && ajax.status == 200)
{

if (ajax.responseText == "{"+'"ok"'+":"+'"Poštanski broj odgovara mjestu"'+'}') {
var paragraf=document.getElementById("greska");

paragraf.style.visibility="hidden";
var slika=document.getElementById('error5');
slika.style.visibility="hidden"; 
}
else{
 var paragraf=document.getElementById("greska");
paragraf.innerHTML="Poštanski broj ne odgovara gradu!"; 
paragraf.style.visibility="visible";
var slika=document.getElementById('error5');
slika.style.visibility="visible"; 
document.getElementById("grad").focus() ;
}



} }


ajax.open("GET", "http://zamger.etf.unsa.ba/wt/postanskiBroj.php?mjesto=" + grad1 + "&postanskiBroj=" + pbroj1, true);


 ajax.send(); }

 else {
    var paragraf=document.getElementById("greska");

paragraf.style.visibility="hidden";
var slika=document.getElementById('error5');
slika.style.visibility="hidden"; 



 }

  }





function provjerigradservis() {



var grad1=document.getElementById("grad").value;

var pbroj1=document.getElementById("pbroj").value;

var ajax = new XMLHttpRequest();
ajax.onreadystatechange = function()
{// Anonimna funkcija

if(ajax.readyState == 4 && ajax.status == 200)
{

if (ajax.responseText == "{"+'"ok"'+":"+'"Poštanski broj odgovara mjestu"'+'}') {
var paragraf=document.getElementById("greska");

paragraf.style.visibility="hidden";
var slika=document.getElementById('error5');
slika.style.visibility="hidden"; 
}
else{
 var paragraf=document.getElementById("greska");
paragraf.innerHTML="Poštanski broj ne odgovara gradu!"; 
paragraf.style.visibility="visible";
var slika=document.getElementById('error5');
slika.style.visibility="visible"; 
document.getElementById("pbroj").focus() ;
}



} }


ajax.open("GET", "http://zamger.etf.unsa.ba/wt/postanskiBroj.php?mjesto=" + grad1 + "&postanskiBroj=" + pbroj1, true);


 ajax.send();

  }


function otvori(stranica)
{
  
  var ajax = new XMLHttpRequest();

  ajax.onreadystatechange=function(){
    if(ajax.readyState == 4 && ajax.status == 200) {
      document.open();
      document.write(ajax.responseText);
      document.close();
    }
  }
  ajax.open("GET",stranica, true);
  ajax.send();
}





function otvorisubmeni(num) {

element = document.getElementById(num);
if(element.style.visibility=="visible" ) 
 element.style.visibility="hidden"  ; 
 
else  if(element.style.visibility=="hidden" || element.style.visibility=="")

 element.style.visibility = "visible";
 

}

function zatvorielement()
{
   
   brojac = window.setTimeout(PerformClose, 700);

}


  function drzisubmeni()
{
  // Reset the timer.
  window.clearTimeout(brojac);
  
}

 
function promijenipozadinu (num, boja)
{

element1 = document.getElementById(num);
  element1.style.backgroundColor=boja;


}


function vratibojupozadine (num, boja)
{
  element1 = document.getElementById(num);
  element1.style.backgroundColor=boja;


}

// validacija bez korištenja regexa, testiramo da li ime i prezime imaju maje od tri slova, ako imamo obavjestava

function provjeriime()
{


  var x = document.getElementById("ime").value;
  x.trim();
  
  var ime="s";
  var prezime="s";



  
 for(var i=0; i<x.length; i++ )
  {   
      if(i==0 && x.charAt(i)==" ") {
      
        continue;
      
}
    
     else if(ime=="s" && x.charAt(i)!=" ") 
        ime=x.charAt(i);

   else if(ime!="s" && x.charAt(i)!=" ")

      
   ime= ime + x.charAt(i); 

     else if (x.charAt(i)==" ")
       i=x.length-1;

  }

 
   
 for(i=ime.length; i<x.length; i++) {

  if(x.charAt(i)==" ") continue;
  
   else if(x.charAt(i)!=" " && prezime=="s")
    prezime=x.charAt(i) ;
  
 else if( x.charAt(i)!=" " && prezime!="s")
 prezime=prezime +x.charAt(i);
 else
  i=x.length-1;
}



 if (ime.length<3 || prezime.length<3 )  {
 var slika=document.getElementById('error1');
slika.style.visibility="visible"; 
 var paragraf=document.getElementById("greska");
 paragraf.innerHTML = "Molim Vas ,unesite validno ime i prezime!";
 paragraf.style.visibility="visible"; 
 }

else {
 var slika=document.getElementById('error1');

slika.style.visibility="hidden";
 document.getElementById("greska").visibility= "hidden";

}
}

function provjeriemail()
{
 var email = document.getElementById("email").value;
 
//! # $ % & ' * + - / = ? ^ _ ` { | } ~.-!#$%'*+=?^{|}~
var emailRegex=/^[a-zA-Z0-9_=?^_'{}|]{2,}@[a-zA-Z]{2,}\.[A-Za-z]{2,3}$/;
if (!emailRegex.test(email)) {
  var slika=document.getElementById('error2');
slika.style.visibility="visible"; 
var paragraf=document.getElementById('greska');
 paragraf.innerHTML = "Molim Vas ,unesite validan email!";
 paragraf.style.visibility="visible"; 

 }
else 
  {
 var slika=document.getElementById('error2');

slika.style.visibility="hidden";
 document.getElementById("greska").style.visibility = "hidden";


  }




}

function provjeritelefon() {

var telefon = document.getElementById("telefon").value;

var telRegex=/^[0-9]{2}[1-9][-]?[0-9]{3}[-]?[0-9]{3}$/ ;
if (telRegex.test(telefon))
  {
      
 var slika=document.getElementById('error3');
slika.style.visibility="hidden";
 document.getElementById("greska").style.visibility = "hidden";



  }
else {
 var slika=document.getElementById('error3');
slika.style.visibility="visible";
var paragraf=document.getElementById("greska");
 paragraf.innerHTML = "Molim Vas ,unesite validan broj telefona!"
 paragraf.style.visibility="visible"; 
 
 }

}


function provjerigrad() {





 var a= document.getElementById("gradovi");

if (document.getElementById("drzave").value=="Hrvatska")
{   

  
   
    a.remove(2);
   a.remove(1);
    a.remove(0) ;

   var opcija= document.createElement("option");
    opcija.text= "Zagreb";
    a.add(opcija);
    var opcija2=document.createElement("option");
    opcija2.text="Split";
    a.add(opcija2);
     var opcija3=document.createElement("option");
    opcija3.text="Dubrovnik";
    a.add(opcija3);




}

else if (document.getElementById("drzave").value=="Srbija")
{   

  
   
    a.remove(2);
   a.remove(1);
    a.remove(0) ;

   var opcija= document.createElement("option");
    opcija.text= "Beograd";
    a.add(opcija);
    var opcija2=document.createElement("option");
    opcija2.text="Novi Sad";
    a.add(opcija2);
     var opcija3=document.createElement("option");
    opcija3.text="Niš";
    a.add(opcija3);




}

else if(document.getElementById("drzave").value=="BiH") {a.remove(2);
   a.remove(1);
    a.remove(0) ;

 var opcija= document.createElement("option");
    opcija.text= "Sarajevo";
    a.add(opcija);
    var opcija2=document.createElement("option");
    opcija2.text="Mostar";
    a.add(opcija2);
     var opcija3=document.createElement("option");
    opcija3.text="Zenica";
    a.add(opcija3);
   
}



}   

function jeliprazno(poruka)
{


  /*var regex=/^\s*$/ 

 // alert(poruka) ;
 if (regex.test(poruka.value))
  return true;
return false; */

 var brojac=0;
 for (var i=0; i<poruka.value.length; i++)
    {
      if(brojac==(poruka.value.length-1)) return true;
     if(poruka.value.charAt(i)==' ' )
      {  
        
        brojac++;

       
      }
   else if (poruka.value.charAt(i)!=' ')
    return false; 
     

    }

}


function provjeriporuku() {


 var poruka=document.getElementById("poruka") ;
 


  
  if(jeliprazno(poruka) || poruka.value.length>250)
  {
    var slika=document.getElementById('error4');
slika.style.visibility="visible"; 
var paragraf=document.getElementById("greska");
 paragraf.innerHTML =  "Molim Vas ,unesite poruku!(manju od 255 karaktera!)";
 paragraf.style.visibility="visible"; 

 


  }
  

 else  if (!jeliprazno(poruka)){
 var slika=document.getElementById('error4');
slika.style.visibility="hidden"; 
document.getElementById("greska").style.visibility = "hidden";


 }
     
}



function provjeri() {
if (document.getElementById("error1").style.visibility=="visible" || document.getElementById("error2").style.visibility=="visible"

    || document.getElementById("error3").style.visibility=="visible" || document.getElementById("error4").style.visibility=="visible") {
 alert("Morate unijeti validne podatke") ;
return false;
 }


}