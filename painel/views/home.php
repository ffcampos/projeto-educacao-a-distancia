<h1>Cursos</h1>

<div class="btn_adicionar"><a href="<?php echo BASE_URL; ?>/home/adicionar" >Adicionar Curso</a></div>
<hr/>
<table border="0" width="100%">
	<tr>
		<th>Imagem</th>
		<th>Nome</th>
		<th width="80">Quantidade Alunos</th>
		<th>Ações</th>
	</tr>
	<?php foreach($cursos as $curso): ?>
	<tr>
		<td width="150"><img src="../assets/images/cursos/<?php echo $curso['imagem']; ?>" border="0" height="70"</td>
		<td><?php echo $curso['nome']; ?></td>
		<td align="center"><?php echo $curso['qt_alunos']; ?></td>
		<td  width="200">
			<a href="<?php echo BASE_URL; ?>/home/editar/<?php echo $curso['id']; ?>">Editar</a> - 
			<a onclick="return confirm('Deseja Realmente excluir?')" href="<?php echo BASE_URL; ?>/home/excluir/<?php echo $curso['id']; ?>">Excluir</a>
		</td>
	</tr>
	<?php endforeach; ?>
</table>
