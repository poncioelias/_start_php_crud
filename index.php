<?php
	
	//obtendo a variavel de passo a ser executado
	$p = isset($_GET['p']) ? $_GET['p'] : null;
	
	//includes obrigatórios
	include("libs/funcoes.php");
	include("application.php");
	
    //configurando o horario
    date_default_timezone_set('America/Sao_Paulo');
        
    //prefine o cache nas paginas
    header("Expires: Mon, 21 Out 1999 00:00:00 GMT");
    header("Cacho-control: no-cache");
    header("Pragma: no-cache");

	session_start();

	switch($p){
		
		case "sair": 

			session_start();
			session_destroy();
			unset( $_SESSION );
			header('Location: /iphotos');
			break;


		default:
			
			$app = new app();

			//caso o usuário esteja logado exibir tela principal, se não tela login
			if (isset($_SESSION['usuario_id'])) {
				
				$tabulador = $app->loadController( "tabulador" );
				
				$tabulador->loadInicio($app);

			} else {
				renderizarLogin($app);
			}

	}
	
function renderizarLogin($app){

	$param = array("titulo"=>$app->app_title,
					"page" => "login",
					"javascript" => $app->login_script,
					"stylecss" => $app->login_style);

	$app->loadView("site", $param);

}
