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

jimport('joomla.plugin.plugin');
jimport('joomla.environment.browser');

require_once(dirname(__FILE__) . '/provider.php');
require_once(dirname(__FILE__) . '/helper.php');
require_once(dirname(__FILE__) . '/scaler.php');
//require_once(dirname(__FILE__) . '/helpers/paramstotext.php');

class cedAdd2HomeIos extends CedAdd2HomeProvider
{

    const IPHONE = "iPhone";
    const IPAD = "iPad";
    const IPOD = "iPod";

    const APPLE_TOUCH_STARTUP_IMAGE = 'apple-touch-startup-image';
    const MEDIA = 'media';

    public function isActive($agent)
    {
        $isIPhone = stripos($agent, self::IPHONE) !== false;
        $isIPad = stripos($agent, self::IPAD) !== false;
        $isIPod = stripos($agent, self::IPOD) !== false;

        return $isIPhone || $isIPad || $isIPod;
    }

    public function execute($agent, $params, $base)
    {
        $this->base = $base;

        $isIPhone = stripos($agent, self::IPHONE) !== false;
        $isIPad = stripos($agent, self::IPAD) !== false;
        $isIPod = stripos($agent, self::IPOD) !== false;

        //http://developer.apple.com/library/safari/#documentation/appleapplications/reference/SafariHTMLRef/Articles/MetaTags.html

        //To prevent the balloon to appear once the app has been added to the home screen,
        if ($params->get('webapp', '1')) {
            $this->addMetadata("apple-mobile-web-app-capable", "yes");
        }

        if ($params->get('webapp-links', true)) {
            $this->preventLinksFromOpeningInMobileSafari();
        }

        if ($params->get('web-app-status-bar-style', 1)) {
            $this->addMetadata("apple-mobile-web-app-status-bar-style", $params->get('web-app-status-bar-style-content', "black"));
        }

        if ($params->get('format-detection', 0)) {
            $this->addMetadata("format-detection", "telephone=no");
        }

        if ($params->get('useCustomTitle', 0)) {
            $this->addMetadata("apple-mobile-web-app-title", $params->get('apple-mobile-web-app-title', 'Welcome to Galaxiis'));
        } else {
            $this->addMetadata("apple-mobile-web-app-title", JFactory::getDocument()->title);
        }


        //This code tells the browser to adjust the site to the width of the device
        if ($params->get('hasViewport', '1')) {
            // https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/UsingtheViewport/UsingtheViewport.html#//apple_ref/doc/uid/TP40006509-SW19
            $view = array();
            $view[] = $params->get('viewport', 'width=device-width');
            $view[] = $params->get('userScaling', 'user-scalable=yes');
            $view[] = "width=" . $params->get('width', '980');
            $view[] = "height=" . $params->get('height', '223');
            $view[] = $params->get('maximum-scale', 'maximum-scale=1.6');
            $view[] = $params->get('minimum-scale', 'minimum-scale=0.25');

            $this->addMetadata("viewport", implode(",", $view));
        }


        if ($params->get('hasStartupImage', '1')) {
            if ($isIPhone || $isIPod) {
                // iPhone
                $this->addHeadLinks(CedAdd2HomeScaler::scaleIfRequired($params->get('apple-touch-startup-image-320x460', 'media/plg_system_add2home/apple-touch-startup-image-320x460.png'), 320, 460),
                    self::APPLE_TOUCH_STARTUP_IMAGE,
                    array(self::MEDIA => "(device-width: 320px) and (device-height: 480px) and (-webkit-device-pixel-ratio: 1)"));

                // iPhone (Retina)
                $this->addHeadLinks(CedAdd2HomeScaler::scaleIfRequired($params->get('apple-touch-startup-image-640x920', 'media/plg_system_add2home/apple-touch-startup-image-640x920.png'), 640, 920),
                    self::APPLE_TOUCH_STARTUP_IMAGE,
                    array(self::MEDIA => "(device-width: 320px) and (device-height: 480px) and (-webkit-device-pixel-ratio: 2)"));

                // iPhone 5
                $this->addHeadLinks(CedAdd2HomeScaler::scaleIfRequired($params->get('apple-touch-startup-image-640x1096', 'media/plg_system_add2home/apple-touch-startup-image-640x1096.png'), 640, 1096),
                    self::APPLE_TOUCH_STARTUP_IMAGE,
                    array(self::MEDIA => "(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)"));

                // iPhone 6
                // http://stackoverflow.com/questions/26026492/correct-size-for-apple-touch-startup-image-in-iphone-6-iphone-6-plus
                $this->addHeadLinks(CedAdd2HomeScaler::scaleIfRequired($params->get('apple-touch-startup-image-750x1334', 'media/plg_system_add2home/apple-touch-startup-image-750x1334.png'), 750, 1334),
                    self::APPLE_TOUCH_STARTUP_IMAGE,
                    array(self::MEDIA => "(device-width: 375px) and (device-height: 667px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 2)"));

                // iPhone 6 landscape
                $this->addHeadLinks(CedAdd2HomeScaler::scaleIfRequired($params->get('apple-touch-startup-image-1334x750', 'media/plg_system_add2home/apple-touch-startup-image-1334x750.png'), 1334, 750),
                    self::APPLE_TOUCH_STARTUP_IMAGE,
                    array(self::MEDIA => "(device-width: 375px) and (device-height: 667px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 2)"));

                // iPhone 6+ Portrait
                $this->addHeadLinks(CedAdd2HomeScaler::scaleIfRequired($params->get('apple-touch-startup-image-1242x2148', 'media/plg_system_add2home/apple-touch-startup-image-1242x2148.png'), 1242, 2148),
                    self::APPLE_TOUCH_STARTUP_IMAGE,
                    array(self::MEDIA => "(device-width: 414px) and (device-height: 736px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 3)"));

                // iPhone 6+ Landscape
                $this->addHeadLinks(CedAdd2HomeScaler::scaleIfRequired($params->get('apple-touch-startup-image-2208x1182', 'media/plg_system_add2home/apple-touch-startup-image-2208x1182.png'), 2208, 1182),
                    self::APPLE_TOUCH_STARTUP_IMAGE,
                    array(self::MEDIA => "(device-width: 414px) and (device-height: 736px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 3)"));

            } else if ($isIPad) {
                // iPad
                //  Portrait image needs to be 768x1004 (note: 1004, not 1024, 20px is for status bar)
                $this->addHeadLinks(CedAdd2HomeScaler::scaleIfRequired($params->get('apple-touch-startup-image-768x1004', 'media/plg_system_add2home/apple-touch-startup-image-768x1004.png'), 768, 1004),
                    self::APPLE_TOUCH_STARTUP_IMAGE,
                    array(self::MEDIA => "screen and (min-device-width: 768px) and (max-device-width: 1004px) and (orientation:portrait) and (-webkit-device-pixel-ratio: 1)"));

                // Landscape image needs to be 1024x748 (note: 748, again 20px for status bar). This image then needs to be rotated 90 degrees clockwise, end result is 748x1024.
                $this->addHeadLinks($params->get('apple-touch-startup-image-748x1024', 'media/plg_system_add2home/apple-touch-startup-image-748x1024.png'),
                    self::APPLE_TOUCH_STARTUP_IMAGE,
                    array(self::MEDIA => "screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation:landscape) and (-webkit-device-pixel-ratio: 1)"));

                // iPad (Retina)
                // If creating a Web App for iPad compatibility it’s recommended that both Landscape and Portrait sizes are used.
                // For the new Retina iPad (if you don't add these, it will use the above with pixel doubling):
                $this->addHeadLinks(CedAdd2HomeScaler::scaleIfRequired($params->get('apple-touch-startup-image-1536x2008', 'media/plg_system_add2home/apple-touch-startup-image-1536x2008.png'), 1536, 2008),
                    self::APPLE_TOUCH_STARTUP_IMAGE,
                    array(self::MEDIA => "screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation:portrait) and (-webkit-device-pixel-ratio: 2)"));

                $this->addHeadLinks(CedAdd2HomeScaler::scaleIfRequired($params->get('apple-touch-startup-image-1496x2048', 'media/plg_system_add2home/apple-touch-startup-image-1496x2048.png'), 1496, 2048),
                    self::APPLE_TOUCH_STARTUP_IMAGE,
                    array(self::MEDIA => "screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation:landscape) and (-webkit-device-pixel-ratio: 2)"));
            }
        }

        //add custom icon to springboard
        // https://developer.apple.com/library/ios/documentation/UserExperience/Conceptual/MobileHIG/IconMatrix.html#//apple_ref/doc/uid/TP40006556-CH27
        $appleTouchIcon = trim('apple-touch-icon' . $params->get('precomposed', '-precomposed'));

        if ($isIPad) {
            $this->addHeadLinks(CedAdd2HomeScaler::scaleIfRequired($params->get('iconIpadRetinaIos7', 'media/plg_system_add2home/galaxiis.png'), 152, 152), $appleTouchIcon, array('sizes' => '152x152'));
            $this->addHeadLinks(CedAdd2HomeScaler::scaleIfRequired($params->get('iconIpadRetinaIos6', 'media/plg_system_add2home/galaxiis.png'), 144, 144), $appleTouchIcon, array('sizes' => '144x144'));
            $this->addHeadLinks(CedAdd2HomeScaler::scaleIfRequired($params->get('iconIpadMiniIos7', 'media/plg_system_add2home/galaxiis.png'), 76, 76), $appleTouchIcon, array('sizes' => '76x76'));
            $this->addHeadLinks(CedAdd2HomeScaler::scaleIfRequired($params->get('iconIpadMiniIos6', 'media/plg_system_add2home/galaxiis.png'), 72, 72), $appleTouchIcon, array('sizes' => '72x72'));
        } else if ($isIPhone) {
            $this->addHeadLinks(CedAdd2HomeScaler::scaleIfRequired($params->get('iconIphone6Plus', 'media/plg_system_add2home/galaxiis.png'), 180, 180), $appleTouchIcon, array('sizes' => '180x180'));
            $this->addHeadLinks(CedAdd2HomeScaler::scaleIfRequired($params->get('iconIphoneRetinaIos7', 'media/plg_system_add2home/galaxiis.png'), 120, 120), $appleTouchIcon, array('sizes' => '120x120'));
            $this->addHeadLinks(CedAdd2HomeScaler::scaleIfRequired($params->get('iconIphoneRetinaIos6', 'media/plg_system_add2home/galaxiis.png'), 114, 114), $appleTouchIcon, array('sizes' => '114x114'));
        }

        //$languages = new ParamsToText();
        //$this->addScriptDeclaration("var cedAdd2HomeLanguages = ". $languages->convert($params));

        $this->addStyleSheet(JUri::root().'media/plg_system_add2home/addtohomescreen.css?v=3.0.4');
        $this->addScript(JUri::root().'media/plg_system_add2home/addtohomescreen.min.js?v=3.0.4');

        $this->addScriptDeclaration(cedAdd2homeHelper::getJavascriptInitializer($params));
    }

    /**
     * Using this on all your internal links you can make your entire site appear to be
     * working outside of safari.
     *
     */
    public function preventLinksFromOpeningInMobileSafari()
    {
        // by https://github.com/irae
        // https://gist.github.com/irae/1042167
        // prevents links from apps from oppening in mobile safari
        $javascript = "
                    (function(document,navigator,standalone) {
                    			if ((standalone in navigator) && navigator[standalone]) {
                    				var curnode, location=document.location, stop=/^(a|html)$/i;
                    				document.addEventListener('click', function(e) {
                    					curnode=e.target;
                    					while (!(stop).test(curnode.nodeName)) {
                    						curnode=curnode.parentNode;
                    					}
                    					// Condidions to do this only on links to your own app
                    					// if you want all links, use if('href' in curnode) instead.
                    					if(
                    						'href' in curnode && // is a link
                    						(chref=curnode.href).replace(location.href,'').indexOf('#') && // is not an anchor
                    						(	!(/^[a-z\+\.\-]+:/i).test(chref) ||                       // either does not have a proper scheme (relative links)
                    							chref.indexOf(location.protocol+'//'+location.host)===0 ) // or is in the same protocol and domain
                    					) {
                    						e.preventDefault();
                    						location.href = curnode.href;
                    					}
                    				},false);
                    			}
                    		})(document,window.navigator,'standalone');
                    ";
        $this->addScriptDeclaration($javascript);
    }

}