<?php

class GetStatTest extends PHPUnit_Framework_TestCase
{
	const WORD = 'すもももももももものうち';

	/** @var MeCab_Tagger */
	private $mecab;

	public function setUp()
	{
		parent::setUp();
		$this->mecab = new MeCab_Tagger();
	}

	public function test_整数が取得出来ること()
	{
		$this->assertTrue(is_int($this->mecab->parseToNode(self::WORD)->getStat()));
	}

	public function test_最終行の場合_最終行であるステータスが返ること()
	{
		$this->assertEquals(\PhpMecabSubstituteClasses\MeCab_Leaf::STAT_EOS, $this->mecab->parseToNode('')->getStat());
	}
}
