<?php

	class Tables {
		function LoadFrom($str){
	      return "SELECT * FROM ".$str;
	    }

	    function Found_Item($item, $str) {
	      return $item.'_'.substr($str, 0, 3);
	    }
		
		function LoadCountFrom($str){
	      $Tables = new Tables;
	      define ('ID_TABLE', $Tables->Found_Item('id', $str));
	      return "SELECT count(".ID_TABLE.") as qt from ".$str;
	    }
		
		function CountViewTable($str){
	      $Tables = new Tables;
	      $Load = new Load;
	      $PDO = $Load->DataBase();
	      $sql = $Tables->LoadCountFrom($str);
	      $res = $PDO->query($sql) or die ($PDO);
	      while($row = $res->fetch(PDO::FETCH_OBJ)){
	        $r = $row->qt;
	      }
	      return $r;
	    }
	}
  	$Tables = new Tables;

	/**
	 * 
	 */
	class Load
	{
		
		function DataBase(){
	    	$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASS);
	      	$pdo->exec('set names utf8');
	      	return $pdo;
	    }

	    /**
	     * Get either a Gravatar URL or complete image tag for a specified email address.
	     *
	     * @param string $email The email address
	     * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
	     * @param string $d Default imageset to use [ 404 | mp | identicon | monsterid | wavatar ]
	     * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
	     * @param boole $img True to return a complete IMG tag False for just the URL
	     * @param array $atts Optional, additional key/value attributes to include in the IMG tag
	     * @return String containing either just a URL or a complete image tag
	     * @source https://gravatar.com/site/implement/images/php/
	     */
	    function Gravatar($email, $s = 80, $d = 'mp', $r = 'g', $img = false, $atts = array()) {
    		$url = 'https://www.gravatar.com/avatar/';
    		$url .= md5( strtolower( trim( $email ) ) );
    		$url .= "?s=$s&d=$d&r=$r";
    		if ( $img ) {
        		$url = '<img src="' . $url . '"';
        		foreach ( $atts as $key => $val )
            		$url .= ' ' . $key . '="' . $val . '"';
        		$url .= ' />';
    		}
    		return $url;
	    }


	    function Team(){
	    	$Load = new Load;
	    	$Tables = new Tables;
	    	$sql = $Tables->LoadFrom('devs');
			$query = $Load->DataBase()->query($sql) or die ($Load->DataBase());
			$count = $Tables->CountViewTable('devs');
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

	    function LoadMenu($str){
	    	switch ($str) {
	    		case 'index':
	    			$type_hero = 'fullheight';
	    			$hero_body = '
		    			<div class="hero-body">
		                    <div class="container has-text-centered">
		                        <div class="columns is-vcentered">
		                            <div class="column is-5">
		                                <figure class="image is-4by3"><img src="https://picsum.photos/800/600/?random" alt="Description"></figure>
		                            </div>
		                            <div class="column is-6 is-offset-1">
		                                <h1 class="title is-2">Olá, eu sou o ORIC</h1>
		                                <h2 class="subtitle is-4">Um robô que está para te ajudar.</h2>
		                                <br>
		                                <p class="has-text-centered"><a href="#sobre" class="button is-medium is-info is-outlined">Conheça</a></p>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		                <div class="hero-foot">
		                    <div class="container">
		                        <div class="tabs is-centered">
		                            <ul>
		                                <li><a><!--Estamos preparando algo aqui--></a></li>
		                            </ul>
		                        </div>
		                    </div>
		                </div>';
	    		break;
	    		
	    		case 'cadastra':
	    			$type_hero = 'medium';
	    			$hero_body = '
	    				<div class="hero-body">
	    					<div class="container has-text-centered">
		    					<div class="columns is-vcentered">
			                        <div class="column is-5">
			                	        <figure class="image is-4by3"><img src="https://picsum.photos/800/600/?random" alt="Description"></figure>
			                        </div>
			                       	<div class="column is-6 is-offset-1">
		    							<h1 class="title is-2">ORIC gosta de imagens</h1>
		    							<h2 class="subtitle is-4">Cadastre uma imagem para ele.</h2>
		    						</div>
		    					</div>
		    				</div>
	    				</div>';
	    		break;

	    		case 'contato':
	    			$type_hero = 'medium';
	    			$hero_body = '
	    				<div class="hero-body">
	    					<div class="container has-text-centered">
		    					<div class="columns is-vcentered">
			                        <div class="column is-5">
			                	        <figure class="image is-4by3"><img src="https://picsum.photos/800/600/?random" alt="Description"></figure>
			                        </div>
			                       	<div class="column is-6 is-offset-1">
		    							<h1 class="title is-2">ORIC gosta de imagens</h1>
		    							<h2 class="subtitle is-4">Cadastre uma imagem para ele.</h2>
		    						</div>
		    					</div>
		    				</div>
	    				</div>';
	    		break;
	    	}

	    	echo'
	    	<section class="hero is-'.$type_hero.' is-default is-bold" id="topo">
                <div class="hero-head">
                	<nav class="navbar is-fixed-top" role="navigation" aria-label="main navigation">
                		<div class="container">
					  		<div class="navbar-brand">
							    <a class="navbar-item" href="index">
							    	<img class="logo" src="assets/brand/1_crop.png" alt="Logo">
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
							      		<a class="navbar-link is-active" href="index">Início</a>
							        	<div class="navbar-dropdown">
								         	<a class="navbar-item" href="index#sobre">Sobre</a>
								          	<a class="navbar-item" href="index#funcoes">Funções</a>
								          	<a class="navbar-item" href="index#equipe">Equipe</a>
								          	<hr class="navbar-divider">
								          	<a class="navbar-item" href="index#apoio">Apoio</a>
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
	        						</div>
	      						</div>
	    					</div>
	    				</div>
  					</div>
				</nav>
            </div>'.$hero_body.'</section>';
	    }
	}
	$Load = new Load;