<div class="row">
	<div class="span6">
		<form id="register_form" class="form-horizontal" method="post" action="<?=site_url('user/register')?>">
			<div class="control-group">
					<label class="control-label">Usuário</label>
					<div class="controls">
						<input type="text" name="login" class="input-xlarge">
					</div>
			</div>
			<div class="control-group">
					<label class="control-label">Email</label>
					<div class="controls">
						<input type="text" name="email" class="input-xlarge">
					</div>
			</div>
			<div class="control-group">
					<label class="control-label">Senha</label>
					<div class="controls">
						<input type="password" name="password" class="input-xlarge">
					</div>
			</div>
			<div class="control-group">
					<label class="control-label">Confirmar Senha</label>
					<div class="controls">
						<input type="password" name="confirm_password" class="input-xlarge">
					</div>
			</div>

			<div class="control-group">
					<div class="controls">
						<input type="submit" class="btn btn-primary" value="Cadastrar">
					</div>
			</div>
		</form>

	<a href="<?=site_url('/')?>">Voltar</a>

	</div>
</div>
<script>
	$(function(){

		$("#register_form").submit(function(evt){
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

