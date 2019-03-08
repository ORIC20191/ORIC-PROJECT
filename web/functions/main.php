<?php
    require_once('classes.php');

    //1 - Conexão com DB
    define('DB_HOST', 'localhost');
    define('DB_USER', 'oric');
    define('DB_PASS', 'y2gMrjJGClnXzGli');
    define('DB_NAME', 'oric_php');

	//Definições de Variáveis de Visualização
	define('YEAR', date('Y'));
    define('TODAY', date(YEAR.'-m-d'));
    define('DATE', date((YEAR-15).'-m-d'));
    define('TITLE', 'ORIC');
	define('DESC', 'Sou Eu');
	define('AUTHOR_1', 'Camila L. Oliveira');
	define('AUTHOR_2', 'Lucas Salazar');
	define('AUTHOR_3', 'Carla Martins');
    define('AUTHOR_1_URL', 'http://projetos.camilaloliveira.com/');
    $title = 'Eu sou '.TITLE;

    define('FOOTER', '&copy;'.YEAR.' ORIC. Todos os direitos reservados.');

    //definir variáveis via funções
    define('SERVER', $_SERVER["SERVER_NAME"].'/');