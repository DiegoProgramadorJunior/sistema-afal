<?php

class ValidarRutphp{

   public function verifica_RUT($rut='') {
      $tmpRUT = '';
      $sep = array();
      $multi = 2;
      $suma = 0;
      if (empty($rut)) return 1;
      for ($i = 0; $i < strlen($rut); $i++) {
        if ($rut[$i] != ' ' AND $rut[$i] != ' ' AND $rut[$i] != '.' AND $rut[$i] != '-') $tmpRUT .= $rut[$i];
      }
      if ( strlen($tmpRUT) == 8 ) $tmpRUT = '0'.$tmpRUT;
      if (strlen($tmpRUT) != 9) return 2;
      $sep['rut'] = substr($tmpRUT,0,8);
      $sep['dv']  = substr($tmpRUT, -1);
      if ($sep['dv'] == 'k') $sep['dv'] = 'K';
      if (!is_numeric($sep['rut'])) return 3;
      if (empty($sep['rut']) OR $sep['dv'] == '') return 4;
      for ($i=strlen($sep['rut']) - 1; $i >= 0; $i--) {
        $suma = $suma + $sep['rut'][$i] * $multi;
        if ($multi == 7) $multi = 2;
        else $multi++;
      }
      $resto = $suma % 11;
      if ($resto == 1) {
        $sep['dvt'] = 'K';
      }
      else {
        if ($resto == 0) {
          $sep['dvt'] = '0';
        }
        else {
          $sep['dvt'] = 11 - $resto;
        }
      }
      if ($sep['dvt'] != $sep['dv']) return 5;
      return 0;
    }
   
  
   
}