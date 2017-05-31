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

require_once(dirname(__FILE__) . '/ios.php');
require_once(dirname(__FILE__) . '/android.php');
require_once(dirname(__FILE__) . '/windows8.php');
require_once(dirname(__FILE__) . '/windows.php');

class plgSystemAdd2Home extends JPlugin
{

    function __construct(& $subject, $config)
    {
        parent::__construct($subject, $config);
        $this->loadLanguage();
    }

    function onBeforeCompileHead()
    {
        //Do not run in admin area and non HTML  (rss, json, error)
        $app = JFactory::getApplication();
        if ($app->isAdmin() || JFactory::getDocument()->getType() !== 'html')
        {
            return true;
        }

        $this->runProvider(new cedAdd2HomeIos());

    }

    function onAfterRender()
    {
        $app = JFactory::getApplication();

        if ($app->isAdmin()) return;

        $document = JFactory::getDocument();
        $docType = $document->getType();
        if ($docType !== 'html') {
            return;
        }

        $provider = new cedAdd2HomeWindows();

        $browser = JBrowser::getInstance();
        $agent = $browser->getAgentString();

        if ($provider->isActive($agent)) {
            $menu = $provider->generateMenu($this->params);
            $body = JFactory::getApplication()->getBody(false);

            // identical meta name can not be added twice to head
            $body = str_replace('</head>', implode("\n", $menu) . "\n</head>", $body);

            JFactory::getApplication()->setBody($body);

            $provider->addDiscoverItBody($this->params);
        }

    }

    /**
     * @param $provider
     */
    private function runProvider($provider)
    {
        $browser = JBrowser::getInstance();
        $agent = $browser->getAgentString();

        if ($provider->isActive($agent, $browser)) {
            $provider->execute($agent, $this->params, JUri::base());

            $document = JFactory::getDocument();

            $metaData = $provider->getMetadata();
            foreach ($metaData as $meta) {
                $document->setMetaData($meta->key, $meta->value);
            }

            $headLinks = $provider->getHeadLinks();
            foreach ($headLinks as $headLink) {
                $document->addHeadLink($headLink->img, $headLink->key, $headLink->rel, $headLink->attributes);
            }

            $styleSheets = $provider->getStyleSheet();
            foreach ($styleSheets as $styleSheet) {
                $document->addStyleSheet($styleSheet);
            }

            $scriptDeclarations = $provider->getScriptDeclaration();
            foreach ($scriptDeclarations as $scriptDeclaration) {
                $document->addScriptDeclaration($scriptDeclaration);
            }

            $scripts = $provider->getScript();
            foreach ($scripts as $script) {
                $document->addScript($script);
            }

            $browser1 = $browser->getBrowser();
            $major = $browser->getMajor();
            $document->addScript("## $browser1 $major");
        }
    }

}