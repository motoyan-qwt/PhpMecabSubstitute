<?php

/**
 * php-mecab互換関数群
 *
 * @author qwintet
 */

if (function_exists('mecab_split')) {
	trigger_error('mecab_splitは既に定義されています', E_USER_WARNING);
} else {
	/**
	 * 与えられた文字列を形態素解析して、結果配列を返す
	 *
	 * @param string $word
	 * @param null|string $dicdir
	 * @param null|string $userdic
	 * @return null|string[]
	 */
	function mecab_split($word, $dicdir = null, $userdic = null)
	{
		if (!is_string($word)) {
			trigger_error('mecab_split() expects parameter 1 to be string.', E_USER_WARNING);
			return null;
		}

		$options = array();
		if ($dicdir || $dicdir = ini_get('mecab.default_dicdir')) {
			$options['-d'] = $dicdir;
		}
		if ($userdic || $userdic = ini_get('mecab.default_userdic')) {
			$options['-u'] = $userdic;
		}

		$mecab_result_lines = PhpMecabSubstitueFunctions\mecab_call($word, $options);
		if (!$mecab_result_lines) {
			return array();
		}

		array_pop($mecab_result_lines);

		return array_map(function($mecab_result_line) {
			list($word, /* info */) = explode("\t", $mecab_result_line);
			return $word;
		}, $mecab_result_lines);
	}
}
