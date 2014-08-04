<?php
/**
* @author    Claudio Mulas <claudio.mulas@ymail.com>
* @copyright GPL
*/

print_r(t9_words(232824));
print_r(t9_words(2328,true));

function t9_words($input, $partials = false) {
	if (!is_numeric($input)) return false;
	
	if (!function_exists("t9_calculator")) {
		function t9_calculator($word) {
			return strtr(strtoupper($word), 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', '22233344455566677778889999');
		}
	}
	
	$file_dictionary = "dictionary.txt";
	$cnt_dictionary = explode("\r\n",file_get_contents($file_dictionary));
	
	foreach ($cnt_dictionary as $word) {
		if (strlen($input) == strlen($word)) {
			if (t9_calculator($word) == $input)
				$results[] = $word;
		}
		elseif ($partials === true && strlen($input) < strlen($word)) {
			if (substr(t9_calculator($word),0,strlen($input)) == $input)
				$results[] = $word;
		} 
	}
	
	
	return $results;
}
