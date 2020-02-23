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
	<legend>Adicionar Módulo Novo</legend>
	<form method="POST">
		Nome do Módulo: <br/>
		<input type="text" name="modulo"/>
		<input type="submit" value="Adicionar"/>
	</form>
</fieldset>

<?php foreach($modulos as $modulo): ?>
	<h4><?php echo utf8_encode($modulo['nome']); ?> - <a onclick="return confirm('Deseja realmente excluir?')"href="<?php echo BASE_URL; ?>/home/del_modulo/<?php echo $modulo['id']; ?>">[Excluir]</a> - <a href="<?php echo BASE_URL; ?>/home/edit_modulo/<?php echo $modulo['id']; ?>">[Editar]</a></h4>
<?php endforeach; ?>
