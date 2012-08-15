kaLibrary PHP SDK
=================
This is a library providing classes for dealing with strings.

C'est une librairie offrent des classes permettant de traiter des chaines de caractères.

Usage
-----
#### Upload file
Allow you to format the file name by removing all special characters, replacing
spaces with dashes and adding a unique id to certify the uniqueness of each file.
exemple :

	<?php
	
	use kaLibrary;
	
	$filename = " quoize ehgdfk è\"éyé\"' \"èé_ _é\"è'h100%.txt";
	$filename = KaString::formatFilename($filename);
	echo $filename; // 502bb72cddb42-test-etait-un-fichier.txt

#### Validate Email
This method is used to validate email in the standard RFC822, RFC2822, RFC1035.
Exemple :

	<?php
	
	use kaLibrary;
	
	$email = 'tes_er t@test.fr';
	var_dump(KaString::validateEmail($filename)); // false