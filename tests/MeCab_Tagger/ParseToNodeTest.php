<?php
/**
 * Created by IntelliJ IDEA.
 * User: k-motoyan
 * Date: 2015/01/16
 * Time: 19:56
 */

class ParseToNodeTest extends PHPUnit_Framework_TestCase
{
	const WORD = 'すもももももももものうち';

	/** @var MeCab_Tagger */
	private $mecab;

	public function setUp()
	{
		parent::setUp();
		$this->mecab = new MeCab_Tagger();
	}

	public function test_適当な文字列を与えた場合_MeCab_Nodeオブジェクトが返ること()
	{
		$this->assertTrue(is_a($this->mecab->parseToNode(self::WORD), 'MeCab_Node'));
	}

	public function test_適当な空文字を与えた場合_Nullが返ること()
	{
		$this->assertNull($this->mecab->parseToNode(''));
	}
}
