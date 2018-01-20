<?php
  include 'UserActions.php';
  /**
   * Order of using functions
   * First obtain a databaseConnection()
   * then check if isValidEmail()
   * then check if isUserRegistered()
   * then do userRegistration()
   * then check if isUserActive()
   * then do userLogin()
   * 
   */
  $User = new UserActions;
  $User->databaseConnection('localhost','root','','admission2018');
  $email='dex.papa@gmail.com';

  echo $User->isValidEmail($email). '<br>'; 
  echo $User->isUserRegistered($email). '<br>';

  if ($User->isUserRegistered($email)) {
      echo 'User is already registered';
  }
  else {
    echo 'User is not registered';
  }
  
  /**
   * Debugging Area
  **/

  echo '<br>'.$User->isUserRegistered('shane@gmail.com');
  
  /**
   * Proper usage of a function which returns a whole dataset from table
   */
  print_r ($User->debugging()[0]['name']);