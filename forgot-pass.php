<?php
  include('header.php');
  switch ($Login->IsLogged()) {
    case false:
        $title = 'Recuperar';
        $message = 'Informe o e-mail para recuperar seu acesso
          <figure class="image is-128x128 avatar"><img class="is-rounded" src="'.$picture.'"></figure>
          <form method="post" action="">
            <div class="field">
              <div class="control">
                <input class="input is-large" type="email" name="email" placeholder="'.$placeholder.'" value="'.$email.'" autofocus="">
              </div>
            </div>
            <input class="button is-block is-info is-large is-fullwidth" type="submit" name="recover" value="Recuperar" />
          </form>';
          $links[1] = 'login'; 
          $links[2] = 'Entrar';
          $links[3] = 'signup'; 
          $links[4] = 'Cadastrar';

          if(isset($_POST['recover'])) {
            # Resgata variáveis do formulário
            $email = isset($_POST['email']) ? $_POST['email'] : '';

            # Verifica se os campos estão vazios e exibe uma mensagem de erro
            if (empty($email)) {
              echo 'Informe email.'; exit;
            }

              # Verifica se o usuário existe e exibe ou uma mensagem de erro ou vai ao cadastro
              $con = $PDO->prepare($Tables->SelectFrom(null, 'users WHERE email = '.$email.' AND status_use = 1')) or die ($PDO);
              if(count($con) == 1){
                $password = $Tables->HashStr($Load->RandomPass());

                $stmt = $PDO->prepare($Tables->SelectFrom(null, 'users WHERE email = '.$email.' AND password = :password AND status_use = 1'));
                $stmt->bindParam(':password', $password);
                $stmt->execute();
                $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (count($users) <= 0) {
                  echo 'Um erro aconteceu'; exit;
                }

                # Busca os resultados e os cataloga com a variável $_SESSION
                $user = $users[0];
                $_SESSION['logged_in'] = true;
                  
                $_SESSION['id'] = $user['id_use'];
                $_SESSION['name'] = $user['name_use'];
                header('Location: profile');
                //$password = $Tables->HashStr();
                //echo 'Sua nova senha é '.$password;
                //echo 'Sua nova senha será encaminhada por email';
              }
          }
    break;
    case true:
        $title = 'Ops';
        $message = 'Sessão já inicializada';
        $links[1] = SERVER; 
        $links[2] = 'Início';
        $links[3] = '#'; 
        $links[4] = 'Voltar aonde estava';
      break;
  }
  include('functions/ops.php');
  include('footer.php');