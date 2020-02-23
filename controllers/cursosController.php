<?php

	class cursosController extends Controller{
		
		public function __construct(){
			parent::__construct();
			$alunos = new Alunos();
			if(!$alunos->isLogged()){
				header("Location: ".BASE_URL."/login");
			}
		}
		
		public function index(){
			header("Location: ".BASE_URL);
		}
		
		public function entrar($id_curso){
			$dados = array(
							"info" => array(),
							"curso" => array(),
							"moculos" => array()
							);
			
			//VERIFICANDO SE O ALUNO PERTENCE REALMENTE AQUELE CURSO 
			$alunos = new Alunos();
			$alunos->setAluno($_SESSION['aluno']);
			$dados['info'] = $alunos;
			
			if($alunos->isInscrito($id_curso)){
				
				$cursos = new Cursos();
				$cursos->setCurso($id_curso);
				$dados['curso'] = $cursos;
				
				$modulos = new Modulos();
				$dados['modulos'] = $modulos->getModulos($id_curso);
				
				$this->loadTemplate("curso_entrar", $dados);
				
			}else{
				header("Location: ".BASE_URL);
			}
		}
		
		public function aula($id_aula){
			
			$dados = array(
							"info" => array(),
							"curso" => array(),
							"modulos" => array(),
							"aula_info" => array()
							);
			$alunos = new Alunos();
			$alunos->setAluno($_SESSION['aluno']);
			$dados['info'] = $alunos;
			
			//PEGANDO O CURSO REFERENTE A AULA SELECIONADA
			$aula = new Aulas();
			$id_curso = $aula->getCursoDeAula($id_aula);
			
			if($alunos->isInscrito($id_curso)){
				$curso = new Cursos();
				$curso->setCurso($id_curso);
				$dados['curso'] = $curso;
				
				$modulos = new Modulos();
				$dados['modulos'] = $modulos->getModulos($id_curso);
				
				$dados['aula_info'] = $aula->getAula($id_aula, $alunos->getId());
				
				//DEFININDO QUAL VIEW CHAMAR MEDIANTE O RETORNO DA AULA
				if($dados['aula_info']['tipo'] == 'video'){
					$view = 'curso_aula_video';
				}else{
					$view = 'curso_aula_poll';
					
					if(!isset($_SESSION['poll'.$id_aula])){
						$_SESSION['poll'.$id_aula] = 1;
					}
					
				}
				
				//RECEBENDO DUVIDAS
				if(isset($_POST['duvida']) && !empty($_POST['duvida'])){
					
					$duvida = addslashes($_POST['duvida']);
					$aula->setDuvida($duvida, $alunos->getId());
				}
				
				//RECEBENDO RESPOSTA QUESTIONARIO
				if(isset($_POST['opcao']) && !empty($_POST['opcao'])){
					$opcao = addslashes($_POST['opcao']);
					
					if($opcao == $dados['aula_info']['resposta']){
						$dados['resposta'] = true;
					}else{
						$dados['resposta'] = false;
					}
					
					$_SESSION['poll'.$id_aula]++;
				}
				
				$this->loadTemplate($view, $dados);
			}else{
				header("Location: ".BASE_URL);
			}
			
		}
	}

?>





















