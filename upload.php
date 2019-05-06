<?php 
	include('header.php');
	echo $Navegation->HeroMenu();
?>
<section class="section is-black" id="formulario">
	<div class="container">
		<h1 class="title">Formulário de Cadastro de Imagens</h1>
		<form method="post" action="">
			<div class="columns">
               	<div class="column is-4">
                  	<div class="field">
          				<label class="label">Nome Completo</label>
          				<div class="control has-icons-left has-icons-right">
          					<input class="input is-link" type="text" name="nome" placeholder="Informe o Nome Completo">
          					<span class="icon is-small is-left"><i class="fas fa-user"></i></span>
        					<span class="icon is-small is-right"><i class="fas fa-check"></i></span>
        				</div>
       				</div>
                </div>
                <div class="column is-4">
                  	<div class="field">
          				<label class="label">Email</label>
          				<div class="control has-icons-left has-icons-right">
          					<input class="input is-link" type="text" name="email" placeholder="Informe um E-mail Válido">
          					<span class="icon is-small is-left"><i class="fas fa-user"></i></span>
        					<span class="icon is-small is-right"><i class="fas fa-check"></i></span>
        				</div>
       				</div>
       			</div>
       		</div>
       		<?php 
       			for ($i=0; $i < 5; $i++) { 
       				?>
       				<div class="columns">
       					<?php
       						for ($i=0; $i < 5; $i++) { 
	       						?>
	       						<div class="column is-2">
	       							<?php
	       							for ($i=0; $i < 5; $i++) { 
	       								?>
										<label class="label">Foto</label>
										<div class="field">
							  				<div class="file is-centered is-boxed is-link has-name is-small">
							    				<label class="file-label">
							     					<input class="file-input" type="file" name="photo">
							      					<span class="file-cta">
							        					<span class="file-icon"><i class="fas fa-upload"></i></span>
							       						<span class="file-label">Carregar Foto…</span>
							     					</span>
							      					<span class="file-name">Carregar Foto…</span>
							    				</label>
							   				</div>
							 			</div>
				                	<?php
				                }
				                ?>
				            </div>
				            <?php
       						}
       					?>
       				</div>
       				<?php
       			}
       		?>
            <div class="columns">
				<div class="column">
					<input class="button is-block is-success is-large is-fullwidth" type="submit" name="save" value="Salvar" />
				</div>
				<div class="column">
					<input class="button is-block is-danger is-large is-fullwidth" type="button" name="cancel" value="Cancelar" />
				</div>
			</div>
		</form>
	</div>
</section>
<script type="text/javascript">
    function Nova(){
        location.reload();
    }
</script>
<p class="subtitle is-6 has-text-centered">
	<?php
		if(isset($_POST['save'])){
			#Resgata variáveis do formulário
          	$email = isset($_POST['email']) ? $_POST['email'] : '';
          	$nome = isset($_POST['nome']) ? $_POST['nome'] : '';

          	#Verifica se os campos estão vazios e exibe uma mensagem de erro
	        if (empty($email) || empty($nome)) {
	            echo 'Informe um nome completo e/ou um e-mail válido.';
	            exit;
	        }
		}
	?>
</p>
<?php include('footer.php'); ?>