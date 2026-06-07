				<div id="topfive" class="sidebox" style="margin:0;padding:0;">
					<h3>Top 5 Sıralama</h3>
					<table style="margin-top:-11px;" id="scoretable" class="small">
						<tbody>
						<tr>
								<th>#</th>
								<th style="text-align:left;padding-left:8px;">Karakter</th>
																<th style="text-align:left;padding-left:8px;">Level</th>

							</tr>
							<?PHP
								$connection = mysqli_connect(sql_server_host, sql_server_user, sql_server_pass, 'player');
								$get_rank = 'SELECT player.id,player.name,player.level,player.exp,player_index.empire,guild.name AS guild_name 
									FROM player.player 
									LEFT JOIN player.player_index 
									ON player_index.id=player.account_id 
									LEFT JOIN player.guild_member 
									ON guild_member.pid=player.id 
									LEFT JOIN player.guild 
									ON guild.id=guild_member.guild_id 
									INNER JOIN account.account 
									ON account.id=player.account_id 
									WHERE player.name NOT LIKE "[%]%" AND account.status!="BLOCK" 
									ORDER BY player.level DESC, player.exp DESC 
									LIMIT 5';
								$result = mysqli_query($connection, $get_rank);
								$int = 0;
								while($array = mysqli_fetch_array($result)) {
									$int = $int + 1;	
									$divide = ($int %2 == 0) ? "odd" : "even";
									echo '<tr class="'.$divide.'">';
									echo '<td class="rank" style="color:#000000;">'.$int.'</td>';
									echo '<td class="name" style="color:#000000;">'.$array['name'].'</td>';
																		echo '<td class="level" style="color:#000000;">'.$array['level'].'</td>';

									echo '</tr>';
								}
							?>
						</tbody>
					</table>
				</div>