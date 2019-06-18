<?php @session_start(); ?><!DOCTYPE html>
<html lang="pt">
<head>
	<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Loja</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body>

	<?php
	$categorias = [
		'Roupas',
		'Calçados',
		'Acessórios',
	];

	if(!empty($_POST['Nome']) && !empty($_FILES['Foto'])) {
		$produto = [
			'Nome' => $_POST['Nome'],
			'Descrição' => $_POST['Descrição'],
			'Categoria' => $_POST['Categoria'],
			'Quantidade' => $_POST['Quantidade'],
			'Preço' => $_POST['Preço']
		];
		$novoNomeDoArquivo = time() . ".jpg";
		if(isset($_FILES['Foto']) && !empty($_FILES['Foto']['tmp_name'])) {
			move_uploaded_file($_FILES['Foto']['tmp_name'], $novoNomeDoArquivo);
			$produto['Foto'] = $novoNomeDoArquivo;
		}
		else if( isset($_GET['editar']) ) {
			$produto['Foto'] = $_SESSION['produtos'][$_GET['editar']]['Foto'];
		}
		if(isset($_GET['editar']) && isset($_SESSION['produtos'][$_GET['editar']])) {
			$_SESSION['produtos'][$_GET['editar']] = $produto;
		} else {
				$_SESSION['produtos'][] = $produto;
		}
	}
	?>

	<div class="container">

		<div class="mb-5"></div>
    <div class="row">
			
			<div class="col-7">
				<table class="table table-hover">
					<thead>
						<ul>
							<li>Código</li>
							<li>Nome</li>
							<li>Categoria</li>
							<li>Preço</li>
							<li>Ações</li>
            </ul>
					</head>
					<body>
						<?php if (isset($_SESSION['produtos'])): ?>
							<?php foreach ($_SESSION['produtos'] as $key => $produto): ?>
								<ul>
									<li><?php echo $key ?></li>
									<li><a href="produto.php?produto=<?php echo $key ?>"><?php echo $produto['Nome'] ?></a></li>
									<li><?php echo $produto['Categoria'] ?></li>
									<li><?php echo $produto['Preço'] ?></li>
									<li>
										<a href="./?editar=<?php echo $key ?>">Editar</a>
										<a href="./?apagar=<?php echo $key ?>">Apagar</a>
                  </li>
                  </ul>
							<?php endforeach ?>
						<?php endif ?>
					</body>
				</table>

			</div>
			<div class="col-5">
				<div class="jumbotron">
					<h4 class="">
						<?php if (isset($_GET['editar'])): ?>
							Editar produto
							<?php else: ?>
								Cadastrar produto
							<?php endif ?>
						</h4>
						<div class="mb-4"></div>
						<form method="post" action="" enctype="multipart/form-data">
						
							<?php if (isset($_GET['editar'])): ?>
								<div class="form-group row">
									<label for="Index" class="form-control-label col-12"><b>Código</b></label>
									<div class="col-12">
										<input type="text" class="form-control" name="Index" value="<?php echo $_GET['editar'] ?> "id="Index" placeholder="Posição do produto no array">
									</div>
								</div>
							<?php endif ?>
							<div class="form-group row">
								<label for="Nome" class="form-control-label col-12">Nome</label>
								<div class="col-12">
									<input type="text" class="form-control" name="Nome" id="Nome" placeholder="Nome">
								</div>
							</div>
							<div class="form-group row">
								<label for="Categoria" class="form-control-label col-12">Categoria</label>
								<div class="col-12">
									<select value="<?php echo $_SESSION['produtos'][$_GET['editar']]['Categoria'] ?>" name="Categoria" id="Categoria" class="form-control">
										<?php foreach ($categorias as $key => $categoria): ?>
											<option value="<?php echo $categoria ?>"><?php echo $categoria ?></option>
										<?php endforeach ?>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="Descrição" class="form-control-label col-12">Descrição</label>
								<div class="col-12">
									<textarea class="form-control" name="Descrição" id="Descrição" placeholder="Descrição"></textarea>
								</div>
							</div>
							<div class="form-group row">
								<label for="Quantidade" class="form-control-label col-12">Quantidade</label>
								<div class="col-12">
									<input type="text" class="form-control" name="Quantidade" id="Quantidade" placeholder="Quantidade">
								</div>
							</div>
							<div class="form-group row">
								<label for="Preço" class="form-control-label col-12">Preço</label>
								<div class="col-12">
									<input type="text" class="form-control" name="Preço" id="Preço" placeholder="Preço">
								</div>
							</div>
							<div class="form-group row">
								<label for="Foto" class="form-control-label col-12"><b>Foto do produto</b></label>
								<div class="col-12">
									<input type="file" class="form-control" name="Foto" id="Foto" placeholder="Foto">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-offset-2 col-12 text-right">
									<button type="submit" class="btn btn-primary">Enviar</button>
								</div>
							</div>
						</form>
					</div>
				</div>

			</div>
		</div>

	
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

		<?php if (isset($_GET['editar'])): ?>
			
			
		<?php endif ?>
	</body>
  </html>
  