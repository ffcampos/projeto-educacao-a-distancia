<h1>Alunos - Adicionar</h1>

<?php if(!empty($erro)): ?>
	<div class="erro"><?php echo $erro; ?></div>
<?php endif; ?>
<form method="POST">
	Nome do Aluno:<br/>
	<input type="text" name="nome" required/><br/><br/>
	E-mail do Aluno:<br/>
	<input type="email" name="email" required/><br/><br/>
	Senha do Aluno:<br/>
	<input type="password" name="senha" required/><br/><br/>
	<input type="submit" value="Cadastrar Aluno"/>
</form>