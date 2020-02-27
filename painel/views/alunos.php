<h1>Alunos</h1>
<div class="btn_adicionar"><a href="<?php echo BASE_URL; ?>/alunos/adicionar">Adicionar Aluno</a></div>
<hr/>
<table border="0" width="100%">
	<tr>
		<th>Nome do Aluno</th>
		<th width="80">Qt. de Alunos</th>
		<th width="200">Ações</th>
	</tr>
	<?php foreach($alunos as $aluno): ?>

		<tr>
			<td><?php echo $aluno['nome']; ?></td>
			<td align="center"><?php echo $aluno['qt_cursos']; ?></td>
			<td align="center">
				<a href="<?php echo BASE_URL; ?>/alunos/edit_aluno/<?php echo $aluno['id']; ?>">Editar</a> - 
				<a onclick="return confirm('Deseja Realmente Excluir??')" href="<?php echo BASE_URL; ?>/alunos/del_aluno/<?php echo $aluno['id']; ?>">Excluir</a>
			</td>
		</tr>

	<?php endforeach;?>
</table>