	<body id="page_home" class="page_logout">
		<?PHP
			include('./inc/header.php');
		?>
		<div id="mainbody">
			<div id="sidebar_left">
				<div id="symbol" class="game"></div>
			</div>
			<div id="content">
				<?PHP
					if(empty($_SESSION)) {
						session_destroy();
						header('Refresh:0; url=index.php');
					} else {
						echo '<h1>Logout</h1>';
						echo '<p>Por favor aguarde...</p>';
						unset($_SESSION['user_id']);
						unset($_SESSION['user_name']);
						unset($_SESSION['user_email']);
						unset($_SESSION['user_real_name']);
						unset($_SESSION['user_social_id']);
						unset($_SESSION['user_cash']);
						unset($_SESSION['user_coins']);
						unset($_SESSION['mall_pos']);
						unset($_SESSION['hash']);
						unset($_SESSION['checksum']);
						session_destroy();
						header('Refresh:1; url=index.php');
					}
				?>
			</div>
			<div class="redrule"></div>
		</div>