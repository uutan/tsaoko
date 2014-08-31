<?php
function Html2Text($str) {
	$str = preg_replace ( "/<sty(.*)\\/style>|<scr(.*)\\/script>|<!--(.*)-->/isU", "", $str );
	$alltext = "";
	$start = 1;
	for($i = 0; $i < strlen ( $str ); $i ++) {
		if ($start == 0 && $str [$i] == ">") {
			$start = 1;
		} else if ($start == 1) {
			if ($str [$i] == "<") {
				$start = 0;
				$alltext .= " ";
			} else if (ord ( $str [$i] ) > 31) {
				$alltext .= $str [$i];
			}
		}
	}
	$alltext = str_replace ( "　", " ", $alltext );
	$alltext = preg_replace ( "/&([^;&]*)(;|&)/", "", $alltext );
	$alltext = preg_replace ( "/[ ]+/s", " ", $alltext );
	return $alltext;
}
function Text2Html($txt) {
	$txt = str_replace ( "  ", "　", $txt );
	$txt = str_replace ( "<", "&lt;", $txt );
	$txt = str_replace ( ">", "&gt;", $txt );
	$txt = preg_replace ( "/[\r\n]{1,}/isU", "<br/>\r\n", $txt );
	return $txt;
}