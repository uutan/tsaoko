<?php
function Pinyin($str, $ishead = 0, $fenge = '') {
	$restr = '';
	$str = trim ( $str );
	$slen = strlen ( $str );
	if ($slen < 2) {
		return $str;
	}
	
	$QCache = new CFileCache ();
	$pinyins = $QCache->get ( 'Pinyin_cache' );
	if (! is_array ( $pinyins )) {
		$fp = fopen ( dirname ( __FILE__ ) . '/data/pinyin.dat', 'r' );
		while ( ! feof ( $fp ) ) {
			$line = trim ( fgets ( $fp ) );
			$pinyins [$line [0] . $line [1]] = substr ( $line, 3, strlen ( $line ) - 3 );
		}
		fclose ( $fp );
		$QCache->set ( 'Pinyin_cache', $pinyins ); //写入缓存
	}
	
	for($i = 0; $i < $slen; $i ++) {
		if (ord ( $str [$i] ) > 0x80) {
			$c = $str [$i] . $str [$i + 1];
			$i ++;
			if (isset ( $pinyins [$c] )) {
				if ($ishead == 0) {
					$restr .= $restr ? $fenge . $pinyins [$c] : $pinyins [$c];
				} else {
					$restr .= $restr ? $fenge . $pinyins [$c] [0] : $pinyins [$c] [0];
				}
			}
		} else if (eregi ( "[a-z0-9]", $str [$i] )) {
			$restr .= $str [$i];
		}
	}
	unset ( $pinyins );
	return $restr;
}