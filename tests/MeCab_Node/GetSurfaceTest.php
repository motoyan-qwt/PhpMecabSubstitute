<?php

class GetSurfaceTest extends PHPUnit_Framework_TestCase
{
	const WORD = '東京都';

	/** @var MeCab_Tagger */
	private $mecab;

	public function setUp()
	{
		parent::setUp();
		$this->mecab = new MeCab_Tagger();
	}

	public function test_解析した単語が取得出来ること()
	{
		$node = $this->mecab->parseToNode(self::WORD);
		$this->assertEquals('東京', $node->getSurface());
		$this->assertEquals('都', $node->getNext()->getSurface());
	}
}
