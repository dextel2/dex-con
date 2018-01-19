<?php
  include 'UserActions.php';

  $User = new UserActions;
  $User->databaseConnection('localhost','root','','admission2018');
  $email = '1234@gmail.com';

  echo $User->isValidEmail($email). '<br>'; 
  echo $User->isUserRegistered($email). '<br>';

  if ($User->isUserRegistered($email)) {
      echo 'User is already registered';
  }
  else {
    echo 'User is not registered';
  }