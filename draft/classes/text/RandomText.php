<?php

/**
 * RPGRandomFrenchText
 *
 * @package ELMG 525 RC
 * @author e-doceo
 * @copyright 2012
 * @version $Id$
 * @access public
 */
class RPGRandomFrenchText {

	/**
	 * RPGRandomFrenchText::getRandomName()
	 *
	 * @return
	 */
	public static function getRandomName() {
		// Retourne un nom à la française
		$buffer = '';

		$common_vowel = 'a a e e i o u';
		$common_double_vowel = 'ai au ei eu ia ie io iu ui ou oi';
		$common_consonant = 'r t p s d f g l m c v b n';
		$common_double_consonant = 'rr rt rp rs rd rf rg rl rm rc rv rb';
		$common_double_consonant .= ' tr tt pr ps pp ph pl';
		$common_double_consonant .= ' qu st sp ss sc dr fr fl ff gu gr gl gn ll mm cr ct cs ch cl cc vr br nn';

		$rare_vowel = 'y';
		$rare_double_vowel = 'ay ey uy oy ya ye yo yu';
		$rare_consonant = 'z h q j k w x';
		$rare_double_consonant = 'tl tm pt sr sl sm sn dt ds dd dl gs kr kl ks ls ld lf lg';
		$rare_double_consonant .= ' lm lc lv lb ln mt mp mc mn xc xs cp ck cm vl nt np ns nd ng nm nc nv';

		for($i = 0, $c_i = mt_rand(0,5) ? mt_rand(2,7) : mt_rand(3,6); $i < $c_i; $i++) {
			if ($i == 0 && mt_rand(0,1)) {
				$c_i++;
			} else {
				// Voyelle
				if ($i%2) {
					if (mt_rand(0,1)) {
						$buffer .= substr($common_double_vowel,mt_rand(0, round((strlen($common_double_vowel)-1)/3)) * 3,2);
					} else {
						$buffer .= substr($common_vowel,mt_rand(0, round((strlen($common_vowel)-1)/2)) * 2,1);
					}
				// Consonne
				} else {
					if ($i > 0 && mt_rand(0,2) && $i < $c_i - 1) {
						$buffer .= substr($common_double_consonant,mt_rand(0, round((strlen($common_double_consonant)-1)/3)) * 3,2);
					} else {
						$buffer .= substr($common_consonant,mt_rand(0, round((strlen($common_consonant)-1)/2)) * 2,1);
					}
				}
			}
		}
		return str_replace('uu', 'u', $buffer);
	}

	/**
	 * RPGRandomFrenchText::replaceHiatus()
	 *
	 * @todo La règle des h muets et aspirés laisse à désirer
	 *
	 * @param mixed $string
	 * @return
	 */
	public static function replaceHiatus($string) {
		$string = preg_replace('/(^| )(([Ll])[ea]|([Dd])[e]) ([AEIOUYaeiouy]|[Hh][^aou])/', '$1$3$4\'$5', $string);
		$string = str_replace(' de le ', ' du ', $string);
		return $string;
	}
}
?>