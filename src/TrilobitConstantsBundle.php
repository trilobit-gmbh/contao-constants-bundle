<?php

declare(strict_types=1);

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 */

namespace Trilobit\ConstantsBundle;

use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Trilobit\ConstantsBundle\DependencyInjection\ConstantsExtension;

/**
 * Configures the trilobit constants bundle.
 *
 * @author trilobit GmbH <https://github.com/trilobit-gmbh>
 */
class TrilobitConstantsBundle extends Bundle
{
    public function getContainerExtension(): ?ExtensionInterface
    {
        return new ConstantsExtension();
    }
}
