<?php

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 * @link       http://github.com/trilobit-gmbh/contao-constants-bundle
 */

namespace Trilobit\ConstantsBundle;

class ConstantsInsertTags
{
    /**
     * @param $strInsertTag
     *
     * @return bool|string
     */
    public function replaceInsertTags($strInsertTag)
    {
        $arrSplit = explode('::', $strInsertTag, 2);

        if ('const' === $arrSplit[0]) {
            $objResult = ConstantsModel::findPublishedByName($arrSplit[1]);

            if (null !== $objResult) {
                return $objResult->value;
            }
        }

        return false;
    }
}
