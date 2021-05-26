<?php

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 * @link       http://github.com/trilobit-gmbh/contao-constants-bundle
 */

namespace Trilobit\ConstantsBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Trilobit\ConstantsBundle\DependencyInjection\ConstantsExtension;

/**
 * Configures the trilobit constants bundle.
 *
 * @author trilobit GmbH <https://github.com/trilobit-gmbh>
 */
class TrilobitConstantsBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new ConstantsExtension();
    }
}
