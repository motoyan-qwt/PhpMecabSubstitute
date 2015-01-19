<?php

use \PhpMecabSubstituteClasses\MeCab_Command;

/**
 * php-mecabのMeCab_Tagger互換クラス
 *
 * @author qwintet
 */
class MeCab_Tagger
{
	/**
	 * @var MeCab_Command mecabコマンドオブジェクト
	 */
	private $_mecab_command;

	/**
	 * @param string[] $options
	 */
	public function __construct($options = array())
	{
		$this->_mecab_command = new MeCab_Command($options);
	}

	/**
	 * 与えられた文字列を形態素解析して、結果を返す
	 *
	 * @param string $word
	 * @return null|string
	 */
	public function parse($word)
	{
		$result = $this->_mecab_command->exec($word);
		if (!$result) {
			return null;
		}
		return join($result, PHP_EOL);
	}

	/**
	 * 与えられた文字列を形態素解析して、結果ノード返す
	 *
	 * @param string $word
	 * @return MeCab_Node|null
	 */
	public function parseToNode($word)
	{
		$result = $this->_mecab_command->exec($word);
		if (!$result) {
			return null;
		}
		return new MeCab_Node($result);
	}
}
