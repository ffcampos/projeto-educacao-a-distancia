<?php

	class Model{
		
		protected $pdo;
		
		public function __construct(){
			global $config;
			
			try{
				
				$this->pdo = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'].";port=".$config['port'],$config['dbuser'], $config['dbpass']);
				
			}catch(PDOException $e){
				
				echo "FALHOU : ".$e->getMessage();
			}
		}
	}
?>