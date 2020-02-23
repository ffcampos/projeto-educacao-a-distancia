<?php

	class ajaxController extends Controller{
		
		public function __construct(){
			parent::__construct();
			$alunos = new Alunos();
			if(!$alunos->isLogged()){
				header("Location: ".BASE_URL."/login");
			}
		}
		
		public function marcar_assistido($id_aula){
			
			$aulas = new Aulas();
			$data = date('Y-m-d H:i:s');
			$id_aluno = $_SESSION['aluno'];
			$aulas->marcarAssistido($id_aula, $data, $id_aluno);
		}
	}
?>