<?php

/**
* @package   s9e\TextFormatter
* @copyright Copyright (c) 2010-2023 The s9e authors
* @license   http://www.opensource.org/licenses/mit-license.php The MIT License
*/
namespace s9e\TextFormatter\Plugins\Emoji;

use s9e\TextFormatter\Plugins\ParserBase;

class Parser extends ParserBase
{
	/**
	* @var string Regexp used to match shortnames
	*/
	protected $shortnameRegexp = '/:[-+_a-z0-9]+(?=:)/';

	/**
	* @var string Regexp used to match UTF-8 emoji
	*/
	protected $unicodeRegexp = '((?:[#*0-9]\\xEF\\xB8\\x8F(?:\\xE2\\x83\\xA3)?|\\xC2[\\xA9\\xAE]\\xEF\\xB8\\x8F|\\xE2(?:\\x80\\xBC\\xEF\\xB8\\x8F|\\x81\\x89\\xEF\\xB8\\x8F|\\x84[\\xA2\\xB9]\\xEF\\xB8\\x8F|\\x86[\\x94-\\x99\\xA9\\xAA]\\xEF\\xB8\\x8F|\\x8C(?:[\\x9A\\x9B]|\\xA8\\xEF\\xB8\\x8F)|\\x8F(?:[\\x8F\\xAD-\\xAF\\xB1\\xB2\\xB8-\\xBA]\\xEF\\xB8\\x8F|[\\xA9-\\xAC\\xB0\\xB3])|\\x93\\x82\\xEF\\xB8\\x8F|\\x96[\\xAA\\xAB\\xB6]\\xEF\\xB8\\x8F|\\x97(?:[\\x80\\xBB\\xBC]\\xEF\\xB8\\x8F|[\\xBD\\xBE])|\\x98(?:[\\x80-\\x84\\x8E\\x91\\x98\\xA0\\xA2\\xA3\\xA6\\xAA\\xAE\\xAF\\xB8-\\xBA]\\xEF\\xB8\\x8F|[\\x94\\x95]|\\x9D(?:\\xEF\\xB8\\x8F|\\xF0\\x9F\\x8F[\\xBB-\\xBF]))|\\x99(?:[\\x80\\x82\\x9F\\xA0\\xA3\\xA5\\xA6\\xA8\\xBB\\xBE]\\xEF\\xB8\\x8F|[\\x88-\\x93\\xBF])|\\x9A(?:[\\x92\\x94-\\x97\\x99\\x9B\\x9C\\xA0\\xA7\\xB0\\xB1]\\xEF\\xB8\\x8F|[\\x93\\xA1\\xAA\\xAB\\xBD\\xBE])|\\x9B(?:[\\x88\\x8F\\x91\\xA9\\xB0\\xB1\\xB4\\xB7\\xB8]\\xEF\\xB8\\x8F|[\\x84\\x85\\x8E\\x94\\xAA\\xB2\\xB3\\xB5\\xBA\\xBD]|\\x93\\xEF\\xB8\\x8F(?:\\xE2\\x80\\x8D\\xF0\\x9F\\x92\\xA5)?|\\xB9(?:\\xEF\\xB8\\x8F|\\xF0\\x9F\\x8F[\\xBB-\\xBF])(?:\\xE2\\x80\\x8D\\xE2\\x99[\\x80\\x82]\\xEF\\xB8\\x8F)?)|\\x9C(?:[\\x82\\x88\\x89\\x8F\\x92\\x94\\x96\\x9D\\xA1\\xB3\\xB4]\\xEF\\xB8\\x8F|[\\x8A\\x8B](?:\\xF0\\x9F\\x8F[\\xBB-\\xBF])?|[\\x8C\\x8D](?:\\xEF\\xB8\\x8F|\\xF0\\x9F\\x8F[\\xBB-\\xBF])|[\\x85\\xA8])|\\x9D(?:[\\x84\\x87\\xA3]\\xEF\\xB8\\x8F|[\\x8C\\x8E\\x93-\\x95\\x97]|\\xA4\\xEF\\xB8\\x8F(?:\\xE2\\x80\\x8D\\xF0\\x9F(?:\\x94\\xA5|\\xA9\\xB9))?)|\\x9E(?:[\\x95-\\x97\\xB0\\xBF]|\\xA1\\xEF\\xB8\\x8F)|\\xA4[\\xB4\\xB5]\\xEF\\xB8\\x8F|\\xAC(?:[\\x85-\\x87]\\xEF\\xB8\\x8F|[\\x9B\\x9C])|\\xAD[\\x90\\x95])|\\xE3(?:\\x80[\\xB0\\xBD]|\\x8A[\\x97\\x99])\\xEF\\xB8\\x8F|\\xF0\\x9F(?:\\x80\\x84|\\x83\\x8F|\\x85[\\xB0\\xB1\\xBE\\xBF]\\xEF\\xB8\\x8F|\\x86[\\x8E\\x91-\\x9A]|\\x87[\\xA6-\\xBF](?:\\xF0\\x9F\\x87[\\xA6-\\xBF])?|\\x88(?:[\\x82\\xB7]\\xEF\\xB8\\x8F|[\\x81\\x9A\\xAF\\xB2-\\xB6\\xB8-\\xBA])|\\x89[\\x90\\x91]|\\x8C(?:[\\xA1\\xA4-\\xAC\\xB6]\\xEF\\xB8\\x8F|[\\x80-\\xA0\\xAD-\\xB5\\xB7-\\xBF])|\\x8D(?:[\\x80-\\x83\\x85-\\x8A\\x8C-\\xBC\\xBE\\xBF]|\\x84(?:\\xE2\\x80\\x8D\\xF0\\x9F\\x9F\\xAB)?|\\x8B(?:\\xE2\\x80\\x8D\\xF0\\x9F\\x9F\\xA9)?|\\xBD\\xEF\\xB8\\x8F)|\\x8E(?:[\\x96\\x97\\x99-\\x9B\\x9E\\x9F]\\xEF\\xB8\\x8F|[\\x80-\\x84\\x86-\\x93\\xA0-\\xBF]|\\x85(?:\\xF0\\x9F\\x8F[\\xBB-\\xBF])?)|\\x8F(?:[\\x82\\x87](?:\\xF0\\x9F\\x8F[\\xBB-\\xBF])?|[\\x84\\x8A](?:\\xF0\\x9F\\x8F[\\xBB-\\xBF])?(?:\\xE2\\x80\\x8D\\xE2\\x99[\\x80\\x82]\\xEF\\xB8\\x8F)?|[\\x8B\\x8C](?:\\xEF\\xB8\\x8F|\\xF0\\x9F\\x8F[\\xBB-\\xBF])(?:\\xE2\\x80\\x8D\\xE2\\x99[\\x80\\x82]\\xEF\\xB8\\x8F)?|[\\x8D\\x8E\\x94-\\x9F\\xB5\\xB7]\\xEF\\xB8\\x8F|[\\x80\\x81\\x85\\x86\\x88\\x89\\x8F-\\x93\\xA0-\\xB0\\xB8-\\xBF]|\\x83(?:\\xF0\\x9F\\x8F[\\xBB-\\xBF])?(?:\\xE2\\x80\\x8D\\xE2(?:\\x99[\\x80\\x82]\\xEF\\xB8\\x8F(?:\\xE2\\x80\\x8D\\xE2\\x9E\\xA1\\xEF\\xB8\\x8F)?|\\x9E\\xA1\\xEF\\xB8\\x8F))?|\\xB3\\xEF\\xB8\\x8F(?:\\xE2\\x80\\x8D(?:\\xE2\\x9A\\xA7\\xEF\\xB8\\x8F|\\xF0\\x9F\\x8C\\x88))?|\\xB4(?:\\xE2\\x80\\x8D\\xE2\\x98\\xA0\\xEF\\xB8\\x8F|\\xF3\\xA0\\x81\\xA7\\xF3\\xA0\\x81\\xA2\\xF3\\xA0\\x81(?:\\xA5\\xF3\\xA0\\x81\\xAE\\xF3\\xA0\\x81\\xA7|\\xB3\\xF3\\xA0\\x81\\xA3\\xF3\\xA0\\x81\\xB4|\\xB7\\xF3\\xA0\\x81\\xAC\\xF3\\xA0\\x81\\xB3)\\xF3\\xA0\\x81\\xBF)?)|\\x90(?:[\\x80-\\x87\\x89-\\x94\\x96-\\xA5\\xA7-\\xBA\\xBC-\\xBE]|\\x88(?:\\xE2\\x80\\x8D\\xE2\\xAC\\x9B)?|\\x95(?:\\xE2\\x80\\x8D\\xF0\\x9F\\xA6\\xBA)?|\\xA6(?:\\xE2\\x80\\x8D(?:\\xE2\\xAC\\x9B|\\xF0\\x9F\\x94\\xA5))?|\\xBB(?:\\xE2\\x80\\x8D\\xE2\\x9D\\x84\\xEF\\xB8\\x8F)?|\\xBF\\xEF\\xB8\\x8F)|\\x91(?:[\\x82\\x83\\x86-\\x90\\xA6\\xA7\\xAB-\\xAD\\xB2\\xB4-\\xB6\\xB8\\xBC](?:\\xF0\\x9F\\x8F[\\xBB-\\xBF])?|[\\xAE\\xB0\\xB1\\xB3\\xB7](?:\\xF0\\x9F\\x8F[\\xBB-\\xBF])?(?:\\xE2\\x80\\x8D\\xE2\\x99[\\x80\\x82]\\xEF\\xB8\\x8F)?|[\\x80\\x84\\x85\\x91-\\xA5\\xAA\\xB9-\\xBB\\xBD-\\xBF]|\\x81\\xEF\\xB8\\x8F(?:\\xE2\\x80\\x8D\\xF0\\x9F\\x97\\xA8\\xEF\\xB8\\x8F)?|\\xA8(?:\\xE2\\x80\\x8D(?:\\xE2(?:\\x9A[\\x95\\x96]\\xEF\\xB8\\x8F|\\x9C\\x88\\xEF\\xB8\\x8F|\\x9D\\xA4\\xEF\\xB8\\x8F\\xE2\\x80\\x8D\\xF0\\x9F(?:\\x92\\x8B\\xE2\\x80\\x8D\\xF0\\x9F)?\\x91\\xA8)|\\xF0\\x9F(?:\\x8C\\xBE|\\x8D[\\xB3\\xBC]|\\x8E[\\x93\\xA4\\xA8]|\\x8F[\\xAB\\xAD]|\\x91(?:[\\xA8\\xA9]\\xE2\\x80\\x8D\\xF0\\x9F\\x91(?:\\xA6(?:\\xE2\\x80\\x8D\\xF0\\x9F\\x91\\xA6)?|\\xA7(?:\\xE2\\x80\\x8D\\xF0\\x9F\\x91[\\xA6\\xA7])?)|\\xA6(?:\\xE2\\x80\\x8D\\xF0\\x9F\\x91\\xA6)?|\\xA7(?:\\xE2\\x80\\x8D\\xF0\\x9F\\x91[\\xA6\\xA7])?)|\\x92[\\xBB\\xBC]|\\x94[\\xA7\\xAC]|\\x9A[\\x80\\x92]|\\xA6(?:[\\xAF\\xBC\\xBD](?:\\xE2\\x80\\x8D\\xE2\\x9E\\xA1\\xEF\\xB8\\x8F)?|[\\xB0-\\xB3])))|\\xF0\\x9F\\x8F(?:\\xBB(?:\\xE2\\x80\\x8D(?:\\xE2(?:\\x9A[\\x95\\x96]\\xEF\\xB8\\x8F|\\x9C\\x88\\xEF\\xB8\\x8F|\\x9D\\xA4\\xEF\\xB8\\x8F\\xE2\\x80\\x8D\\xF0\\x9F(?:\\x92\\x8B\\xE2\\x80\\x8D\\xF0\\x9F)?\\x91\\xA8\\xF0\\x9F\\x8F[\\xBB-\\xBF])|\\xF0\\x9F(?:\\x8C\\xBE|\\x8D[\\xB3\\xBC]|\\x8E[\\x93\\xA4\\xA8]|\\x8F[\\xAB\\xAD]|\\x92[\\xBB\\xBC]|\\x94[\\xA7\\xAC]|\\x9A[\\x80\\x92]|\\xA4\\x9D\\xE2\\x80\\x8D\\xF0\\x9F\\x91\\xA8\\xF0\\x9F\\x8F[\\xBC-\\xBF]|\\xA6(?:[\\xAF\\xBC\\xBD](?:\\xE2\\x80\\x8D\\xE2\\x9E\\xA1\\xEF\\xB8\\x8F)?|[\\xB0-\\xB3]))))?|\\xBC(?:\\xE2\\x80\\x8D(?:\\xE2(?:\\x9A[\\x95\\x96]\\xEF\\xB8\\x8F|\\x9C\\x88\\xEF\\xB8\\x8F|\\x9D\\xA4\\xEF\\xB8\\x8F\\xE2\\x80\\x8D\\xF0\\x9F(?:\\x92\\x8B\\xE2\\x80\\x8D\\xF0\\x9F)?\\x91\\xA8\\xF0\\x9F\\x8F[\\xBB-\\xBF])|\\xF0\\x9F(?:\\x8C\\xBE|\\x8D[\\xB3\\xBC]|\\x8E[\\x93\\xA4\\xA8]|\\x8F[\\xAB\\xAD]|\\x92[\\xBB\\xBC]|\\x94[\\xA7\\xAC]|\\x9A[\\x80\\x92]|\\xA4\\x9D\\xE2\\x80\\x8D\\xF0\\x9F\\x91\\xA8\\xF0\\x9F\\x8F[\\xBB\\xBD-\\xBF]|\\xA6(?:[\\xAF\\xBC\\xBD](?:\\xE2\\x80\\x8D\\xE2\\x9E\\xA1\\xEF\\xB8\\x8F)?|[\\xB0-\\xB3]))))?|\\xBD(?:\\xE2\\x80\\x8D(?:\\xE2(?:\\x9A[\\x95\\x96]\\xEF\\xB8\\x8F|\\x9C\\x88\\xEF\\xB8\\x8F|\\x9D\\xA4\\xEF\\xB8\\x8F\\xE2\\x80\\x8D\\xF0\\x9F(?:\\x92\\x8B\\xE2\\x80\\x8D\\xF0\\x9F)?\\x91\\xA8\\xF0\\x9F\\x8F[\\xBB-\\xBF])|\\xF0\\x9F(?:\\x8C\\xBE|\\x8D[\\xB3\\xBC]|\\x8E[\\x93\\xA4\\xA8]|\\x8F[\\xAB\\xAD]|\\x92[\\xBB\\xBC]|\\x94[\\xA7\\xAC]|\\x9A[\\x80\\x92]|\\xA4\\x9D\\xE2\\x80\\x8D\\xF0\\x9F\\x91\\xA8\\xF0\\x9F\\x8F[\\xBB\\xBC\\xBE\\xBF]|\\xA6(?:[\\xAF\\xBC\\xBD](?:\\xE2\\x80\\x8D\\xE2\\x9E\\xA1\\xEF\\xB8\\x8F)?|[\\xB0-\\xB3]))))?|\\xBE(?:\\xE2\\x80\\x8D(?:\\xE2(?:\\x9A[\\x95\\x96]\\xEF\\xB8\\x8F|\\x9C\\x88\\xEF\\xB8\\x8F|\\x9D\\xA4\\xEF\\xB8\\x8F\\xE2\\x80\\x8D\\xF0\\x9F(?:\\x92\\x8B\\xE2\\x80\\x8D\\xF0\\x9F)?\\x91\\xA8\\xF0\\x9F\\x8F[\\xBB-\\xBF])|\\xF0\\x9F(?:\\x8C\\xBE|\\x8D[\\xB3\\xBC]|\\x8E[\\x93\\xA4\\xA8]|\\x8F[\\xAB\\xAD]|\\x92[\\xBB\\xBC]|\\x94[\\xA7\\xAC]|\\x9A[\\x80\\x92]|\\xA4\\x9D\\xE2\\x80\\x8D\\xF0\\x9F\\x91\\xA8\\xF0\\x9F\\x8F[\\xBB-\\xBD\\xBF]|\\xA6(?:[\\xAF\\xBC\\xBD](?:\\xE2\\x80\\x8D\\xE2\\x9E\\xA1\\xEF\\xB8\\x8F)?|[\\xB0-\\xB3]))))?|\\xBF(?:\\xE2\\x80\\x8D(?:\\xE2(?:\\x9A[\\x95\\x96]\\xEF\\xB8\\x8F|\\x9C\\x88\\xEF\\xB8\\x8F|\\x9D\\xA4\\xEF\\xB8\\x8F\\xE2\\x80\\x8D\\xF0\\x9F(?:\\x92\\x8B\\xE2\\x80\\x8D\\xF0\\x9F)?\\x91\\xA8\\xF0\\x9F\\x8F[\\xBB-\\xBF])|\\xF0\\x9F(?:\\x8C\\xBE|\\x8D[\\xB3\\xBC]|\\x8E[\\x93\\xA4\\xA8]|\\x8F[\\xAB\\xAD]|\\x92[\\xBB\\xBC]|\\x94[\\xA7\\xAC]|\\x9A[\\x80\\x92]|\\xA4\\x9D\\xE2\\x80\\x8D\\xF0\\x9F\\x91\\xA8\\xF0\\x9F\\x8F[\\xBB-\\xBE]|\\xA6(?:[\\xAF\\xBC\\xBD](?:\\xE2\\x80\\x8D\\xE2\\x9E\\xA1\\xEF\\xB8\\x8F)?|[\\xB0-\\xB3]))))?))?|\\xA9(?:\\xE2\\x80\\x8D(?:\\xE2(?:\\x9A[\\x95\\x96]\\xEF\\xB8\\x8F|\\x9C\\x88\\xEF\\xB8\\x8F|\\x9D\\xA4\\xEF\\xB8\\x8F\\xE2\\x80\\x8D\\xF0\\x9F(?:\\x92\\x8B\\xE2\\x80\\x8D\\xF0\\x9F)?\\x91[\\xA8\\xA9])|\\xF0\\x9F(?:\\x8C\\xBE|\\x8D[\\xB3\\xBC]|\\x8E[\\x93\\xA4\\xA8]|\\x8F[\\xAB\\xAD]|\\x91(?:\\xA6(?:\\xE2\\x80\\x8D\\xF0\\x9F\\x91\\xA6)?|\\xA7(?:\\xE2\\x80\\x8D\\xF0\\x9F\\x91[\\xA6\\xA7])?|\\xA9\\xE2\\x80\\x8D\\xF0\\x9F\\x91(?:\\xA6(?:\\xE2\\x80\\x8D\\xF0\\x9F\\x91\\xA6)?|\\xA7(?:\\xE2\\x80\\x8D\\xF0\\x9F\\x91[\\xA6\\xA7])?))|\\x92[\\xBB\\xBC]|\\x94[\\xA7\\xAC]|\\x9A[\\x80\\x92]|\\xA6(?:[\\xAF\\xBC\\xBD](?:\\xE2\\x80\\x8D\\xE2\\x9E\\xA1\\xEF\\xB8\\x8F)?|[\\xB0-\\xB3])))|\\xF0\\x9F\\x8F(?:\\xBB(?:\\xE2\\x80\\x8D(?:\\xE2(?:\\x9A[\\x95\\x96]\\xEF\\xB8\\x8F|\\x9C\\x88\\xEF\\xB8\\x8F|\\x9D\\xA4\\xEF\\xB8\\x8F\\xE2\\x80\\x8D\\xF0\\x9F(?:\\x92\\x8B\\xE2\\x80\\x8D\\xF0\\x9F)?\\x91[\\xA8\\xA9]\\xF0\\x9F\\x8F[\\xBB-\\xBF])|\\xF0\\x9F(?:\\x8C\\xBE|\\x8D[\\xB3\\xBC]|\\x8E[\\x93\\xA4\\xA8]|\\x8F[\\xAB\\xAD]|\\x92[\\xBB\\xBC]|\\x94[\\xA7\\xAC]|\\x9A[\\x80\\x92]|\\xA4\\x9D\\xE2\\x80\\x8D\\xF0\\x9F\\x91[\\xA8\\xA9]\\xF0\\x9F\\x8F[\\xBC-\\xBF]|\\xA6(?:[\\xAF\\xBC\\xBD](?:\\xE2\\x80\\x8D\\xE2\\x9E\\xA1\\xEF\\xB8\\x8F)?|[\\xB0-\\xB3]))))?|\\xBC(?:\\xE2\\x80\\x8D(?:\\xE2(?:\\x9A[\\x95\\x96]\\xEF\\xB8\\x8F|\\x9C\\x88\\xEF\\xB8\\x8F|\\x9D\\xA4\\xEF\\xB8\\x8F\\xE2\\x80\\x8D\\xF0\\x9F(?:\\x92\\x8B\\xE2\\x80\\x8D\\xF0\\x9F)?\\x91[\\xA8\\xA9]\\xF0\\x9F\\x8F[\\xBB-\\xBF])|\\xF0\\x9F(?:\\x8C\\xBE|\\x8D[\\xB3\\xBC]|\\x8E[\\x93\\xA4\\xA8]|\\x8F[\\xAB\\xAD]|\\x92[\\xBB\\xBC]|\\x94[\\xA7\\xAC]|\\x9A[\\x80\\x92]|\\xA4\\x9D\\xE2\\x80\\x8D\\xF0\\x9F\\x91[\\xA8\\xA9]\\xF0\\x9F\\x8F[\\xBB\\xBD-\\xBF]|\\xA6(?:[\\xAF\\xBC\\xBD](?:\\xE2\\x80\\x8D\\xE2\\x9E\\xA1\\xEF\\xB8\\x8F)?|[\\xB0-\\xB3]))))?|\\xBD(?:\\xE2\\x80\\x8D(?:\\xE2(?:\\x9A[\\x95\\x96]\\xEF\\xB8\\x8F|\\x9C\\x88\\xEF\\xB8\\x8F|\\x9D\\xA4\\xEF\\xB8\\x8F\\xE2\\x80\\x8D\\xF0\\x9F(?:\\x92\\x8B\\xE2\\x80\\x8D\\xF0\\x9F)?\\x91[\\xA8\\xA9]\\xF0\\x9F\\x8F[\\xBB-\\xBF])|\\xF0\\x9F(?:\\x8C\\xBE|\\x8D[\\xB3\\xBC]|\\x8E[\\x93\\xA4\\xA8]|\\x8F[\\xAB\\xAD]|\\x92[\\xBB\\xBC]|\\x94[\\xA7\\xAC]|\\x9A[\\x80\\x92]|\\xA4\\x9D\\xE2\\x80\\x8D\\xF0\\x9F\\x91[\\xA8\\xA9]\\xF0\\x9F\\x8F[\\xBB\\xBC\\xBE\\xBF]|\\xA6(?:[\\xAF\\xBC\\xBD](?:\\xE2\\x80\\x8D\\xE2\\x9E\\xA1\\xEF\\xB8\\x8F)?|[\\xB0-\\xB3]))))?|\\xBE(?:\\xE2\\x80\\x8D(?:\\xE2(?:\\x9A[\\x95\\x96]\\xEF\\xB8\\x8F|\\x9C\\x88\\xEF\\xB8\\x8F|\\x9D\\xA4\\xEF\\xB8\\x8F\\xE2\\x80\\x8D\\xF0\\x9F(?:\\x92\\x8B\\xE2\\x80\\x8D\\xF0\\x9F)?\\x91[\\xA8\\xA9]\\xF0\\x9F\\x8F[\\xBB-\\xBF])|\\xF0\\x9F(?:\\x8C\\xBE|\\x8D[\\xB3\\xBC]|\\x8E[\\x93\\xA4\\xA8]|\\x8F[\\xAB\\xAD]|\\x92[\\xBB\\xBC]|\\x94[\\xA7\\xAC]|\\x9A[\\x80\\x92]|\\xA4\\x9D\\xE2\\x80\\x8D\\xF0\\x9F\\x91[\\xA8\\xA9]\\xF0\\x9F\\x8F[\\xBB-\\xBD\\xBF]|\\xA6(?:[\\xAF\\xBC\\xBD](?:\\xE2\\x80\\x8D\\xE2\\x9E\\xA1\\xEF\\xB8\\x8F)?|[\\xB0-\\xB3]))))?|\\xBF(?:\\xE2\\x80\\x8D(?:\\xE2(?:\\x9A[\\x95\\x96]\\xEF\\xB8\\x8F|\\x9C\\x88\\xEF\\xB8\\x8F|\\x9D\\xA4\\xEF\\xB8\\x8F\\xE2\\x80\\x8D\\xF0\\x9F(?:\\x92\\x8B\\xE2\\x80\\x8D\\xF0\\x9F)?\\x91[\\xA8\\xA9]\\xF0\\x9F\\x8F[\\xBB-\\xBF])|\\xF0\\x9F(?:\\x8C\\xBE|\\x8D[\\xB3\\xBC]|\\x8E[\\x93\\xA4\\xA8]|\\x8F[\\xAB\\xAD]|\\x92[\\xBB\\xBC]|\\x94[\\xA7\\xAC]|\\x9A[\\x80\\x92]|\\xA4\\x9D\\xE2\\x80\\x8D\\xF0\\x9F\\x91[\\xA8\\xA9]\\xF0\\x9F\\x8F[\\xBB-\\xBE]|\\xA6(?:[\\xAF\\xBC\\xBD](?:\\xE2\\x80\\x8D\\xE2\\x9E\\xA1\\xEF\\xB8\\x8F)?|[\\xB0-\\xB3]))))?))?|\\xAF(?:\\xE2\\x80\\x8D\\xE2\\x99[\\x80\\x82]\\xEF\\xB8\\x8F)?)|\\x92(?:[\\x81\\x82\\x86\\x87](?:\\xF0\\x9F\\x8F[\\xBB-\\xBF])?(?:\\xE2\\x80\\x8D\\xE2\\x99[\\x80\\x82]\\xEF\\xB8\\x8F)?|[\\x83\\x85\\x8F\\x91\\xAA](?:\\xF0\\x9F\\x8F[\\xBB-\\xBF])?|[\\x80\\x84\\x88-\\x8E\\x90\\x92-\\xA9\\xAB-\\xBF])|\\x93(?:[\\x80-\\xBC\\xBF]|\\xBD\\xEF\\xB8\\x8F)|\\x94[\\x80-\\xBD]|\\x95(?:[\\x89\\x8A\\xAF\\xB0\\xB3\\xB6-\\xB9]\\xEF\\xB8\\x8F|[\\x8B-\\x8E\\x90-\\xA7]|\\xB4(?:\\xEF\\xB8\\x8F|\\xF0\\x9F\\x8F[\\xBB-\\xBF])|\\xB5(?:\\xEF\\xB8\\x8F|\\xF0\\x9F\\x8F[\\xBB-\\xBF])(?:\\xE2\\x80\\x8D\\xE2\\x99[\\x80\\x82]\\xEF\\xB8\\x8F)?|\\xBA(?:\\xF0\\x9F\\x8F[\\xBB-\\xBF])?)|\\x96(?:[\\x87\\x8A-\\x8D\\xA5\\xA8\\xB1\\xB2\\xBC]\\xEF\\xB8\\x8F|[\\x95\\x96](?:\\xF0\\x9F\\x8F[\\xBB-\\xBF])?|\\x90(?:\\xEF\\xB8\\x8F|\\xF0\\x9F\\x8F[\\xBB-\\xBF])|\\xA4)|\\x97(?:[\\x82-\\x84\\x91-\\x93\\x9C-\\x9E\\xA1\\xA3\\xA8\\xAF\\xB3\\xBA]\\xEF\\xB8\\x8F|[\\xBB-\\xBF])|\\x98(?:[\\x80-\\xAD\\xAF-\\xB4\\xB7-\\xBF]|\\xAE(?:\\xE2\\x80\\x8D\\xF0\\x9F\\x92\\xA8)?|\\xB5(?:\\xE2\\x80\\x8D\\xF0\\x9F\\x92\\xAB)?|\\xB6(?:\\xE2\\x80\\x8D\\xF0\\x9F\\x8C\\xAB\\xEF\\xB8\\x8F)?)|\\x99(?:[\\x85-\\x87\\x8B\\x8D\\x8E](?:\\xF0\\x9F\\x8F[\\xBB-\\xBF])?(?:\\xE2\\x80\\x8D\\xE2\\x99[\\x80\\x82]\\xEF\\xB8\\x8F)?|[\\x8C\\x8F](?:\\xF0\\x9F\\x8F[\\xBB-\\xBF])?|[\\x80\\x81\\x83\\x84\\x88-\\x8A]|\\x82(?:\\xE2\\x80\\x8D\\xE2\\x86[\\x94\\x95]\\xEF\\xB8\\x8F)?)|\\x9A(?:[\\xA3\\xB4\\xB5](?:\\xF0\\x9F\\x8F[\\xBB-\\xBF])?(?:\\xE2\\x80\\x8D\\xE2\\x99[\\x80\\x82]\\xEF\\xB8\\x8F)?|[\\x80-\\xA2\\xA4-\\xB3\\xB7-\\xBF]|\\xB6(?:\\xF0\\x9F\\x8F[\\xBB-\\xBF])?(?:\\xE2\\x80\\x8D\\xE2(?:\\x99[\\x80\\x82]\\xEF\\xB8\\x8F(?:\\xE2\\x80\\x8D\\xE2\\x9E\\xA1\\xEF\\xB8\\x8F)?|\\x9E\\xA1\\xEF\\xB8\\x8F))?)|\\x9B(?:[\\x80\\x8C](?:\\xF0\\x9F\\x8F[\\xBB-\\xBF])?|[\\x8B\\x8D-\\x8F\\xA0-\\xA5\\xA9\\xB0\\xB3]\\xEF\\xB8\\x8F|[\\x81-\\x85\\x90-\\x92\\x95-\\x97\\x9C-\\x9F\\xAB\\xAC\\xB4-\\xBC])|\\x9F[\\xA0-\\xAB\\xB0]|\\xA4(?:[\\x8C\\x8F\\x98-\\x9F\\xB0-\\xB4\\xB6](?:\\xF0\\x9F\\x8F[\\xBB-\\xBF])?|[\\xA6\\xB5\\xB7-\\xB9\\xBD\\xBE](?:\\xF0\\x9F\\x8F[\\xBB-\\xBF])?(?:\\xE2\\x80\\x8D\\xE2\\x99[\\x80\\x82]\\xEF\\xB8\\x8F)?|[\\x8D\\x8E\\x90-\\x97\\xA0-\\xA5\\xA7-\\xAF\\xBA\\xBF]|\\xBC(?:\\xE2\\x80\\x8D\\xE2\\x99[\\x80\\x82]\\xEF\\xB8\\x8F)?)|\\xA5(?:[\\x80-\\x85\\x87-\\xB6\\xB8-\\xBF]|\\xB7(?:\\xF0\\x9F\\x8F[\\xBB-\\xBF])?)|\\xA6(?:[\\xB5\\xB6\\xBB](?:\\xF0\\x9F\\x8F[\\xBB-\\xBF])?|[\\xB8\\xB9](?:\\xF0\\x9F\\x8F[\\xBB-\\xBF])?(?:\\xE2\\x80\\x8D\\xE2\\x99[\\x80\\x82]\\xEF\\xB8\\x8F)?|[\\x80-\\xB4\\xB7\\xBA\\xBC-\\xBF])|\\xA7(?:[\\x8D\\x8F\\x94\\x96-\\x9D](?:\\xF0\\x9F\\x8F[\\xBB-\\xBF])?(?:\\xE2\\x80\\x8D\\xE2\\x99[\\x80\\x82]\\xEF\\xB8\\x8F)?|[\\x92\\x93\\x95](?:\\xF0\\x9F\\x8F[\\xBB-\\xBF])?|[\\x9E\\x9F](?:\\xE2\\x80\\x8D\\xE2\\x99[\\x80\\x82]\\xEF\\xB8\\x8F)?|[\\x80-\\x8C\\x90\\xA0-\\xBF]|\\x8E(?:\\xF0\\x9F\\x8F[\\xBB-\\xBF])?(?:\\xE2\\x80\\x8D\\xE2(?:\\x99[\\x80\\x82]\\xEF\\xB8\\x8F(?:\\xE2\\x80\\x8D\\xE2\\x9E\\xA1\\xEF\\xB8\\x8F)?|\\x9E\\xA1\\xEF\\xB8\\x8F))?|\\x91(?:\\xE2\\x80\\x8D(?:\\xE2(?:\\x9A[\\x95\\x96]|\\x9C\\x88)\\xEF\\xB8\\x8F|\\xF0\\x9F(?:\\x8C\\xBE|\\x8D[\\xB3\\xBC]|\\x8E[\\x84\\x93\\xA4\\xA8]|\\x8F[\\xAB\\xAD]|\\x92[\\xBB\\xBC]|\\x94[\\xA7\\xAC]|\\x9A[\\x80\\x92]|\\xA4\\x9D\\xE2\\x80\\x8D\\xF0\\x9F\\xA7\\x91|\\xA6(?:[\\xAF\\xBC\\xBD](?:\\xE2\\x80\\x8D\\xE2\\x9E\\xA1\\xEF\\xB8\\x8F)?|[\\xB0-\\xB3])|\\xA7(?:\\x91\\xE2\\x80\\x8D\\xF0\\x9F\\xA7)?\\x92(?:\\xE2\\x80\\x8D\\xF0\\x9F\\xA7\\x92)?))|\\xF0\\x9F\\x8F(?:\\xBB(?:\\xE2\\x80\\x8D(?:\\xE2(?:\\x9A[\\x95\\x96]\\xEF\\xB8\\x8F|\\x9C\\x88\\xEF\\xB8\\x8F|\\x9D\\xA4\\xEF\\xB8\\x8F\\xE2\\x80\\x8D\\xF0\\x9F(?:\\x92\\x8B\\xE2\\x80\\x8D\\xF0\\x9F)?\\xA7\\x91\\xF0\\x9F\\x8F[\\xBC-\\xBF])|\\xF0\\x9F(?:\\x8C\\xBE|\\x8D[\\xB3\\xBC]|\\x8E[\\x84\\x93\\xA4\\xA8]|\\x8F[\\xAB\\xAD]|\\x92[\\xBB\\xBC]|\\x94[\\xA7\\xAC]|\\x9A[\\x80\\x92]|\\xA4\\x9D\\xE2\\x80\\x8D\\xF0\\x9F\\xA7\\x91\\xF0\\x9F\\x8F[\\xBB-\\xBF]|\\xA6(?:[\\xAF\\xBC\\xBD](?:\\xE2\\x80\\x8D\\xE2\\x9E\\xA1\\xEF\\xB8\\x8F)?|[\\xB0-\\xB3]))))?|\\xBC(?:\\xE2\\x80\\x8D(?:\\xE2(?:\\x9A[\\x95\\x96]\\xEF\\xB8\\x8F|\\x9C\\x88\\xEF\\xB8\\x8F|\\x9D\\xA4\\xEF\\xB8\\x8F\\xE2\\x80\\x8D\\xF0\\x9F(?:\\x92\\x8B\\xE2\\x80\\x8D\\xF0\\x9F)?\\xA7\\x91\\xF0\\x9F\\x8F[\\xBB\\xBD-\\xBF])|\\xF0\\x9F(?:\\x8C\\xBE|\\x8D[\\xB3\\xBC]|\\x8E[\\x84\\x93\\xA4\\xA8]|\\x8F[\\xAB\\xAD]|\\x92[\\xBB\\xBC]|\\x94[\\xA7\\xAC]|\\x9A[\\x80\\x92]|\\xA4\\x9D\\xE2\\x80\\x8D\\xF0\\x9F\\xA7\\x91\\xF0\\x9F\\x8F[\\xBB-\\xBF]|\\xA6(?:[\\xAF\\xBC\\xBD](?:\\xE2\\x80\\x8D\\xE2\\x9E\\xA1\\xEF\\xB8\\x8F)?|[\\xB0-\\xB3]))))?|\\xBD(?:\\xE2\\x80\\x8D(?:\\xE2(?:\\x9A[\\x95\\x96]\\xEF\\xB8\\x8F|\\x9C\\x88\\xEF\\xB8\\x8F|\\x9D\\xA4\\xEF\\xB8\\x8F\\xE2\\x80\\x8D\\xF0\\x9F(?:\\x92\\x8B\\xE2\\x80\\x8D\\xF0\\x9F)?\\xA7\\x91\\xF0\\x9F\\x8F[\\xBB\\xBC\\xBE\\xBF])|\\xF0\\x9F(?:\\x8C\\xBE|\\x8D[\\xB3\\xBC]|\\x8E[\\x84\\x93\\xA4\\xA8]|\\x8F[\\xAB\\xAD]|\\x92[\\xBB\\xBC]|\\x94[\\xA7\\xAC]|\\x9A[\\x80\\x92]|\\xA4\\x9D\\xE2\\x80\\x8D\\xF0\\x9F\\xA7\\x91\\xF0\\x9F\\x8F[\\xBB-\\xBF]|\\xA6(?:[\\xAF\\xBC\\xBD](?:\\xE2\\x80\\x8D\\xE2\\x9E\\xA1\\xEF\\xB8\\x8F)?|[\\xB0-\\xB3]))))?|\\xBE(?:\\xE2\\x80\\x8D(?:\\xE2(?:\\x9A[\\x95\\x96]\\xEF\\xB8\\x8F|\\x9C\\x88\\xEF\\xB8\\x8F|\\x9D\\xA4\\xEF\\xB8\\x8F\\xE2\\x80\\x8D\\xF0\\x9F(?:\\x92\\x8B\\xE2\\x80\\x8D\\xF0\\x9F)?\\xA7\\x91\\xF0\\x9F\\x8F[\\xBB-\\xBD\\xBF])|\\xF0\\x9F(?:\\x8C\\xBE|\\x8D[\\xB3\\xBC]|\\x8E[\\x84\\x93\\xA4\\xA8]|\\x8F[\\xAB\\xAD]|\\x92[\\xBB\\xBC]|\\x94[\\xA7\\xAC]|\\x9A[\\x80\\x92]|\\xA4\\x9D\\xE2\\x80\\x8D\\xF0\\x9F\\xA7\\x91\\xF0\\x9F\\x8F[\\xBB-\\xBF]|\\xA6(?:[\\xAF\\xBC\\xBD](?:\\xE2\\x80\\x8D\\xE2\\x9E\\xA1\\xEF\\xB8\\x8F)?|[\\xB0-\\xB3]))))?|\\xBF(?:\\xE2\\x80\\x8D(?:\\xE2(?:\\x9A[\\x95\\x96]\\xEF\\xB8\\x8F|\\x9C\\x88\\xEF\\xB8\\x8F|\\x9D\\xA4\\xEF\\xB8\\x8F\\xE2\\x80\\x8D\\xF0\\x9F(?:\\x92\\x8B\\xE2\\x80\\x8D\\xF0\\x9F)?\\xA7\\x91\\xF0\\x9F\\x8F[\\xBB-\\xBE])|\\xF0\\x9F(?:\\x8C\\xBE|\\x8D[\\xB3\\xBC]|\\x8E[\\x84\\x93\\xA4\\xA8]|\\x8F[\\xAB\\xAD]|\\x92[\\xBB\\xBC]|\\x94[\\xA7\\xAC]|\\x9A[\\x80\\x92]|\\xA4\\x9D\\xE2\\x80\\x8D\\xF0\\x9F\\xA7\\x91\\xF0\\x9F\\x8F[\\xBB-\\xBF]|\\xA6(?:[\\xAF\\xBC\\xBD](?:\\xE2\\x80\\x8D\\xE2\\x9E\\xA1\\xEF\\xB8\\x8F)?|[\\xB0-\\xB3]))))?))?)|\\xA9[\\xB0-\\xBC]|\\xAA[\\x80-\\x88\\x90-\\xBD\\xBF]|\\xAB(?:[\\x83-\\x85\\xB0\\xB2-\\xB8](?:\\xF0\\x9F\\x8F[\\xBB-\\xBF])?|[\\x80-\\x82\\x8E-\\x9B\\xA0-\\xA8]|\\xB1(?:\\xF0\\x9F\\x8F(?:\\xBB(?:\\xE2\\x80\\x8D\\xF0\\x9F\\xAB\\xB2\\xF0\\x9F\\x8F[\\xBC-\\xBF])?|\\xBC(?:\\xE2\\x80\\x8D\\xF0\\x9F\\xAB\\xB2\\xF0\\x9F\\x8F[\\xBB\\xBD-\\xBF])?|\\xBD(?:\\xE2\\x80\\x8D\\xF0\\x9F\\xAB\\xB2\\xF0\\x9F\\x8F[\\xBB\\xBC\\xBE\\xBF])?|\\xBE(?:\\xE2\\x80\\x8D\\xF0\\x9F\\xAB\\xB2\\xF0\\x9F\\x8F[\\xBB-\\xBD\\xBF])?|\\xBF(?:\\xE2\\x80\\x8D\\xF0\\x9F\\xAB\\xB2\\xF0\\x9F\\x8F[\\xBB-\\xBE])?))?)))(?!\\xEF\\xB8\\x8E)(?:\\xEF\\xB8\\x8F)?)S';

	/**
	* {@inheritdoc}
	*/
	public function parse($text, array $matches)
	{
		$this->parseShortnames($text);
		$this->parseCustomAliases($text);
		$this->parseUnicode($text);
	}

	/**
	* Add an emoji tag for given sequence
	*
	* @param  integer $tagPos Position of the tag in the original text
	* @param  integer $tagLen Length of text consumed by the tag
	* @param  string  $hex    Full-qualified sequence of codepoints in hex
	* @return void
	*/
	protected function addTag($tagPos, $tagLen, $hex)
	{
		$tag = $this->parser->addSelfClosingTag($this->config['tagName'], $tagPos, $tagLen, 10);

		// Short sequence, only the relevant codepoints are kept
		$seq = str_replace(['-200d', '-fe0f'], '', $hex);
		$tag->setAttribute('seq', $seq);

		// Twemoji sequence, leading zeroes are removed and VS-16 are removed from non-ZWJ sequences
		$tseq = ltrim($hex, '0');
		if (strpos($tseq, '-200d') === false)
		{
			$tseq = str_replace('-fe0f', '', $tseq);
		}
		$tag->setAttribute('tseq', $tseq);
	}

	/**
	* Get the sequence of Unicode codepoints that corresponds to given emoji
	*
	* @param  string $str UTF-8 emoji
	* @return string      Codepoint sequence, e.g. "0023-20e3"
	*/
	protected function getHexSequence($str)
	{
		$seq = [];
		$i   = -1;
		while (++$i < strlen($str))
		{
			$cp = ord($str[$i]);
			if ($cp >= 0xF0)
			{
				$cp = ($cp << 18) + (ord($str[++$i]) << 12) + (ord($str[++$i]) << 6) + ord($str[++$i]) - 0x3C82080;
			}
			elseif ($cp >= 0xE0)
			{
				$cp = ($cp << 12) + (ord($str[++$i]) << 6) + ord($str[++$i]) - 0xE2080;
			}
			elseif ($cp >= 0xC0)
			{
				$cp = ($cp << 6) + ord($str[++$i]) - 0x3080;
			}
			$seq[] = sprintf('%04x', $cp);
		}

		return implode('-', $seq);
	}

	/**
	* Parse custom aliases in given text
	*
	* @param  string $text Original text
	* @return void
	*/
	protected function parseCustomAliases($text)
	{
		if (empty($this->config['customRegexp']))
		{
			return;
		}

		$matchPos = 0;
		if (isset($this->config['customQuickMatch']))
		{
			$matchPos = strpos($text, $this->config['customQuickMatch']);
			if ($matchPos === false)
			{
				return;
			}
		}

		preg_match_all($this->config['customRegexp'], $text, $matches, PREG_OFFSET_CAPTURE, $matchPos);
		foreach ($matches[0] as list($alias, $tagPos))
		{
			if (isset($this->parser->registeredVars['Emoji.aliases'][$alias]))
			{
				$hex = $this->getHexSequence($this->parser->registeredVars['Emoji.aliases'][$alias]);
				$this->addTag($tagPos, strlen($alias), $hex);
			}
		}
	}

	/**
	* Parse shortnames in given text
	*
	* @param  string $text Original text
	* @return void
	*/
	protected function parseShortnames($text)
	{
		$matchPos = strpos($text, ':');
		if ($matchPos === false)
		{
			return;
		}
		preg_match_all($this->shortnameRegexp, $text, $matches, PREG_OFFSET_CAPTURE, $matchPos);
		foreach ($matches[0] as list($alias, $tagPos))
		{
			$alias .= ':';
			$tagLen = strlen($alias);
			if (isset($this->parser->registeredVars['Emoji.aliases'][$alias]))
			{
				$hex = $this->getHexSequence($this->parser->registeredVars['Emoji.aliases'][$alias]);
				$this->addTag($tagPos, $tagLen, $hex);
			}
			elseif (preg_match('/^:[0-3][0-9a-f]{3,4}(?:-[0-9a-f]{4,5})*:$/', $alias))
			{
				$this->addTag($tagPos, $tagLen, substr($alias, 1, -1));
			}
		}
	}

	/**
	* Parse Unicode emoji in given text
	*
	* @param  string $text Original text
	* @return void
	*/
	protected function parseUnicode($text)
	{
		if (strpos($text, "\xE2") === false && strpos($text, "\xEF") === false && strpos($text, "\xF0") === false)
		{
			return;
		}
		preg_match_all($this->unicodeRegexp, $text, $matches, PREG_OFFSET_CAPTURE);
		foreach ($matches[0] as list($emoji, $tagPos))
		{
			$this->addTag($tagPos, strlen($emoji), $this->getHexSequence($emoji));
		}
	}
}