<?php

	# Classe Referente ao Login
  	class Login { 
        # 1 - Retorna se o usuário logou
        function IsLogged() {
        	return (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != true) ? false : true;
        }
    }
    $Login = new Login;

	# Classe referente as Tabelas
  	class Tables {
		# 1.1 - Localizar uma coluna de uma tabela para carregar seus dados
	    function Found_Item($item, $name_table){
	    	return $item.'_'.substr($name_table, 0, 3);
	    }
	    
	    # 1 - Carregar todos os dados (ou específicos) de uma tabela através do string informado
	    function SelectFrom($item = null, $name_table_and_cond, $limit = array()){
	    	$Tables = new Tables;
	    	switch ($item) {
	    		case 'COUNT': 	$sql = 'SELECT COUNT('.$Tables->Found_Item('id', $name_table_and_cond).') AS qt'; break;
	    		case null: 		$sql = 'SELECT *'; break;
	    		default: 		$sql = 'SELECT '.$item; break;
	    	}
	    	$sql .= (!$limit) ? ' FROM '.$name_table_and_cond : ' FROM '.$name_table_and_cond.' LIMIT '.$limit[1].', '.$limit[2];
	    	return $sql;
	    }
	    
	    # 2 - Cria o Hash da Senha, usando MD5 e SHA-1
	    function HashStr($password){
	    	return sha1(md5($password));
	    }
	    
	    # 3 - Busca uma determinada linha da tabela //a desenvolver
	    function SearchId($name_table){
	     	return isset($_REQUEST['id']) ? $_REQUEST['id']: '';
	    }
	    
	    # 4 - Conta os registros de uma tabela ou de uma busca //a aprimorar
	    function CountViewTable($type = null, $name_table, $item = null){
	    	$Load = new Load;
	    	$Tables = new Tables;
	      	$PDO = $Load->DataBase();
	      	switch ($type) {
	      		case 'search':
	      			$q = isset($_GET['q']) ? $_GET['q'] : '';
	      			$qt = count($PDO->prepare($Tables->SelectFrom('COUNT', $name_table)." WHERE ".$item." LIKE '%".$q."%' ORDER BY ".$item) or die ($PDO));
	      		break;
	      		
	      		case null:
	      		default:
	      			$con = $PDO->query($Tables->SelectFrom('COUNT', $name_table)) or die ($PDO);
	      			while($row = $con->fetch(PDO::FETCH_OBJ)){
	        			$qt = $row->qt;
	      			}
	      		break;
	      	}
	      	return $qt;
	    }
	    
	    # 5 - Deleta um registro do sistema // a desenvolver
	    function DeleteId($name_table){
	    	$Load = new Load;
	    	$Tables = new Tables;
	    	$PDO = $Load->DataBase();
	    	$con = $PDO->query('DELETE FROM '.$name_table.' WHERE '.$Tables->FoundId($name_table).' = '.$Tables->SearchId($name_table)) or die ($PDO);
	    	if ($con) {
	    	  return $Load->GoToLink($name_table);
	    	} else {
	    	  #Exibir mensagem de erro 
	    	  //return messageShow('error', $_SERVER['REQUEST_URI'], $str);
	    	}
	    }
  	}
  	$Tables = new Tables;


	# Classe Referente ao Carregamento das Atribuições, Variáveis
	class Load {
		# 1 - Conexão com o BD
	    function DataBase() {
	    	$pdo = new PDO('mysql:host='.DB_HOST.'; dbname='.DB_NAME.'; charset=utf8', DB_USER, DB_PASS);
	    	$pdo->exec('set names utf8');
	    	return $pdo;
	    }
		
		# 2 Verifica se o server é https e printa a URL do link
	    function Server() {
	     	return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https://'.$_SERVER["SERVER_NAME"].'/' : 'http://'.$_SERVER["SERVER_NAME"].'/';
	    }
	    
	    # 3 - Redirecionamento de URL
	    function Link($name_page) {
	      	return header('Location: '.SERVER.''.$name_page);
	    }
	    
	    # 4 - Descobrir o link para gerar o Load page
	    function DiscoverLink($link = LINK, $sizeof = false){
	    	$link = substr(LINK, 1);
	    	if ($link != 'login')
	    		$link = (isset($_GET['id'])) ? substr($link, 0, $sizeof) : $link;
	    	else
         		$link = (isset($_GET['email'])) ? substr($link, 1) : $link;
         	return $link;
	    }
	    
	    # 5 - Gerador de Senha Aleatória
	    function RandomPass($size = 10, $ma = true, $mi = true, $nu = true, $si = false){
	    	#letras maiusculas e minusculas
	    	foreach(range('a', 'z') as $mi) {
	    		$mi;
	    		$ma = strtoupper($mi);
	    	}
	    	#numeros
		 	foreach(range(0, 9) as $nu) { $nu; }
		 	#simbolos
		 	foreach(range('!', '+') as $si) { $si; }
		 
		 	if ($ma || $mi || $nu || $si){
		 		$password = str_shuffle($ma); 		# se $maiusculas for "true", a variável $ma é embaralhada e adicionada para a variável $senha
		        $password .= str_shuffle($mi);		# se $minusculas for "true", a variável $mi é embaralhada e adicionada para a variável $senha
		        $password .= str_shuffle($nu);		# se $numeros for "true", a variável $nu é embaralhada e adicionada para a variável $senha
		        $password .= str_shuffle($si);		# se $simbolos for "true", a variável $si é embaralhada e adicionada para a variável $senha
		    }
	    	return substr(str_shuffle($password), 0, $size);	# retorna a senha embaralhada com "str_shuffle" com o tamanho definido pela variável $tamanho
		}
		
		# 5 - Exibe a imagem gravada no BD ou a imagem gravada no site Gravatar.com
		function Gravatar($email = MAIN_EMAIL, $s = 240, $d = 'mp', $r = 'g', $img = false, $atts = array()){
			$Login = new Login;
			$Load = new Load;
			$Tables = new Tables;
			$photo = '';
			$PDO = $Load->DataBase();
			$link = $Load->DiscoverLink();
			if($Login->IsLogged()){
				#echo $link;
				switch($link){
					case 'employees': case 'teachers': case 'students':
						$con = $PDO->query($Tables->SelectFrom('email', $link.', users WHERE '.$link.'.id_use = users.id_use')) or die ($PDO);
						while($row = $con->fetch(PDO::FETCH_OBJ)) {
							$email = isset($row->email) ? $row->email : 'someone@somewhere.com';
						}
					break;
					default:
						$id = (isset($_SESSION['id'])) ? $_SESSION['id'] : $_GET['id'];
						$con = $PDO->query($Tables->SelectFrom('photo, email', 'users WHERE id_use = '.$id)) or die ($PDO);
						while($row = $con->fetch(PDO::FETCH_OBJ)) {
							$email = isset($row->email) ? $row->email : 'someone@somewhere.com';
							$photo = isset($row->photo) ? $row->photo : '';
						}
					break;
				}
			}
			if(!$photo){
				$url = 'https://www.gravatar.com/avatar/';
			    $url .= md5(strtolower(trim($email)));
			    $url .= "?s=$s&d=$d&r=$r";
			    if ($img) {
			    	$url = '<img src="'.$url.'"';
			        foreach ($atts as $key => $val)
			            $url .= ' '.$key.'="'.$val.'"';
			        $url .= ' />';
			    }
			    $photo = $url;
			}
            return $photo;
		}

		function WhatLink($link = LINK){
			switch ($link) {
				case 'cadastra': $str = 'Cadastrar Imagens'; break;
				case SERVER: $str = 'Início'; break;
		    }
		    return $str;
		}

		function Team(){
			$Load = new Load;
	    	$Tables = new Tables;
			$query = $Load->DataBase()->query($Tables->SelectFrom(null,'devs')) or die ($Load->DataBase());
			$count = $Tables->CountViewTable(null, 'devs');
			$res = intval($count / 3);

			echo '<div class="columns">';
			while($row = $query->fetch(PDO::FETCH_OBJ)){
				$nome = $row->nome_dev;
				$funcao = '';
				$foto = $Load->Gravatar($row->email_dev);
				for ($i = 1; $i <= $res; $i++){
					echo'
						<div class="column">
	                    	<div class="content has-text-left">
								<figure class="image is-128x128"><img class="is-rounded" src="'.$foto.'"></figure>
								<p>'.$nome.'</p>
								<p>'.$funcao.'</p>
							</div>
						</div>';
				}
			}
			echo '</div>';
		}
	}
	$Load = new Load;
	define('SERVER', $Load->Server());

	class Navegation {
		# 1 - Gera o Menu de topo se o usuário estiver logado. Menu irá variar de acordo com o tipo de usuário
	    function HeroMenu($link = LINK){
	    	$Login = new Login;
	    	switch($Login->IsLogged()){
                case true:
                	$link_sec = 'logout';
                	switch ($link) {
                		case 'index': case SERVER: 
                			$section_class = 'is-fullheight';
                			$message = '
                				<div class="column is-5">
									<figure class="image is-4by3"><img src="https://picsum.photos/800/600/?random" alt="Description"></figure>
								</div>
	                			<div class="column is-6 is-offset-1">
									<h1 class="title is-2">Olá, eu sou o ORIC</h1>
									<h2 class="subtitle is-4">Um robô que está para te ajudar.</h2>
									<br>
									<p class="has-text-centered"><a href="'.SERVER.'#sobre" class="button is-medium is-info is-outlined">Conheça</a></p>
								</div>';
                		break;
                		case 'cadastra': 
                			$section_class = 'is-medium';
                			$message = '
                				<div class="column is-5">
									<figure class="image is-4by3"><img src="https://picsum.photos/800/600/?random" alt="Description"></figure>
								</div>
                				<div class="column is-6 is-offset-1">
									<h1 class="title is-2">ORIC gosta de imagens</h1>
									<h2 class="subtitle is-4">Cadastre uma imagem para ele.</h2>
								</div>';
                		break;
                		case 'contato': 
                			$section_class = 'is-medium';
                			$message = '
                				<div class="column is-5">
									<figure class="image is-4by3"><img src="https://picsum.photos/800/600/?random" alt="Description"></figure>
								</div>
                				<div class="column is-6 is-offset-1">
									<h1 class="title is-2">ORIC gosta de imagens</h1>
									<h2 class="subtitle is-4">Cadastre uma imagem para ele.</h2>
								</div>';
                		break;
                	}
                case false:
                	$link_sec = 'login';
                	switch ($link) {
                		case 'index': case SERVER: 
		                	$section_class = 'is-fullheight'; 
		                	$message = '
		                		<div class="column is-5">
									<figure class="image is-4by3"><img src="https://picsum.photos/800/600/?random" alt="Description"></figure>
								</div>
								<div class="column is-6 is-offset-1">
									<h1 class="title is-2">Olá, eu sou o ORIC</h1>
									<h2 class="subtitle is-4">Um robô que está para te ajudar.</h2>
									<br>
									<p class="has-text-centered"><a href="'.SERVER.'#sobre" class="button is-medium is-info is-outlined">Conheça</a></p>
								</div>';
							break;
						default: $section_class = 'is-small'; $message = ''; break;
					}
                break;
            }

            return '
	            <section class="hero '.$section_class.' is-default is-bold" id="topo">
		        	<div class="hero-head">
		                <nav class="navbar is-fixed-top" role="navigation" aria-label="main navigation">
		                	<div class="container">
							  	<div class="navbar-brand">
									<a class="navbar-item" href="'.SERVER.'">
										<img class="logo" src="'.SERVER.'assets/brand/1_crop.png" alt="Logo">
									</a>
									<a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
										<span aria-hidden="true"></span>
										<span aria-hidden="true"></span>
										<span aria-hidden="true"></span>
									</a>
			  						</div>
			  						<div id="navbarBasicExample" class="navbar-menu">
									    <div class="navbar-start">
									    	<div class="navbar-item has-dropdown is-hoverable">
									      		<a class="navbar-link is-active" href="'.SERVER.'">Início</a>
									        	<div class="navbar-dropdown">
										         	<a class="navbar-item" href="'.SERVER.'#sobre">Sobre</a>
										          	<a class="navbar-item" href="'.SERVER.'#funcoes">Funções</a>
										          	<a class="navbar-item" href="'.SERVER.'#equipe">Equipe</a>
										          	<hr class="navbar-divider">
										          	<a class="navbar-item" href="'.SERVER.'#apoio">Apoio</a>
									        	</div>
									      	</div>
									    </div>
			    						<div class="navbar-end">
			      							<div class="navbar-item">
			      								<a class="navbar-item">
			                                        <i class="fas fa-search" aria-hidden="true"></i>&nbsp;&nbsp;
			                                        <span><input class="input" type="search" placeholder="Procurar..."></span>
			                                    </a>
			                                </div>
			        						<div class="buttons">
									          	<a class="button is-primary" href="cadastra">
									            	<strong><i class="fas fa-camera"></i>&nbsp;Cadastro</strong>
									          	</a>
			          							<a class="button is-light" href="contato"><i class="fas fa-envelope"></i>&nbsp;Contato</a>
			          							<a class="button is-light" href="'.$link_sec.'"><i class="fas fa-user"></i>&nbsp;Entrar</a>
			        						</div>
			      						</div>
			    					</div>
			    				</div>
		  					</div>
						</nav>
		            </div>
		            <div class="hero-body">
						<div class="container has-text-centered">
							<div class="columns is-vcentered">
				                '.$message.'    
							</div>
						</div>
					</div>
	        	</section>';
    	}
    }
    $Navegation = new Navegation;