	<body id="page_game" class="page_characters">
		<?PHP
			include('./inc/header.php');
		?>
		<div id="mainbody">
			<div id="sidebar_left">
				<div id="sidemenu" class="characters sidebox">
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
				<h1>Personagens</h1>
				<p>No Metin2 existem <strong>quatro personagens</strong> que decide entre duas habilidades raciais diferentes.</p>
				<a href="#warrior" title="Guerreira">Guerreira</a> | <a href="#ninja" title="Ninja">Ninja</a> | <a href="#shaman" title="Shaman">Shaman</a> | <a href="#sura" title="Sura">Sura</a>				
				<div style="position:relative; margin-top:20px;">
					<img src="content/characters/warrior.jpg" width="150" height="258" alt="" style="position:absolute; left:0px; top:0px;" />
					<div style="margin-left:160px; margin-right:100px;">
						<a name="warrior"></a>
						<h2>Guerreira</h2>
						<p>É no <strong>combate corpo-a-corpo</strong> que os Guerreiros são mestres, devido ao seu armamento e à sua armadura pesada necessitam de uma <strong>enorme força física</strong> e de uma mente sã.</p>
						<p>Dependendo das habilidades escolhidas, eles podem usar lâminas enormes e fazer graves danos ou fazer contra-ataques espectaculares, após defender com o seu escudo os ataques dos seus inimigos.</p>						
					</div>
				</div>
				<div style="position:relative; z-index:2; margin-top:40px;">
					<img src="content/characters/ninja.jpg" width="200" height="265" alt="" style="position:absolute; right:0px; top:-30px;" />
					<div style="margin-right:220px;">
						<a name="ninja"></a>
						<h2>Ninja</h2>
						<p>Os Ninjas são <strong>assassinos profissionais</strong>, que podem fazer <strong>emboscadas</strong>. Eles só usam armadura leve para conseguírem aumentar a velocidade e mobilidade.</p>
						<p>Como resultado da escolha das suas habilidades, os Ninjas são mestres a lutar com adagas ou no uso do arco a grandes distâncias.</p>						
					</div>
				</div>
				<div style="position:relative; z-index:3; margin-right:120px; margin-top:30px;">
					<img src="content/characters/shaman.jpg" width="124" height="260" alt="" style="position:absolute; left:0px; top:0px;" />
					<div style="margin-left:140px;">
						<a name="shaman"></a>
						<h2>Shaman</h2>
						<p>Os Shamans são sábios que usam <strong>Feitiços e Magia</strong>. Quando estão a lutar e a ajudar os seus amigos, os seus <strong>poderes místicos</strong> podem ser decisivos.</p>
						<p>Dependendo das habilidades escolhidas, um shaman tem a possibilidade de aumentar o dano do ataque ou melhorar os seus feitiços de cura e de ajuda.</p>
					</div>
				</div>
				<div style="position:relative; margin-top:90px; margin-bottom:30px;">
					<img src="content/characters/sura.jpg" width="110" height="266" alt="" style="position:absolute; right:0px; top:-100px;" />
					<div style="margin-right:130px;">
						<a name="sura"></a>
						<h2>Sura</h2>
						<p>Os Suras são <strong>Guerreiros</strong> que desenvolveram <strong>poderes mágicos</strong> quando decidiram deixar crescer a <strong>Seed of Devil</strong> no seu braço. Por isso é que são tão bons a <strong>manejar</strong> espadas em combate directo, assim como a <strong>usar a magia</strong> contra os seus inimigos.</p>
						<p>Como resultado da escolha das suas habilidades, eles melhoram os seus feitiços de ataque ou ganham magias de suporte adicionais.</p>
					</div>
				</div>
			</div>
			<div class="redrule"></div>
		</div>