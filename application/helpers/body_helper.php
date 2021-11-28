<?php 
	function email_konfirmasi(array $isi){
	$body = '<!doctype html><html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head> <title>Email Konfirmasi</title> <meta http-equiv="X-UA-Compatible" content="IE=edge"> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1"> <style type="text/css"> #outlook a{padding:0}.ReadMsgBody{width:100%}.ExternalClass{width:100%}.ExternalClass *{line-height:100%}body{margin:0;padding:0;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%}table,td{border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0}img{border:0;height:auto;line-height:100%;outline:0;text-decoration:none;-ms-interpolation-mode:bicubic}p{display:block;margin:13px 0}.url a{color:#ffffff}.url a:hover{color:#ffff00}a:link,a:visited{color:#ffffff;text-align:center;text-decoration:none;display:inline-block}a:active,a:hover{color:#111111}</style> <style type="text/css">@media only screen and (max-width:480px){@-ms-viewport{width:320px}@viewport{width:320px}}</style><!--[if mso]> <xml> <o:OfficeDocumentSettings> <o:AllowPNG/> <o:PixelsPerInch>96</o:PixelsPerInch> </o:OfficeDocumentSettings> </xml><![endif]--><!--[if lte mso 11]> <style type="text/css"> .outlook-group-fix{width:100% !important;}</style><![endif]--> <style type="text/css">@media only screen and (min-width:480px){.mj-column-per-100{width: 100% !important;}}</style></head><body style="background-color:#f9f9f9;"> <div style="background-color:#f9f9f9;"><!--[if mso | IE]> <table align="center" border="0" cellpadding="0" cellspacing="0" style="width:600px;" width="600"> <tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--> <div style="background:#f9f9f9;background-color:#f9f9f9;Margin:0px auto;max-width:600px;"> <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#f9f9f9;background-color:#f9f9f9;width:100%;"> <tbody> <tr> <td style="border-bottom:#333957 solid 5px;direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;"><!--[if mso | IE]> <table role="presentation" border="0" cellpadding="0" cellspacing="0"> <tr> </tr></table><![endif]--> </td></tr></tbody> </table> </div><!--[if mso | IE]> </td></tr></table> <table align="center" border="0" cellpadding="0" cellspacing="0" style="width:600px;" width="600"> <tr> <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--> <div style="background:#fff;background-color:#fff;Margin:0px auto;max-width:600px;"> <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#fff;background-color:#fff;width:100%;"> <tbody> <tr> <td style="border:#dddddd solid 1px;border-top:0px;direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;"><!--[if mso | IE]> <table role="presentation" border="0" cellpadding="0" cellspacing="0"> <tr> <td style="vertical-align:bottom;width:600px;"><![endif]--> <div class="mj-column-per-100 outlook-group-fix" style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:bottom;width:100%;"> <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:bottom;" width="100%"> <tr> <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;"> <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;"> <tbody> <tr> <td style="width:64px;"> <img height="auto" src="cid:logo_jrp" style="border:0;display:block;outline:none;text-decoration:none;width:100%;" width="64"/> </td></tr></tbody> </table> </td></tr><tr> <td align="center" style="font-size:0px;padding:10px 25px;padding-bottom:40px;word-break:break-word;"> <div style="font-family:Arial,sans-serif;font-size:32px;font-weight:bold;line-height:1;text-align:center;color:#555;"> Silahkan konfirmasi email Anda </div></td></tr><tr> <td align="center" style="font-size:0px;padding:10px 25px;padding-bottom:0;word-break:break-word;"> <div style="font-family:Arial,sans-serif;font-size:16px;line-height:22px;text-align:center;color:#555;"> Terima kasih </div></td></tr><tr> <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;"> <div style="font-family:Arial,sans-serif;font-size:16px;line-height:22px;text-align:center;color:#555;"> Anda telah mendaftar di '.$isi['site_name'].'. </div></td></tr><tr> <td align="center" style="font-size:0px;padding:10px 25px;padding-bottom:20px;word-break:break-word;"> <div style="font-family:Arial,sans-serif;font-size:16px;line-height:22px;text-align:center;color:#555;"> Harap validasi alamat email Anda untuk mulai menggunakan Layanan. </div></td></tr><tr> <td align="center" style="font-size:0px;padding:10px 25px;padding-top:30px;padding-bottom:40px;word-break:break-word;"> <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:separate;line-height:100%;"> <tr> <td align="center" bgcolor="#2F67F6" role="presentation" style="border:none;border-radius:3px;color:#ffffff;cursor:auto;padding:15px 25px;" valign="middle"> <p class="url" style="color:#ffffff;font-family:Arial,sans-serif;font-size:15px;font-weight:normal;line-height:120%;Margin:0;text-decoration:none;text-transform:none;"> <a href="'.$isi['url_token'].'">Konfirmasikan Email Anda</a> </p></td></tr></table> </td></tr><tr> <td align="center" style="font-size:0px;padding:10px 25px;padding-bottom:0;word-break:break-word;"> <div style="font-family:Arial,sans-serif;font-size:16px;line-height:22px;text-align:center;color:#555;"> Atau verifikasi menggunakan tautan ini: </div></td></tr><tr> <td align="center" style="font-size:0px;padding:10px 25px;padding-bottom:40px;word-break:break-word;"> <div style="font-family:Arial,sans-serif;font-size:16px;line-height:22px;text-align:center;color:#555;"> <a href="'.$isi['url_token'].'" style="color:#2F67F6">'.$isi['url_token'].'</a> </div></td></tr><tr> <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;"> <div style="font-family:Arial,sans-serif;font-size:26px;font-weight:bold;line-height:1;text-align:center;color:#555;"> Butuh bantuan? </div></td></tr><tr> <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;"> <div style="font-family:Arial,sans-serif;font-size:14px;line-height:22px;text-align:center;color:#555;"> Silakan kirim dan umpan balik atau informasi bug<br>to <a href="mailto:kalkulatorcetak@gmail.com" style="color:#2F67F6">kalkulatorcetak@gmail.com</a> </div></td></tr></table> </div><!--[if mso | IE]> </td></tr></table><![endif]--> </td></tr></tbody> </table> </div><!--[if mso | IE]> </td></tr></table> <table align="center" border="0" cellpadding="0" cellspacing="0" style="width:600px;" width="600"> <tr> <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--> <div style="Margin:0px auto;max-width:600px;"> <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;"> <tbody> <tr> <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;"><!--[if mso | IE]> <table role="presentation" border="0" cellpadding="0" cellspacing="0"> <tr> <td style="vertical-align:bottom;width:600px;"><![endif]--> <div class="mj-column-per-100 outlook-group-fix" style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:bottom;width:100%;"> <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%"> <tbody> <tr> <td style="vertical-align:bottom;padding:0;"> <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%"> <tr> <td align="center" style="font-size:0px;padding:0;word-break:break-word;"> <div style="font-family:Arial,sans-serif;font-size:12px;font-weight:300;line-height:1;text-align:center;color:#575757;"> Jl. KH. Abdul Fatah Hasan. Serang 42117, INDONESIA </div></td></tr><tr> <td align="center" style="font-size:0px;padding:10px;word-break:break-word;"> <div style="font-family:Arial,sans-serif;font-size:12px;font-weight:300;line-height:1;text-align:center;color:#575757;"> <a href="'.$isi['url_simulasi'].'" style="color:#575757">Simulasi</a> </div></td></tr></table> </td></tr></tbody> </table> </div><!--[if mso | IE]> </td></tr></table><![endif]--> </td></tr></tbody> </table> </div><!--[if mso | IE]> </td></tr></table><![endif]--> </div></body></html>';
	return $body;
	}
	function body_satu(array $isi){
		$body = '<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0;">
		<meta name="format-detection" content="telephone=no"/>
		<style>
			/* Reset styles */ 
			body { margin: 0; padding: 0; min-width: 100%; width: 100% !important; height: 100% !important;}
			body, table, td, div, p, a { -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%; }
			table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse !important; border-spacing: 0; }
			img { border: 0; line-height: 100%; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; }
			#outlook a { padding: 0; }
			.ReadMsgBody { width: 100%; } .ExternalClass { width: 100%; }
			.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: 100%; }
			
			/* Rounded corners for advanced mail clients only */ 
			@media all and (min-width: 560px) {
			.container { border-radius: 8px; -webkit-border-radius: 8px; -moz-border-radius: 8px; -khtml-border-radius: 8px; }
			}
			
			/* Set color for auto links (addresses, dates, etc.) */ 
			a, a:hover {
			color: #FFFFFF;
			}
			.footer a, .footer a:hover {
			color: #828999;
			}
			
		</style>
		
		<!-- MESSAGE SUBJECT -->
		<title>Responsive HTML email templates</title>
		
	</head>
	
	<!-- BODY -->
	<!-- Set message background color (twice) and text color (twice) -->
	<body topmargin="0" rightmargin="0" bottommargin="0" leftmargin="0" marginwidth="0" marginheight="0" width="100%" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%; height: 100%; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%;
	background-color: #2D3445;
	color: #FFFFFF;"
	bgcolor="#2D3445"
	text="#FFFFFF">
		
		<!-- SECTION / BACKGROUND -->
		<!-- Set message background color one again -->
		<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%;" class="background"><tr><td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;"
			bgcolor="#2D3445">
				
				<!-- WRAPPER -->
				<!-- Set wrapper width (twice) -->
				<table border="0" cellpadding="0" cellspacing="0" align="center"
				width="500" style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit;
				max-width: 500px;" class="wrapper">
					
					<tr>
						<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
						padding-top: 20px;
						padding-bottom: 20px;">
							<a target="_blank" style="text-decoration: none;"
							href="'.$isi['site_url'].'">
							<img border="0" vspace="0" hspace="0" src="cid:logo_jrp" height="30" alt="Logo" title="Logo" style="color: #FFFFFF;
							font-size: 10px; margin: 0; padding: 0; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; border: none; display: block;" /></a>
						</td>
					</tr>
					<tr>
						<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;
						padding-top: 0px;" class="hero"><a target="_blank" style="text-decoration: none;"
							href="https://kalkulatorcetak.com/"><img border="0" vspace="0" hspace="0"
								src="https://hitungin.my.id/banner/promo.png"
								alt="Please enable images to view this content" title="Hero Image"
								width="340" style="
								width: 87.5%;
								max-width: 340px;
							color: #FFFFFF; font-size: 13px; margin: 0; padding: 0; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; border: none; display: block;"/></a></td>
					</tr>
					
					<!-- SUPHEADER -->
					<!-- Set text color and font family ("sans-serif" or "Georgia, serif") -->
					<tr>
						<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 14px; font-weight: 400; line-height: 150%; letter-spacing: 2px;
						padding-top: 27px;
						padding-bottom: 0;
						color: #FFFFFF;
						font-family: sans-serif;" class="supheader">
							INTRODUCING
						</td>
					</tr>
					
					<!-- HEADER -->
					<!-- Set text color and font family ("sans-serif" or "Georgia, serif") -->
					<tr>
						<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;  padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 24px; font-weight: bold; line-height: 130%;
						padding-top: 5px;
						color: #FFFFFF;
						font-family: sans-serif;" class="header">
							Responsive HTML email templates
						</td>
					</tr>
					
					<!-- PARAGRAPH -->
					<!-- Set text color and font family ("sans-serif" or "Georgia, serif"). Duplicate all text styles in links, including line-height -->
					<tr>
						<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 17px; font-weight: 400; line-height: 160%;
						padding-top: 15px; 
						color: #FFFFFF;
						font-family: sans-serif;" class="paragraph">
							More than 50%&nbsp;of&nbsp;total email opens occurred on&nbsp;a&nbsp;mobile device&nbsp;— a&nbsp;mobile-friendly design is&nbsp;a&nbsp;must for&nbsp;email campaigns.
						</td>
					</tr>
					<tr>
						<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
						padding-top: 25px;
						padding-bottom: 5px;" class="button"><a
							href="https://github.com/konsav/email-templates/" target="_blank" style="text-decoration: underline;">
								<table border="0" cellpadding="0" cellspacing="0" align="center" style="max-width: 240px; min-width: 120px; border-collapse: collapse; border-spacing: 0; padding: 0;"><tr><td align="center" valign="middle" style="padding: 12px 24px; margin: 0; text-decoration: underline; border-collapse: collapse; border-spacing: 0; border-radius: 4px; -webkit-border-radius: 4px; -moz-border-radius: 4px; -khtml-border-radius: 4px;"
									bgcolor="#E9703E"><a target="_blank" style="text-decoration: underline;
										color: #FFFFFF; font-family: sans-serif; font-size: 17px; font-weight: 400; line-height: 120%;"
										href="https://github.com/konsav/email-templates/">
											KONFIRMASI
										</a>
									</td></tr></table></a>
						</td>
					</tr>
					
					<!-- LINE -->
					<!-- Set line color -->
					<tr>
						<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
						padding-top: 30px;" class="line"><hr
							color="#565F73" align="center" width="100%" size="1" noshade style="margin: 0; padding: 0;" />
						</td>
					</tr>
					
					<!-- FOOTER -->
					<!-- Set text color and font family ("sans-serif" or "Georgia, serif"). Duplicate all text styles in links, including line-height -->
					<tr>
						<td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 13px; font-weight: 400; line-height: 150%;
						padding-top: 10px;
						padding-bottom: 20px;
						color: #828999;
						font-family: sans-serif;" class="footer">
							
							This email template was sent to&nbsp;you becouse we&nbsp;want to&nbsp;make the&nbsp;world a&nbsp;better place. You&nbsp;could change your <a href="https://github.com/konsav/email-templates/" target="_blank" style="text-decoration: underline; color: #828999; font-family: sans-serif; font-size: 13px; font-weight: 400; line-height: 150%;">subscription settings</a> anytime.
							
							<!-- ANALYTICS -->
							<!-- http://www.google-analytics.com/collect?v=1&tid={{UA-Tracking-ID}}&cid={{Client-ID}}&t=event&ec=email&ea=open&cs={{Campaign-Source}}&cm=email&cn={{Campaign-Name}} -->
							<img width="1" height="1" border="0" vspace="0" hspace="0" style="margin: 0; padding: 0; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; border: none; display: block;"
							src="https://raw.githubusercontent.com/konsav/email-templates/master/images/tracker.png" />
							
						</td>
					</tr>
					
					<!-- End of WRAPPER -->
				</table>
				
				<!-- End of SECTION / BACKGROUND -->
			</td></tr></table>
			
	</body>
</html>';
		return $body;
	}
	function body_dua(array $isi){
		$body = '<!doctype html>
		<html>
		<head>
		<meta name="viewport" content="width=device-width" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Simple Transactional Email</title>
		<style>
		/* -------------------------------------
		GLOBAL RESETS
		------------------------------------- */
		
		/*All the styling goes here*/
		
		img {
        border: none;
        -ms-interpolation-mode: bicubic;
        max-width: 100%; 
		}
		
		body {
        background-color: #f6f6f6;
        font-family: sans-serif;
        -webkit-font-smoothing: antialiased;
        font-size: 14px;
        line-height: 1.4;
        margin: 0;
        padding: 0;
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%; 
		}
		
		table {
        border-collapse: separate;
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
        width: 100%; }
        table td {
		font-family: sans-serif;
		font-size: 14px;
		vertical-align: top; 
		}
		
		/* -------------------------------------
		BODY & CONTAINER
		------------------------------------- */
		
		.body {
        background-color: #f6f6f6;
        width: 100%; 
		}
		
		/* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
		.container {
        display: block;
        margin: 0 auto !important;
        /* makes it centered */
        max-width: 580px;
        padding: 10px;
        width: 580px; 
		}
		
		/* This should also be a block element, so that it will fill 100% of the .container */
		.content {
        box-sizing: border-box;
        display: block;
        margin: 0 auto;
        max-width: 580px;
        padding: 10px; 
		}
		
		/* -------------------------------------
		HEADER, FOOTER, MAIN
		------------------------------------- */
		.main {
        background: #ffffff;
        border-radius: 3px;
        width: 100%; 
		}
		
		.wrapper {
        box-sizing: border-box;
        padding: 20px; 
		}
		
		.content-block {
        padding-bottom: 10px;
        padding-top: 10px;
		}
		
		.footer {
        clear: both;
        margin-top: 10px;
        text-align: center;
        width: 100%; 
		}
        .footer td,
        .footer p,
        .footer span,
        .footer a {
		color: #999999;
		font-size: 12px;
		text-align: center; 
		}
		
		/* -------------------------------------
		TYPOGRAPHY
		------------------------------------- */
		h1,
		h2,
		h3,
		h4 {
        color: #000000;
        font-family: sans-serif;
        font-weight: 400;
        line-height: 1.4;
        margin: 0;
        margin-bottom: 30px; 
		}
		
		h1 {
        font-size: 35px;
        font-weight: 300;
        text-align: center;
        text-transform: capitalize; 
		}
		
		p,
		ul,
		ol {
        font-family: sans-serif;
        font-size: 14px;
        font-weight: normal;
        margin: 0;
        margin-bottom: 15px; 
		}
        p li,
        ul li,
        ol li {
		list-style-position: inside;
		margin-left: 5px; 
		}
		
		a {
        color: #3498db;
        text-decoration: underline; 
		}
		
		/* -------------------------------------
		BUTTONS
		------------------------------------- */
		.btn {
        box-sizing: border-box;
        width: 100%; }
        .btn > tbody > tr > td {
		padding-bottom: 15px; }
        .btn table {
		width: auto; 
		}
        .btn table td {
		background-color: #ffffff;
		border-radius: 5px;
		text-align: center; 
		}
        .btn a {
		background-color: #ffffff;
		border: solid 1px #3498db;
		border-radius: 5px;
		box-sizing: border-box;
		color: #3498db;
		cursor: pointer;
		display: inline-block;
		font-size: 14px;
		font-weight: bold;
		margin: 0;
		padding: 12px 25px;
		text-decoration: none;
		text-transform: capitalize; 
		}
		
		.btn-primary table td {
        background-color: #3498db; 
		}
		
		.btn-primary a {
        background-color: #3498db;
        border-color: #3498db;
        color: #ffffff; 
		}
		
		/* -------------------------------------
		OTHER STYLES THAT MIGHT BE USEFUL
		------------------------------------- */
		.last {
        margin-bottom: 0; 
		}
		
		.first {
        margin-top: 0; 
		}
		
		.align-center {
        text-align: center; 
		}
		
		.align-right {
        text-align: right; 
		}
		
		.align-left {
        text-align: left; 
		}
		
		.clear {
        clear: both; 
		}
		
		.mt0 {
        margin-top: 0; 
		}
		
		.mb0 {
        margin-bottom: 0; 
		}
		
		.preheader {
        color: transparent;
        display: none;
        height: 0;
        max-height: 0;
        max-width: 0;
        opacity: 0;
        overflow: hidden;
        mso-hide: all;
        visibility: hidden;
        width: 0; 
		}
		
		.powered-by a {
        text-decoration: none; 
		}
		
		hr {
        border: 0;
        border-bottom: 1px solid #f6f6f6;
        margin: 20px 0; 
		}
		
		/* -------------------------------------
		RESPONSIVE AND MOBILE FRIENDLY STYLES
		------------------------------------- */
		@media only screen and (max-width: 620px) {
        table[class=body] h1 {
		font-size: 28px !important;
		margin-bottom: 10px !important; 
        }
        table[class=body] p,
        table[class=body] ul,
        table[class=body] ol,
        table[class=body] td,
        table[class=body] span,
        table[class=body] a {
		font-size: 16px !important; 
        }
        table[class=body] .wrapper,
        table[class=body] .article {
		padding: 10px !important; 
        }
        table[class=body] .content {
		padding: 0 !important; 
        }
        table[class=body] .container {
		padding: 0 !important;
		width: 100% !important; 
        }
        table[class=body] .main {
		border-left-width: 0 !important;
		border-radius: 0 !important;
		border-right-width: 0 !important; 
        }
        table[class=body] .btn table {
		width: 100% !important; 
        }
        table[class=body] .btn a {
		width: 100% !important; 
        }
        table[class=body] .img-responsive {
		height: auto !important;
		max-width: 100% !important;
		width: auto !important; 
        }
		}
		
		/* -------------------------------------
		PRESERVE THESE STYLES IN THE HEAD
		------------------------------------- */
		@media all {
        .ExternalClass {
		width: 100%; 
        }
        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
		line-height: 100%; 
        }
        .apple-link a {
		color: inherit !important;
		font-family: inherit !important;
		font-size: inherit !important;
		font-weight: inherit !important;
		line-height: inherit !important;
		text-decoration: none !important; 
        }
        #MessageViewBody a {
		color: inherit;
		text-decoration: none;
		font-size: inherit;
		font-family: inherit;
		font-weight: inherit;
		line-height: inherit;
        }
        .btn-primary table td:hover {
		background-color: #34495e !important; 
        }
        .btn-primary a:hover {
		background-color: #34495e !important;
		border-color: #34495e !important; 
        } 
		}
		
		</style>
		</head>
		<body class="">
		<span class="preheader">This is preheader text. Some clients will show this text as a preview.</span>
		<table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
		<tr>
        <td>&nbsp;</td>
        <td class="container">
		<div class="content">
		
		<!-- START CENTERED WHITE CONTAINER -->
		<table role="presentation" class="main">
		
		<!-- START MAIN CONTENT AREA -->
		<tr>
		<td class="wrapper">
		<table role="presentation" border="0" cellpadding="0" cellspacing="0">
		<tr>
		<td style="background:#3498db;padding:5px"><div style="padding:5px;float: left;margin-right: 10px;">
		<img src="cid:logo_jrp" alt="Logo" style="height: 50px">
		</div></td>
		</tr>
		<tr>
		<td>
		'.$isi['body'].'
		</td>
		</tr>
		</table>
		</td>
		</tr>
		
		<!-- END MAIN CONTENT AREA -->
		</table>
		<!-- END CENTERED WHITE CONTAINER -->
		
		<!-- START FOOTER -->
		<div class="footer">
		<table role="presentation" border="0" cellpadding="0" cellspacing="0">
		<tr>
		<td class="content-block powered-by">
		Powered by <a href="https://widget.my.id">Widget</a>.
		</td>
		</tr>
		</table>
		</div>
		<!-- END FOOTER -->
		
		</div>
        </td>
        <td>&nbsp;</td>
		</tr>
		</table>
		</body>
		</html>
		';	 
		return $body;
	}
		