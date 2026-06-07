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
					echo '<h1>A tua Conta</h1>';
					echo '<fieldset><legend>Informação da conta</legend><table>';
					echo '<ul style="color:#990000;">';
					echo '<li><strong>Jogador:</strong> '.$_SESSION['user_name'].'</li>';
					echo '<li><strong>Email:</strong> '.$_SESSION['user_email'].'</li>';
					echo '<li><strong>As tuas Moedas Dragão:</strong> '.$_SESSION['user_cash'].' <a href="index.php?donate">(obter)</a></li>';
					echo '<li><strong>Os teus Escudos do Dragão:</strong> '.$_SESSION['user_coins'].'</li>';
					echo '</ul>';
			?>
						<ul>
							<li><a href="index.php?s=donate">Obter MD</a></li>
							<li><a href="index.php?s=account_change_password">Mudar a Palavra-Passe</a></li>
						</ul>
					</table>
				</fieldset>
			<?PHP
				} else {
					echo '<h1>Erro</h1>';
					echo '<p class="error">Não tens permissão para acessar esta página.</p>';
					header('Refresh:3; url=index.php');
				}
			?>
			</div>
			<div class="redrule"></div>
		</div>