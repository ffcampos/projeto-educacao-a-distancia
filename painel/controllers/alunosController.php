<?php

	class alunosController extends Controller{

		public function __construct(){
			parent::__construct();

			$user = new Usuarios();
			if(!$user->isLogged()){
				header("Location".BASE_URL."/login");
			}
		}

		public function index(){
			$dados = array("alunos" => array());

			$alunos = new Alunos();
			$dados['alunos'] = $alunos->getAlunos();

			$this->loadTemplate("alunos", $dados);
		}

		public function del_aluno($id){

			if(isset($id) && !empty($id)){

				$id = addslashes($id);
				$alunos = new Alunos();
				$alunos->delAluno($id);
				header("Location: ".BASE_URL."/alunos");

			}
		}

		public function adicionar(){

			$dados = array("erro" => '');

			if(isset($_POST['nome']) && !empty($_POST['nome'])){
				$nome = addslashes($_POST['nome']);
				$email = addslashes($_POST['email']);
				$senha = md5(addslashes($_POST['senha']));
				$alunos = new Alunos();
				if(!$alunos->verificaAluno($email)){

					$alunos->addAluno($nome, $email, $senha);
					header("Location: ".BASE_URL."/alunos");

				}else{
					$dados['erro'] = 'E-mail já cadastrado !';
				}

			}
			$this->loadTemplate("adicionar_aluno", $dados);
		}

		public function edit_aluno($id){

			$dados = array();

			$cursos = new Cursos();
			$alunos = new Alunos();
			$dados['aluno'] = $alunos->getAluno($id);
			$dados['cursos'] = $cursos->getCursos();
			$dados['inscritos'] = $cursos->getCursosInscrito($id);

			if(isset($_POST['nome']) && !empty($_POST['nome'])){

				$nome = addslashes($_POST['nome']);
				$email = addslashes($_POST['email']);
				
				$senha = md5(addslashes($_POST['senha']));
				$cursos = $_POST['cursos'];

				if($alunos->verificaAluno($email, $id) === true){

					$alunos->editarAluno($nome, $email, $senha, $cursos, $id);
					header("Location: ".BASE_URL."/alunos");
					
				}else{

					$dados['erro'] = 'E-MAIL JÁ CADASTRADO !!';
				}


			}

			$this->loadTemplate("editar_aluno", $dados);
		}

	}


?>