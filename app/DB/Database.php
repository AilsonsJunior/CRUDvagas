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

        //metodos responsavel por executar as queries dentro do banco 
        public function execute($query, $params = []) {
            try{

                $statement = $this->connection->prepare($query);
                $statement->execute($params);
                return $statement;

            }catch(PDOException $e){

                die('Error: ' .$e->getMessage());

            }
        }

        //metodo responsável por inserir dados no banco.
        public function insert($values){
            //dados da query
            $fields = array_keys($values);
            $binds = array_pad([], count($fields), '?');

            //montando a query
            $query =  'INSERT INTO '.$this->table.' ('.implode(',',$fields).') VALUES ('.implode(',',$binds).')';

            //executa o insert
            $this->execute($query, array_values($values));

            //retorna a ID
            return $this->connection->lastInsertId();
        }

        //metodo responsavel por realizar a consulta no banco 
        public function select ($where = null, $order = null, $limit = null, $fields='*'){

            //dados da query
            $where = strlen($where) ? 'WHERE '.$where : '';
            $order = strlen($order) ? 'ORDER BY '.$order : '';
            $limit = strlen($limit) ? 'LIMIT '.$limit : '';

            //montando a query
            $query = 'SELECT '.$fields.' FROM '.$this->table.' '.$where.' '.$order.' '.$limit;

            return $this->execute($query);
        }

        //metodo responsavel por atulizar dados no banco de dados.
        public function update($where, $values) {

            //dados da querry
            $fields = array_keys($values);

            //montando a query
            $query = 'UPDATE '.$this->table.' SET '.implode('=?,',$fields).'=? WHERE '.$where;

            //executa a query
            $this->execute($query,array_values($values));

            return true;
        }

        //metodo responsavel por excluir dados do banco.
        public function delete ($where) {

            //montando a query
            $query = 'DELETE FROM '.$this->table.' WHERE '.$where;

            //excuta a query
            $this->execute($query);

            //retorna sucesso
            return true;

        }

    }
?>