<?php

class Cliente
{

  var $nome;
  var $cpf_cnpj;
  var $telefone;
  var $email;
  var $cep;
  var $endereco;
  var $bairro;
  var $numero;
  var $cidade;
  var $uf;

  function __construct(
    $nome,
    $cpf_cnpj,
    $telefone,
    $email,
    $cep,
    $endereco,
    $bairro,
    $numero,
    $cidade,
    $uf
  ) {
    if(!$this->cepValido($cep)) throw new Exception("Cep no formato inválido");
    if(!$this->telefoneInvalido($telefone)) throw new Exception("Telefone inválido");
    if(!$this->emailInvalido($email)) throw new exception ("Email no formato inválido");

    $this->nome = $nome;
    $this->cpf_cnpj = $cpf_cnpj;
    $this->telefone = $telefone;
    $this->email = $email;
    $this->cep = $cep;
    $this->endereco = $endereco;
    $this->bairro = $bairro;
    $this->numero = $numero;
    $this->cidade = $cidade;
    $this->uf = $uf;
  }
  
    

  function cepValido($cep){
    if(strlen($cep)==10){
      $regex_cep = "/^[0-9]{2}\.[0-9]{3}\-[0-9]{3}$/";
      return preg_match($regex_cep, $cep);
    }else{
      return false;

    }
  }
  function telefoneInvalido($telefone){
    if(strlen($telefone) == 15){
      $regex_telefone = "/^\([0-9]{2}\)[0-9]{5}\-[0-9]{4}$/";
      return preg_match($regex_telefone, str_replace(" ", "" ,$telefone));
    }else{
      return false;
    }
  }

  function emailInvalido($email){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
      return true;
    }else{
      return false;
    }
  }
}
