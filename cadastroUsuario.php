<!DOCTYPE html>
<html lang="en">
<?php include_once "head.php"; ?>
<body>
 <?php include_once "header.php"; ?>

<main class="container">
     <section class="row">
         <div class="col-md-6">
         <form action="salvarUsuario.php" method="post" enctype= "multipart/form-data">

        <!-- Nome do Usuário -->
        <div class="form-group">
            <label for="nomeUsuario">Nome de Usuario</label>
            <input type="text" class="form-control" id="cadastroUsuario" placeholder="Nome do Usuario" name="nomeUsuario">
        </div>
        <!-- E-mail do Usuário -->
        <div class="form-group">
            <label for="emailUsuario">E-mail do Usuario</label>
            <input type="email" class="form-control" id="emailUsuario" placeholder="Email do Usuario" name="emailUsuario">
        </div>
        <!-- Senha do Usuário -->
        <div class="form-group">
            <label for="senhaUsuario">Senha</label>
           <input type="password" class="form-control" id="senhaUsuario" placeholder"Senha do Usuario" name="senhaUsuario">
        </div>
        <!-- Nível de acesso -->
        <div class="form-group">
            <label for="nivelUsuario">nivel do Usuario</label>
                <select name="nivelUsuario" id="nivelUsuario" class="form-control">
                    <option selected disable>Selecione o nivel !</option>
                    <option value="0">Administrador</option>
                    <option value="1">Usuario</option>
                </select>
        </div>
       



        <button class="btn btn-success" type="submit">Finalizar cadastro</button>

        <input type="file" name="arquivo">

        <button type="submit">Enviar</button>
        </form>
         </div>
     </section>
 </main>
 
 
</body>
</html>
