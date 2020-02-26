<?php

	class Aulas extends Model{
		
		public function __construct(){
			parent::__construct();
		}

		public function getAula($id_aula){
			$retorno = array();
			$sql = "SELECT tipo FROM aulas WHERE id = '$id_aula'";
			$sql = $this->pdo->query($sql);

			if($sql->rowCount() > 0){
				$row = $sql->fetch();
				if($row['tipo'] == 'video'){
					$sql = "SELECT nome, descricao, url FROM videos WHERE id_aula = '$id_aula'";
					$sql = $this->pdo->query($sql);
					if($sql->rowCount() > 0){
						$retorno = $sql->fetch();
						$retorno['tipo'] = 'video';
					}
				}else{
					$sql = "SELECT * FROM questionarios WHERE id_aula = '$id_aula'";
					$sql = $this->pdo->query($sql);
					if($sql->rowCount() > 0){
						$retorno = $sql->fetch();
						$retorno['tipo'] = 'poll';

					}
				}
			}


			return $retorno;

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

		public function editAulaVideo($id_aula, $nome, $descricao, $url){
			$retorno = 0;
			$sql = "SELECT id_curso FROM aulas WHERE id = '$id_aula'";
			$sql = $this->pdo->query($sql);

			if($sql->rowCount() > 0){
				$retorno = $sql->fetch();
			}

			$sql = "UPDATE videos SET nome = '$nome', descricao = '$descricao', url = '$url' WHERE id_aula = '$id_aula'";
			$sql = $this->pdo->query($sql);

			return $retorno;
		}

		public function editAulaPoll($pergunta, $opcao1, $opcao2, $opcao3, $opcao4, $resposta, $id){

			$retorno = array();
			$sql = "SELECT id_curso FROM aulas WHERE id = '$id'";
			$sql = $this->pdo->query($sql);

			if($sql->rowCount() > 0){
				$retorno = $sql->fetch();
			}

			$sql = "UPDATE questionarios SET pergunta = '$pergunta', opcao1 = '$opcao1', opcao2 = '$opcao2', opcao3 = '$opcao3', opcao4 = '$opcao4', resposta = '$resposta' WHERE id_aula = '$id'";
			$sql = $this->pdo->query($sql);

			return $retorno;
		}

	}
?>