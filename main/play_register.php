	<body id="page_play" class="page_register">
		<?PHP
			include('./inc/header.php');
		?>
		<div id="mainbody">
			<div id="sidebar_left">
				<div id="sidemenu" class="register sidebox">
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
				<div class="sidebox blue" id="boardbox">
					<h3>Fórum</h3>
					<p>Visita o <a href="#" title="Nosso Fórum">Fórum Metin2</a> e descobre estratégias com outros jogadores.</p>
				</div>
				<div id="symbol" class="play"></div>
			</div>
			<div id="content">
				<h1>Registo</h1>
				<?PHP
					if($serverSettings['registration']) {
						if(isset($_POST['submit'])) {
							if(isset($_POST['agb'])) {
								$connection = mysqli_connect(sql_server_host, sql_server_user, sql_server_pass, 'account');
								$connection->query('SET NAMES utf8');
								
								$real_name = mysqli_real_escape_string($connection, $_POST['real_name']);
								$username = mysqli_real_escape_string($connection, $_POST['username']);
								$email = mysqli_real_escape_string($connection, $_POST['email']);
								$password = mysqli_real_escape_string($connection, $_POST['password']);
								$password2 = mysqli_real_escape_string($connection, $_POST['password2']);
								$social_id = (int)$_POST['social_id'];
								
								if(empty($real_name) || empty($username) || empty($email) || 
									empty($password) || empty($password2) || empty($social_id)) {
									echo '<p class="error">Por favor preenche todos os campos corretamente.</p>';
								}
								//elseif(!preg_match('/^[a-zA-Z\s,."-\pL]+$/u', $real_name)) {
								elseif(!preg_match('/^([ \x{00C0}-\x{01FF}a-zA-Z\"\-])+$/u', $real_name)) {
									echo '<p class="error">Por favor insere um nome válido.</p>';
								}
								elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
									echo '<p class="error">Por favor insere um e-mail válido.</p>';
								}
								elseif($password != $password2) {
									echo '<p class="error">A palavra-passe não é igual à que repetiste.</p>';
								}
								else {
									$existing_user = 'SELECT `login` FROM `account` WHERE `login` = "'.$username.'"';
									$existing_email = 'SELECT `email` FROM `account` WHERE `email` = "'.$email.'"';
									$check_user = mysqli_query($connection, $existing_user);
									$check_email = mysqli_query($connection, $existing_email);
									if(mysqli_num_rows($check_user) != 0) {
										echo '<p class="error">Este utilizador já está registado.</p>';
									}
									elseif(mysqli_num_rows($check_email) != 0) {
										echo '<p class="error">Este e-mail já está registado.</p>';
									}
									elseif(strlen($real_name) > 30 || strlen($real_name) < 3 ||
										strlen($username) > 16 || strlen($username) < 5 ||
										strlen($password) > 16 || strlen($password) < 5 ||
										strlen($email) > 40 ||
										strlen($social_id) != 7) {
										echo '<p class="error">Por favor verifique novamente o requisitos para cada campo.</p>';
									}
									else {
										if($serverSettings['mail_activation']) {
											$hash = md5(uniqid(rand(), true));
											$create_account = 'INSERT INTO `account` SET `login` = "'.$username.'", `password` = PASSWORD("'.$password.'"), `social_id` = "'.$social_id.'", `real_name` = "'.$real_name.'", `email` = "'.$email.'", `mail_activation` = "'.$hash.'"';
											$result = mysqli_query($connection, $create_account);
											if($result) {
												$headers = $mail_headers;
												$subject = $serverSettings['server_name'].' - Registo';
												$content = '<font face="arial">';
												$content .= 'Olá '.$real_name.',<br /><br />';
												$content .= 'O teu registo em '.$serverSettings['server_url'].' foi efectuado com sucesso.<br />';
												$content .= '<a href="'.$serverSettings['server_url'].'/index.php?s=account_login&do=activate&hash='.$hash.'">Clique aqui para activares a tua conta e começares a jogar.</a><br /><br />';
												$content .= $mail_footer;
												mail($email, $subject, $content, $headers);
												echo '<p><font color="green">O teu registo foi efectuado com sucesso. Por favor verifique a caixa de entrada do teu correio electrónico.</font></p>';
											}
											else { 
												echo '<p class="error">Houve um erro ao registar. Por favor tenta mais tarde ou contacte com a administração.</p>';
											}
										} else {
											$create_account = 'INSERT INTO `account` SET `login` = "'.$username.'", `password` = PASSWORD("'.$password.'"), `social_id` = "'.$social_id.'", `real_name` = "'.$real_name.'", `email` = "'.$email.'", `status` = "OK", `mail_activation` = "0"';
											$result = mysqli_query($connection, $create_account);
											if($result) {
												echo '<p><font color="green">O teu registo foi efectuado com sucesso.</font></p>'; 
											}
											else { 
												echo '<p class="error">Houve um erro ao registar. Por favor tenta mais tarde ou contacte com a administração.</p>';
											}					
										}
									}
								}
							} else {
								echo '<p class="error">Não podes continuar com o registo porque não aceitas-te os Termos e condições de uso.</p>';
							}
						}
				?>
				<form name="registration" id="registration" method="POST">
					<fieldset><legend>Registo no Jogo:</legend>
						<p>Cria uma conta no jogo <b>gratuitamente</b> e consegue aceder ao mundo de Metin2:</p>
						<table>
							<tr>
								<td>Seu nome real:</td>
								<td><input type="text" name="real_name" placeholder="Nome Real" size="25" value="" maxlength="30" autofocus required /></td>
							</tr>
							<tr>
								<td>Nome da conta: </br><small>(Entre 5 e 16 caracteres permitidos)</small></td>
								<td><input type="text" name="username" placeholder="Nome da conta" size="25" value="" maxlength="16" autofocus required /></td>
							</tr>
							<tr>
								<td>E-Mail:</td>
								<td><input type="text" name="email" placeholder="E-Mail" size="25" maxlength="40" autofocus required /></td>
							</tr>
							<tr>
								<td>Palavra-passe: </br><small>(Entre 5 e 16 caracteres permitidos)</small></td>
								<td><input type="password" name="password" placeholder="Palavra-passe" size="25" value="" maxlength="16" autofocus required /></td>
							</tr>
							<tr>
								<td>Repete a palavra-passe:</td>
								<td><input type="password" name="password2" placeholder="Repete a palavra-passe" size="25" value="" maxlength="16" autofocus required /></td>
							</tr>
							<tr>
								<td>Código de apagar personagem: </br><small>(7 caracteres obrigatórios)</small></td>
								<td><input type="text" name="social_id" placeholder="Código de apagar personagem" size="25" value="" maxlength="7" autofocus required /></td>
							</tr>
							<tr>
								<td>T&C:</td>
								<td><input type="checkbox" name="agb" /> Li os <a target="_blank" href="index.php?s=agb">Termos e condições de uso</a> e aceito-os.</td>
							</tr>
						</table>
						<input type="submit" name="submit" id="save" value="Registar">
					</fieldset>
				</form>
				<?PHP
					} else {
						echo '<p class="error">Não te podes registar no momento.</p>';
					}
				?>
				<br><p><strong><u>Noticia:</u></strong><br>A nossa manutenção semanal ocorre a cada quinta-feira nas horas 10.00 do servidor. Os Servidores voltaram novamente após a manutenção as 12.00 e nessa altura vão ficar inteiramente disponível.</p>
			</div>
			<div class="redrule"></div>
		</div>