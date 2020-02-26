<h1>Editar Aula</h1>
<form method="POST">
	Título da Aula:<br/>	
	<input type="text" name="nome" value="<?php echo $aula['nome']; ?>"/><br/><br/>
	Descrição da Aula:<br/>
	<textarea name="descricao"><?php echo $aula['descricao']; ?></textarea><br/><br/>
	Url do Vídeo: <br/><br/>
	<input type="text" name="url" value="<?php echo $aula['url']; ?>"/><br/><br/>
	<input type="submit" value="Salvar"/>
</form>