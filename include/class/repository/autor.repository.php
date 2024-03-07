<?php
class AutorRepository implements Repository{
    public static function listAll(){
        $db = DB::getInstance();

        $sql = "SELECT * FROM table WHERE id=:id";
        $query = $db->prepare($sql);
        $query->execute();
        
        $list = array();
        foreach($query->fetchAll(PDO::FETCH_OBJ) as $row){
            $autor = new Autor;
            $autor->setId($row->id);
            $autor->setNome($row->nome);
            $autor->setdataInclusao($row->data_inclusao);
            $autor->setInclusaoFuncionarioId($row->inclusao_funcionario_id);
            $autor->setAlteracaoFuncionarioId($row->alteracao_funcionario_id);
            $list[] = $autor;
        }
    return $list;
    }
    public static function get($id){
        $db = DB::getInstance();

        $sql = "SELECT * FROM table WHERE id=:id";
        $query = $db->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0){
            $row = $query->fetch(PDO::FETCH_OBJ);
            $autor = new Autor;
            $autor->setId($row->id);
            $autor->setNome($row->nome);
            $autor->setDataInclusao($row->data_inclusao);
            $autor->setInclusaoFuncionarioId($row->inclusao_funcionario_id);
            $autor->setAlteracaoFuncionarioId($row->alteracao_funcionario_id);
            return $autor;
        }
        return null; //retorna nulo se não encontrar o autor com esse ID no banco de dados.
    }
    public static function insert($obj){
        $db = DB::getInstance() ;//cria uma instancia da classe db (conexão com o bd).]
        $sql = "INSERT INTO autor (nome, data_inclusao, inclusao_funcionario_id) VALUES(:nome, :data_inclusao, : inclusao_funcionario_id)";

        $query = $db->prepare($sql);//prepara a query para ser executada.
        $query->bindValue(":nome", $obj->getNome());
        $query->bindValue(":data_inclusao", $obj->getNome());
        $query->bindValue(":inclusao_funcionario_id", $obj->getNome());
        $query->execute();
        $id = $db->lastInsertId();//recupera o último Id inserido no BD.
        return $id;
    }
    public static function update($obj){
        $db = DB::getInstance();
        $sql = "UPDATE autor SET nome = :nome, data_alteracao = :data_alteracao, alteracao_funcionario_id = :alteracao_funcionario_id WHERE id = :id";

        $query = $db->prepare($sql);//prepara a query para ser executada.
        $query->bindValue(':id', $obj->getId(),);
        $query->bindValue(':nome', $obj->getNome());
        $query->bindValue(':data_inclusao', $obj->getDataInclusao());
        $query->bindValue(':alteracao_funcionario_id', $obj->getAlteracaoFuncionarioId());
        $query->execute();
    }
    public static function delete($obj){
        $db = DB::getInstance();
        $sql = "DELETE FROM autor WHERE id = :id";
        $query = $db->prepare($sql);
        $query->bindValue(':id', $obj->getId());
        $query->execute();
    }

}
?>