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

include '../default/default.php';
include __path_classes__ . '/importacao/csv.class.php';

/**
 * Lendo os dados do arquivo
 */
$csv = new CSV();
$csv->arquivo = __path_base__ . '/importacao/arquivos/2011-11.csv';
$csv->lerCsv();

/*
 * Busca o usuário
 */
$db = new DB();
$db->execScript('SELECT id FROM funcionarios WHERE usuario = "wolmer"');
if ($db->num_linhas) {
    $usuario = $db->dados['id'];
} else {
    exit('O funcionário não foi encontrado para incluir os horários.');
}

echo $usuario;

?>
