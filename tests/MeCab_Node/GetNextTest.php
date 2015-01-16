<?php

class GetNextTest extends PHPUnit_Framework_TestCase
{
	const WORD = 'すもももももももものうち';

	/** @var MeCab_Tagger */
	private $mecab;

	public function setUp()
	{
		parent::setUp();
		$this->mecab = new MeCab_Tagger();
	}

	public function test_ポインタが進んでいること()
	{
		$node = $this->mecab->parseToNode(self::WORD);
		$first_position = $node->key();
		$next_position = $node->getNext()->key();
		$this->assertNotEquals($first_position, $next_position);
	}

	public function test_ポインタが最後まで進んだ場合_Nullを返すこと()
	{
		$arg = array(1,2,3);

		$node = new MeCab_Node($arg);
		foreach($arg as $v) {
			$node->getNext();
		}

		$this->assertNull($node->getNext());
	}
}
