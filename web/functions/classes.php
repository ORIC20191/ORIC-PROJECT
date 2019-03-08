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
	}
	$Load = new Load;