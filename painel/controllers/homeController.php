<?php

	class homeController extends Controller{
		
		public function __construct(){
			
			parent::__construct();
			$usuarios = new Usuarios();
			if(!$usuarios->isLogged()){
				header("Location: ".BASE_URL."/login");
			}
			
		}
		
		public function index(){
			
			$dados = array("cursos" => array());
			$cursos = new Cursos();
			$dados['cursos'] = $cursos->getCursos();
			
			$this->loadTemplate("home", $dados);
		}
		
		public function excluir($id){
			if(isset($id) && !empty($id)){
				$id = addslashes($id);
				$cursos = new Cursos();
				$cursos->excluirCurso($id);
			}
			header("Location: ".BASE_URL);
			
		}
		
		public function adicionar(){
			$dados = array();
			$cursos = new Cursos();
			if(isset($_POST['nome']) && !empty($_POST['nome'])){
				$nome = addslashes($_POST['nome']);
				$descricao = addslashes($_POST['descricao']);
				$imagem = $_FILES['imagem'];
				
				if(!empty($imagem['tmp_name'])){
					
					$md5Name = md5(time().rand(0,9999)).'.jpg';
					$types = array('image/jpg', 'image/png', 'image/jpeg');
					if(in_array($imagem['type'], $types)){
						move_uploaded_file($imagem['tmp_name'], "../assets/images/cursos/".$md5Name);
						$cursos->addCurso($nome, $descricao, $md5Name);
						header("Location: ".BASE_URL);
					}
					
				}
			}
			
			$this->loadTemplate("cursos_add", $dados);
		}
		
		public function editar($id){
			$dados = array(
							"curso" => array(),
							"modulos" => array()
							);
			$cursos = new Cursos();
			$modulos = new Modulos();
			$aulas = new Aulas();
			
			$dados['curso'] = $cursos->getCursoById($id);
			$dados['modulos'] = $modulos->getAulasDoModulo($id);
			
			// USUARIO ADICIONOU AULA NOVA
			if(isset($_POST['aula']) && !empty($_POST['aula'])){
				$aula = addslashes($_POST['aula']);
				$moduloAula = addslashes($_POST['moduloAula']);
				$tipo = addslashes($_POST['tipo']);

				$aulas->addAula($moduloAula, $id, $tipo, $aula);

			}

			if(isset($_POST['modulo']) && !empty($_POST['modulo'])){
				$modulo = utf8_decode(addslashes($_POST['modulo']));
				$modulos->adicionarModulo($modulo, $id);
				header("Location: ".BASE_URL."/home/editar/".$id);
			}
			
			if(isset($_POST['nome']) && !empty($_POST['nome'])){
				$nome = addslashes($_POST['nome']);
				$descricao = addslashes($_POST['descricao']);
				$imagem = $_FILES['imagem'];
				
				if(!empty($imagem['tmp_name'])){
					
					$md5Name = md5(time().rand(0,9999)).'.jpg';
					$types = array('image/jpg', 'image/png', 'image/jpeg');
					if(in_array($imagem['type'], $types)){
						move_uploaded_file($imagem['tmp_name'], "../assets/images/cursos/".$md5Name);
						
					}
				}else{
					$md5Name = "";
				}
				
				
				$cursos->updateCurso($id, $nome, $descricao, $md5Name);
				header("Location: ".BASE_URL);
			}
			
			
			

			$this->loadTemplate("curso_edit", $dados);
		}
		
		public function del_modulo($id){
			if(isset($id) && !empty($id)){
				$modulos = new Modulos();
				$id_curso = $modulos->deleteModulo($id);
			}
			header("Location: ".BASE_URL."/home/editar/".$id_curso);
			
		}
		
		public function edit_modulo($id){
			if(isset($id) && !empty($id)){
				$id = addslashes($id);
				
				$dados = array();
				$modulos = new Modulos();
				if(isset($_POST['modulo']) && !empty($_POST['modulo'])){
					$modulo = utf8_decode(addslashes($_POST['modulo']));
					$id_curso = $modulos->updateModulo($modulo, $id);
					header("Location: ".BASE_URL."/home/editar/".$id_curso);
				}
				
				$dados['modulo'] = $modulos->getModulo($id);
				
				$this->loadTemplate("curso_edit_modulo", $dados);
			}
		}

		public function del_aula($id){

			if(isset($id) && !empty($id)){
				$id = addslashes($id);
				$aulas = new Aulas();
				$id_curso = $aulas->deleteAula($id);
				header("Location: ".BASE_URL."/home/editar/".$id_curso['id_curso']);

			}
		}

		public function edit_aula($id){
			$dados = array("aula" => array());
			$view = 'curso_edit_aula_video';

			$aulas = new Aulas();
			$dados['aula'] = $aulas->getAula($id);

			if($dados['aula']['tipo'] == 'poll'){
				$view = 'curso_edit_aula_poll';

			}

			if(isset($_POST['nome']) && !empty($_POST['nome'])){

				$nome = addslashes($_POST['nome']);
				$descricao = addslashes($_POST['descricao']);
				$url = addslashes($_POST['url']);
				$id_curso = $aulas->editAulaVideo($id, $nome, $descricao, $url);
				header("Location: ".BASE_URL."/home/editar/".$id_curso['id_curso']);

			}

			if(isset($_POST['pergunta']) && !empty($_POST['pergunta'])){

				$pergunta = utf8_decode(addslashes($_POST['pergunta']));
				$opcao1 = utf8_decode(addslashes($_POST['opcao1']));
				$opcao2 = utf8_decode(addslashes($_POST['opcao2']));
				$opcao3 = utf8_decode(addslashes($_POST['opcao3']));
				$opcao4 = utf8_decode(addslashes($_POST['opcao4']));
				$resposta = addslashes($_POST['resposta']);

				$id_curso = $aulas->editAulaPoll($pergunta, $opcao1, $opcao2, $opcao3, $opcao4, $resposta, $id);
				header("Location: ".BASE_URL."/home/editar/".$id_curso['id_curso']);

			}

			$this->loadTemplate($view, $dados);
		}
	}
?>
















