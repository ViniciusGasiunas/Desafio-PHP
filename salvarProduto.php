<?php
include_once "funcoes.php";
//echo "<pre>";
//var_dump($_FILES);
$contadorInputVazio = 0;
foreach($_POST as $item){
    $item == ""?$contadorInputVazio++:0;
}
if($contadorInputVazio ==  count($_POST)){
echo "<h1> Você não enviou nenhuma informação sobre o produto </h1>";
echo '<a class="btn btn-primary" href="cadastroProduto.php">Voltar para a página de Cadastro !</a>';
exit;
}
$imgAceitas = ["image/png", "image/jpg", "image/jpeg"];
$erroEnvio = $_FILES['arquivo']['error'];
$nomeProduto = $_POST['nomeProduto'];
$precoProduto = $_POST['precoProduto'];
$descProduto = $_POST['descProduto'];
$nomeArquivo = $_FILES['arquivo']['name'];
$arquivoTmp = $_FILES['arquivo']['tmp_name'];
$caminhoImg = "img/$nomeArquivo";
$typeFile = $_FILES['arquivo']['type'];
if($erroEnvio !== 0){
echo "<h1> Houve um erro no envio do arquivo ! <br>Verifique e tente novamente</br> </h1>";
echo '<a class="btn btn-primary" href="cadastroProduto.php">Voltar para a página de Cadastro !</a>';
exit;
}
if(!is_numeric(array_search($typeFile, $imgAceitas))){
    echo "<h1> Extensão do arquivo inválida ! <br> Verifique se o arquivo é uma imagem do tipo: .PNG, .JPG OU .JPEG ! </br> </h1>";
    echo '<a class="btn btn-primary" href="cadastroProduto.php">Voltar para a página de Cadastro !</a>';
    exit;
}
move_uploaded_file($arquivoTmp, "img/$nomeArquivo");
addProduto($nomeProduto, $descProduto, $precoProduto, $caminhoImg);