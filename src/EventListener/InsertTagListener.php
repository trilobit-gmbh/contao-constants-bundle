<?php

declare(strict_types=1);

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
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

        return $result;
    }
}
