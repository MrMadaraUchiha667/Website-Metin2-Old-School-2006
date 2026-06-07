	<?PHP
		if(!empty($_SESSION['user_id'])) {
			echo '<body id="page_account" class="page_account">';
		} else {
	?>
	<body id="page_home" class="page_index">
		<?PHP
			}
			include('./inc/header.php');
		?>
		<div id="mainbody">
			<div id="sidebar_left">
				<?PHP
					if(!empty($_SESSION['user_id'])) {
						echo '<div id="sidemenu" class="account sidebox">';
					} else {
				?>
				<div id="sidemenu" class="index sidebox">
					<?PHP
						}
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
					<h3>Kayıt Ol</h3>
					<p><br /><a href="index.php?s=play_register" title="Registro">Buraya Tıklayrak</a> Yeni Bir Hesap Oluştur</p>
				</div>
				<div class="sidebox blue" id="boardbox">
					<h3>Forum</h3>
					<p>Topluluk Sitemize <a href="#" title="Nosso Fórum">Giriş Yap</a> ve Etkinliklerden Yararlan</p>
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
			<div id="content" style="width:390px;">
				<img src="content/home_rider.png" alt="" width="120" height="177" style="float:right; margin:0;" />
				<h1>MT2Dosyalar</h1>
				<p><strong>MT2Dosyalar</strong> sizi oryantal fantezi dünyasına götürür. Bir dövüş sanatları ustası olun ve toprağa hakim olan Metin Taşlarına karşı Tanrı Ejderhalarının bir müttefiki olarak savaşın . savaşın vahşi savaşlar , Üç imparatorluktan biri için topraklarını fethetmek ve imparatorlukları İmparator onları olurlar. Kaderin senin ellerinde!</strong></p>
				<center>					
					<a href="index.php?s=play_download" class="downloadnplay"><strong>Ücretsiz Oyna !</strong></a>
				</center>
				<p style="clear:both;">&nbsp;</p>
				<h2 style="clear:right;">Metin2 - Doğuya Has Macera</h2>
				<ul style="color:#990000;">
					<li><strong>Çok sayıda maceracı ve savaşçının sizi beklediği dev bir kıta.</strong></li>
					<li><strong>Girip savaşabileceğiniz üç imparatorluk.</strong></li>
					<li><strong>Onur için ve arazi, yaya ya da at sırtında mücadele!</strong></li>
					<li><strong>Lonca kurallarınızı oluşturun ve kendi güvenli yerinizi oluşturun.</strong></li>
					<li><strong>Birçok ölümcül beceriye sahip dövüş sanatlarında usta ol.</strong></li>
					<li><strong>Bir sanat ustası ol ve eşyalarını geliştir!</strong></li>
				</ul>
			</div>
			<div class="redrule"></div>
		</div>