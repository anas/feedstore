<?php
exit;
/*
	$res = 'HTTP/1.1 200 OK
Date: Wed, 29 Oct 2008 12:45:58 GMT
Server: Apache/1.3.33 (Unix) mod_fastcgi/2.4.2 mod_gzip/1.3.26.1a mod_ssl/2.8.22 OpenSSL/0.9.7e
Set-Cookie: c9MWDuvPtT9GIMyPc3jwol1VSlO=se36MdAq78Mzk5oVW2I2ZXMNarHKZI_-2fnHikgrifHV_tzGlFwg38P1PI_OqRWnytj9ZLEOtEFhg-lLzATB-2LImFk0ksCQlx6YvsCGz5HJNwW2rv3jzcxlLGg53NV_Se-PZm%7c0fySgEE5TKWtFMTpPb1Xj7KcoxW2WBuFLju6vUYrmNtd0zQwoY3euA4WyTduzMGG1NwZJG%7ca_7g-LZY2ctVyFKdTdaMVDyTaF3XoY4182kf-9ui9hsbXmyEcreo8ZEBWOoMYTXA1oCDR0%7c1225284359; domain=.paypal.com; path=/
Set-Cookie: cookie_check=yes; expires=Sat, 27-Oct-2018 12:45:59 GMT; domain=.paypal.com; path=/
Set-Cookie: navcmd=_notify-validate; domain=.paypal.com; path=/
Set-Cookie: navlns=0; expires=Tue, 24-Oct-2028 12:45:59 GMT; domain=.paypal.com; path=/
Set-Cookie: Apache=10.191.196.11.292171225284358754; path=/; expires=Tue, 16-Sep-02 06:17:42 GMT
Connection: close
Content-Type: text/html; charset=UTF-8

VERIFIED
	';
	$pieces = preg_split("*\n\n*", $res);
	echo $pieces[1];
*/	
	session_start();
	session_write_close();
	session_id("ac4962dc56bbf496973f7dfc81db4b13");
	session_start();
	echo session_id() . "<br>";
	var_dump($_SESSION);
?>
