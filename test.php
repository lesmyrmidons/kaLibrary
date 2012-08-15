<?php 
require_once 'KaString.class.php';
use kaLibrary\KaString;

$filename = " quoize ehgdfk è\"éyé\"' \"èé_ _é\"è'h100%.txt";
$filename = KaString::formatFilename($filename);

echo $filename . "\n";

$email = 'test@test.fr';

var_dump(KaString::validateEmail($email));