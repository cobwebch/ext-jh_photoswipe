<?php
namespace Heilmann\JhPhotoswipe\ViewHelpers\Extension;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016-2017 Jonathan Heilmann <mail@jonathan-heilmann.de>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class InListLoadedViewHelper
 * @package Heilmann\JhPhotoswipe\ViewHelpers\Extension
 */
class InListLoadedViewHelper extends AbstractViewHelper
{

    /**
     * Initialize arguments
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('list', 'string', 'Comma separated list of extensions names that may be loaded, UpperCamelCase', true);
    }

    /**
     * Render method
     *
     * @return string Name of the loaded extension. If no extension from list ist loaded, false is returned
     */
    public function render()
    {
        $listItems = GeneralUtility::trimExplode(',', $this->arguments['list'], true);

        if (count($listItems) >= 1)
            foreach ($listItems as $extensionName)
            {
                $extensionKey = GeneralUtility::camelCaseToLowerCaseUnderscored($extensionName);
                $isLoaded = ExtensionManagementUtility::isLoaded($extensionKey);
                if ($isLoaded)
                    return $extensionName;
            }

        return false;
    }
}
