<?php
/**
 * Cette classe permet de faire tous les traitement
 * sur une chaine.
 * @author Kévin ARBOUIN <kevin.arbouin@gmail.com>
 * @static
 */
namespace kaLibrary;

class KaString
{
    /**
     * Checks the validity of an email based on the standards RFC822, RFC2822, RFC1035
     * Vérifie la validité d'un mail en ce basant sur les normes RFC822, RFC2822, RFC1035
     * @link	http://atranchant.developpez.com/code/validation/
     * 
     * @author Kévin ARBOUIN <kevin.arbouin@gmail.com>
     * @param	string	$value
     * @return	boolean
     * @static
     */
    public static function validateEmail($value)
    {
        $atom = '[-a-z0-9!#$%&\'*+\\/=?^_`{|}~]';
        $domain = '([a-z0-9]([-a-z0-9]*[a-z0-9]+)?)';

        $regex = '/^' . $atom . '+' . '(\.' . $atom . '+)*' . '@' . '('
                . $domain . '{1,63}\.)+' . $domain . '{2,63}$/i';

        if (preg_match($regex, $value)) {
            return true;
        }
        return false;
    }

    /**
     * Returns the string $str every accent delete
     * Retourne la chaine $str une fois tous les accent supprimer
     * 
     * @author Kévin ARBOUIN <kevin.arbouin@gmail.com>
     * @param    string	$str		String to format
     * @param    string	$charset	Optional, indicate the charset you want. default is the charset UTF-8
     * @return   string
     * @static
     */
    public static function removeAccents($str, $charset = 'utf-8')
    {
        $str = htmlentities($str, ENT_NOQUOTES, $charset);

        $str = preg_replace(
                '#&([A-za-z])(?:acute|cedil|circ|grave|orn|ring|slash|th|tilde|uml);#',
                '\1', $str);
        // pour les ligatures e.g. '&oelig;'
        $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str);
        // supprime les autres caractères
        $str = preg_replace('#&[^;]+;#', '', trim($str));

        return $str;
    }

    /**
     * Returns the file extension based on extensions permitted otherwise returns null
     * 
     * @author Kévin ARBOUIN <kevin.arbouin@gmail.com>
     * @param	string	$fileName
     * @param	mixed	$ext
     * @return	string|null
     * @static
     */
    public static function getExtension($fileName, $ext = '/\.[a-zA-Z-]{2,4}$/i')
    {
        if (is_array($ext)) {
            foreach ($ext as $value) {
                if (preg_match("/{$value}$/", $fileName)) {
                    return $value;
                }
            }
        } else {
            preg_match($ext, $fileName, $tab, PREG_OFFSET_CAPTURE);
            return $tab[0][0];
        }
        return null;
    }

    /**
     * Generates a unique file name by keeping the original name and adding a unique key
     * Génère un nom de fichier unique en gardant le nom d'origine et en ajoutant une clé unique
     * 
     * @param	string	$filename
     * @return	string
     * @author Kévin ARBOUIN <kevin.arbouin@gmail.com>
     * @static
     */
    public static function formatFilename($filename)
    {
        $fileExtension = static::getExtension($filename);

        $baseName = substr($filename, 0,
                strlen($filename) - strlen($fileExtension));
        $str = strtolower(static::removeAccents($baseName));
        $str = preg_replace('/ {1,}/', ' ', $str);
        $stripBaseName = preg_replace('/[^a-zA-Z0-9-]{1,}/', '-', trim($str));
        $stripBaseName = preg_replace('/[-]{1,}$/', '', trim($stripBaseName));

        $finalFilename = uniqid() . '-' . $stripBaseName . $fileExtension;

        return $finalFilename;
    }
    
    /**
     * Converts a string in a word by putting a capital letter for each word.
     * Transforme une chaine de caractère en un mot en mettant une majuscule à chaque mot.
     * 
     * @author Kévin ARBOUIN <kevin.arbouin@gmail.com>
     * @param string $string
     * @return string
     */
    public static function upperCamelCase($string)
    {
        $str = preg_replace('/[_-]+/', ' ', $string);
        $str = ucwords($str);
        return str_replace(' ', '', $str);
    }
    
    /**
     * Converts a string in a word by putting a capital letter for each word except the first.
     * Transforme une chaine de caractère en un mot en mettant une majuscule à chaque mot sauf pour le premier.
     * 
     * @author Kévin ARBOUIN <kevin.arbouin@gmail.com>
     * @param string $string
     * @return string
     */
    public static function lowerCamelCase($string)
    {
        $str = preg_replace('/[_-]+/', ' ', $string);
        $str = lcfirst(ucwords($str));
        return str_replace(' ', '', $str);
    }
    
    
}
