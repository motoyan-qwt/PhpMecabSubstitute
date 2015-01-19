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

	public function test_解析文字が取得出来る場合_正常であるステータスが返ること()
	{
		$node = $this->mecab->parseToNode('あ');
		$this->assertEquals(\PhpMecabSubstituteClasses\MeCab_Leaf::STAT_NORMAL, $node->getStat());
	}

	public function test_最終行の場合_最終行であるステータスが返ること()
	{
		$node = $this->mecab->parseToNode('あ');
		$this->assertEquals(\PhpMecabSubstituteClasses\MeCab_Leaf::STAT_EOS, $node->getNext()->getStat());
	}
}
