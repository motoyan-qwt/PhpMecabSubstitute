<?php

use \PhpMecabSubstituteClasses\MeCab_Leaf;

/**
 * MeCab解析文字集合
 *
 * @author qwintet
 */
class MeCab_Node extends ArrayIterator
{
	/**
	 * @var MeCab_Leaf[] MeCab解析文字オブジェクト
	 */
	private $_entities = array();

	/**
	 * ポインタを次に進めた状態で、オブジェクトを返す。
	 * ポインタが終点になった場合はnullを返却する。
	 *
	 * @return self|null
	 */
	public function getNext()
	{
		$this->next();

		if (!$this->valid()) {
			return null;
		}
		return $this;
	}

	/**
	 * 解析状態の取得
	 *
	 * @return int
	 */
	public function getStat()
	{
		return $this->_getEntity()->getStat();
	}

	/**
	 * 解析文字の取得
	 *
	 * @return string
	 */
	public function getSurface()
	{
		return $this->_getEntity()->getSurface();
	}

	/**
	 * 解析文字の品詞を取得
	 *
	 * @return string
	 */
	public function getFeature()
	{
		return $this->_getEntity()->getFeature();
	}

	/**
	 * MeCab解析結果のオブジェクトを取得する。
	 *
	 * @return MeCab_Leaf
	 */
	private function _getEntity()
	{
		$key = $this->key();

		if (!isset($this->_entities[$key])) {
			$this->_entities[$key] = new MeCab_Leaf($this->current());
		}

		return $this->_entities[$key];
	}
}
