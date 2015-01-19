<?php

namespace PhpMecabSubstituteClasses;

/**
 * MeCab解析文字
 *
 * @author qwintet
 */
class MeCab_Leaf
{
	/**
	 * MeCab Leaf Status: Normal.
	 */
	const STAT_NORMAL = 0;

	/**
	 * MeCab Leaf Status: Unknown.
	 */
	const STAT_UNKNOWN = 1;

	/**
	 * MeCab Leaf Status: Beginning of Sentence.
	 */
	const STAT_BOS = 2;

	/**
	 * MeCab Leaf Status: End of Sentence.
	 */
	const STAT_EOS = 3;

	/**
	 * @var string 解析文字
	 */
	private $_surface;

	/**
	 * @var string 解析文字の品詞
	 */
	private $_feature;

	/**
	 * @param string $leaf
	 */
	public function __construct($leaf)
	{
		$parsed_leaf = explode("\t", $leaf);
		$this->_surface = empty($parsed_leaf[0]) ? '' : $parsed_leaf[0];

		if (!empty($parsed_leaf[1])) {
			$leaf_info = explode(',', $parsed_leaf[1]);
			$this->_feature = empty($leaf_info[0]) ? '' : $leaf_info[0];
		}
	}

	/**
	 * 解析状態の取得
	 *
	 * @return int
	 */
	public function getStat()
	{
		if ($this->_surface === 'BOS') {
			return self::STAT_BOS;
		}
		if ($this->_surface === 'EOS') {
			return self::STAT_EOS;
		}
		if (empty($this->_surface)) {
			return self::STAT_UNKNOWN;
		}
		return self::STAT_NORMAL;
	}

	/**
	 * 解析文字の取得
	 *
	 * @return string
	 */
	public function getSurface()
	{
		return $this->_surface;
	}

	/**
	 * 解析文字の品詞を取得
	 *
	 * @return string
	 */
	public function getFeature()
	{
		return $this->_feature;
	}
}
