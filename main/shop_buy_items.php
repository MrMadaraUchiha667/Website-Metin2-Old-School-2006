	<body id="page_shop" class="page_category_0">
		<?PHP
			include('./inc/header.php');
		?>
		<div id="mainbody">
			<div id="sidebar_left">
				<div id="sidemenu">
					<?PHP
						include('./inc/sidebar_login.php');
					?>
					<?PHP
						include('./inc/submenus.php');
					?>
				</div>
				<div id="symbol" class="game"></div>
			</div>
			<div id="content">
				<?PHP
					if(!empty($_SESSION['user_id'])) {
						$connection = mysqli_connect(sql_server_host, sql_server_user, sql_server_pass, 'account');
						$connection->query('SET NAMES utf8');
						if(isset($_GET['buy']) && isset($_GET['hash']) && !empty($_GET['hash']) && isset($_GET['chksum']) && !empty($_GET['chksum'])) {
							if(strlen($_GET['hash']) == 32 && preg_match('/^[a-zA-Z0-9]+$/', $_GET['hash']) && strlen($_GET['chksum']) == 32 && preg_match('/^[a-zA-Z0-9]+$/', $_GET['chksum'])) {
								if($_SESSION['hash'] == $_GET['hash'] && $_SESSION['checksum'] == $_GET['chksum']) {
									// get item data
									$get_item = 'SELECT * FROM `item_shop`.`items` WHERE `id` = "'.$_GET['buy'].'"';
									$get_item_result = mysqli_query($connection, $get_item);
									if(mysqli_num_rows($get_item_result)) {
										$get_item_data = mysqli_fetch_object($get_item_result);
										echo '<h1>Loja de Artigos - Confirmação</h1>';
										echo '<h2>'.$get_item_data->id.'. '.$get_item_data->name.' ('.$get_item_data->count.' und.) - '.$get_item_data->price.' MD</h2>';
										if(isset($_POST['buy_item'])) {
											// get user data
											$get_user = 'SELECT * FROM `account`.`account` WHERE `login` = "'.$_SESSION['user_name'].'"';
											$get_user_result = mysqli_query($connection, $get_user);
											if(mysqli_num_rows($get_user_result)) {
												$get_user_data = mysqli_fetch_object($get_user_result);
												// compare coins
												if($get_item_data->price <= $get_user_data->cash) {
													$give_item = 'INSERT INTO `player`.`item` SET `owner_id` = "'.$get_user_data->id.'", `window` = "MALL", `pos` = "'.$_SESSION['mall_pos'].'", `count` = "'.$get_item_data->count.'", `vnum` = "'.$get_item_data->vnum.'"';
													$give_item_result = mysqli_query($connection, $give_item);
													// if delivery is ok...
													if($give_item_result) {
														// set item mall position
														if($_SESSION['mall_pos'] == '44') {
															$_SESSION['mall_pos'] = '0';
														} else {
															$_SESSION['mall_pos'] = $_SESSION['mall_pos'] + 1;
														}
														$purchase = $get_user_data->cash - $get_item_data->price;
														$update_cash = 'UPDATE `account`.`account` SET `cash` = "'.$purchase.'" WHERE `login` = "'.$_SESSION['user_name'].'"';
														$update_cash_result = mysqli_query($connection, $update_cash);
														// if purchase is ok...
														if($update_cash_result) {
															$_SESSION['user_cash'] = $purchase;
															echo '<p><font color="green">Compraste '.$get_item_data->name.' por '.$get_item_data->price.' MD.</font></p>';
															echo '<a href="index.php?s=shop_items" title="Voltar">< Voltar à loja de artigos</a>';
															$create_log = 'INSERT INTO `item_shop`.`log` SET `account_id` = "'.$get_user_data->id.'", `vnum` = "'.$get_item_data->vnum.'", `price` = "'.$get_item_data->price.'", `datetime` = NOW(),';
															$create_log_result = mysqli_query($connection, $create_log);
														} else {
															echo '<p class="error">Houve um erro na compra.</p>';
														}
													} else {
														echo '<p class="error">Houve um erro na entrega do item.</p>';
													}
												} else { 
													echo '<p class="error">Não tens MD suficientes. (<a href="index.php?s=donate">obter mais</a>)';
												}
											} else {
												header('Refresh:0; url=index.php?s=shop_items');
											}
										} else {
											echo '<p>Queres confirmar esta compra?</p>';
											echo '<form name="buy" method="POST">';
											echo '<a name="'.$get_item_data->vnum.'" />';
											echo '<div class="shopitem">';
											echo '<h3>'.$get_item_data->name.'</h3>';
											echo '<table cellpadding="0" cellspacing="0">';
											echo '<tr>';
											echo '<td rowspan="3" class="display">';
											echo '<img title="'.$get_item_data->name.'" src="layout/images/shopitems/'.$get_item_data->vnum.'-s.gif" width="70" height="70" style="display:block" />';
											echo '<div class="count">('.$get_item_data->count.' Peças)</div>';
											echo '<div class="price" title="Este item custa '.$get_item_data->price.' MD.">'.$get_item_data->price.' MD</div>';
											echo '</td>';
											if(preg_match('[segundo|segundos|minuto|minutos|hora|horas]', $get_item_data->time) == true) {
												echo '<td class="playtime">Funciona durante '.$get_item_data->time.' de jogo</td>';
											} elseif(preg_match('[dia|dias|semana|semanas]', $get_item_data->time) == true) {
												echo '<td class="days">Funciona durante '.$get_item_data->time.' de calendário</td>';
											} else {
												echo '<td class="instant">Uma unica aplicação</td>';
											}
											if($get_item_data->tradable == 0) {
												echo '<td class="notrade">Não comercial</td>';
											} else {
												echo '<td class="trade">Comercial</td>';
											}
											echo '</tr>';
											echo '<tr>';
											echo '<td class="description" colspan="2"><p>'.$get_item_data->description.'</p></td>';
											echo '</tr>';
											echo '<tr>';
											if($get_item_data->all_chars != 0) {
												echo '<td class="actions"><strong style="background-repeat:no-repeat;background-image:url(layout/images/plusplus.gif);padding-left:16px">Disponível para todos as personagens</strong></td>';
											} else {
												echo '<td class="actions"></td>';
											}
											echo '<td class="actions">';
											echo '<input type="submit" name="buy_item" class="buy" value="Confirmar" />';
											echo '</td>';
											echo '</tr>';
											echo '</table>';
											echo '</div>';
											echo '<br />';
											echo '</form>';
											echo '<a href="index.php?s=shop_items" title="Voltar">< Voltar à loja de artigos</a>';
										}
									} else {
										header('Refresh:0; url=index.php?s=shop_items');
									}
								} else {
									header('Refresh:0; url=index.php?s=shop_items');
								}
							} else {
								header('Refresh:0; url=index.php?s=shop_items');
							}
						} else {
							header('Refresh:0; url=index.php?s=shop_items');
						}
					} else {
						header('Refresh:0; url=index.php');
					}
				?>
				<br />
			</div>
			<div class="redrule"></div>
		</div>