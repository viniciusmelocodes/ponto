<?php
/**
 * Controle de Ponto Eletronico
 *
 * PHP version >= 5.2
 *
 * @category  Ponto
 * @package   Importacao
 * @author    Wolmer Willian Andrill Pinto <wolmerwap@gmail.com>
 * @copyright 2003-2012 Comércio e Serviços Ltda.
 * @link      http://www.wolmerwap.com.br
 */

Class DATAHORA {

    /**
	 * Método Construtor
	 */
	function __construct() {
	}
    
    
    public function somar_hora ($hora1, $hora2) {
        $hora1 = $this->tranfora_segundos($hora1);
        $hora2 = $this->tranfora_segundos($hora2);
        $hora  = $hora1 + $hora2;
        if ($hora < 0) {
            $hora = '-' . $this->tranfora_horas($hora * (-1));
        } else {
            $hora = $this->tranfora_horas($hora);
        }
        return $hora;
    }
    
    
    public function subtrair_hora ($hora1, $hora2) {
        $hora1 = $this->tranfora_segundos($hora1);
        $hora2 = $this->tranfora_segundos($hora2);
        $hora  = $hora1 - $hora2;
        if ($hora < 0) {
            $hora = '-' . $this->tranfora_horas($hora * (-1));
        } else {
            $hora = $this->tranfora_horas($hora);
        }
        return $hora;
    }
    
    
    private function tranfora_segundos ($hora) {
        $hora = split(':', $hora);
        
        if ($hora[0] < 0) {
            $hora[0] *= -1;
            $segundos = (((($hora[0] * 60) + $hora[1]) * 60) + $hora[2]) * (-1);
        } else {
            $segundos = ((($hora[0] * 60) + $hora[1]) * 60) + $hora[2];
        }
        return $segundos;
    }
    
    
    private function tranfora_horas ($segundo) {
        $min  = (int) ($segundo / 60);
        $seg  = $segundo - ($min * 60);
        $hora = (int) ($min / 60);
        $min  = $min - ($hora * 60);
        
        $hora = ($hora < 10 ? '0' . $hora : $hora);
        $min  = ($min < 10  ? '0' . $min  : $min);
        $seg  = ($seg < 10  ? '0' . $seg  : $seg);
        return "{$hora}:{$min}:{$seg}";
    }
}
?>
