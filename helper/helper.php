<?php 
//----------------------------------------------------------------------------------
if ( ! function_exists('character_limiter'))
{
	/**
	 * Character Limiter
	 *
	 * Limits the string based on the character count.  Preserves complete words
	 * so the character count may not be exactly as specified.
	 *
	 * @param	string
	 * @param	int
	 * @param	string	the end character. Usually an ellipsis
	 * @return	string
	 */
	function character_limiter($str, $n = 500, $end_char = '&#8230;')
	{
		if (mb_strlen($str) < $n)
		{
			return $str;
		}

		// a bit complicated, but faster than preg_replace with \s+
		$str = preg_replace('/ {2,}/', ' ', str_replace(array("\r", "\n", "\t", "\x0B", "\x0C"), ' ', $str));

		if (mb_strlen($str) <= $n)
		{
			return $str;
		}

		$out = '';
		foreach (explode(' ', trim($str)) as $val)
		{
			$out .= $val.' ';

			if (mb_strlen($out) >= $n)
			{
				$out = trim($out);
				return (mb_strlen($out) === mb_strlen($str)) ? $out : $out.$end_char;
			}
		}
	}
}

//----------------------------------------------------------------------------------
if ( ! function_exists('word_limiter'))
{
	/**
	 * Word Limiter
	 *
	 * Limits a string to X number of words.
	 *
	 * @param	string
	 * @param	int
	 * @param	string	the end character. Usually an ellipsis
	 * @return	string
	 */
	function word_limiter($str, $limit = 100, $end_char = '&#8230;')
	{
		if (trim($str) === '')
		{
			return $str;
		}

		preg_match('/^\s*+(?:\S++\s*+){1,'.(int) $limit.'}/', $str, $matches);

		if (strlen($str) === strlen($matches[0]))
		{
			$end_char = '';
		}

		return rtrim($matches[0]).$end_char;
	}
}

//-------------------------------------------------------------------------------------
if ( ! function_exists('camelize'))
{
	/**
	 * Camelize
	 *
	 * Takes multiple words separated by spaces or underscores and camelizes them
	 *
	 * @param	string	$str	Input string
	 * @return	string
	 */
	function camelize($str)
	{
		return strtolower($str[0]).substr(str_replace(' ', '', ucwords(preg_replace('/[\s_]+/', ' ', $str))), 1);
	}
}
//-------------------------------------------------------------------------------------
if ( ! function_exists('humanize'))
{
	/**
	 * Humanize
	 *
	 * Takes multiple words separated by the separator and changes them to spaces
	 *
	 * @param	string	$str		Input string
	 * @param 	string	$separator	Input separator
	 * @return	string
	 */
	function humanize($str, $separator = '_')
	{
		return ucwords(preg_replace('/['.preg_quote($separator).']+/', ' ', trim(strtolower($str))));
	}
}

//-------------------------------------------------------------------------------------
if ( ! function_exists('random_string'))
{
	/**
	 * Create a Random String
	 *
	 * Useful for generating passwords or hashes.
	 *
	 * @param	string	type of random string.  basic, alpha, alnum, numeric, nozero, unique, md5, encrypt and sha1
	 * @param	int	number of characters
	 * @return	string
	 */
	function random_string($type = 'alnum', $len = 8)
	{
		switch ($type)
		{
			case 'basic':
				return mt_rand();
			case 'alnum':
			case 'numeric':
			case 'nozero':
			case 'alpha':
				switch ($type)
				{
					case 'alpha':
						$pool = 'abcdefghjklmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
						break;
					case 'alnum':
						$pool = '123456789abcdefghjklmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
						break;
					case 'numeric':
						$pool = '0123456789';
						break;
					case 'nozero':
						$pool = '123456789';
						break;
				}
				return substr(str_shuffle(str_repeat($pool, ceil($len / strlen($pool)))), 0, $len);
			case 'unique': // todo: remove in 3.1+
			case 'md5':
				return md5(uniqid(mt_rand()));
			case 'encrypt': // todo: remove in 3.1+
			case 'sha1':
				return sha1(uniqid(mt_rand(), TRUE));
		}
	}
}