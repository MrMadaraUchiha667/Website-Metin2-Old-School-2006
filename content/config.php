<?PHP
	error_reporting(0);
?>
<!DOCTYPE html>
<html lang="pt">
	<head>
		<meta charset="utf-8" />
		<title>Configurar</title>
		<style type="text/css">
			body {
				background-color: #fff;
				color: #000;
				font-family: Helvetica;
				font-size: 14px;
			}
			form {
				margin: auto;
				position: relative;
				width: 550px;
				height: 100%;
				line-height: 20px;
				padding: 10px;
				border: 1px solid #999;
				box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
			}
			input.button {
				width: 100px;
				height: 30px;
				position: absolute;
				right: 10px;
				bottom: 10px;
				background: #fff;
				border: 1px solid #999;
			}
			input.button:hover {
				background:#fff;
				color: #09C;
			}
			input.button:focus {
				outline: 0;
			}
			h2 {
				text-align: center;
			}
			fieldset {
				border: 1px solid #999;
			}
			legend {
				font-weight: bold;
			}
		</style>
	</head>
	<body>
		<?PHP
			define('home', 'config.php?step=1');
			if(isset($_GET['step']) && !empty($_GET['step'])) {
				if($_GET['step'] >= 6 ) {
					goto home;
				}
				if($_GET['step'] == 1) {
					if(isset($_POST['config'])) {
						// ...
		?>
		<form action="config.php?step=2" method="POST">
			<h2>Configuração</h2>
			<p>Preenche todos os campos com os <b>dados correctos</b> para o total funcionamento da página web.</p>
			<small>Os campos com * são obrigatórios!</small>
				<br />
				<fieldset>
					<legend>Informações do Servidor</legend>
					<label>Título da Página Web: *</label><br />
					<input type="text" size="30px" name="homepage_titel" placeholder="Metin2 - MMORPG de Acção Oriental" autofocus required />
					<br />
					<label>Nome do Servidor: *</label><br />
					<input type="text" size="30px" name="server_name" placeholder="Metin2" autofocus required />
					<br />
					<label>Breve descrição do Servidor:</label><br />
					<input type="text" size="30px" name="server_description" placeholder="MMORPG Metin2" />
					<br />
					<label>URL da Página Web: *</label><br />
					<input type="text" size="30px" name="server_url" placeholder="https://www.metin2.com.pt" autofocus required />
					<br />
					<label>E-Mail do Servidor: *</label><br />
					<input type="text" size="30px" name="server_mail" placeholder="mail@metin2.com" autofocus required />
					<br />
					<label>E-Mail de suporte do Servidor: *</label><br />
					<input type="text" size="30px" name="server_support_mail" placeholder="suporte@metin2.com" autofocus required />
					<br />
					<label>Registo activo? *</label><br />
					<select name="registration">
						<option selected="selected" value="true">Sim</option>
						<option value="false">Não</option>
					</select>
					<br />
					<label>Registo por e-mail? (Activação por e-mail) *</label><br />
					<select name="mail_activation">
						<option selected="selected" value="true">Sim</option>
						<option value="false">Não</option>
					</select>
					<br />
					<label>Link do download do cliente:</label><br />
					<input type="text" size="30px" name="client_download" placeholder="https://www.metin2.com.pt/Metin2.exe" autofocus required />
				</fieldset>
				
				<fieldset>
					<legend>Contacto do Servidor</legend>
					<label>Endereço:</label><br />
					<input type="text" size="30px" name="contact_address" placeholder="348 180-210 Lisboa Portugal" />
					<br />
					<label>Número de Telefone:</label><br />
					<input type="text" size="30px" name="contact_number" placeholder="+351 21 145 1361" />
					<br />
					<label>E-Mail de Contacto</label><br />
					<input type="text" size="30px" name="contact_mail" placeholder="info@metin2.com" />
				</fieldset>
				
				<fieldset>
					<legend>Base de Dados do Servidor</legend>
					<label>Host: *</label><br />
					<input type="text" name="sql_server_host" placeholder="127.0.0.1" autofocus required />
					<br />
					<label>Usuário: *</label><br />
					<input type="text" name="sql_server_user" placeholder="Usuário" autofocus required />
					<br />
					<label>Palavra-Passe: *</label><br />
					<input type="password" name="sql_server_pass" placeholder="Palavra-Passe" autofocus required />
				</fieldset>
				<p>Estes dados serão guardados em <u>./inc/config.php</u></p>
				<input type="submit" class="button" name="config" value="Continuar" />
		</form>
		<?PHP
					} else {
						goto home;
					}
				} elseif($_GET['step'] == 2) {
					if(isset($_POST['config'])) {
						$check_sql_server = mysqli_connect($_POST['sql_server_host'], $_POST['sql_server_user'], $_POST['sql_server_pass']);
						if(!$check_sql_server) {
							echo '<form action="javascript:history.back()" method="POST">';
							echo '<h2>Configuração</h2>';
							echo '<p>Houve um erro ao verificar a conexão com a tua base de dados.</p><br /><small><font color="red">'.mysqli_connect_error().'</font></small>';
							echo '<input type="submit" class="button" value="Voltar" />';
							echo '</form>';
						} else {
							$config = '<?PHP' . "\r\n";
							$config .= '	// server database' . "\r\n";
							$config .= '	DEFINE(\'sql_server_host\', \''.$_POST['sql_server_host'].'\');' . "\r\n";
							$config .= '	DEFINE(\'sql_server_user\', \''.$_POST['sql_server_user'].'\');' . "\r\n";
							$config .= '	DEFINE(\'sql_server_pass\', \''.$_POST['sql_server_pass'].'\');' . "\r\n";
							$config .= '	// server settings' . "\r\n";
							$config .= '	$serverSettings[\'homepage_name\'] = \''.$_POST['homepage_titel'].'\';' . "\r\n";
							$config .= '	$serverSettings[\'server_name\'] = \''.$_POST['server_name'].'\';' . "\r\n";
							$config .= '	$serverSettings[\'server_description\'] = \''.$_POST['server_description'].'\';' . "\r\n";
							$config .= '	$serverSettings[\'server_url\'] = \''.$_POST['server_url'].'\';' . "\r\n";
							$config .= '	$serverSettings[\'server_mail\'] = \''.$_POST['server_mail'].'\';' . "\r\n";
							$config .= '	$serverSettings[\'server_support_mail\'] = \''.$_POST['server_support_mail'].'\';' . "\r\n";							
							$config .= '	$serverSettings[\'client_download\'] = \''.$_POST['client_download'].'\';' . "\r\n";
							$config .= '	$serverSettings[\'registration\'] = '.$_POST['registration'].';' . "\r\n";
							$config .= '	$serverSettings[\'mail_activation\'] = '.$_POST['mail_activation'].';' . "\r\n";
							$config .= '	// email headers' . "\r\n";
							$config .= '	$mail_headers = \'X-Priority: 3\' . "\r\n";' . "\r\n";
							$config .= '	$mail_headers .= \'X-Mailer: \'.$serverSettings[\'server_name\'].\' Mailer\' . "\r\n";' . "\r\n";
							$config .= '	$mail_headers .= \'MIME-Version: 1.0\' . "\r\n";' . "\r\n";
							$config .= '	$mail_headers .= \'Content-type: text/html; charset=utf-8\' . "\r\n";' . "\r\n";
							$config .= '	$mail_headers .= \'From: \'.$serverSettings[\'server_name\'].\' <\'.$serverSettings[\'server_mail\'].\'>\' . "\r\n";' . "\r\n";
							$config .= '	$mail_headers .= \'Reply-To: \'.$serverSettings[\'server_mail\'] . "\r\n";' . "\r\n";
							$config .= '	// email subject' . "\r\n";
							$config .= '	// email content' . "\r\n";
							$config .= '	// email footer' . "\r\n";
							$config .= '	$mail_footer = \'Este e-mail foi gerado automaticamente. Por favor não-o responda pois não é dado suporte ao jogo ou facturação.<br />\';' . "\r\n";
							$config .= '	$mail_footer .= \'Suporte: \'.$serverSettings[\'server_support_mail\'].\'<br /><br />\';' . "\r\n";
							$config .= '	$mail_footer .= \''.$_POST['contact_address'].'<br />\';' . "\r\n";
							$config .= '	$mail_footer .= \'Telefone: '.$_POST['contact_number'].'<br />\';' . "\r\n";
							$config .= '	$mail_footer .= \'Contacto: '.$_POST['contact_mail'].'<br />\';' . "\r\n";
							$config .= '?>';
							$config_file = fopen('./inc/config.php','w+');
							$write_config = fwrite($config_file,$config);
							if($write_config) {
								echo '<form action="config.php?step=3" method="POST">';
								echo '<h2>Configuração</h2>';
								echo '<p>O ficheiro foi configurada com os dados que introduziu anteriormente.</p>';
								echo '<small><a href="javascript:history.back()">Clique aqui para voltar à configuração.</a>';
								echo '<input type="submit" class="button" name="config" value="Continuar" />';
								echo '</form>';
							} else {
								echo '<form action="javascript:history.back()" method="POST">';
								echo '<h2>Configuração</h2>';
								echo '<p>Houve um erro ao configurar o ficheiro.</p>';
								echo '<input type="submit" class="button" value="Voltar" />';
								echo '</form>';
							}
						}
					} else { 
						goto home;
					}
		?>
		<?PHP
				} elseif($_GET['step'] == 3) {
					if(isset($_POST['config'])) {
						require_once('./inc/config.php');
						$sql_server = mysqli_connect(sql_server_host, sql_server_user, sql_server_pass);
						$sql_server->query('SET NAMES utf8');

						$query = array();
						$query[] = 'ALTER TABLE `account`.`account` CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;';
						$query[] = 'ALTER TABLE `account`.`account` ADD `coins` int(11) NOT NULL DEFAULT "0";';
						$query[] = 'ALTER TABLE `account`.`account` ADD `mail_activation` varchar(32) NOT NULL;';
						$query[] = 'ALTER TABLE `account`.`account` ADD `password_recover` varchar(32) NOT NULL;';
						$query[] = 'CREATE DATABASE `item_shop` CHARACTER SET utf8 COLLATE utf8_unicode_ci;';
						$query[] = 'DROP TABLE IF EXISTS `item_shop`.`items`;';
						$query[] = 'CREATE TABLE `item_shop`.`items` (
										`id` int(10) unsigned NOT NULL auto_increment,
										`vnum` int(10) unsigned NOT NULL,
										`name` varchar(255) collate utf8_unicode_ci NOT NULL,
										`description` varchar(255) collate utf8_unicode_ci NOT NULL,
										`count` int(3) NOT NULL,
										`price` int(10) NOT NULL,
										`tradable` int(1) NOT NULL,
										`all_chars` int(1) NOT NULL,
										`time` varchar(255) collate utf8_unicode_ci NOT NULL,
										`category` set("0","1","2","3") collate utf8_unicode_ci NOT NULL default "",
										PRIMARY KEY  (`id`)
									) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;';
						$query[] = 'INSERT INTO `item_shop`.`items` VALUES ("1", "71016", "Luva do ladrão", "Duplica as tuas hipóteses de capturar objectos por 30 minutos de jogo.", "1", "25", "0", "0", "30 minutos", "0,1");';
						$query[] = 'DROP TABLE IF EXISTS `item_shop`.`log`;';
						$query[] = 'CREATE TABLE `item_shop`.`log` (
										`id` int(10) unsigned NOT NULL auto_increment,
										`account_id` int(10) unsigned NOT NULL,
										`vnum` int(10) unsigned NOT NULL,
										`price` int(10) NOT NULL,
										`datetime` datetime NOT NULL,
										PRIMARY KEY  (`id`)
									) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;';
						$query[] = 'DROP TABLE IF EXISTS `account`.`orders`;';
						$query[] = 'CREATE TABLE `account`.`orders` (
										`order_id` int(11) NOT NULL AUTO_INCREMENT,
										`txn_id` varchar(19) NOT NULL,
										`payer_email` varchar(75) NOT NULL,
										`mc_gross` float(9,2) NOT NULL,
										PRIMARY KEY (`order_id`),
										UNIQUE KEY `txn_id` (`txn_id`)
									) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;';
						echo '<form action="config.php?step=4" method="POST">';
						echo '<h2>Base de Dados</h2>';
						foreach($query AS $update) {
							echo '<small>QUERY: <i>'.$update.'</i></small>';
							$update_table = mysqli_query($sql_server, $update);
							if($update_table) {
								echo '<p style="color:#080">Concluído</p>';
							} else {
								echo '<p style="color:#800">Erro: '.mysqli_error($sql_server).'</p>';
							}
						}
						echo '<small><a href="javascript:history.go(-2);">Clique aqui para voltar à configuração.</a>';
						echo '<input type="submit" class="button" name="finish" value="Concluir" />';
						echo '</form>';
					} else {
						goto home;
					}
				} elseif($_GET['step'] == 4) {
					if(isset($_POST['finish'])) {
						echo '<form action="config.php?step=5" method="POST">';
						echo '<h2>Concluído</h2>';
						echo '<p>A configuração da página web está concluída. Todos os dados estão guardados no ficheiro ./inc/config.php, em caso queira alterar algo.</p>';
						echo '<small>Após clicares em \'Concluír\', este script será eliminado.</small>';
						echo '<input type="submit" class="button" name="redirect" value="Concluír" />';
						echo '</form>';
					} else {
						goto home;
					}
				} elseif($_GET['step'] == 5) {
					if(isset($_POST['redirect'])) {
						unlink('config.php');
						echo '<meta http-equiv="refresh" content="0; URL=index.php" />';
					} else {
						goto home;
					}
				}
		?>
		<?PHP 
			} else {
		?>
		<?PHP home: ?>
		<form action="config.php?step=1" method="POST">
			<h2>Configuração</h2>
			<p>Bem vindo à página de configuração da página web. Este script irá configurar o ficheiro necessário para todo o funcionamento da página web. Clique no botão 'Configurar' para começar.</p>
			<small>Após a configuração, este script será eliminado.</small>
			<input type="submit" class="button" name="config" value="Configurar" />
		</form>
		<br /><small><center>Metin2 Project 2007 By <a href="http://cyber-gamers.org/index.php/user/53268-owsap/">OWSAP</a> © <?PHP echo date("Y"); ?></center></small>
		<?PHP
			}
		?>
	</body>
</html>