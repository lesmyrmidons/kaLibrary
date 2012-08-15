<?php 
require_once 'KaString.class.php';
use kaLibrary\KaString;

$filename = " quoize ehgdfk è\"éyé\"' \"èé_ _é\"è'h100%.txt";
$filename = KaString::formatFilename($filename);

echo $filename . "\n";

$email = 'test@test.fr';
$email1 = 't@test.f';
$email2 = 'tes_er t@test.fr';
$email3 = 'test_st@test.fr';

var_dump(KaString::validateEmail($email));
var_dump(KaString::validateEmail($email1));
var_dump(KaString::validateEmail($email2));
var_dump(KaString::validateEmail($email3));