<?php
/**
 * Controle de Ponto Eletronico
 *
 * PHP version >= 5.2
 *
 * @category  Ponto
 * @package   Classes
 * @author    Wolmer Willian Andrill Pinto <wolmerwap@gmail.com>
 * @copyright 2003-2012 Comércio e Serviços Ltda.
 * @link      http://www.wolmerwap.com.br
 */

Class DB {
    
    /**
     * Usuário do banco de dados
     * @var string
     */
	private $usuario = '';
    
    /**
     * Senha do banco de dados
     * @var string
     */
	private $senha = '';
    
    /**
     * Servidor usado
     * @var string
     */
	private $servidor   = '';
    
    /**
     * Nome da base de dados
     * @var string
     */
	private $nome_base = '';
    
    /**
     * Ponteiro para o Banco
     * @var int 
     */
	private $conexao = 0;
    
    /**
     * Ponteiro para a consulta
     * @var int
     */
    private $resource = 0;
    
    /**
     * Script sql para ser executado no banco, 
     * podendo ser uma ou mais instruções
     * @var string
     */
	public $sql = '';
    
    /**
     * Resultado da consulta executada na base
     * @var array
     */
	public $dados = array();
    
    /**
     * Ponteiro para o Banco
     * @var int 
     */
	public $num_linhas = 0;
   
    /**
	 * Método Construtor
	 */
	function __construct($sServer = null, $sUser = null, $sPass = null, $sDatabase = null) {
		if(isset ($sServer) && $sServer != null){
			$this->servidor = $sServer;
        } else {
			$this->servidor = __SGDB_SERVER__;
        }
        
		if(isset ($sUser) && $sUser != null){
			$this->usuario = $sUser;
        } else {
			$this->usuario = __SGDB_USER__;
        }
        
		if(isset ($sPass) && $sPass != null){
			$this->senha = $sPass;
        } else {
			$this->senha = __SGDB_PASSWD__;
        }
        
		if(isset ($sDatabase) && $sDatabase != null){
			$this->nome_base = $sDatabase;
        } else {
			$this->nome_base = __SGDB_DATABASE__;
        }

		$this->dbconnect();
	}
    
    /**
     * Conexão com o banco de dados
     */
    private function dbconnect () {
		$this->conexao = mysql_connect(
            $this->servidor, 
            $this->usuario, 
            $this->senha, 
            false
        );
        
        if (!$this->conexao || 
            !mysql_select_db($this->nome_base, $this->conexao)) {
			$this->conexao = (integer) 0;
			$this->resource = (integer) 0;
		}
    }
    
    /**
     * Executa o script passado ou a instrução inserida em $sql
     */
    public function execScript($sql) {
        if ($sql) {
            $instrucao = $sql;
        } elseif ($this->sql) {
            $instrucao = $this->sql;
        } else {
            exit('Não foi enviada uma instrução para ser executada.');
        }
        if ($instrucao) {
            $this->resource   = mysql_query($instrucao, $this->conexao);
            $this->num_linhas = mysql_affected_rows($this->conexao);
            $this->dados      = mysql_fetch_array($this->resource);
        }
    }
}
?>
