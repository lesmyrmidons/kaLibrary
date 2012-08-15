<?php 
require_once 'KaString.class.php';
use kaLibrary\KaString;

/**
 * Example format filename
 */
$filename = " quoize ehgdfk è\"éyé\"' \"èé_ _é\"è'h100%.txt";
$filename = KaString::formatFilename($filename);

echo $filename . "\n";
echo "--------------------------------------\n";
/**
 * Example validate Email
 */
$email = 'test@test.fr';
$email1 = 't@test.f';
$email2 = 'tes_er t@test.fr';
$email3 = 'test_st@test.fr';

var_dump(KaString::validateEmail($email));
var_dump(KaString::validateEmail($email1));
var_dump(KaString::validateEmail($email2));
var_dump(KaString::validateEmail($email3));
echo "--------------------------------------\n";

/**
 * Example UpperCamelCase
 */
$str = array('upper camel case', 'upper-camel-case', 'upper_camel_case');
foreach ($str as $value) {
    echo $value . ' => ' . KaString::upperCamelCase($value) . "\n";
}
echo "--------------------------------------\n";

/**
 * Example lowerCamelCase
 */
$str = array('lower camel case', 'lower-camel-case', 'lower_camel_case', 'LowerCamelCase');
foreach ($str as $value) {
    echo $value . ' => ' . KaString::lowerCamelCase($value) . "\n";
}
echo "--------------------------------------\n";