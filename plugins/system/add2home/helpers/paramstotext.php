<?php
/**
 * @package     CedAdd2Home
 * @subpackage  com_cedadd2home
 *
 * @copyright   Copyright (C) 2013-2017 galaxiis.com All rights reserved.
 * @license     The author and holder of the copyright of the software is Cédric Walter. The licensor and as such issuer of the license and bearer of the
 *              worldwide exclusive usage rights including the rights to reproduce, distribute and make the software available to the public
 *              in any form is Galaxiis.com
 *              see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class ParamsToText
{


    public function convert($params)
    {
        return " {
	de_de: {
		ios: '".$params->get('lang-de_de-ios', '')."',
		android: '".$params->get('lang-de_de-android', '')."',
	},
	en_us: {
		ios: '".$params->get('lang-en_us-ios', '')."',
		android: '".$params->get('lang-en_us-ios', '')."',
	},
	es_es: {
		ios: '".$params->get('lang-es_es-ios', '')."',
		android: '".$params->get('lang-es_es-ios', '')."',
	},
	fr_fr: {
		ios: '".$params->get('lang-fr_fr-ios', '')."',
		android: '".$params->get('lang-fr_fr-ios', '')."',
	},
	he_il: {
		ios: '".$params->get('lang-he_il-ios', '')."',
		android: '".$params->get('lang-he_il-ios', '')."',
	},
	it_it: {
		ios: '".$params->get('lang-it_it-ios', '')."',
		android: '".$params->get('lang-it_it-ios', '')."',
	},
	nb_no: {
		ios: '".$params->get('lang-nb_no-ios', '')."',
		android: '".$params->get('lang-nb_no-ios', '')."',
	},
	pt_br: {
		ios: '".$params->get('lang-pt_br-ios', '')."',
		android: '".$params->get('lang-pt_br-ios', '')."',
	},
	pt_pt: {
		ios: '".$params->get('lang-pt_pt-ios', '')."',
		android: '".$params->get('lang-pt_pt-ios', '')."',
	},
	nl_nl: {
        ios: '".$params->get('lang-nl_nl-ios', '')."',
		android: '".$params->get('lang-nl_nl-ios', '')."',	},
	sv_se: {
		ios: '".$params->get('lang-sv_se-ios', '')."',
		android: '".$params->get('lang-sv_se-ios', '')."',
	},
	zh_cn: {
		ios: '".$params->get('lang-zh_cn-ios', '')."',
		android: '".$params->get('lang-zh_cn-ios', '')."',
	},
	zh_tw: {
		ios: '".$params->get('lang-zh_tw-ios', '')."',
		android: '".$params->get('lang-zh_tw-ios', '')."',
	},
	fi_FI: {
		ios: '".$params->get('lang-fi_FI-ios', '')."',
		android: '".$params->get('lang-fi_FI-ios', '')."',
	}
};";
    }

}