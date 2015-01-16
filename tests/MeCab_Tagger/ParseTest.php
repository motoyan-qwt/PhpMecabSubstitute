<?php

class ParseTest extends PHPUnit_Framework_TestCase
{
	const WORD = 'すもももももももものうち';

	private $mecab;

	public function setUp()
	{
		parent::setUp();
		$this->mecab = new MeCab_Tagger();
	}

	/**
	 * @group MacError
	 */
	public function test_出力結果の確認()
	{
		$expect = 'すもももももももものうち
すもも	名詞,一般,*,*,*,*,すもも,スモモ,スモモ
も	助詞,係助詞,*,*,*,*,も,モ,モ
もも	名詞,一般,*,*,*,*,もも,モモ,モモ
も	助詞,係助詞,*,*,*,*,も,モ,モ
もも	名詞,一般,*,*,*,*,もも,モモ,モモ
の	助詞,連体化,*,*,*,*,の,ノ,ノ
うち	名詞,非自立,副詞可能,*,*,*,うち,ウチ,ウチ
EOS';
		$this->assertEquals($expect, $this->mecab->parse(self::WORD));
	}
}
