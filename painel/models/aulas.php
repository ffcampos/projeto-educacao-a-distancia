<?php

	class Aulas extends Model{
		
		public function __construct(){
			parent::__construct();
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
	}
?>