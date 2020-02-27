<?php

	class Alunos extends Model{

		public function __construct(){
			parent::__construct();
		}

		public function verificaAluno($email, $id = ''){
			if(!empty($id)){

				$sql = "SELECT * FROM alunos WHERE email = '$email' AND id = '$id'";

			}else{
				$sql = "SELECT * FROM alunos WHERE email = '$email'";
			}
			
			$sql = $this->pdo->query($sql);

			if($sql->rowCount() >0){
				return true;
			}else{
				return false;
			}

		}

		public function getAlunos(){

			$retorno = array();

			$sql ="SELECT *, (select count(*) from aluno_curso where alunos.id = aluno_curso.id_aluno) as qt_cursos FROM alunos"; 
			$sql = $this->pdo->query($sql);
			if($sql->rowCount() > 0){
				$retorno = $sql->fetchAll();
			}

			return $retorno;

		}

		public function getAluno($id){

			$retorno = array();

			$sql = "SELECT * FROM alunos WHERE id = '$id'";
			$sql = $this->pdo->query($sql);

			if($sql->rowCount() > 0){
				$retorno = $sql->fetch();
			}

			return $retorno;

		}

		public function delAluno($id){

			$this->pdo->query("DELETE FROM duvidas WHERE id_aluno = '$id'");
			$this->pdo->query("DELETE FROM historico WHERE id_aluno = '$id'");
			$this->pdo->query("DELETE FROM aluno_curso WHERE id_aluno = '$id'");
			$this->pdo->query("DELETE FROM alunos WHERE id = '$id'");

		}

		public function addAluno($nome, $email, $senha){

			$sql = "INSERT INTO alunos SET nome = '$nome', email = '$email', senha = '$senha'";
			$sql = $this->pdo->query($sql);
		}

		public function editarAluno($nome, $email, $senha, $cursos, $id){

			$sql = "UPDATE alunos SET nome = '$nome', email = '$email', senha = '$senha' WHERE id = '$id'";
			$sql = $this->pdo->query($sql);

			$sql = "DELETE FROM aluno_curso WHERE id_aluno = '$id'";
			$sql = $this->pdo->query($sql);

			foreach($cursos as $curso){
				$sql = "INSERT INTO aluno_curso SET id_aluno = '$id', id_curso = '$curso'";
				$sql = $this->pdo->query($sql);
			}
			
		}
	}

?>