<?php

class App {
    
    //dados conexao com o banco de dados
    public $db_host = "localhost";
    public $db_user = "root";
    public $db_pass = "";
    public $db_name = "pos_contato_bd";
    
    //principais dados do site
    public $app_title = "Sistema";
    
	//arquivos de estilo css
    public $login_style = "login_v1.css";
    public $app_style = "app_v1.css";
    
	//arquivos de script js
    public $login_script = "login_v1.min";
    public $app_script = "app_v1";
    
    //principais dados interno do sistema
    public $system_path_upload = "upload/";
    
    //conexao com o banco de dados
    public $connection;
    
    function __construct(){
        try {
            $param = array (
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
            );
            $this->connection = new PDO('mysql:host='.$this->db_host.';port=3306;dbname='.$this->db_name,$this->db_user,$this->db_pass,$param);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    function loadModel( $model ) {

        include("app/model/" . $model . ".class.php" );
        return new $model();

    }

    function loadController( $controller ) {

        include("app/controller/" . $controller . ".class.php" );
        return new $controller();

    }
       
    //função para carregar um módulo de template
    function loadView($view, $tpl = null) {
        include("app/view/".strtolower($view).".tpl.php");
    }
	
	//função para imprimir mensagens ao usuário
	function msg ($texto, $class) {
		echo "<p class='$class'><strong>$texto</strong></p";
	}
    
}

