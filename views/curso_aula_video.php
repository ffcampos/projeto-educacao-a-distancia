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
	<h1>Vídeo - <?php echo $aula_info['nome']; ?></h1>
	<iframe id="video" style="width:100%" frameborder="0" src="//player.vimeo.com/video/<?php echo $aula_info['url']; ?>"></iframe><br/>
	<?php echo $aula_info['descricao']; ?><br/>
	
	<?php if($aula_info['assistido'] == '1'): ?>
		<strong>AULA JÁ ASSITIDA</strong>
		<?php else: ?>
		<button onclick="marcarAssistido(this)" data-id=<?php echo $idAula; ?>>Marcar como assistido</button><br/>
	<?php endif; ?>
	
	<hr/>
	
	<h3>Dúvidas? Envie sua pergunta</h3>
	<form method="POST" class="form_duvida">
		<textarea name="duvida"></textarea><br/><br/>
		<input type="submit" value="Enviar Dúvida"/><br/>
	</form>
</div>