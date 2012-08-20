kaLibrary PHP SDK
=================
This is a library providing classes for dealing with strings.

Usage
-----
#### Upload file
Allow you to format the file name by removing all special characters, replacing
spaces with dashes and adding a unique id to certify the uniqueness of each file.

Example :

	<?php
	
	use kaLibrary;
	
	$filename = " quoize ehgdfk è\"éyé\"' \"èé_ _é\"è'h100%.txt";
	$filename = KaString::formatFilename($filename);
	echo $filename; // 502be7c9f33c6-quoize-ehgdfk-e-eye-ee-e-e-h100.txt

#### Validate Email
This method is used to validate email in the standard RFC822, RFC2822, RFC1035.

Example :

	<?php
	
	use kaLibrary;
	
	$email = 'tes_er t@test.fr';
	var_dump(KaString::validateEmail($filename)); // false