		<!doctype html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>DIYNote</title>
	<link rel="stylesheet" href="<?=base_url()?>public/third-party/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url()?>public/css/style.css">
	<script src="<?=base_url()?>public/third-party/js/jquery.js"></script>
	<script src="<?=base_url()?>public/third-party/js/bootstrap.min.js"></script>
	<script src="<?=base_url()?>public/js/dashboard/result.js"></script>
	<script src="<?=base_url()?>public/js/dashboard/event.js"></script>
	<script src="<?=base_url()?>public/js/dashboard/template.js"></script>
	<script src="<?=base_url()?>public/js/dashboard.js"></script>	
	<script>
	$(function() {
		// Inicio da API Dashboard
		var dashboard = new Dashboard();
	});
	</script>	
</head>
<body>
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container">
				<span class="brand">DIYNote</span>
				<ul class="nav">
					<li><a href="#">Painel</a></li>
					<li><a href="#">Perfil</a></li>					
				</ul>
				<div class="pull-right">
					<a class="btn" href="<?=site_url('dashboard/logout') ?>">Sair</a>
				</div>
			</div>
		</div>	
	</div>

	<!-- start:container -->
	<div class="container">
		<div id="error" class="alert alert-error hide"></div>
		<div id="success" class="alert alert-success hide"></div>