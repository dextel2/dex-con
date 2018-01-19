<?php
    /**
     * This class contains set of methods which are related to users
     * This contains methods such as 
     * 1 Database connection
     * 2 User Registrations
     * 3 User Login
     * 4 Validate Email
     */

     class UserActions{
        var $connection = false;

        /**
         * Simple method to connect with the databse
         * This method is simple to connect yet hard to implement
         */
        function databaseConnection($databaseHost,$databaseUsername,$databasePassword,$databaseName){
            try{
                $this->connection = new PDO("mysql:host=$databaseHost;dbname=$databaseName;", $databaseUsername, $databasePassword);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                if($this->connection){
                    return $this->connection;
                }
                else{
                    return false;
                    exit();
                }
            }
            catch(Exception $e){

            }
        }

        /**
         * A function which registers users after validating all the details
         * Right now the function is in pilot stage to test the validations
         * TODO : Validate EMAIL first
         */
         function userRegistration($email,$password,$confirmPassword){
                if($email==null){
                    return 'Email Address Cannot be Empty';
                }
                if($password==null){
                    return 'Password Cannot Be Empty';
                }
                if($confirmPassword==null){
                    return 'You cannot leave confirm password Empty';
                }
                if($email!=null && $password!=null && $confirmPassword!=null){
                    //Checking if email is valid or not
                    if($password==$confirmPassword){
                        /**
                        * Check if email is already in the database
                        * Hash password here an run insert query
                        */
                        return true;
                        }
                    else{
                        return 'Password and confirm password must match';
                        exit();
                        } 
                }
         }

        /**
        * A direct copy paste code from Stackoverflow 
        * @author unbreak
        */
        function isValidEmail($email){
            // First, we check that there's one @ symbol, and that the lengths are right
            if (!preg_match("/^[^@]{1,64}@[^@]{1,255}$/", $email)) {
                // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
                return 'false';
            }
            // Split it into sections to make life easier
            $email_array = explode("@", $email);
            $local_array = explode(".", $email_array[0]);
            for ($i = 0; $i < sizeof($local_array); $i++) {
                if (!preg_match("/^(([A-Za-z0-9!#$%&'*+\/=?^_`{|}~-][A-Za-z0-9!#$%&'*+\/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/", $local_array[$i])) {
                    return 'false';
                }
            }
            if (!preg_match("/^\[?[0-9\.]+\]?$/", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
                $domain_array = explode(".", $email_array[1]);
                if (sizeof($domain_array) < 2) {
                    return 'false'; // Not enough parts to domain
                }
                for ($i = 0; $i < sizeof($domain_array); $i++) {
                    if (!preg_match("/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$/", $domain_array[$i])) {
                        return 'false';
                    }
                }
            }
            return true;
        }

        /**
         * This functions checks in the database if the user is already registered with
         * same email id
         */
        function isUserRegistered($email){
            try{
                $mailCheck = $this->connection->prepare("SELECT email from users");
                $mailCheck->execute();
                $rows = $mailCheck->fetch(PDO::FETCH_NUM);
                if($rows > 0 ){
                    return 'User is already registered';
                }
                else{
                    //In this case user can register
                    return true;
                }
            }
            catch(Exception $e){

            }
        }
        /**
         * This function checks if the email and password are correct or not
         * If the credentials are correct it will login the user
         */
        function userLogin($email,$password){
            try{ 
                $result = $this->connection->prepare("SELECT * FROM admins WHERE email=? AND password=?");
                $result->bindParam(1,$email);
                $result->bindParam(2,$password);
                $result->execute();
                $rows = $result->fetch(PDO::FETCH_NUM);
                if($rows > 0){
                    return 'Login Success';
                }
                else{
                    return 'Failure';
                }
            }
            catch(Exception $e){
                return false;
            }
        }

        /**
         * Debug Function
         * This function will return all records in the table
         */
        function debugging(){
            $result = $this->connection->prepare("SELECT * FROM admins");
            $result->execute();
            return $result->fetchAll();
        }
    }