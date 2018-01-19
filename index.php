<?php
  include 'UserActions.php';

  $User = new UserActions;
 // print_r ($User->databaseConnection('localhost','root','','admission2018'));
 
   if($User->isValidEmail('yash@gmail.com')){
     /**
      * Passed only true values
      * Passing Spaces < > will break the function
      * solution is to understan empty() function first
      */
 
     echo $User->userRegistration('text@exampl.ecom','123','123');
   }
  //echo $User->userRegistration('y','2','2');
 
 // print_r ($User->debugging());

