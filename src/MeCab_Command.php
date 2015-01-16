<?php

/**
 * MeCab Shellコマンド生成オブジェクト
 *
 * @qwintet
 */
class MeCab_Command
{
	/**
	 * @var string[] オプションキーのデフォルト値とアライアスのMAP
	 */
	private static $_option_key_map = array(
		'--dicdir' => '-d',
		'--userdic' => '-u'
	);

	/**
	 * @var string[]
	 */
	private $_options;

	/**
	 * @param string[] $options
	 */
	public function __construct(array $options = array())
	{
		$merged_options = array_merge($options, $this->_getDefaultOption());
		$this->_check( $this->_optionKeyUnique($merged_options) );
		$this->_options = $merged_options;
	}

	/**
	 * mecabコマンドの実行
	 *
	 * @param string $word
	 * @return array|null
	 */
	public function exec($word)
	{
		return PhpMecabSubstitueFunctions\mecab_call($word, $this->_options);
	}

	/**
	 * オプションに同じ意味を持つアライアスとデフォルトキーが存在する場合、
	 * デフォルトキーを削除してオプション値をユニークな状態にする。
	 *
	 * @param string[] $options
	 * @return string[]
	 */
	private function _optionKeyUnique(array $options)
	{
		$option_key_map = self::$_option_key_map;

		return array_filter($options, function($key) use($options, $option_key_map) {
			if (!array_key_exists($key, $option_key_map)) {
				return true;
			}
			if (!array_key_exists($option_key_map[$key], $options)) {
				return true;
			}
			return false;
		});
	}

	/**
	 * php.iniやini_setで設定されたmecabのオプション値を取得する
	 *
	 * return string[]
	 */
	private function _getDefaultOption()
	{
		$default_option = array();

		if ($dicdir = ini_get('mecab.default_dicdir')) {
			$default_option['-d'] = $dicdir;
		}
		if ($userdic = ini_get('mecab.default_userdic')) {
			$default_option['-u'] = $userdic;
		}

		return $default_option;
	}

	/**
	 * オプション値の妥当性をチェックする。
	 * 妥当性の無い値だった場合、warningを発行する。
	 *
	 * @param string[] $options
	 */
	private function _check(array $options)
	{
		foreach ($options as $key => $option) {
			switch($key) {
				case '-d':
				case '-u':
					if (!file_exists($option) || !is_readable($option)) {
						$err = sprintf('MeCab_Tagger::__construct(): %s does not exist or is not readable', $option);
						trigger_error($err, E_USER_WARNING);
					}
					break;
				default:
					$err = sprintf('MeCab_Tagger::__construct(): Invalid option %s given', $key);
					trigger_error($err, E_USER_WARNING);
					break;
			}
		}
	}
}
