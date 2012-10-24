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

if (!$_REQUEST['arquivo']) {
    exit('Informe o arquivo para importação.');
}

$arquivo = $_REQUEST['arquivo'];

/**
 * Lendo os dados do arquivo
 */
$csv = new CSV();
$csv->arquivo = __path_base__ . '/importacao/arquivos/' . $arquivo;
$csv->lerCsv();

/*
 * Busca o usuário
 */
$db = new DB();
$db->execScript('SELECT id FROM funcionarios WHERE usuario = "wolmer"');
if ($db->num_linhas) {
    $usuario = $db->dados[0]['id'];
} else {
    exit('O funcionário não foi encontrado para incluir os horários.');
}

foreach ($csv->dados as $dados) {
    $i = 1;
    $data = split('/', $dados[0]);
    $data = "{$data[2]}-{$data[1]}-{$data[0]}";
    while ($i < count($dados)) {
        if ($dados[$i] || $dados[$i + 1]) {
            $db->execScript("REPLACE INTO controle_horarios VALUES(
                            NULL, 
                            {$usuario}, 
                            '{$data}', 
                            '{$dados[$i]}', 
                            '{$dados[$i + 1]}'
                        );");
        }
        $i += 2;
    }
}
echo 'Importação realizada com sucesso !';
?>
