<h1>Alunos - Editar</h1>
<?php if(!empty($erro)): ?>
	<div class="erro"><?php echo $erro; ?></div>
<?php endif; ?>
<form method="POST">
	Nome do Aluno:<br/>
	<input type="text" name="nome" value="<?php echo utf8_encode($aluno['nome']); ?>" required/><br/><br/>
	E-mail do Aluno:<br/>
	<input type="email" name="email" value="<?php echo $aluno['email']; ?>" required/><br/><br/>
	Senha do Aluno:<br/>
	<input type="password" name="senha" required/><br/><br/>

	Cursos:(Segure CTRL para selecionar outros cursos)<br/>

	<select name="cursos[]" multiple style="height:150px" required>
		<?php foreach($cursos as $curso): ?>
			<option value="<?php echo $curso['id']; ?>" <?php
			if(in_array($curso['id'], $inscritos)){
				echo 'selected="selected"';
			}
			?>><?php  echo utf8_encode($curso['nome']); ?></option>
		<?php endforeach; ?>
	</select><br/><br/>
	<input type="submit" value="Salvar"/>

</form>