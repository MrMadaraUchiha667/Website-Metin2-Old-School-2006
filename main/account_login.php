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
			<div id="home_gal">
				<img src="content/screen01.jpg" width="100" height="75" alt="" />
				<img src="content/screen02.jpg" width="100" height="75" alt="" />
				<img src="content/screen03.jpg" width="100" height="75" alt="" />
				<img src="content/screen04.jpg" width="100" height="75" alt="" />
				<img src="content/screen05.jpg" width="100" height="75" alt="" />
				<img src="content/screen06.jpg" width="100" height="75" alt="" />
			</div>
			<div id="content" style="width:390px;" >
				<h1>Login</h1>
				<?PHP
					if(isset($_GET['do']) && $_GET['do']=="activate" && isset($_GET['hash']) && !empty($_GET['hash'])) {
						if(strlen($_GET['hash']) == 32 && preg_match('/^[a-zA-Z0-9]+$/',$_GET['hash'])) {
							$connection = mysqli_connect(sql_server_host, sql_server_user, sql_server_pass, 'account');
							$connection->query('SET NAMES utf8');
							
							$get_hash = 'SELECT `id`, `mail_activation` FROM `account`.`account` WHERE `mail_activation` = "'.$_GET['hash'].'" AND `mail_activation` != "1"';
							$result = mysqli_query($connection, $get_hash);
							if(mysqli_num_rows($result)) {
								$get_id = mysqli_fetch_object($result);
								$update_user = 'UPDATE `account`.`account` SET `mail_activation` = "1", `status` = "OK" WHERE `id` = "'.$get_id->id.'"';
								$update_result = mysqli_query($connection, $update_user);
								if($update_result) {
									echo '<p><font color="green">A tua conta foi activada! Já podes fazer login e jogar.</font></p>';
								}
							}
						}
					}
					
					if(isset($_POST['submit'])) {
						$connection = mysqli_connect(sql_server_host, sql_server_user, sql_server_pass, 'account');
						$connection->query('SET NAMES utf8');
						
						$check_account = 'SELECT * FROM `account`.`account` WHERE `login` = "'.mysqli_real_escape_string($connection, $_POST['playername']).'" AND `password` = PASSWORD("'.mysqli_real_escape_string($connection, $_POST['password']).'")';
						$result = mysqli_query($connection, $check_account);
						if(mysqli_num_rows($result)) {
							$array = mysqli_fetch_array($result);
							$_SESSION['user_id'] = $array['id'];
							$_SESSION['user_name'] = $array['login'];
							$_SESSION['user_email'] = $array['email'];
							$_SESSION['user_real_name'] = $array['real_name'];
							$_SESSION['user_social_id'] = $array['social_id'];
							$_SESSION['user_cash'] = $array['cash'];
							$_SESSION['user_coins'] = $array['coins'];
							$_SESSION['mall_pos'] = '0';
							$hash = md5(uniqid(rand(), true));
							$_SESSION['hash'] = $hash;
							$_SESSION['checksum'] = '0';
							echo '<meta http-equiv="refresh" content="0; URL=index.php?s=home" />';
						} else {
							echo '<p class="error">Identificação errada. O ID de utilizador ou Palavra-passe estão incorrectos!</p>';
						}
					}
				?>
				<form name="login" method="POST">
					<fieldset><legend>Login</legend>
						<table>
							<tr>
								<td>ID:</td>
								<td><input type="text" name="playername" id="playername" size="20" maxlength="30" value=""></td>
							</tr>
							<tr>
								<td>Password:</td>
								<td><input type="password" name="password" id="password" size="20" maxlength="60" value=""> <a href="index.php?s=account_forgot_password">Perdido?</a></td>
							</tr>
						</table>
						<input type="submit" name="submit" id="save" value="Login">
					</fieldset>
				</form>
			</div>
			<div class="redrule"></div>
		</div>