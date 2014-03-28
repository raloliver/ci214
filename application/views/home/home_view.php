<div class="row">
	<div class="span6 offset2">
		<form id="login_form" class="form-horizontal" method="post" action="<?=site_url('api/login')?>">
			<h3 class="text-right">Login</h3>
			<div class="control-group">
					<label class="control-label">Usuário</label>
					<div class="controls">
						<input type="text" name="login" class="input-xlarge">
					</div>
			</div>
			<div class="control-group">
					<label class="control-label">Senha</label>
					<div class="controls">
						<input type="password" name="password" class="input-xlarge">
					</div>
			</div>

			<div class="control-group">
					<div class="controls">
						<input type="submit" class="btn btn-primary" value="Entrar">
						<a class="btn" href="<?=site_url('home/register')?>">Cadastrar</a>
					</div>
			</div>
		</form>
	</div>
</div>
<script>
	$(function(){

		$("#login_form").submit(function(evt){
			evt.preventDefault();
			var url = $(this).attr('action');
			var postData = $(this).serialize();

			$.post(url, postData, function(o){
				if (o.result == 1) {
					window.location.href = '<?=site_url('dashboard')?>';
					// alert('Login Efetuado com Sucesso!');
				} else {
					alert('Login e/ou Senha Inválido!');
				};
			}, 'json');
		});

	});
</script>

