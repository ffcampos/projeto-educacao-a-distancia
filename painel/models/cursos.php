<?php

	class Cursos extends Model{
		public function __construct(){
			
			parent::__construct();
			
		}

				
		public function getCursos(){
			$retorno = array();
			$sql = "SELECT *, (select count(*) from aluno_curso where aluno_curso.id_curso = cursos.id) as qt_alunos FROM cursos ORDER BY cursos.nome ASC";
			$sql = $this->pdo->query($sql);
			
			if($sql->rowCount() > 0){
				$retorno = $sql->fetchAll();
			}
			
			return $retorno;
		}
		
		public function excluirCurso($id_curso){
			
			$sql = "SELECT id FROM aulas WHERE id_curso = '$id_curso'";
			$sql = $this->pdo->query($sql);
			
			
			if($sql->rowCount() > 0){
				$aulas = $sql->fetchAll();
				foreach($aulas as $aula){
					
					$sqlAula = "DELETE FROM historico WHERE id_aula = '".($aula['id_aula'])."'";
					$sqlAula = $this->pdo->query($sqlAula);
					
					$sqlAula = "DELETE FROM questionarios WHERE id_aula = '".($aula['id_aula'])."'";
					$sqlAula = $this->pdo->query($sqlAula);
					
					$sqlAula = "DELETE FROM videos WHERE id_aula = '".($aula['id_aula'])."'";
					$sqlAula = $this->pdo->query($sqlAula);
					
				}
			}
						
			$sql = "DELETE FROM aluno_curso WHERE id_curso = '$id_curso'";
			$sql = $this->pdo->query($sql);
			
			$sql = "DELETE FROM aulas WHERE id_curso = '$id_curso'";
			$sql = $this->pdo->query($sql);
			
			$sql = "DELETE FROM modulos WHERE id_curso = '$id_curso'";
			$sql = $this->pdo->query($sql);
			
			$sql = "DELETE FROM cursos WHERE id = '$id_curso'";
			$sql = $this->pdo->query($sql);
			
		}
		
		public function addCurso($nome, $descricao, $imagem){			
			
			$sql = "INSERT INTO cursos SET nome = '$nome', imagem = '$imagem', descricao = '$descricao'";
			$sql = $this->pdo->query($sql);
			
		}
		
		public function getCursoById($id){
			$retorno = array();
			
			$sql = "SELECT * FROM cursos WHERE id = '$id'";
			$sql = $this->pdo->query($sql);
			
			if($sql->rowCount() > 0){
				$retorno = $sql->fetch();
			}
			
			return $retorno;
		}
		
		public function updateCurso($id, $nome, $descricao, $md5Name){
			
			if(!empty($md5Name)){
				
				$sql = "UPDATE cursos SET nome = '$nome', descricao = '$descricao', imagem = '$md5Name' WHERE id = '$id'";
				
			}else{
				
				$sql = "UPDATE cursos SET nome = '$nome', descricao = '$descricao' WHERE id = '$id'";
			}
			$sql = $this->pdo->query($sql);
		}

		public function getCursosInscrito($id_aluno){
			$retorno = array();

			$sql = "SELECT id_curso FROM aluno_curso WHERE id_aluno = '$id_aluno'";
			$sql = $this->pdo->query($sql);

			if($sql->rowCount() > 0){

				$rows = $sql->fetchAll();
				foreach($rows as $row){
					$retorno[] = $row['id_curso'];
				}
			}

			return $retorno;
		}
		
		
	}

?>












