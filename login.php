<?php
  include('header.php');
  switch ($Login->IsLogged()) {
    case false:
        $title = 'Login';
        $message = 'Informe os dados para entrar
          <figure class="image is-128x128 avatar"><img class="is-rounded" src="'.$picture.'"></figure>
          <form method="post" action="">
            <div class="field">
              <div class="control">
                <input class="input is-large" type="email" name="email" placeholder="'.$placeholder.'" value="'.$email.'" autofocus="">
              </div>
            </div>
            <div class="field">
              <div class="control">
                <input class="input is-large" type="password" name="password" placeholder="Sua Senha">
              </div>
            </div>
            <div class="field">
              <label class="checkbox"><input type="checkbox">&nbsp;Lembre-me</label>
            </div>
            <input class="button is-block is-info is-large is-fullwidth" type="submit" name="signin" value="Entrar" />
          </form>';
          $links[1] = SERVER.'signup'; 
          $links[2] = 'Cadastrar';
          $links[3] = SERVER.'forgot-pass'; 
          $links[4] = 'Recuperar Senha';

          if(isset($_POST['signin'])) {
            # Resgata variáveis do formulário
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $password = isset($_POST['password']) ? $Tables->HashStr($_POST['password']) : '';
            # Verifica se os campos estão vazios e exibe uma mensagem de erro
            if (empty($email) || empty($password)) {
              echo 'Informe email e/ou senha.'; exit;
            }
                        
            # Verificar se o usuário existe e se a senha é a mesma     
            $stmt = $PDO->prepare($Tables->SelectFrom(null, 'users WHERE email LIKE :email AND password LIKE :password AND status_use = 1', 0, 1));
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($users) <= 0) {
              echo 'Email ou senha incorretos. Deseja <strong><a href="forgot-pass?email='.$email.'">recuperar</a></strong>?'; exit;
            }
            # Busca os resultados e os cataloga com a variável $_SESSION
            $user = $users[0];
            $_SESSION['logged_in'] = true;    
            $_SESSION['id'] = $user['id_use'];
            $_SESSION['name'] = $user['name_use'];
            header('Location: '.SERVER);
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