<div class="curso_info">
	<img src="<?php echo BASE_URL; ?>/assets/images/cursos/<?php echo $curso->getImagem(); ?>" border="0" height="60"/>
	<h3><?php echo $curso->getNome(); ?></h3>
	<?php echo $curso->getDescricao();?><br/>
	Aulas Assistidas: <?php echo $aulas_assistidas;?> /  <?php echo $total_aulas. ' ('.number_format((($aulas_assistidas / $total_aulas) * 100), 2).'%)'; ?>
</div>
<div class="curso_left">

	<?php foreach($modulos as $modulo): ?>
		<div class="modulo"><?php echo utf8_encode($modulo['nome']); ?></div>
		<?php foreach($modulo['aulas'] as $aula): ?>
			<a href="<?php echo BASE_URL; ?>/cursos/aula/<?php echo $aula['id']; ?>"><div class="aula"><?php echo $aula['nome']; ?>
			
				<?php if($aula['assistido'] === true):?>
					<img style="float:right;margin-right:10px;margin-top:5px" src="<?php echo BASE_URL; ?>/assets/images/assistido.png" border="0" height="20"/>
				<?php endif; ?>

			</div></a>
		<?php endforeach; ?>
	<?php endforeach; ?>
	
	
</div>
<div class="curso_right">
	<h1>Questionário</h1>
	
	<?php if($_SESSION['poll'.$aula_info['id_aula']] > 2){
		echo "EXCEDEU O LIMITE DE TENTATIVAS DE RESPOSTA";
	}else{
		echo "Tentativa: ".$_SESSION['poll'.$aula_info['id_aula']].' de 2';
		?>
	
	
		<h3><?php echo $aula_info['pergunta']; ?></h3>
		<form method="POST">
			<input type="radio" name="opcao" value="1" id="opcao1"/>
			<label for="opcao1"><?php echo utf8_encode($aula_info['opcao1']); ?></label><br/><br/>
		
			<input type="radio" name="opcao" value="2" id="opcao2"/>
			<label for="opcao2"><?php echo utf8_encode($aula_info['opcao2']); ?></label><br/><br/>
		
			<input type="radio" name="opcao" value="3" id="opcao3"/>
			<label for="opcao3"><?php echo utf8_encode($aula_info['opcao3']); ?></label><br/><br/>
		
			<input type="radio" name="opcao" value="4" id="opcao4"/>
			<label for="opcao4"><?php echo utf8_encode($aula_info['opcao4']); ?></label><br/><br/>
		
			<input type="submit" value="Enviar Resposta"/><br/><br/>
		</form>
		<?php
			if(isset($resposta)){
				if($resposta === true){
					echo "RESPOSTA CORRETA !!";
				}else{
					echo "RESPOSTA ERRADA !!";
				}
			}
		?>
	<?php } ?>	
	
</div>



















