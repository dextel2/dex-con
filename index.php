<?php
  include 'UserActions.php';
  /**
   * Order of using functions
   * First obtain a databaseConnection()
   * then check if isValidEmail()
   * then check if isUserRegistered()
   * then do userRegistration()
   * then do sendAuthEmail()
   * then check if isUserActive()
   * then do userLogin()
   * 
   */
/**
 * --------------------------------
 * Block - 1 Testing individually
 * all the functions , mostly 
 * non-database functions
 * --------------------------------
 */

  $User = new UserActions;
  $User->databaseConnection('localhost','root','','admission2018');
  $email='dex.papa@gmail.com';


/*  if ($User->isValidEmail($email)) {
    if ($User->isUserRegistered($email)) {
      echo 'User is already registerd, try login';
      exit();
    }
    else {
      echo 'register will go here';
      exit();
    }
  }
  else {
    echo 'Email is Not Valid';
    exit();
  }
*/
  /**
   * Debugging Area
  **/

  //echo '<br>'. $User->isUserRegistered('shane@gmail.com');
  
  /**
   * Proper usage of a function which returns a whole dataset from table
   */
  //print_r ($User->debugging()[0]['name']);

  //echo '<br>'. $User->sendAuthEmail($email,$mailBody);  
  /** 
  *echo $User->isValidEmail($email). '<br>'; 
  *echo $User->isUserRegistered($email). '<br>';
  *if ($User->isUserRegistered($email)) {
  *    echo 'User is already registered';
  *}
  *else {
  *  ecx`ho 'User is not registered';
  *}
*/

$Message = "";
if (isset($_POST['submit'])) {
  $mailBody = $_POST['editor1'];
  $RecvEmail = $_POST['email'];
  if ($User->isValidEmail($RecvEmail)) {
    if($User->sendAuthEmail($RecvEmail,$mailBody)) {
      $Message = "Message Sent Successfully";
    }
    else {
      $Message = "Error Please Contact Devloper";
    }
  }
  else {
    $Message = "Invalid Email Address";
  }
}


/**
 * -------------------------------------
 * Block - 2 : Testing CRUD/OOP Function(s)
 * This is working perfectly as expected
 * ---------------------------------------
 */

 /* 
 $crud = new UserActions();
 $crud->databaseConnection('localhost','root','','windowsDB');

 if($crud->isUserRegistered('yashkaranke@gmail.com')) {
   echo 'User is registered';
   exit();
 }
 else {
  if($crud->userRegistration('yashkaranke@gmail.com','123','123')) {
    echo 'success';
  }
  else {
    echo 'failure';
  }
 }
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Send Email</title>
  <script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
</head>
<body>

<?php echo $Message ?>
<form action="index.php" method="post">
<input type="email" name="email" placeholder="Enter recievers email ID" required> 

<textarea name="editor1"></textarea>
		<script>
			CKEDITOR.replace( 'editor1' );
		</script>

  <input type="submit" value="Send Email" name="submit">

</form>
</body>
</html>