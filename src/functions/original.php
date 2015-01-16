<?php

/**
 * PhpMecabSubstitue独自関数群
 *
 * @author qwintet
 */

namespace PhpMecabSubstitueFunctions
{
	function make_mecab_command(array $options)
	{
		$command = 'mecab';
		foreach ($options as $key => $option) {
			if (strpos($key, '--', 0) === 0) {
				$command .= ' ' . $key . '=' . $option;
				continue;
			}
			$command .= ' ' . $key . ' ' . $option;
		}
		return $command;
	}

	function mecab_call($word, array $options = array())
	{
		$proc = proc_open(
			make_mecab_command($options),
			array(
				array('pipe', 'r'),
				array('pipe', 'w'),
				array('pipe', 'w')
			),
			$pipe
		);

		if (!is_resource($proc)) {
			trigger_error('Un generated mecab process resource.', E_USER_WARNING);
			return null;
		}

		fwrite($pipe[0], $word);
		fclose($pipe[0]);

		$lines = array();
		while ($line = fgets($pipe[1])) {
			$lines[] = str_replace(array("\r\n", "\r", "\n"), '', $line);
		}
		fclose($pipe[1]);

		$error = null;
		fwrite($pipe[2], $error);
		fclose($pipe[2]);

		$status = proc_close($proc);
		if ($status > 0) {
			trigger_error($error, E_USER_WARNING);
			return null;
		}

		return $lines;
	}
}
