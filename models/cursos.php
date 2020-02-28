<?php

	class Cursos extends Model{
		
		public function __construct(){
			parent::__construct();
		}
		private $info;
		
		public function getCursosDoAluno($id){
			
			$retorno = array();
			// PEGANDO PRIMEIRO OS CURSOS QUE O ALUNO ESTA MATRICULADO E DEPOIS AS INFORMAÇÕES DOS CURSOS
			$sql = "SELECT aluno_curso.id_curso, cursos.id, cursos.nome, cursos.descricao, cursos.imagem FROM cursos LEFT JOIN aluno_curso ON cursos.id = aluno_curso.id_curso WHERE aluno_curso.id_aluno = '$id'";
			$sql = $this->pdo->query($sql);
			if($sql->rowCount() > 0){
				$retorno = $sql->fetchAll();
			}
			return $retorno;
		}
		
		public function setCurso($id){
							
			$sql = "SELECT * FROM cursos WHERE id = '$id'";
			$sql = $this->pdo->query($sql);
			
			if($sql->rowCount() > 0){
				$this->info = $sql->fetch();
			}					
		}
		
		public function getNome(){
			return $this->info['nome'];
		}
		public function getImagem(){
			return $this->info['imagem'];
		}
		public function getDescricao(){
			return $this->info['descricao'];
		}
		public function getId(){
			return $this->info['id'];
		}

		public function getTotalAulas(){

			$sql = "SELECT id FROM aulas WHERE id_curso = '".($this->getId())."'";
			$sql = $this->pdo->query($sql);

			return $sql->rowCount();
		}
	}
?>






















