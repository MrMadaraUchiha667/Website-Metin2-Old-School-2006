<?PHP
	if(file_exists('config.php')) {
		header("Location: config.php");
		die();
	}
	header('Content-Type: text/html; charset=UTF-8');
	error_reporting(0);
	session_start();
	require('./inc/config.php');
	
	$connection = mysqli_connect(sql_server_host, sql_server_user, sql_server_pass);
	if(!$connection) {
		die ('A conexão com a base de dados falhou.<hr><font color="red">'.mysqli_connect_error().'</font>');
	}
?>
<!DOCTYPE html>
<html lang="pt">
	<head>
		<meta charset="utf-8" />
		<title><?PHP echo $serverSettings['homepage_name']; ?></title>
		<meta name="description" content="<?PHP echo $serverSettings['server_description']; ?>" />
		
		<link rel="stylesheet" href="layout/metin_scr.css" type="text/css" />
		<link rel="stylesheet" href="lang/pt/layout/metin_scr.css" type="text/css" />
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
	</head>
		<?PHP
			$includeDir = './main/';
			$includeDefault = $includeDir.'home.php';
			
			if(isset($_GET['s']) && !empty($_GET['s'])) {
				$_GET['s'] = str_replace('\0', '', $_GET['s']);
				$includeFile = basename(realpath($includeDir.$_GET['s'].'.php'));
				$includePath = $includeDir.$includeFile;
				
				if(!empty($includeFile) && file_exists($includePath)) {
					include($includePath);
				} else {
					header('Refresh:0; url=index.php');
				}
			} else {
				header('Refresh:0; url=index.php?s=home');
			}
		?>
		<?PHP
			include('./inc/footer.php');
		?>
		<div id="preloadedImages">
			<div id="button_home_over"></div>
			<div id="button_game_over"></div>
			<div id="button_gallery_over"></div>
			<div id="button_play_over"></div>
			<div id="button_community_over"></div>
			<div id="button_shop_over.jpg"></div>
			<div id="button_buy_over"></div>
			<div id="button_gift_over"></div>
			<div id="spielpass_over"></div>
			<div id="download_over"></div>
		</div>
	</body>
</html>