# PDO Practice

This repo cotains a collection of methods which are PDO wrappers. Following is the list

 - [`databaseConnection($databaseHost, $databaseUsername, $databasePassword, $databaseName)`](https://github.com/dextel2/dex-con/blob/master/UserActions.php#L28)
 - [`userRegistration($email, $password, $confirmPassword)`](https://github.com/dextel2/dex-con/blob/master/UserActions.php#L143)
 - [`isValidEmail($email)`](https://github.com/dextel2/dex-con/blob/master/UserActions.php#L92)
 - [`IsNullOrEmptyString($question)`](https://github.com/dextel2/dex-con/blob/master/UserActions.php#L133) - Not sure what this does
 - [`isUserRegistered($email)`](https://github.com/dextel2/dex-con/blob/master/UserActions.php#L143)
 - [`isUserActive($email)`](https://github.com/dextel2/dex-con/blob/master/UserActions.php#L172)
 - [`userLogin($email, $password)`](https://github.com/dextel2/dex-con/blob/master/UserActions.php#L197)
 - [`sendAuthEmail($email,$mailBody)`](https://github.com/dextel2/dex-con/blob/master/UserActions.php#L222) -- Very sensitive method
 - [`debugging()`](https://github.com/dextel2/dex-con/blob/master/UserActions.php#L269)

 ## Instructions

 - All the description of the method(s) are commented in the code itself
 - If you want to contribute, you're welcomed, but do not touch the
   `sendAuthEmail` method, I personally look to that method.
 - You will require [smtp4dev](http://smtp4dev.codeplex.com/) for
   testing `sendAuthEmail` method, without `Synchro's` Workaround, if
   that also fails you'll have to keep that workaround.
