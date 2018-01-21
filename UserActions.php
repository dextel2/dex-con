<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
/**
 * This class contains set of methods which are related to users
 * This contains methods such as
 * 1 Database connection
 * 2 User Registrations
 * 3 User Login
 * 4 Validate Email
 * 5 check if user is already registered or not
 * 
 * This class also has methods which are not being used,
 * I am keeping those methods because they might be useful in future
 */
class UserActions

{
	var $connection = false;
	/**
	 * Simple method to connect with the databse
	 * This method is simple to connect yet hard to implement
	 */
	function databaseConnection($databaseHost, $databaseUsername, $databasePassword, $databaseName)
	{
		try {
			$this->connection = new PDO("mysql:host=$databaseHost;dbname=$databaseName;", $databaseUsername, $databasePassword);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			if ($this->connection) {
				return $this->connection;
			}
			else {
				return false;
				exit();
			}
		}

		catch(Exception $e) {
		}
	}

	/**
	 * A function which registers users after validating all the details
	 * Right now the function is in pilot stage to test the validations
	 * TODO : Validate EMAIL first
	 */
	function userRegistration($email, $password, $confirmPassword)
	{
		if ($email == null && empty($email)) {
            return false;
            exit();
		}

		if ($password == null) {
            return false;
            exit();
		}

		if ($confirmPassword == null) {
            return false;
            exit();
		}

		if ($email != null && $password != null && $confirmPassword != null) {

			// Checking if email is valid or not

			if ($password == $confirmPassword) {
				/**
				 * dependency isUserRegistered()
				 * Hash password here an run insert query
				 * insert is working properly
                 * TODO: Run insert query here
				 */

				$registerData = $this->connection->prepare("INSERT INTO `win` VALUES ('$email','$password')");
				$registerData->execute();
				return true;
			}
			else {
                return false;
                //Password and confirm password must match
				exit();
			}
		}
	}

	/**
	 * A direct copy paste code from Stackoverflow
	 * @author unbreak
	 */
	function isValidEmail($email)
	{

		// First, we check that there's one @ symbol, and that the lengths are right

		if (!preg_match("/^[^@]{1,64}@[^@]{1,255}$/", $email)) {

			// Email invalid because wrong number of characters in one section, or wrong number of @ symbols.

			return false;
		}

		// Split it into sections to make life easier

		$email_array = explode("@", $email);
		$local_array = explode(".", $email_array[0]);
		for ($i = 0; $i < sizeof($local_array); $i++) {
			if (!preg_match("/^(([A-Za-z0-9!#$%&'*+\/=?^_`{|}~-][A-Za-z0-9!#$%&'*+\/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/", $local_array[$i])) {
				return false;
			}
		}

		if (!preg_match("/^\[?[0-9\.]+\]?$/", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
			$domain_array = explode(".", $email_array[1]);
			if (sizeof($domain_array) < 2) {
				return false; // Not enough parts to domain
			}

			for ($i = 0; $i < sizeof($domain_array); $i++) {
				if (!preg_match("/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$/", $domain_array[$i])) {
					return false;
				}
			}
		}

		return true;
    }
    /**
     * Function for basic field validation (present and neither empty nor only white space
     * @author Michael Haren
     * @Source Stackoverflow
     * Not sure what this function does..still keeping this for future use maybe
     */
    function IsNullOrEmptyString($question){
        return (!isset($question) || trim($question)==='');
    }

	/**
	 * This functions checks in the database if the user is already registered with
	 * same email id
     * This function is working perfectly fine, It requires databaseConnection() to be initialized
     * DO NOT ATTEMPT TO UPDATE THIS FUNCTION
	 */
	function isUserRegistered($email)
	{
		try {
            if($email==null) {
                return false;
                exit();
            }
			$mailCheck = $this->connection->prepare("SELECT `EMAIL` from win WHERE `email` = ?");
			$mailCheck->bindValue(1, $email);
			$mailCheck->execute();
			if ($mailCheck->rowCount() > 0) {
				return true;
			}
			else {
                return false;
                exit();
			}
		}

		catch(Exception $e) {
		}
	}

	/**
	 * Function to check if the user is active or not
	 * If user is active then only user will be allowed to login.
	 */
	function isUserActive($email)
	{
		try {
			$userCheck = $this->connection->prepare("SELECT `EMAIL`,`isActive` from student_data WHERE `EMAIL` = ? AND `isActive` = 1");
			$userCheck->bindValue(1, $email);
			$userCheck->execute();
			if ($userCheck->rowCount() > 0) {
				return true;
			}
			else {
				return false;
			}
		}
		catch(Exception $e) {
		}
	}

	/**
	 * This function checks if the email and password are correct or not
	 * If the credentials are correct it will login the user
	 */
	function userLogin($email, $password)
	{
		try {
			$result = $this->connection->prepare("SELECT * FROM admins WHERE email=? AND password=?");
			$result->bindParam(1, $email);
			$result->bindParam(2, $password);
			$result->execute();
			$rows = $result->fetch(PDO::FETCH_NUM);
			if ($rows > 0) {
				return true;
			}
			else {
				return false;
			}
		}

		catch(Exception $e) {
			return false;
		}
	}

	/**
	 * TODO: Send Authenticate email to the user
	 * Currently sending only email
	 */
	function sendAuthEmail($email,$mailBody) {
		try {
			$mail = new PHPMailer(true);
			$mail->SMTPDebug = 0; //SMTP Debug
			$mail->isSMTP();
			$mail->Host = "smtp.gmail.com";
			$mail->SMTPAuth = true;
			$mail->Username = 'karanke.development@gmail.com';
			$mail->Password = 'yourpasswordhere';
			$mail->SMTPSecure = 'tls';
			$mail->Port = '587';
			/**
			 * SMTPOptions work-around by @author : Synchro
			 * This setting should removed on server and 
			 * mailing should be working on the server
			 */
			$mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);
			//Recipients
			$mail->setFrom('no-reply@confirmation.com', 'Do Not Reply');
			$mail->addAddress($email,'Yash Karanke');     // Add a recipient
			$mail->addReplyTo('no-reply@confirmation.com');

			 //Content
			 $mail->isHTML(true);                                  // Set email format to HTML
			 $mail->Subject = 'Authentication Email';
			 $mail->Body    = $mailBody;
		 
			 if($mail->send()){
				return true;
			 }
			 else {
				 return false;
				 exit();
			 }
		}
		catch (Exception $e) {
			return $mail->ErrorInfo;
		}

	}

	/**
	 * Debug Function
	 * This function will connect to database and check if the query is working or not
	 */
	function debugging()
	{
		$result = $this->connection->prepare("SELECT * FROM admins");
		$result->execute();
		return $result->fetchAll();
	}
}
