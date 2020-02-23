<?php

	class Alunos extends Model{
		
		public function __construct(){
			
			parent::__construct();
		}
		
		private $info;
		
		public function isLogged(){
			
			if(isset($_SESSION['aluno']) && !empty($_SESSION['aluno'])){
				return true;
			}else{
				return false;
			}
		}
		
		public function fazerLogin($email, $senha){
									
			$sql = "SELECT * FROM alunos WHERE email = '$email' AND senha = '$senha'";
			$sql = $this->pdo->query($sql);
			
			if($sql->rowCount() > 0){
				$row = $sql->fetch();
				$_SESSION['aluno'] = $row['id'];
				return true;
			}
			
			return false;;
		}
		
		public function setAluno($id){
			
			$sql = "SELECT * FROM alunos WHERE id = '$id'";
			$sql = $this->pdo->query($sql);
			
			if($sql->rowCount() > 0){
				$this->info = $sql->fetch();
			}
		}
		
		public function getNome(){
			return $this->info['nome'];
		}
		
		public function getId(){
			return $this->info['id'];
		}
		
		public function isInscrito($id){
			
			$sql = "SELECT * FROM aluno_curso WHERE id_aluno = '".($this->info['id'])."' AND id_curso = '$id'";
			$sql = $this->pdo->query($sql);
			
			if($sql->rowCount() > 0){
				return true;
			}else{
				return false;
			}
		}
		
	}
?>















