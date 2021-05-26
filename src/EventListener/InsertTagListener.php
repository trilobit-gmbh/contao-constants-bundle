<?php

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 * @link       http://github.com/trilobit-gmbh/contao-constants-bundle
 */

namespace Trilobit\ConstantsBundle\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Trilobit\ConstantsBundle\Model\ConstantsModel;

class InsertTagListener
{
    /**
     * Class ReplaceInsertTags.
     *
     * @Hook("replaceInsertTags")
     */
    public function __invoke(string $tag)
    {
        $chunks = explode('::', $tag);

        if ('const' !== $chunks[0]) {
            return false;
        }

        if (null === ($result = ConstantsModel::findPublishedByName($chunks[1]))) {
            return false;
        }

        return $result->value;
    }
}
