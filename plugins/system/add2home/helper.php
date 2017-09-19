<?php

/**
 * Created by PhpStorm.
 * User: cedric
 * Date: 12/14/2014
 * Time: 12:16 PM
 */
class cedAdd2homeHelper
{

    public static function getJavascriptInitializer($params, $isAndroid = false)
    {
        $parameters = array();

        $parameters[] = "modal: " . $params->get('modal', 'true');
        $parameters[] = "mandatory: " . $params->get('mandatory', 'true');
        $parameters[] = "skipFirstVisit: " . $params->get('skipFirstVisit', 'false');
        $parameters[] = "startDelay: " . intval($params->get('startDelay', 1));
        $parameters[] = "lifespan: " . intval($params->get('lifespan', 15));

        $parameters[] = "displayPace: " . self::mapZeroToFalse($params->get('displayPace', 0));

        $parameters[] = "maxDisplayCount: " . $params->get('maxDisplayCount', 1);
        $parameters[] = "icon: " . $params->get('icon', 'true');
        $parameters[] = "detectHomescreen: " . $params->get('detectHomescreen', 'false');

        $autoStart = $params->get('autostart', 1);
        if ($autoStart)
            $parameters[] = "autostart: true";
        else {
            $parameters[] = "autostart: false";
        }

        $parameters[] = "debug: " . $params->get('debug', 'false');
        $parameters[] = "logging: " . $params->get('logging', 'false');

        $parameters[] = "appID: '" . $params->get('appID', "org.cubiq.myCoolApp") . "'";
        $parameters[] = "privateModeOverride: " . $params->get('privateModeOverride', 'true');


        $message = self::getCustomMessage($params);
        if ($message != '') {
            $parameters[] = $message;
        }

        if ($params->get('onShow', '') != '') {
            $parameters[] = "onShow: '" . $params->get('onShow', '');
        }
        if ($params->get('onAdd', '') != '') {
            $parameters[] = "onAdd: '" . $params->get('onAdd', '');
        }

        $pluginsParameters = implode(", ", $parameters);

        $javascript = array();
        $javascript[] = "";
        $javascript[] = "jQuery(window).on('load',  function() {";
        $javascript[] = "var _ath = addToHomescreen;";

        if ($isAndroid) {
            $javascript[] = "";
            $javascript[] = "var _ua = window.navigator.userAgent;";
            $javascript[] = "_ath.isAndroidBrowser = _ua.indexOf('Android') > -1 && !(/Chrome\/[.0-9]*/).test(_ua);";
            $javascript[] = "_ath.isCompatible = _ath.isCompatible || _ath.isAndroidBrowser;";
            $javascript[] = "if ( _ath.OS == 'unsupported' && _ath.isAndroidBrowser ) {
                            	_ath.OS = (/ (GT-I9|GT-P7|SM-T2|GT-P5|GT-P3|SCH-I8)/).test(_ua) ? 'samsungAndroid' : 'stockAndroid';
                        }";
            $javascript[] = "";
        }
        $javascript[] = '_ath({' . $pluginsParameters . '});';
        $javascript[] = "";
        $javascript[] = "});";

        return implode("\n", $javascript);
    }

    private static function getCustomMessage($params)
    {
        if ($params->get('customMessageYes', false)) {

            $message = $params->get('customMessage');

//            return " message:'" . json_encode(utf8_encode($params->get('customMessage'))) . "'";

            //escape single quote, newline and special character
            return " message:'" . htmlspecialchars(nl2br(addslashes($params->get('customMessage')))) . "'";
//            return " message:'" . json_encode($message,JSON_HEX_APOS). "'";
        }

        return "";
    }

    /**
     * @param $var
     * @return int|string
     */
    protected static function mapZeroToFalse($var)
    {
        $displayPace = intval($var);
        $displayPace = $displayPace == 0 ? "false" : $displayPace;

        return $displayPace;
    }

}