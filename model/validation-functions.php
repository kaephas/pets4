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

function validQty($qty) {
    return is_numeric($qty) && $qty > 0;
}

function validAcc($acc) {
    global $f3;
    // if it's empty, don't check for in array
    return empty($acc) || in_array($acc, $f3->get('accessories'));
}

function testLoad() {
    // to see if any functions are loading
    return true;
}

function validForm1() {
    $isValid = true;
    global $f3;
    if(!validQty($f3->get('qty'))) {
        $isValid = false;
        $f3->set('errors["qty"]', 'Enter a valid quantity.');
    }

    if(!validString($f3->get('pet'))) {
        $isValid = false;
        $f3->set('errors["qty"]', 'Please enter a pet.');
    }

    return $isValid;
}

function validForm2() {
    global $f3;
    $isValid = true;

    if(!validColor($f3->get('color'))) {
        $isValid = false;
        $f3->set('errors["color"]', 'Please choose a color.');
    }

    if(!validAcc($f3->get('access'))) {
        $isValid = false;
        $f3->set('errors["access"]', "That's not an accessory.");
    }

    return $isValid;

}