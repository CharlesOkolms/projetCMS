<?php
// fonctions génériques en php utilisables n'importe où dans le projet

/**
* Permet de tester une date contre un format indiqué.
* @param string $date La date à tester
* @param string $format Format présumé de la date à tester
* @return bool Renvoie TRUE si $date est bien bien une date dans le format indiqué, FALSE sinon.
*/
function validateDate($date, $format = 'Y-m-d'){
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}


/**
 * Génère une string random de la longueur demandée.
 * @param int $l : longueur de la chaine générée.
 * @return string
 */
function randomString(int $l){
  $c= "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
  srand((double)microtime()*1000000);
  for($i=0; $i<$l; $i++) {
      $rand.= $c[rand()%strlen($c)];
  }
  return $rand;
 }
