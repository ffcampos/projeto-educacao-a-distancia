<?php

	class Usuarios extends Model{
		public function __construct(){
			parent::__construct();
		}
		
		public function isLogged(){
			if(isset($_SESSION['admins']) && !empty($_SESSION['admins'])){
				return true;
			}else{
				return false;
			}
		}
		
		public function fazerLogin($email, $senha){
			
			$sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
			
			$sql = $this->pdo->query($sql);
			
			if($sql->rowCount() > 0){
				$row = $sql->fetch();
				$_SESSION['admins'] = $row['id'];
				return true;
			}
			return false;
		}
	}

?>