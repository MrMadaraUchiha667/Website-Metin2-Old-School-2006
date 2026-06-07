	<body id="page_home" class="page_index">
		<?PHP
			include('./inc/header.php');
		?>
		<div id="mainbody">
			<div id="sidebar_left">
				<div id="sidemenu" class="index sidebox">
					<?PHP
						include('./inc/sidebar_login.php');
					?>
					<?PHP
						include('./inc/submenus.php');
					?>
				</div>
				<?PHP
					include('./inc/sidebar_ranking.php');
				?>
				<div class="sidebox blue" id="registerbox">
					<h3>Registar</h3>
					<p><br /><a href="index.php?s=play_register" title="Registro">Regista-te</a> aqui gratis.</p>
				</div>
				<div class="sidebox blue" id="boardbox">
					<h3>Fórum</h3>
					<p>Visita o <a href="#" title="Nosso Fórum">Fórum Metin2</a> e descobre estratégias com outros jogadores.</p>
				</div>
				<div id="symbol" class="game"></div>
			</div>
			<div id="content">
				<h1>Pedir uma nova password</h1>			
				<?PHP
					if(isset($_GET['do']) && $_GET['do']=="recover" && isset($_GET['hash']) && !empty($_GET['hash'])) {
						if(strlen($_GET['hash']) == 32 && preg_match('/^[a-zA-Z0-9]+$/',$_GET['hash'])) {
							$connection = mysqli_connect(sql_server_host, sql_server_user, sql_server_pass, 'account');
							$connection->query('SET NAMES utf8');
							
							$get_hash = 'SELECT `id`, `login`, `email`, `real_name`, `password_recover` FROM `account`.`account` WHERE `password_recover` = "'.mysqli_real_escape_string($connection, $_GET['hash']).'"';
							$result = mysqli_query($connection, $get_hash);
							if(mysqli_num_rows($result)) {
								$get_data = mysqli_fetch_object($result);
								$new_password = substr(md5(uniqid(rand(), true)),0,8);
								$update_password = 'UPDATE `account`.`account` SET `password` = PASSWORD("'.$new_password.'"), `password_recover` = "0" WHERE `id` = "'.$get_data->id.'"';
								$update_result = mysqli_query($connection, $update_password);
								if($update_result) {
									$headers = $mail_headers;
									$subject = $serverSettings['server_name'].' - Recuperação da Palavra-Passe';
									$content = 'Olá '.$get_data->real_name.',<br /><br />';
									$content .= 'A tua nova palavra-passe da conta <b>'.$get_data->login.'</b> é, <b>'.$new_password.'</b><br /><br />';
									$content .= $mail_footer;
									mail($get_data->email, $subject, $content, $headers);
									echo '<p><font color="green">Uma nova palavra-passe foi enviada para o teu correio electrónico.</font></p>';
								}
							}
						}
					}
				?>
				<?PHP
					if(isset($_POST['submit'])) {
						$connection = mysqli_connect(sql_server_host, sql_server_user, sql_server_pass, 'account');
						$connection->query('SET NAMES utf8');
						
						$check_player = 'SELECT `id`, `login`, `real_name`, `email` FROM `account`.`account` WHERE `login` = "'.mysqli_real_escape_string($connection, $_POST['playername']).'" AND `email` = "'.mysqli_real_escape_string($connection, $_POST['email']).'"';
						$result = mysqli_query($connection, $check_player);
						if(mysqli_num_rows($result)) {
							$get_data = mysqli_fetch_object($result);
							
							$hash = md5(uniqid(rand(), true));
							$set_hash = 'UPDATE `account`.`account` SET `password_recover` = "'.$hash.'" WHERE `id` = "'.$get_data->id.'"';
							$create_hash = mysqli_query($connection, $set_hash);
							if($create_hash) {
								$headers = $mail_headers;
								$subject = $serverSettings['server_name'].' - Recuperação da Palavra-Passe';
								$content = 'Olá '.$get_data->real_name .',<br /><br />';
								$content .= 'Ao teu pedido de recuperação da palavra-passe, <a href="'.$serverSettings['server_url'].'/index.php?s=account_forgot_password&do=recover&hash='.$hash.'">clique aqui para recuperar</a>.<br /><br />';
								$content .= $mail_footer;
								mail($_POST['email'], $subject, $content, $headers);
								echo '<p><font color="green">Um e-mail de recuperação foi enviado para o teu correio electrónico.</font></p>';
							}
						} else {
							echo '<p class="error">Identificação errada. O ID de utilizador ou E-Mail estão incorrectos!</p>';
						}
					}
				?>
				<form name="forgot" method="POST">
					<fieldset><legend>Pedido de password:</legend>
						<p>Para a criação de uma nova contra-senha precisamos tua ID da Conta e tua direção de e-mail.</p>
						<p>A contra-senha será enviada a tua direção de e-mail.</p>	
						<table>
							<tr>
								<td>ID:</td>
								<td><input type="text" name="playername" id="playername" size="19" maxlength="16" value=""></td>
							</tr>
							<tr>
								<td>Correio Electrónico:</td>
								<td><input type="text" name="email" id="email" size="19" maxlength="60" value=""></td>
							</tr>												
						</table>
						<input type="submit" name="submit" value="Pedir uma nova palavra-passe">
					</fieldset>
				</form>
			</div>
			<div class="redrule"></div>
		</div>