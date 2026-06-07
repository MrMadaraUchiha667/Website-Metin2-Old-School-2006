					<div id="menu_game">
						<h3>Hakkımızda</h3>
						<a id="submenu_features" href="index.php?s=game_features">Genel</span>
						<a id="submenu_story" href="index.php?s=game_story">Tarihi</a>
						<a id="submenu_empires" href="index.php?s=game_empires">Bayraklar</a>
						<a id="submenu_characters" href="index.php?s=game_characters">Karakterler</a>
					</div>
					<div id="menu_gallery">
						<h3>Resim Galerisi</h3>
						<a id="submenu_screens" href="index.php?s=gallery_screens">Ekran Resimleri</a>
						<a id="submenu_movies" href="index.php?s=gallery_movies">Videolar</a>
						<a id="submenu_wallpaper" href="index.php?s=gallery_wallpaper">Duvar Kağıtları</a>
					</div>
					<div id="menu_play">
						<h3>Tanıtım</h3>
						<a id="submenu_manual" href="index.php?s=play_manual">Nasıl Oynanır ?</a>
						<a id="submenu_hardware" href="index.php?s=play_hardware">Sistem Gereksinimleri</a>
						<a id="submenu_download" href="index.php?s=play_download">Oyunu İndir</a>
						<a id="submenu_register" href="index.php?s=play_register">Kayıt Ol</a>
					</div>
					<div id="menu_community">
						<h3>Sıralama</h3>
						<a id="submenu_rankings" href="index.php?s=community_rankings">Sıralamalar</a>
						<a id="submenu_faq" href="index.php?s=community_faq">Kurallar</a>
						<a id="submenu_board" href="#" target="_blank">Fórum</a>
					</div>

					<?PHP
						if(!empty($_SESSION['user_id'])) {
							// ...
					?>
					<div id="menu_account">
						<h3>Informação da Conta</h3>
						<div style="margin-left:-20px;font-size:11px;">
							<a id="submenu_data" href="index.php?s=account_data">Hesabım</a>
							<a id="submenu_itemshop" href="index.php?s=shop_items">Market</a>
							<a id="submenu_donate" href="index.php?s=donate">Yükleme Yap</a>
							<a id="submenu_logout" href="index.php?s=account_logout">Çıkış Yap</a>
						</div>
					</div>
					<?PHP
						}
					?>