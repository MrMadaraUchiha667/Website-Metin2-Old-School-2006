	<body id="page_shop" class="page_category_0">
		<?PHP
			include('./inc/header.php');
		?>
		<div id="mainbody">
			<div id="sidebar_left">
				<?PHP
					if(isset($_GET['category']) && is_numeric($_GET['category']) && preg_match('/^[1-9][0-9]*$/', $_GET['category'])) {
						echo '<div id="sidemenu" class="page_category_'.$_GET['category'].' sidebox">';
					} else {
						// ...
				?>
				<?PHP
					if(!empty($_SESSION['user_id'])) {
						echo '<div id="sidemenu" class="page_category_0 sidebox">';
					} else {
						echo '<div id="sidemenu">';
					}
				?>
					<?PHP
					}
						include('./inc/sidebar_login.php');
					?>
					<?PHP
						include('./inc/submenus.php');
					?>
					<?PHP
						if(!empty($_SESSION['user_id'])) {
							echo '<div id="menu_shop">';
							echo '<h3>Loja de Artigos</h3>';
							echo '<a id="submenu_category_0" href="index.php?s=shop_items&category=0">Todos os artigos</a>';
							echo '<a id="submenu_category_1" href="index.php?s=shop_items&category=1">Reforço à conta</a>';
							echo '</div>';
						}
					?>
				</div>
				<div id="symbol" class="game"></div>
			</div>
			<div id="content">
				<h1>Loja de Artigos</h1>
				<?PHP
					if(!empty($_SESSION['user_id'])) {
						echo '<p id="txt"><p>Bem vindo à <strong>Tenda de artigos</strong> do Metin2!</p>';
						echo '<p>Aqui poderás adquirir <strong>equipamento e objectos únicos</strong> para as tuas personagens, que te oferecerão <strong>habilidades especiais</strong>.</p>';
						echo '<p><strong>Importante!</strong> Os artigos adquiridos não aparecerão no teu inventário, mas serão depositados pelo <strong>Administrador do armazém</strong>. Aí poderás pôr teu(s) artigo(s) em qualquer personagem.</p>';						
						echo '<h2>Tens, <strong>'.$_SESSION['user_cash'].'</strong> MD</h2>';
						
						$connection = mysqli_connect(sql_server_host, sql_server_user, sql_server_pass, 'account');
						$connection->query('SET NAMES utf8');
						$_SESSION['checksum'] = md5(uniqid(rand(), true));
						check_category:
						if(isset($_GET['category']) && is_numeric($_GET['category'])) {
							$items = 'SELECT * FROM `item_shop`.`items` WHERE category LIKE "%'.$_GET['category'].'%"';
							$get_items = mysqli_query($connection, $items);
							if(!empty(mysqli_num_rows($get_items))) {
								while($item_data = mysqli_fetch_object($get_items)) {
									echo '<a name="'.$item_data->vnum.'" />';
									echo '<div class="shopitem">';
									echo '<h3>'.$item_data->name.'</h3>';
									echo '<table cellpadding="0" cellspacing="0">';
									echo '<tr>';
									echo '<td rowspan="3" class="display">';
									echo '<img title="'.$item_data->name.'" src="layout/images/shopitems/'.$item_data->vnum.'-s.gif" width="70" height="70" style="display:block" />';
									echo '<div class="count">('.$item_data->count.' Peças)</div>';
									echo '<div class="price" title="Este item custa '.$item_data->price.' MD.">'.$item_data->price.' MD</div>';
									echo '</td>';
									if(preg_match('[segundo|segundos|minuto|minutos|hora|horas]', $item_data->time) == true) {
										echo '<td class="playtime">Funciona durante '.$item_data->time.' de jogo</td>';
									} elseif(preg_match('[dia|dias|semana|semanas]', $item_data->time) == true) {
										echo '<td class="days">Funciona durante '.$item_data->time.' de calendário</td>';
									} else {
										echo '<td class="instant">Uma unica aplicação</td>';
									}
									if($item_data->tradable == 0) {
										echo '<td class="notrade">Não comercial</td>';
									} else {
										echo '<td class="trade">Comercial</td>';
									}
									echo '</tr>';
									echo '<tr>';
									echo '<td class="description" colspan="2"><p>'.$item_data->description.'</p></td>';
									echo '</tr>';
									echo '<tr>';
									if($item_data->all_chars != 0) {
										echo '<td class="actions"><strong style="background-repeat:no-repeat;background-image:url(layout/images/plusplus.gif);padding-left:16px">Disponível para todos as personagens</strong></td>';
									} else {
										echo '<td class="actions"></td>';
									}
									echo '<td class="actions">';
									echo '<a href="index.php?s=shop_buy_items&buy='.$item_data->id.'&hash='.$_SESSION['hash'].'&chksum='.$_SESSION['checksum'].'" title="Comprar agora '.$item_data->count.' x '.$item_data->name.'!" class="buy"><div>Comprar</div></a>';
									echo '</td>';
									echo '</tr>';
									echo '</table>';
									echo '</div>';
									echo '<br />';
								}
							} else {
								echo '<p class="error">Não existe artigos à venda.</p>';
							}
						} else {
							$_GET['category'] = 0;
							goto check_category;
						}
					} else {
						echo '<p class="error">Não estás identificado! Primeiro tens de fazer <a href="index.php?s=account_login">login</a> para conseguíres comprar artigos.</p>';
					}
				?>
				<br />
			</div>
			<div class="redrule"></div>
		</div>