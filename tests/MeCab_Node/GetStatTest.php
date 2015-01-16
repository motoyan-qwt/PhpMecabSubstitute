<?php

class GetStatTest extends PHPUnit_Framework_TestCase
{
	const WORD = 'すもももももももものうち';

	/** @var MeCab_Node */
	private $node;

	public function setUp()
	{
		parent::setUp();
		$mecab = new MeCab_Tagger();
		$this->node = $mecab->parseToNode(self::WORD);
	}

	public function test_整数が取得出来ること()
	{
		$this->assertTrue(is_int($this->node->getStat()));
	}
}
