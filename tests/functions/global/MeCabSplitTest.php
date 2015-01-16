<?php

class MeCabSplitTest extends PHPUnit_Framework_TestCase
{
	const WORD = 'すもももももももものうち';

	public function illegalArgumentProvider()
	{
		return array(
			array(365),
			array(3.14),
			array(array(1,2,3)),
			array(new stdClass())
		);
	}

	/**
	 * @group MacError
	 */
	public function test_出力結果の確認()
	{
		$expect = array("すもも", "も", "もも", "も", "もも", "の", "うち");
		$this->assertEquals($expect, mecab_split(self::WORD));
	}

	public function test_引数に空文字列を与えた場合_空の配列が返ること()
	{
		$this->assertEquals(array(), mecab_split(''));
	}

	/**
	 * @dataProvider illegalArgumentProvider
	 */
	public function test_引数に文字列以外の値を与えた場合_エラーが発行されること($arg)
	{
		$this->setExpectedException('PHPUnit_Framework_Error', 'mecab_split() expects parameter 1 to be string.');
		mecab_split($arg);
	}
}
