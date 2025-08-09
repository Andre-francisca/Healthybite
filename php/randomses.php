<?php 
  $numchars =4; //You can specify the length here
  //This is the list from which id is generated.
  $chars =   explode(',','0,1,2,3,4,5,6,7,8,9'); 
  $randses='ses'; 
  //Do a random generation in a for loop
  for($i=0; $i<$numchars;$i++)  { 
    $randses.=$chars[rand(0,count($chars)-1)]; 
  } 
  //Here you go.. Nice & pretty
   

?>