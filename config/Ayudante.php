<?php
/**
 * Felipe Herrera 4 Jul 2022
 * Funciones de Ayuda
 */
function limpiarString($texto)
{
  $textoLimpio = str_replace ("\"" , "" , $texto);
  $textoLimpio = str_replace ("\'" , "" , $textoLimpio);
  $textoLimpio = str_replace ("'" , "" , $textoLimpio);
  $textoLimpio = str_replace ("&" , "" , $textoLimpio);

  return $textoLimpio;
}
