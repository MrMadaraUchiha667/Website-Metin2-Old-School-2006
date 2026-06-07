	<body id="page_gallery" class="page_singlescreenshot">
		<?PHP
			include('./inc/header.php');
		?>
		<div id="mainbody">
			<div id="sidebar_left">
				<div id="sidemenu" class="singlescreenshot sidebox">
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
				<div id="symbol" class="gallery"></div>
			</div>
			<div id="content">
				<h1>Screenshots</h1>
					<?PHP
						$id = $_REQUEST['id'];
						switch($id) {
							default: include('show.php');
							break;
							case "1": 
								echo '<p><strong><span style="color:#999999;">&lt; Screenshot anterior</span> | <a href="index.php?s=gallery_screens">Descrição</a> | <a href="index.php?s=show&id=2">Seguinte screenshot &gt;</a></strong></p>';
								echo '<a href="index.php?s=gallery_screens"><img src="content/screens/001.jpg" alt="" width="550" height="366"/></a><h2>Arquitectura Oriental</h2>';
								break;
							case "2": 
								echo '<p><strong><a href="index.php?s=show&id=1">&lt; Screenshot anterior</a> | <a href="index.php?s=gallery_screens">Descrição</a> | <a href="index.php?s=show&id=3">Seguinte screenshot &gt;</a></strong></p>';
								echo '<a href="index.php?s=gallery_screens"><img src="content/screens/002.jpg" alt="" width="550" height="366"/></a><h2>Pesca feliz</h2>';
								break;
							case "3": 
								echo '<p><strong><a href="index.php?s=show&id=2">&lt; Screenshot anterior</a> | <a href="index.php?s=gallery_screens">Descrição</a> | <a href="index.php?s=show&id=4">Seguinte screenshot &gt;</a></strong></p>';
								echo '<a href="index.php?s=gallery_screens"><img src="content/screens/003.jpg" alt="" width="550" height="366"/></a><h2>Montagem</h2>';
								break;
							case "4": 
								echo '<p><strong><a href="index.php?s=show&id=3">&lt; Screenshot anterior</a> | <a href="index.php?s=gallery_screens">Descrição</a> | <a href="index.php?s=show&id=5">Seguinte screenshot &gt;</a></strong></p>';
								echo '<a href="index.php?s=gallery_screens"><img src="content/screens/004.jpg" alt="" width="550" height="366"/></a><h2>Confiança mutua</h2>';
								break;
							case "5": 
								echo '<p><strong><a href="index.php?s=show&id=4">&lt; Screenshot anterior</a> | <a href="index.php?s=gallery_screens">Descrição</a> | <a href="index.php?s=show&id=6">Seguinte screenshot &gt;</a></strong></p>';
								echo '<a href="index.php?s=gallery_screens"><img src="content/screens/005.jpg" alt="" width="550" height="366"/></a><h2>Acção em campo</h2>';
								break;
							case "6": 
								echo '<p><strong><a href="index.php?s=show&id=5">&lt; Screenshot anterior</a> | <a href="index.php?s=gallery_screens">Descrição</a> | <a href="index.php?s=show&id=7">Seguinte screenshot &gt;</a></strong></p>';
								echo '<a href="index.php?s=gallery_screens"><img src="content/screens/006.jpg" alt="" width="550" height="366"/></a><h2>Múltiplos monstros</h2>';
								break;
							case "7": 
								echo '<p><strong><a href="index.php?s=show&id=6">&lt; Screenshot anterior</a> | <a href="index.php?s=gallery_screens">Descrição</a> | <a href="index.php?s=show&id=8">Seguinte screenshot &gt;</a></strong></p>';
								echo '<a href="index.php?s=gallery_screens"><img src="content/screens/007.jpg" alt="" width="550" height="366"/></a><h2>Cavalga e luta no teu cavalo!</h2>';
								break;
							case "8": 
								echo '<p><strong><a href="index.php?s=show&id=7">&lt; Screenshot anterior</a> | <a href="index.php?s=gallery_screens">Descrição</a> | <a href="index.php?s=show&id=9">Seguinte screenshot &gt;</a></strong></p>';
								echo '<a href="index.php?s=gallery_screens"><img src="content/screens/008.jpg" alt="" width="550" height="366"/></a><h2>Há lugares geniais para ir pescar</h2>';
								break;
							case "9": 
								echo '<p><strong><a href="index.php?s=show&id=8">&lt; Screenshot anterior</a> | <a href="index.php?s=gallery_screens">Descrição</a> | <span style="color:#999999;">Seguinte screenshot &gt;</span></strong></p>';
								echo '<a href="index.php?s=gallery_screens"><img src="content/screens/009.jpg" alt="" width="550" height="366"/></a><h2>Uma luta difícil</h2>';
							break;
						}
					?>
			</div>
			<div class="redrule"></div>
		</div>