<?php 

	class loginController extends Controller{
		
		public function __construct(){
			
			parent::__construct();
		}
		
		public function index(){
			
			$dados = array("erro" => '');
			if(isset($_POST['email']) && !empty($_POST['email'])){
				$email = addslashes($_POST['email']);
				$senha = md5(addslashes($_POST['senha']));
				$aluno = new Alunos();
				if($aluno->fazerLogin($email, $senha)){
					header("Location: ".BASE_URL);
				}else{
					$dados['erro'] = "USUÁRIO E/OU SENHA INCORRETOS !!";
				}
				
			}
			$this->loadView("login", $dados);
			
		}
		
		public function logout(){
			unset($_SESSION['aluno']);
			header("Location: ".BASE_URL);
		}
		
	}


?>