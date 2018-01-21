# PDO Practice

This repo cotains a collection of methods which are PDO wrappers. Following is the list

 1. `databaseConnection($databaseHost, $databaseUsername, $databasePassword, $databaseName)`
 2. `userRegistration($email, $password, $confirmPassword)`
 3. `isValidEmail($email)`
 4. `IsNullOrEmptyString($question)` - Not sure what this does
 5. `isUserRegistered($email)`
 6. `isUserActive($email)`
 7. `userLogin($email, $password)`
 8. `sendAuthEmail($email,$mailBody)` -- Very sensitive method
 9. `debugging()`

 ## Instructions

 All the description of the method(s) are commented in the code itself
 If you want to contribute, you're welcomed, but do not touch the `sendAuthEmail` method, I personally look to that method.