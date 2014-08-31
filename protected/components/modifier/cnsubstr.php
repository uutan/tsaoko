<?php
// $Id: 090618 kth007@gmail.com $


function cn_substr($string, $length, $charset = true, $dot = '') {
	$strlen = strlen ( $string );
	if ($strlen <= $length)
		return $string;
	$string = str_replace ( array ('&nbsp;', '&amp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;' ), array (' ', '&', '"', "'", '“', '”', '—', '<', '>', '·', '…' ), $string );
	$strcut = '';
	$length -= min ( $length, strlen ( $dot ) );
	if ($charset == true) {
		$n = $tn = $noc = 0;
		while ( $n < $strlen && isset ( $string [$n] ) ) {
			$t = ord ( $string [$n] );
			if ($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
				$tn = 1;
				$n ++;
				$noc ++;
			} elseif (194 <= $t && $t <= 223) {
				$tn = 2;
				$n += 2;
				$noc += 2;
			} elseif (224 <= $t && $t < 239) {
				$tn = 3;
				$n += 3;
				$noc += 2;
			} elseif (240 <= $t && $t <= 247) {
				$tn = 4;
				$n += 4;
				$noc += 2;
			} elseif (248 <= $t && $t <= 251) {
				$tn = 5;
				$n += 5;
				$noc += 2;
			} elseif ($t == 252 || $t == 253) {
				$tn = 6;
				$n += 6;
				$noc += 2;
			} else {
				$n ++;
			}
			if ($noc >= $length)
				break;
		}
		if ($noc > $length)
			$n -= $tn;
		$strcut = substr ( $string, 0, $n );
	} else {
		$dotlen = strlen ( $dot );
		$maxi = $length - $dotlen - 1;
		for($i = 0; $i < $maxi; $i ++) {
			$strcut .= ord ( $string [$i] ) > 127 ? $string [$i] . $string [++ $i] : $string [$i];
		}
	}
	$strcut = str_replace ( array ('&', '"', "'", '<', '>' ), array ('&amp;', '&quot;', '&#039;', '&lt;', '&gt;' ), $strcut );
	if ($strcut != $string)
		$strcut .= $dot;
	return $strcut;
}
