<?php

use \PhpMecabSubstituteFunctions as F;

class MakeMeCabCommandTest extends PHPUnit_Framework_TestCase
{
	function test_引数が空の配列の場合_mecabという文字列が返ること()
	{
		$this->assertEquals('mecab', F\make_mecab_command(array()));
	}

	function test_引数に配列を与えた場合_mecabという文字と配列の文字が連結された文字列が返ること()
	{
		$this->assertEquals('mecab foo bar', F\make_mecab_command(array('foo' => 'bar')));
	}

	function test_引数に配列のキー値がハイフン２つから始まる値を与えた場合_mecabという文字と配列の文字イコールで連結された文字列が返ること()
	{
		$this->assertEquals('mecab --foo=bar', F\make_mecab_command(array('--foo' => 'bar')));
	}
}
