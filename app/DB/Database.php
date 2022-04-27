<?php

    namespace App\Db;

    use PDO;
use PDOException;

    class Database {

        //host de conexão
        const Host = 'localhost';

        //nome do banco de dados 
        const NAME = 'crudvagas';

        //usuario do banco 
        const USER = 'root';

        //senha de acesso ao banco 
        const PASS  = '';

        //tabela a ser manipulada 
        private $table;

        //instantica de banco de dados 
        private $connection;

        //define tabela, instanticia e conexão
        public function __construct($table = null){
            $this->table = $table;
            $this->setConnection();
            
        }

        //metodo responsavel para criar uma conexão com o banco
        private function setConnection(){
            try{

                $this->connection = new PDO('mysql:host='.self::Host.';dbname='.self::NAME,self::USER,self::PASS);

                $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            }catch(PDOException $e){

                die('Error: ' .$e->getMessage());

            }


        }
    }
?>