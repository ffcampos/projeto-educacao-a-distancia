<?php

	class Modulos extends Model{
		public function __construct(){
			parent::__construct();
		}
		
		public function getModulos($id_curso){
			
			$retorno = array();
			$sql = "SELECT * FROM modulos WHERE id_curso = '$id_curso'";
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
	}
?>