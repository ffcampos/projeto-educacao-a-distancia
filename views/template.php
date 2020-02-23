<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Plataforma EAD</title>
	<meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
	
	
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
	
	<link href="<?php echo BASE_URL;?>/assets/css/style.css" rel="stylesheet"/>
	
	

</head>
<body>
	<div class="topo">
	
		<a href="<?php echo BASE_URL; ?>/login/logout"><div>Sair</div></a>
		<div class="topo_usuario"><?php echo $viewData['info']->getNome(); ?></div>
		
	</div>
	
	<div class="container">
		<?php $this->loadViewInTemplate($viewName, $viewData);?>
	</div>
	
</body>

</html>