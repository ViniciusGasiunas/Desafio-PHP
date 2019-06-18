<?php
session_start(); 
function logarUsuario($nome, $nivelDeAcesso){
  $usuario = ["logado"=>true, "nome"=>$nome, "nivelAcesso"=>$nivelDeAcesso];
  $_SESSION['usuario'] = $usuario;
}
function addProduto($nome, $descricao, $preco, $img){
  $jsonProdutos = file_exists("usuario.json")?file_get_contents('Produtos.json'):"";
  $produtos = json_decode($jsonProdutos, true);
  // $produtos = $produtos['Produtos'];
  
  $chave = count($produtos) + 1;
  $novoProduto = ["id"=>"produto$chave","nome"=>$nome, "descricao"=>$descricao, "preco"=> $preco, "img"=>$img];
  
  $produtos[]=$novoProduto;
  
  $jsonProdutos = json_encode($produtos);
  file_put_contents('Produtos.json', $jsonProdutos);
  return true;
}
function addUsuario($nomeUsuario, $emailUsuario, $senhaUsuario, $nivelDeAcesso){
    $jsonUsuarios = file_get_contents('Usuarios.json');
    $Usuarios = json_decode($jsonUsuarios, true);
    
    $itensUsuarios = is_array($Usuarios['usuarios'])?count($Usuarios['usuarios']):0;
    $chave = $itensUsuarios + 1;
    $novoUsuario = ["id"=>"usuario$chave","nome"=>$nomeUsuario, "email"=>$emailUsuario, "senha"=> $senhaUsuario, "nivelAcesso"=>$nivelDeAcesso];
    
    $Usuarios["usuarios"][]=$novoUsuario;
    
    $jsonUsuarios = json_encode($Usuarios);
  
    file_put_contents('Usuarios.json', $jsonUsuarios);
  
    return true;
}
function validarNome($nome){
    return $nome != "" &&  strlen($nome) >= 3;
}
function validarCPF($cpf){
    return strlen($cpf) == 11;
}
function validarCartao($numeroCartao){
  return strlen($numeroCartao) == 16;
}
function validarDataValidade($dataValidade){
  return $dataValidade > date('y-m-d');
}
function validarCVV($cvv){
  return strlen($cvv) == 3;
}