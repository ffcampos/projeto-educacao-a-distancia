<?php

	class Aulas extends Model{
		
		public function __construct(){
			parent::__construct();
		}
		
		public function getAulasDoModulo($id){
			$retorno = array();
			
			$sql = "SELECT * FROM aulas WHERE id_modulo = '$id' ORDER BY ordem";
			$sql = $this->pdo->query($sql);
			
			if($sql->rowCount() > 0){
				$retorno = $sql->fetchAll();
				foreach($retorno as $aulaChave => $aula){
					if($aula['tipo'] == 'video'){
						
						$sql = "SELECT nome FROM videos WHERE id_aula = '".($aula['id'])."'";
						$sql = $this->pdo->query($sql)->fetch();
						
						$retorno[$aulaChave]['nome'] = $sql['nome'];
						
					}elseif($aula['tipo'] == 'poll'){
						
						$retorno[$aulaChave]['nome'] = "Questionario";
					}
					
				}
			}
			
			return $retorno;
		}

		public function deleteAula($id){
			$retorno = array();

			$sql = "SELECT id_curso FROM aulas WHERE id = '$id'";
			$sql = $this->pdo->query($sql);

			if($sql->rowCount() > 0){
				$retorno = $sql->fetch();

				$sql = "DELETE FROM historico WHERE id_aula = '$id'";
				$sql = $this->pdo->query($sql);

				$sql = "DELETE FROM videos WHERE id_aula = '$id'";
				$sql = $this->pdo->query($sql);

				$sql = "DELETE FROM questionarios WHERE id_aula = '$id'";
				$sql = $this->pdo->query($sql);

				$sql = "DELETE FROM aulas WHERE id = '$id'";
				$sql = $this->pdo->query($sql);
				
			}
			return $retorno;
		}

		public function addAula($moduloAula, $curso, $tipo, $aula){

			$sql = "SELECT ordem FROM aulas WHERE id_modulo = '$moduloAula' ORDER BY ordem DESC LIMIT 1 ";
			$sql = $this->pdo->query($sql);
			$ordem = 1;

			if($sql->rowCount() > 0){
				$sql = $sql->fetch();
				$ordem = intval($sql['ordem']);
				$ordem++;
			}

			$sql = "INSERT INTO aulas SET id_modulo = '$moduloAula', id_curso = '$curso', ordem = '$ordem', tipo = '$tipo'";
			$sql = $this->pdo->query($sql);
			$id_aula = $this->pdo->lastInsertId();

			if($tipo == 'video'){
				$sql = "INSERT INTO videos SET id_aula = '$id_aula', nome = '$aula'";				
				$sql = $this->pdo->query($sql);

			}else{
				$sql = "INSERT INTO questionarios SET id_aula = '$id_aula'";
				$sql = $this->pdo->query($sql);
			}

		}
	}
?>