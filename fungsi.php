<?php

function random_karakter(){
	$karakter = array('a','A','b','B','c','C','d','D','e','E','f','F','g','G','h','H','i','I','j','J','k','K','l','L','m','M','n','N','o','O','p','P','q','Q','r','R','s','S','t','T','u','U','v','V','w','W','x','X','y','Y','z','Z','1','2','3','4','5','6','7','8','9','0');
	$max = (count($karakter)-1);
	srand(((double)microtime()*1000000));
	$kar1 = $karakter[rand(0,$max)];
	$kar2 = $karakter[rand(0,$max)];
	$kar3 = $karakter[rand(0,$max)];
	$kar4 = $karakter[rand(0,$max)];
	$kar5 = $karakter[rand(0,$max)];
	$kar6 = $karakter[rand(0,$max)];
	$kar7 = $karakter[rand(0,$max)];
	$kar8 = $karakter[rand(0,$max)];
	$kar9 = $karakter[rand(0,$max)];
	//Anda bisa menambahkan variabe nya seperti $kar10 dan seterusnya
	$random_karakter = $kar1.$kar2.$kar3.$kar4.$kar5.$kar6.$kar7.$kar8.$kar9;
	return $random_karakter;
}

// fungsi enkripsi base64 dengan key
function base64_encrypt($plain_text, $password, $iv_len = 16) {
	$plain_text .= "\x13";
	$n = strlen($plain_text);
	if ($n % 16) $plain_text .= str_repeat("\0", 16 - ($n % 16));
	$i = 0;
	$enc_text = get_rnd_iv($iv_len);
	$iv = substr($password ^ $enc_text, 0, 512);
	while ($i < $n) {
		$block = substr($plain_text, $i, 16) ^ pack('H*', md5($iv));
		$enc_text .= $block;
		$iv = substr($block . $iv, 0, 512) ^ $password;
		$i += 16;
	}
	$hasil=base64_encode($enc_text);
	return str_replace('+', '@', $hasil);
}
 
// fungsi base64 decrypt
// untuk mendekripsi string base64
function base64_decrypt($enc_text, $password, $iv_len = 16) {
	$enc_text = str_replace('@', '+', $enc_text);
	$enc_text = base64_decode($enc_text);
	$n = strlen($enc_text);
	$i = $iv_len;
	$plain_text = '';
	$iv = substr($password ^ substr($enc_text, 0, $iv_len), 0, 512);
	while ($i < $n) {
		$block = substr($enc_text, $i, 16);
		$plain_text .= $block ^ pack('H*', md5($iv));
		$iv = substr($block . $iv, 0, 512) ^ $password;
		$i += 16;
	}
	return preg_replace('/\\x13\\x00*$/', '', $plain_text);
}
	 
function get_rnd_iv($iv_len) {
	$iv = '';
	while ($iv_len-- > 0) {
		$iv .= chr(mt_rand() & 0xff);
	}
	return $iv;
}

function extract_var($data) {
	$data = explode("&",$data);
	for ($x=0; $x <= count($data)-1; $x++){
		$tmp = explode('=', $data[$x]);
		@$r[$tmp[0]] = $tmp[1];  
	}
	return $r;
}

?>