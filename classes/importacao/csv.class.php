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

Class CSV {
    
    /**
     * Arquivo para ser lido
     * @var string
     */
    public $arquivo = '';
    
    /**
     * Retorno da leitura do arquivo
     * @var array
     */
    public $resultado = array();
    
    /**
     * Se vai utilizar a primeira linha como indice para leitura
     * @var boolean
     */
    public $usa_indice = false;
    
    /**
     * Delimitador utilizado no csv
     * @var string
     */
    public $delimitador = ';';

    /**
	 * Método Construtor
	 */
	function __construct() {
	}

    /**
     * Leitura do csv 
     */
    public function lerCsv () {
        $linha  = 0;
        $indice = array();
        $handle = fopen ($this->arquivo,"r");
        while (($data = fgetcsv($handle, 1000, $this->delimitador)) !== false) {
            for ($i = 0; $i < count ($data); $i++) {
                if ($linha == 0 && $this->usa_indice) {
                    $indice[] = $data[$i];
                } elseif ($this->usa_indice) {
                    $this->resultado[$linha][$indice[$i]] = $data[$i];
                } else {
                    $this->resultado[$linha][$i] = $data[$i];
                }
            }   
            $linha++;
        }
        fclose ($handle);
    }
}
?>
