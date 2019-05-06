<?php
    require_once('classes.php');

    # Definições
    # 1 - Conexão com DB
    define('DB_HOST', 'localhost');
    define('DB_USER', 'oric');
    define('DB_PASS', 'y2gMrjJGClnXzGli');
    define('DB_NAME', 'oric_php');

    # 3 - Definição de META
    define('YEAR',          date('Y'));
    define('TODAY',         date(YEAR.'-m-d'));
    define('DATE',          date((YEAR-15).'-m-d'));
    define('TITLE',         'ORIC');
    define('DESC',          'Sou Eu');
    define('TITLE_HEAD',    'Eu Sou '. TITLE);
    define('AUTHOR',        'ORIC');
    define('AUTHOR_1',      'Camila L. Oliveira');
    define('AUTHOR_2',      'Lucas Salazar');
    define('AUTHOR_3',      'Carla Martins');
    define('AUTHOR_1_URL',  'http://projetos.camilaloliveira.com/');
    define('FOOTER',        '&copy;'.YEAR.' ORIC. Todos os direitos reservados.');

    # 4 - Definição de Conexão
    $PDO = $Load->DataBase();
    define('LINK',       $_SERVER['REQUEST_URI']);
    $link = $Load->DiscoverLink();
    define('MAIN_EMAIL', 'someone@somewhere.com');
    $error = array();

    # 5 - Definições de Inserção/Edição
    $id = (isset($_SESSION['id'])) ? $_SESSION['id'] : (isset($_GET['id'])) ? $_GET['id'] : '';
    $email = isset($_GET['email']) ? $_GET['email'] : '';
    $placeholder = isset($_GET['email']) ? $_GET['email'] : 'Informe seu email';
    $picture = isset($_GET['email']) ? $Load->Gravatar($_GET['email']) : $Load->Gravatar();
    $password = 'Informe sua senha';
    $password_conf = 'Repita corretamente';

    switch ($id) {
        case true: $selected_type = 'editar'; $type_button = 'edit'; break;
        case false: $selected_type = 'cadastrar'; $type_button = 'save'; break;
    }

    # 6 - Definições de Paginação
    $vf = 10;
    $pg = isset($_GET['pg']) ? $_GET['pg'] : '';
    $pc = (!$pg) ? 1 : $pg;
    $vi = $pc - 1;
    $vi = $vi * $vf;
   
    define('MAX', strlen($link));
    $sizeof = array();
    $sizeof[1] = MAX;
    #echo $sizeof[1].' ';
    $sizeof[2] = strlen(strstr(LINK, '?id='.$id));
    #echo $sizeof[2];
    $link = (isset($_GET['id'])) ? $Load->DiscoverLink($link, ($sizeof[1] - $sizeof[2])) : $Load->DiscoverLink();