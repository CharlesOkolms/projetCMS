<?php
// fonctions génériques en php utilisables n'importe où dans le projet



/**
* Permet de tester une date contre un format indiqué.
* @param $date string Chaine de caractere de la date à tester
* @param $format string Format présumé de la date à tester
* @return bool Renvoie TRUE si $date est bien bien une date dans le format indiqué, FALSE sinon.
*/
function validateDate($date, $format = 'Y-m-d'){
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}
