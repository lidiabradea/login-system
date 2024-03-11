       
<?php

function generateRandomPassword($length = 10) {
    $uppercaseChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $lowercaseChars = 'abcdefghijklmnopqrstuvwxyz';
    $numberChars = '0123456789';
    $specialChars = '!@#$%^&*()-_=+[]{}|;:,.<>?';
    
    $allChars = $uppercaseChars . $lowercaseChars . $numberChars . $specialChars;
    
    $password = '';
    
                // Ensure at least one character from each character set
    $password .= $uppercaseChars[rand(0, strlen($uppercaseChars) - 1)];
    $password .= $lowercaseChars[rand(0, strlen($lowercaseChars) - 1)];
    $password .= $numberChars[rand(0, strlen($numberChars) - 1)];
    $password .= $specialChars[rand(0, strlen($specialChars) - 1)];
    
                // Fill the remaining characters from the pool
    for ($i = strlen($password); $i < $length; $i++) {
        $password .= $allChars[rand(0, strlen($allChars) - 1)];
    }
    
                // Shuffle the characters to randomize the password
    $password = str_shuffle($password);
    
    return $password;
}

?>