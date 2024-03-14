<?php
class ClienteRepository implements Repository{
    public static function listAll(){
        $db = DB::getInstance();

        $sql = "SELECT * FROM table WHERE id=:id";
        $query = $db->prepare($sql);
        $query->execute();
        
        $list = array();
        foreach($query->fetchAll(PDO::FETCH_OBJ) as $row){
            $cliente = new Cliente;
            $cliente->setId($row->id);
            $cliente->setNome($row->nome);
            $cliente->setTelefone($row->telefone);
            $cliente->setCpf($row->cpf);
            $cliente->setRg($row->rg);
            $cliente->setDataNascimento($row->data_nascimento); 
            $cliente->setDataInclusao($row->data_inclusao);
            $cliente->setDataAlteracao($row->data_alteracao);
            $cliente->setInclusaoFuncionarioId($row->inclusao_funcionario_id);
            $cliente->setAlteracaoFuncionarioId($row->alteracao_funcionario_id);
            $list[] = $cliente;
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
            $cliente = new Cliente;
            $cliente->setId($row->id);
            $cliente->setNome($row->nome);
            $cliente->setTelefone($row->telefone);
            $cliente->setCpf($row->cpf);
            $cliente->setRg($row->rg);
            $cliente->setDataNascimento($row->data_nascimento); 
            $cliente->setDataInclusao($row->data_inclusao);
            $cliente->setDataAlteracao($row->data_alteracao);
            $cliente->setInclusaoFuncionarioId($row->inclusao_funcionario_id);
            $cliente->setAlteracaoFuncionarioId($row->alteracao_funcionario_id);
            return $cliente;
        }
        return null; //retorna nulo se não encontrar o autor com esse ID no banco de dados.
    }
    public static function insert($obj){
        $db = DB::getInstance() ;//cria uma instancia da classe db (conexão com o bd).]
        $sql = "INSERT INTO cliente (nome, telefone, cpf, rg, data_nascimento, data_inclusao, inclusao_funcionario_id) VALUES(:nome, :telefone, :cpf, :rg, :data_nascimento, :data_inclusao, : inclusao_funcionario_id)";

        $query = $db->prepare($sql);//prepara a query para ser executada.
        $query->bindValue(":nome", $obj->getNome());
        $query->bindValue(":telefone", $obj->getTelefone());
        $query->bindValue(":cpf", $obj->getCpf());
        $query->bindValue(":rg", $obj->getRg());
        $query->bindValue(":data_nascimento", $obj->getDataNascimento());
        $query->bindValue(":data_inclusao", $obj->getNome());
        $query->bindValue(":inclusao_funcionario_id", $obj->getNome());
        $query->execute();
        $id = $db->lastInsertId();//recupera o último Id inserido no BD.
        return $id;
    }
    public static function update($obj){
        $db = DB::getInstance();
        $sql = "UPDATE cliente SET nome = :nome, telefone = :telefone, cpf = : cpf, rg = :rg data_nascimento = :data_nascimento, data_alteracao = :data_alteracao, alteracao_funcionario_id = :alteracao_funcionario_id WHERE id = :id";

        $query = $db->prepare($sql);//prepara a query para ser executada.
        $query->bindValue(':id', $obj->getId(),);
        $query->bindValue(':nome', $obj->getNome());
        $query->bindValue(':telefone' ,$obj->getTelefone());
        $query->bindValue(':cpf' ,$obj->getCpf());
        $query->bindValue(':rg' ,$obj->getRg());
        $query->bindValue(':data_nascimento' ,$obj->getDataNascimento());
        $query->bindValue(':data_alteracao', $obj->getDataAlteracao());
        $query->bindValue(':alteracao_funcionario_id', $obj->getAlteracaoFuncionarioId());
        $query->execute();
    }
    public static function delete($obj){
        $db = DB::getInstance();
        $sql = "DELETE FROM cliente WHERE id = :id";
        $query = $db->prepare($sql);
        $query->bindValue(':id', $obj->getId());
        $query->execute();
    }

}
?>