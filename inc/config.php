<?PHP
	// server database
	DEFINE('sql_server_host', 'server ip adresi');
	DEFINE('sql_server_user', 'root');
	DEFINE('sql_server_pass', 'sifresi');
	// server settings
	$serverSettings['homepage_name'] = 'MT2Dosyalar';
	$serverSettings['server_name'] = 'MT2Dosyalar';
	$serverSettings['server_description'] = 'MT2Dosyalar';
	$serverSettings['server_url'] = 'https://mt2dosyalar.com/';
	$serverSettings['server_mail'] = 'da@hotmail.com';
	$serverSettings['server_support_mail'] = 'sa@hotmail.com';
	$serverSettings['client_download'] = 'https://siteadresi.com';
	$serverSettings['registration'] = true;
	$serverSettings['mail_activation'] = true;
	// email headers
	$mail_headers = 'X-Priority: 3' . "\r\n";
	$mail_headers .= 'X-Mailer: '.$serverSettings['server_name'].' Mailer' . "\r\n";
	$mail_headers .= 'MIME-Version: 1.0' . "\r\n";
	$mail_headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$mail_headers .= 'From: '.$serverSettings['server_name'].' <'.$serverSettings['server_mail'].'>' . "\r\n";
	$mail_headers .= 'Reply-To: '.$serverSettings['server_mail'] . "\r\n";
	// email subject
	// email content
	// email footer
	$mail_footer = 'Este e-mail foi gerado automaticamente. Por favor não-o responda pois não é dado suporte ao jogo ou facturação.<br />';
	$mail_footer .= 'Suporte: '.$serverSettings['server_support_mail'].'<br /><br />';
	$mail_footer .= 'adana<br />';
	$mail_footer .= 'Telefone: 1221212121<br />';
	$mail_footer .= 'Contacto: dsadsa@hotmail.com<br />';
?>