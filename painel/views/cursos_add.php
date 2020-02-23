<h1>Cursos - Adicionar</h1>
<form method="POST" enctype="multipart/form-data">
	Nome do Curso:<br/>
	<input type="text" name="nome" required/><br/><br/>
	Descrição:<br/>
	<textarea name="descricao" required></textarea><br/><br/>
	Imagem:<br/>
	<input type="file" name="imagem" required/><br/><br/>
	<input type="submit" value="Adicionar Curso"/>
</form>