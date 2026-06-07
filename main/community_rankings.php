	<body id="page_community" class="page_rankings">
		<?PHP
			include('./inc/header.php');
		?>
		<div id="mainbody">
			<div id="sidebar_left">
				<div id="sidemenu" class="rankings sidebox">
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
				<div id="symbol" class="support"></div>
			</div>
			<div id="content">
				<h1>Classificações</h1>
				<div id="ranking">
					<?PHP
						if(isset($_GET['class'])) {
							$job = $_GET['class'];
						} else {
							$job = '-1';
						}
						$jobs = -1; $job0 = 0; $job1 = 1; $job2 = 2; $job3 = 3;
						if($job == 0) {
							$class = '(job = 0 OR job = 4) AND'; // guerreiro m/f
						} elseif($job == 1) {
							$class = '(job = 5 OR job = 1) AND'; // ninja m/f
						} elseif($job == 2) {
							$class = '(job = 2 OR job = 6) AND'; // sura m/f
						} elseif($job == 3) {
							$class = '(job = 7 OR job = 3) AND'; // xamã m/f
						} else {
							$class = '';
						}
						echo '<a id="link_all" class="active_ranking" href="index.php?s=community_rankings&class='.$jobs.'" title=""><span>Todos</span></a>&nbsp;';
						echo '<a id="link_c0" href="index.php?s=community_rankings&class='.$job0.'" title="Guerreira"><span>Guerreira</span></a>&nbsp;';
						echo '<a id="link_c1" href="index.php?s=community_rankings&class='.$job1.'" title="Ninja"><span>Ninja</span></a>&nbsp;';
						echo '<a id="link_c2" href="index.php?s=community_rankings&class='.$job2.'" title="Sura"><span>Sura</span></a>&nbsp;';
						echo '<a id="link_c3" href="index.php?s=community_rankings&class='.$job3.'" title="Shaman"><span>Shaman</span></a>';
					?>
					<form id="searchform" action="" method="post" charset="utf-8">
						<div>
							<table>
								<tr>
									<td>Mostrar Personagem:</td>
									<td><input type="hidden" name="class" value="-1"/><input type="hidden" name="s" value="1"/> <input type="text" name="name" /><input type="submit" value="Procurar" /></td>
								</tr>
							</table>
						</div>
					</form>
					<table id="scoretable">
						<colgroup>
							<col width="18%" />
							<col width="40%" />
							<col width="12%" />
							<col width="30%" />
						</colgroup>
						<thead>
							<tr>
								<th>Classificação</th>
								<th>Nome</th>
								<th>Nível</th>
								<th>EXP</th>
							</tr>
						</thead>
						<tbody>
						<?PHP
							$connection = mysqli_connect(sql_server_host, sql_server_user, sql_server_pass, 'player');
							
							$get_players = "SELECT * FROM `player`";
							$max_rows = mysqli_query($connection, $get_players);
							$total_players = mysqli_num_rows($max_rows);
							
							echo '<a id="link_top" href="index.php?s=community_rankings&class='.$job.'&players=0" title="Top 10"><span>Top 10</span></a>';
							echo '<a id="link_last" href="index.php?s=community_rankings&class='.$job.'&players='.$total_players.'" title="Apenas qualificado"><span>Apenas qualificado</span></a>';
							if(isset($_GET['players'])) {
								$get = $_GET['players'];
							} else {
								$get = 0;
							}
							$next_players = $get+10;
							$previous_players = $get-10;
							
							if($get > $total_players) { // if $get is greater than $total_players,
								echo '<a id="link_better" name="players" href="index.php?s=community_rankings&class='.$job.'&players='.$previous_players.'" title="mostrar classificações anteriores"></a>';
							} elseif($get >= 10) { // if $get is greater or equal to $total_players,
								echo '<a id="link_better" href="index.php?s=community_rankings&class='.$job.'&players='.$previous_players.'" title="mostrar classificações anteriores"></a>';
							} elseif($get < $total_players) { // if $total_players is greater than $get,
								echo '<a id="link_worse" href="index.php?s=community_rankings&class='.$job.'&players='.$next_players.'" title="mostrar classificações seguintes"></a>';	
							} elseif($total_players <= 10) { // if $total_players is less or equal to 30,
								// don´t show previous or next buttons
							} else {
								echo '<a id="link_worse" href="index.php?s=community_rankings&class='.$job.'&players='.$next_players.'" title="mostrar classificações seguintes"></a>';
							}
							$get_rank = 'SELECT * FROM `player` WHERE '.$class.' name NOT LIKE "[%]%" ORDER BY level DESC, exp DESC, name ASC LIMIT '.$get.',10';
							$result = mysqli_query($connection, $get_rank);
							$int = 0 + $get;
							while($array = mysqli_fetch_array($result)) {
								$int = $int + 1;	
								$divide = ($int %2 == 0) ? "odd" : "even";
								echo '<tr class="'.$divide.'">
									<td class="rank" style="color:#000000;">'.$int.'</td>
									<td class="name" style="color:#000000;">'.$array['name'].'</td>
									<td class="level" style="color:#000000;">'.$array['level'].'</td>
									<td class="exp" style="color:#000000;">'.$array['exp'].'</td>
								</tr>';
							}
						?>
						</tbody>
					</table>
					<?PHP $update_time = mktime(date("H"),date("i")-10,date("s"),date("m"),date("d"),date("Y")); echo "".date("D d F Y H:i:s", $update_time); ?>
				</div>
			</div>
			<div class="redrule"></div>
		</div>