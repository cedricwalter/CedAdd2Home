<?php
/**
 * @package     CedAdd2Home
 * @subpackage  com_cedadd2home
 *
 * @copyright   Copyright (C) 2013-2019 galaxiis.com All rights reserved.
 * @license     The author and holder of the copyright of the software is Cédric Walter. The licensor and as such issuer of the license and bearer of the
 *              worldwide exclusive usage rights including the rights to reproduce, distribute and make the software available to the public
 *              in any form is Galaxiis.com
 *              see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.image.image');
jimport('joomla.filesystem.path');
jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');

class CedAdd2HomeScaler
{

    public static function scaleIfRequired($myImage, $width, $height)
    {
        $image = $myImage;
        if (!self::startsWith($myImage, JPATH_SITE)) {
            $image = JPATH_SITE . "/$myImage";
        }

        $jImage = new JImage(JPath::clean($image));

        //check if file exist already and is of correct size
        $imageAlreadyOfCorrectSize = $jImage->getWidth() == $width && $jImage->getHeight() == $height;
        if ($imageAlreadyOfCorrectSize) {
            return $myImage;
        }

        $relativeFilePath = "cache/CedAdd2Home/new-$width"."x$height-".basename($image);
        $newFile = JPath::clean(JPATH_SITE ."/". $relativeFilePath);

        //lazy resize for performances
        if (JFile::exists($newFile)) {
            return $relativeFilePath;
        }

        self::createDirectoryIfNotExist($newFile);

        $resizeJImage = $jImage->resize($width, $height, true, JImage::SCALE_FILL);
        $resizeJImage->toFile($newFile, IMAGETYPE_JPEG, array('quality' => 85));

        return $relativeFilePath;
    }

    private static function createDirectoryIfNotExist($thumbnailFileNamePath)
    {
        $directory = dirname($thumbnailFileNamePath);
        if (!JFolder::exists($directory)) {
            JFolder::create($directory);
        }
    }

    private static function startsWith($haystack, $needle)
    {
        return $needle === "" || strpos($haystack, $needle) === 0;
    }

}
