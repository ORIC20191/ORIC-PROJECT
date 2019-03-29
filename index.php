<?php 
    include('header.php'); 
    echo $Load->LoadMenu('index');
?>
    <section class="section is-black" id="sobre">
        <div class="container">
            <h1 class="title">Quem sou eu?</h1>
            <p class="">Trata-se de um projeto de robô autônomo em desenvolvimento por alguns alunos da <strong>Fatec Carapicuíba</strong>, que decidiram reinventar o relacionamento entre todos os stakeholders da instituição.</p>
        </div>
    </section>
    <section class="section" id="funcoes">
        <div class="container">
            <h1 class="title">Minhas funções</h1>
            <p class="">Serei um auxiliar docente, <strong>auxiliando</strong> alunos, funcionários e professores da instituição.</p>
        </div>
    </section>
    <section class="section" id="equipe">
        <div class="container">
            <h1 class="title">Quem me desenvolveu?</h1>
            <p class="">Aqui, vocês poderão <strong>conhecer</strong> quem me desenvolveu: </p>
            <br/>
            <?php echo $Load->Team(); ?>
        </div>
    </section>
    <section class="section" id="apoio">
        <div class="container">
            <h1 class="title">Quem está comigo?</h1>
            <p class="">A simple container to divide your page into <strong>sections</strong>, like the one you're currently reading</p>
        </div>
    </section>

<?php include('footer.php'); ?>