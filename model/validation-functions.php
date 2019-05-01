<?php

/* Validate a color
 *
 * @param String color
 * @return boolean
 */
function validColor($color) {
    global $f3;
    return in_array($color, $f3->get('colors'));
}

/* Validate a string input
 *
 * @param String String to validate
 * @return if string is empty
 */
function validString($string) {
    return $string != "" && ctype_alpha($string);
}

/* Validate a quantity

 *@param a Number
 * @return if quantity is valid and not empty
 */
function validQuanity($qty) {
    return !empty($qty) && $qty >= 1 && is_numeric($qty);
}

//validate checkboxes