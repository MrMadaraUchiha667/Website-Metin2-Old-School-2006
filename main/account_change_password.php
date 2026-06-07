	<body id="page_account" class="page_data">
		<?PHP
			include('./inc/header.php');
		?>
		<div id="mainbody">
			<div id="sidebar_left">
				<?PHP
					if(!empty($_SESSION['user_id'])) {
						echo '<div id="sidemenu" class="data sidebox">';
					} else {
						echo '<div id="sidemenu">';
					}
				?>
					<?PHP
						include('./inc/sidebar_login.php');
					?>
					<?PHP
						include('./inc/submenus.php');
					?>
				</div>
				<div class="sidebox blue" id="registerbox">
					<h3>Registar</h3>
					<p><br /><a href="index.php?s=play_register" title="Registro">Regista-te</a> aqui gratis.</p>
				</div>
				<?PHP
					if(!empty($_SESSION['user_id'])) {
						echo '<div class="sidebox blue" id="boardbox">';
						echo '<h3>Fórum</h3>';
						echo '<p>Visita o <a href="#" title="Nosso Fórum">Fórum Metin2</a> e descobre estratégias com outros jogadores.</p>';
						echo '</div>';
					}
				?>
				<div id="symbol" class="game"></div>
			</div>
			<div id="content">
				<?PHP
					if(!empty($_SESSION['user_id'])) {
						// ...
				?>
				<h1>A tua Conta</h1>
				<?PHP
					if(isset($_POST['submit'])) {
						$connection = mysqli_connect(sql_server_host, sql_server_user, sql_server_pass, 'account');
						$connection->query('SET NAMES utf8');
						
						$check_old_password = 'SELECT * FROM `account` WHERE `id` = "'.$_SESSION['user_id'].'" AND `password` = PASSWORD("'.$_POST['old_password'].'")';
						$result = mysqli_query($connection, $check_old_password);
						if(mysqli_num_rows($result)) {
							if(empty($_POST['old_password']) || empty($_POST['password']) || empty($_POST['password2'])) {
								echo '<p class="error">Por favor preenche todos os campos corretamente.</p>';
							} elseif($_POST['password'] != $_POST['password2']) {
								echo '<p class="error">A palavra-passe nova não é igual à que repetiste.</p>';
							} elseif(strlen($_POST['password']) > 16 || strlen($_POST['password']) < 5 || strlen($_POST['password2']) > 16 || strlen($_POST['password2']) < 5) {
								echo '<p class="error">Por favor verifique novamente o requisitos para cada campo.</p>';
							} else{
								$update_password = 'UPDATE account.account SET password = PASSWORD("'.$_POST['password'].'") WHERE id = "'.$_SESSION['user_id'].'"';
								$update_result = mysqli_query($connection, $update_password);
								if($update_result) {
									$headers = $mail_headers;
									$subject = $serverSettings['server_name'].' - Palavra-Passe Nova';
									$content = 'Olá '.$_SESSION['user_real_name'].',<br /><br />';
									$content .= 'A tua palavra-passe foi alterada com sucesso para, <b>'.$_POST['password'].'</b><br /><br />';
									$content .= $mail_footer;
									mail($_SESSION['user_email'], $subject, $content, $headers);
									echo '<p><font color="green">A tua palavra-passe foi alterada com sucesso. Um email foi enviado ao teu correio electrónico com a nova palavra-passe.</font></p>';
								} else {
									echo '<p class="error">Houve um erro ao alterar a tua palavra-passe.</p>';
								}
							}
						} else {
							echo '<p class="error">A palavra-passe antiga está errada.</p>';
						}
					}
				?>
				<form name="change" method="POST">
					<fieldset><legend>Mudar a Palavra-Passe</legend>
						<p>A nova palavra-passe deve conter um mínimo de 5 a 16 caracteres.</p>
						<table>
							<tr>
								<td>Palavra-Passe antiga:</td>
								<td><input type="password" name="old_password" id="password" size="20" maxlength="16" value=""></td>
							</tr>
							<tr>
								<td>Palavra-Passe nova:</td>
								<td><input type="password" name="password" id="password" size="20" maxlength="16" value=""></td>
							</tr>
							<tr>
								<td>Repete a palavra-passe nova:</td>
								<td><input type="password" name="password2" id="password" size="20" maxlength="16" value=""></td>
							</tr>
						</table>
						<input type="submit" name="submit" value="Mudar a palavra-passe">
					</fieldset>
				</form>
				<?PHP	
					} else {
						echo '<h1>Erro</h1>';
						echo '<p class="error">Não tens permissão para aceder a esta página porque não estás logado.</p>';
						header('Refresh:3; url=index.php?s=account_login');
					}
				?>
			</div>
			<div class="redrule"></div>
		</div>