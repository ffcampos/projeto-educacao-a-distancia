<?php

	class homeController extends Controller{
		
		public function __construct(){
			
			parent::__construct();
			$aluno = new Alunos();
			if(!$aluno->isLogged()){
				header("Location: ".BASE_URL."/login");
			}
			
		}
		
		public function index(){
			
			$dados = array(
							"info" => array(),
							"cursos" => array()
							);
			
			$alunos = new Alunos();
			$alunos->setAluno($_SESSION['aluno']);
			//ENVIANDO INFORMAÇÕES DOS ALUNOS PARA O INFO (A SER USADO NO VIEW)
			$dados['info'] = $alunos;
			
			$cursos = new Cursos();
			$dados['cursos'] = $cursos->getCursosDoAluno($alunos->getId());
			
			$this->loadTemplate("home", $dados);
		}
		
	}
?>