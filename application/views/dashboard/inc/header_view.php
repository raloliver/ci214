	<!doctype html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>DIYNote</title>
	<link rel="stylesheet" href="<?=base_url()?>public/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url()?>public/css/style.css">
	<script src="<?=base_url()?>public/js/jquery.js"></script>
	<script src="<?=base_url()?>public/js/bootstrap.min.js"></script>
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
	<nav class="navbar">
		<div class="navbar-inner">
			<span class="brand">DIYNote</span>
			<ul class="nav">
				<li><a href="#">Painel</a></li>
				<li><a href="#">Perfil</a></li>
				<li><a href="<?=site_url('dashboard/logout') ?>">Sair</a></li>
			</ul>
		</div>	
	</nav>

	<!-- start:wrapper -->
	<div class="wrapper">
		<div id="error" class="alert alert-error hide"></div>
		<div id="success" class="alert alert-success hide"></div>