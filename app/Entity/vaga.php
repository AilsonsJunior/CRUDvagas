<?php

namespace App\Entity;

use App\Db\Database;

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
        echo "<pre>"; print_r($obDatabase); echo "</pre>"; exit;

        //atribuir o ID da vaga

        //retornar sucesso

    }
}

?>