<?php
/**
 * @package     CedAdd2Home
 * @subpackage  com_cedadd2home
 *
 * @copyright   Copyright (C) 2013-2016 galaxiis.com All rights reserved.
 * @license     The author and holder of the copyright of the software is Cédric Walter. The licensor and as such issuer of the license and bearer of the
 *              worldwide exclusive usage rights including the rights to reproduce, distribute and make the software available to the public
 *              in any form is Galaxiis.com
 *              see LICENSE.txt
 * @id 
 */

// Don't allow direct access to the module.
defined('_JEXEC') or die('Restricted access');

// Load the javascript
JHtml::_('behavior.framework');
JHtml::_('behavior.modal', 'a.modal');
?>

<div class="smugmugpanel">

    <div style="float: left;">
        <div class="icon">
            <a href="index.php?option=com_cedadd2home&view=liveupdate"
               title="<?php echo JText::_('Live Update');?>"> <img
                    src="<?php echo JURI::root() ?>/media/com_cedadd2home/images/update_48x48.png"
                    alt="<?php echo JText::_('Live Update');?>"/>
                <span><?php echo JText::_('Live Update');?></span></a></div>
    </div>
    <div style="float: left;">
        <div class="icon"><a href="http://www.galaxiis.com/ticket/" target="_blank"
                             title="<?php echo JText::_('Found a bug? submit it now!');?>"> <img
                src="<?php echo JURI::root() ?>/media/com_cedadd2home/images/bug.png"/>
            <span><?php echo JText::_('BUG?');?></span></a>
        </div>
    </div>

    <div style="float: left;">
        <div class="icon"><a href="http://www.galaxiis.com/cedadd2home-showcase/" target="_blank"
                             title="<?php echo JText::_('HOME PAGE');?>"> <img
            src="<?php echo JURI::root() ?>/media/com_cedadd2home/images/frontpage.png"/>
            <span><?php echo JText::_('HOME PAGE');?></span></a>
        </div>
    </div>
    <div style="float: left;">
        <div class="icon"><a
            href="http://www.galaxiis.com/cedadd2home-doc/"
            target="_blank"
            title="<?php echo JText::_('MANUAL');?>"> <img
            src="<?php echo JURI::root() ?>/media/com_cedadd2home/images/manual.png"/>
            <span><?php echo JText::_('MANUAL');?></span></a>
        </div>
    </div>
    <div style="float: left;">
        <div class="icon"><a
            href="http://www.galaxiis.com/forums/"
            target="_blank"
            title="<?php echo JText::_('FORUM');?>"> <img
            src="<?php echo JURI::root() ?>/media/com_cedadd2home/images/forum.png"/>
            <span><?php echo JText::_('FORUM');?></span></a>
        </div>
    </div>
    <div style="float: left;">
        <div class="icon"><a
            href="http://confluence.galaxiis.com/display/GAL/SOFTWARE+LICENSE+AGREEMENT"
            target="_blank"
            title="<?php echo JText::_('LICENSE');?>"> <img
            src="<?php echo JURI::root() ?>/media/com_cedadd2home/images/license.png"/>
            <span><?php echo JText::_('LICENSE');?></span></a>
        </div>
    </div>
    <div style="float: left;">
        <div class="icon">
            <a href="skype:cedric.walter?call"
               title="<?php echo JText::_('SKYPE ME');?>"> <img
                src="<?php echo JURI::root() ?>/media/com_cedadd2home/images/skype.png"/>
                <span><?php echo JText::_('SKYPE ME');?></span></a>
        </div>
    </div>
    <div style="float: left;">
        <div class="icon">
            <a href="http://extensions.joomla.org/extensions/mobile/apple-display/18868"
               target="_blank"
               title="<?php echo JText::_('JED VOTE');?>"> <img
                src="<?php echo JURI::root() ?>/media/com_cedadd2home/images/jed.png"/>
                <span><?php echo JText::_('JED VOTE');?></span></a>
        </div>
    </div>
    <div style="float: left;">
        <div class="icon">
            <a href="http://extensions.joomla.org/extensions/owner/cedric_walter"
               target="_blank"
               title="<?php echo JText::_('Other Extensions By the Same Author');?>"> <img
                src="<?php echo JURI::root() ?>/media/com_cedadd2home/images/jed.png"/>
                <span><?php echo JText::_('OTHER EXTENSIONS');?></span></a>
        </div>
    </div>
    <div style="float: left;">
        <div class="icon">
            <a href="http://www.galaxiis.com/cedadd2home-download/"
               target="_blank"
               title="<?php echo JText::_('Download Latest Version');?>"> <img
                src="<?php echo JURI::root() ?>/media/com_cedadd2home/images/download.png"/>
                <span><?php echo JText::_('Download Latest Version');?></span></a>
        </div>
    </div>
    <div style="float: left;">
        <div class="icon">
            <a href="https://www.facebook.com/galaxiiscom"
               target="_blank"
               title="<?php echo JText::_('Like on Facebook');?>"> <img
                src="<?php echo JURI::root() ?>/media/com_cedadd2home/images/facebook.png"/>
                <span><?php echo JText::_('Like on Facebook');?></span></a>
        </div>
    </div>
    <div style="float: left;">
        <div class="icon">
            <a href="http://twitter.com/galaxiiscom"
               target="_blank"
               title="<?php echo JText::_('Follow Me on Twitter');?>"> <img
                src="<?php echo JURI::root() ?>/media/com_cedadd2home/images/twitter.png"/>
                <span><?php echo JText::_('Follow Me on Twitter');?></span></a>
        </div>
    </div>
    <div style="float: left;">
        <div class="icon">
            <a href="https://plus.google.com/u/0/104558366166000378462"
               target="_blank"
               title="<?php echo JText::_('Follow Me on Google+');?>"> <img
                src="<?php echo JURI::root() ?>/media/com_cedadd2home/images/google.png"/>
                <span><?php echo JText::_('Follow Me on Google+');?></span></a>
        </div>
    </div>
</div>

<div class="tagversion">

    <p><a href="http://extensions.joomla.org/extensions/mobile/apple-display/18868" target="_blank">CedAdd2Home 2.1.0-free</a>
    </p>

    <p>
        Copyright &copy; 2013-2014 <a href="http://www.galaxiis.com">(C) 2013-2014 galaxiis.com All rights reserved.
    </p>
</div>