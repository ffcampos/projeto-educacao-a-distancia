<?php

	class Modulos extends Model{
		
		public function __construct(){
			parent::__construct();
		}
		
		public function getModulo($id){
			
			$retorno = array();
			$sql = "SELECT * FROM modulos WHERE id = '$id'";
			$sql = $this->pdo->query($sql);
			
			if($sql->rowCount() > 0){
				$retorno = $sql->fetch();
			}
			return $retorno;
			
		}
		public function getAulasDoModulo($id){
			
			$retorno = array();
			$sql = "SELECT * FROM modulos WHERE id_curso = '$id'";
			$sql = $this->pdo->query($sql);
			
			if($sql->rowCount() > 0){
				$retorno = $sql->fetchAll();
				
				$aulas = new Aulas();
				
				//PUXANDO AS AULAS E OS MÓDULOS
				
				foreach($retorno as $mChave => $mDados){
					$retorno[$mChave]['aulas'] = $aulas->getAulasDoModulo($mDados['id']);
					
				}
			}
			
			
			return $retorno;
		}
		
		public function adicionarModulo($modulo, $id){
			
			$sql = "INSERT INTO modulos SET nome = '$modulo', id_curso = '$id'";
			$sql = $this->pdo->query($sql);
			
		}
		
		public function deleteModulo($id){
			
			$retorno = 0;
			$sql = "SELECT id_curso FROM modulos WHERE id = '$id'";
			$sql = $this->pdo->query($sql);
			
			if($sql->rowCount() > 0){
				$sql = $sql->fetch();
				$retorno = $sql['id_curso'];
				
			}
			
			$sql = "DELETE FROM modulos WHERE id = '$id'";
			$sql = $this->pdo->query($sql);
			
			return $retorno;
		}
		
		public function updateModulo($modulo, $id){
			$retorno = 0;
			$sql = "SELECT id_curso FROM modulos WHERE id = '$id'";
			$sql = $this->pdo->query($sql);
			
			if($sql->rowCount() > 0){
				$sql = $sql->fetch();
				$retorno = $sql['id_curso'];
				
			}
			
			$sql = "UPDATE modulos SET nome = '$modulo' WHERE id = '$id'";
			$sql = $this->pdo->query($sql);
			
			return $retorno;
			
		}
		
		
	}
?>



















