<?php

	class Aulas extends Model{
		
		public function __construct(){
			parent::__construct();
		}
		
		private function isAssistido($id_aula, $id_aluno){

			$sql = "SELECT * FROM historico WHERE id_aula = '$id_aula' AND id_aluno = '$id_aluno'";
			$sql = $this->pdo->query($sql);

			if($sql->rowCount() > 0){
				return true;
			}else{
				return false;
			}

		}

		public function getAulasDoModulo($id){
			$retorno = array();
			$aluno = $_SESSION['aluno'];
			
			$sql = "SELECT * FROM aulas WHERE id_modulo = '$id' ORDER BY ordem";
			$sql = $this->pdo->query($sql);
			
			if($sql->rowCount() > 0){
				$retorno = $sql->fetchAll();
				foreach($retorno as $aulaChave => $aula){
					$retorno[$aulaChave]['assistido'] = $this->isAssistido($aula['id'], $aluno);
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
		
		public function getCursoDeAula($id_aula){
			
			$sql = "SELECT id_curso FROM aulas WHERE id = '$id_aula'";
			$sql = $this->pdo->query($sql);
			
			if($sql->rowCount() > 0){
				$row = $sql->fetch();
				return $row['id_curso'];
			}else{
				return 0;
			}
			
		}
		
		public function getAula($id_aula, $id_aluno){
			$retorno = array();
			
			$sql = "SELECT aulas.tipo, (select count(*) from historico where historico.id_aula = aulas.id and historico.id_aluno = '$id_aluno') as assistido FROM aulas WHERE aulas.id = '$id_aula'";
			$sql = $this->pdo->query($sql);
			
			if($sql->rowCount() > 0){
				$row = $sql->fetch();
				
				if($row['tipo'] == 'video'){
					
					$sql = "SELECT * FROM videos WHERE id_aula = '$id_aula'";
					$sql = $this->pdo->query($sql);
					$retorno = $sql->fetch();
					
					//RESGATANDO O TIPO QUE NAO VAI PARA O ARRAY QUE SERA CARREGADO NO VIEW
					$retorno['tipo'] = 'video';
					
				}elseif($row['tipo'] == 'poll'){
					
					$sql = "SELECT * FROM questionarios WHERE id_aula = '$id_aula'";
					$sql = $this->pdo->query($sql);
					$retorno = $sql->fetch();
					
					$retorno['tipo'] = 'poll';
				}
				$retorno['assistido'] = $row['assistido'];
			}
			return $retorno;
		}
		
		public function setDuvida($duvida, $id_aluno){
			
			$data = date('Y-m-d H:i:s');
			$sql = "INSERT INTO duvidas SET data_duvida = '$data', duvida = '$duvida', id_aluno = '$id_aluno'";
			
			$sql = $this->pdo->query($sql);
			
		}
		
		public function marcarAssistido($id_aula, $data, $id_aluno){
			$sql = "INSERT INTO historico SET data_vista = '$data', id_aluno = '$id_aluno', id_aula = '$id_aula'";
			$sql = $this->pdo->query($sql);
		}


	}
?>











































