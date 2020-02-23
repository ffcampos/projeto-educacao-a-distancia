<!DOCTYPE html>
<html lang="pt=br">
<head>
	<title>Login Painel Administrativo</title>
	<meta charset="UTF-8"/>
	<meta name="viewport" id="viewport" content="width=device-width,initial-scale=1"/>
	<style type="text/css">
		form{
			width: 300px;
			height: 300px;
			background-color: #DDD;
			margin: auto;
			margin-top: 30px;
			padding: 20px;
			border-radius: 10px;
		}
		#tEmail{
			width: 263px;
		}
		#tSenha{
			width: 263px;
		}
		input{
			width: 300px;
			padding: 15px;
			font-size: 14px;
		}
		.erro{
			width: 300px;
			height: 50px;
			line-height: 50px;
			border-radius: 10px;
			margin:auto;
			margin-top: 10px;
			text-align: center;
			margin: 1px solid #DDD;
			background-color: red;
		}
	</style>
</head>
	<body>
		
		
		<form method="POST">
			<h2>Login Painel</h2>
			<input type="email" name="email" id="tEmail" placeholder="E-mail" required autofocus/><br/><br/>
			<input type="password" name="senha" id="tSenha" placeholder="Senha" required/><br/><br/>
			<input type="submit" value="Logar"/>
		</form>
		<?php if(!empty($viewData['erro'])): ?>
			<div class="erro"><?php echo $viewData['erro']; ?></div>
		<?php endif; ?>
	</body>
</html>