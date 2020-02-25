<h1>Curso - Editar</h1>
<form method="POST" enctype="multipart/form-data">
	Nome do Curso:<br/>
	<input type="text" name="nome" value="<?php echo utf8_encode($curso['nome']); ?>"required/><br/><br/>
	Descrição:<br/>
	<textarea name="descricao" required><?php echo utf8_encode($curso['descricao']); ?></textarea><br/><br/>
	Imagem:<br/>
	<input type="file" name="imagem"/><br/>
	<img src="<?php echo BASE_URL; ?>../../assets/images/cursos/<?php echo $curso['imagem']; ?>" border="0" height="80"/><br/><br/>
	<input type="submit" value="Salvar"/>
</form>
<hr/>
<h2>Aulas</h2>

<fieldset>
	<legend><strong>Adicionar Módulo Novo</strong></legend>
	<form method="POST">
		Nome do Módulo: <br/>
		<input type="text" name="modulo"/>
		<input type="submit" value="Adicionar"/>
	</form>
</fieldset><br/>
<fieldset>
	<legend><strong>Adicionar Aula Nova</strong></legend>
		<form method="POST">
			Título da Aula: <br/>
			<input type="text" name="aula"/><br/><br/>
			Selecione o Módulo para a Aula:<br/>
			<select name="moduloAula">
				<?php foreach($modulos as $modulo): ?>
					<option value="<?php echo $modulo['id']; ?>"><?php echo utf8_encode($modulo['nome']); ?></option>
				<?php endforeach; ?>
			</select><br/><br/>
			Selecione o Tipo da Aula:<br/>
			<select name="tipo">
				<option value="video">Vídeo</option>
				<option value="poll">Questionário</option>
			<select><br/><br/>
			<input type="submit" value="Adicionar Aula"/>
		</form>
</fieldset><br/>

<?php foreach($modulos as $modulo): ?>
	<h4><?php echo utf8_encode($modulo['nome']); ?> - <a onclick="return confirm('Deseja realmente excluir?')"href="<?php echo BASE_URL; ?>/home/del_modulo/<?php echo $modulo['id']; ?>">[Excluir]</a> - <a href="<?php echo BASE_URL; ?>/home/edit_modulo/<?php echo $modulo['id']; ?>">[Editar]</a></h4>

	<?php foreach($modulo['aulas'] as $aula): ?>
		<h5><?php echo $aula['nome']; ?> <a href="">[Editar]</a> - <a href="<?php echo BASE_URL; ?>/home/del_aula/<?php echo $aula['id']; ?>">[Excluir]</a></h5>
	<?php endforeach; ?>
<?php endforeach; ?>
