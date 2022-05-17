<?php

namespace App\Entity;

use App\Db\Database;
use \PDO;

class Vaga{
    
    //id da vaga
    public $id;

    //Titulo da vaga
    public $titulo;

    //Descrição da vaga
    public $descricao;

    //Status da vaga 
    public $ativo;

    //Data de publicação
    public $data;

    //metodo responsavel por cadastrar nova vaga
    public function cadastrar() {

        //definir data
        $this->data = date('Y-m-d H:i:s');

        //inserir a vaga no banco
        $obDatabase = new Database('vagas');
        $this->id = $obDatabase->insert([
                                        'titulo'     => $this->titulo, 
                                        'descricao'  => $this->descricao,
                                        'ativo'      => $this->ativo,
                                        'data'       => $this->data
                                        ]);                              
        
        //retornar sucesso
        return true;           
    }

    //metodo responsavel por atualizar os dados do banco
    public function atualizar() {
        return (new Database('vagas'))->update('id =' .$this->id,[
                                                                'titulo'     => $this->titulo, 
                                                                'descricao'  => $this->descricao,
                                                                'ativo'      => $this->ativo,
                                                                'data'       => $this->data
                                                                ]);

    }

    //metodo responsavel por excluir vagas
    public function excluir () {
        return (new Database('vagas'))->delete('id = '.$this->id);

    }

    //metodo responsavel por pegar as vagas registradas no banco 
    public static function getVagas ($where = null, $order = null, $limit = null){
        return (new Database('vagas'))->select($where,$order,$limit)
                                      ->fetchAll(PDO::FETCH_CLASS, self::class); 
    }

    //metodo responsavel por buscar vagas por ID
    public static function getVaga($id) {

        return (new Database('vagas'))->select('id = ' .$id)
                                      ->fetchObject(self::class);
    
    }

}


?>