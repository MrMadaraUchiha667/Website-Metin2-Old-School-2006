	<body id="page_play" class="page_download">
		<?PHP
			include('./inc/header.php');
		?>
		<div id="mainbody">
			<div id="sidebar_left">
				<div id="sidemenu" class="download sidebox">
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
				<div id="symbol" class="game"></div>
			</div>
			<div id="content">
				<h1>Download</h1>
				<p><strong>Metin2</strong> já esta disponível</p>
				<p>O programa de instalação pode ser descarregado aqui:</p>				
				<p><strong><a href="<?PHP echo $serverSettings['client_download']; ?>">Metin2 download - Servidor 1. (413 MB)</a></strong></p>
				<p>&nbsp;</p>
				<p><center><a style="font-size:large" href="index.php?s=play_register">Regista-te aqui!</a></center></p>
				<h2>Instalação</h2>
				<p><p><strong>Guarda o ficheiro de instalação</strong> (Metin2.exe) no teu ambiente de trabalho. Depois <strong>abre o ficheiro</strong> (faz duplo-clique no ficheiro)</p>
				<p>Segue os passos do programa de instalação!</p></p>
			</div>
			<div class="redrule"></div>
		</div>