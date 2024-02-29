<?php
class Cliente{
    private $id;
    private $nome;
    private $telefone;
    private $email;
    private $cpf;
    private $rg;
    private $data_nascimento;
    private $data_inclusao;
   private $data_alteracao;
   private $inclusao_funcionario_id;
   private $alteracao_funcionario_id;
   public function getId(){
    return $this->id;
}
public  function setId($id){
    $this->id = $id;
}
public function getNome() {
    return $this->nome;
}
public  function setNome($id){
    $this->nome = $nome;
}
public function setTelefone(){
    $this->telefone= $telefone;
}
   public function getDataInclusao(){
    return $this->data_inclusao;
}
public  function setDataInclusao(){
    $this-> data_inclusao = data_inclusao;
}
public function getDataAlteracao(){
    return $this->data_alteracao;
}
public  function setDataalteracao(){
    $this-> data_alteracao = data_alteracao;
}
public function getInclusaoFuncionarioId(){
    return $this->inclusao_funcionario_id;
}
public  function setInclusaoFuncionarioId(){
    $this->inclusao_funcionario_id = inclusao_funcionario_id;
}
public function getAlteracaoFuncionarioId(){
    return $this->alteracao_funcionario_id;
}
public  function setAlteracaoFuncionarioId(){
    $this-> alteracao_funcionario_id = alteracao_funcionario_id;
}
}