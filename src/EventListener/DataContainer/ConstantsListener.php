<?php

declare(strict_types=1);

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 */

namespace Trilobit\ConstantsBundle\EventListener\DataContainer;

use Contao\DataContainer;
use Contao\System;
use Trilobit\ConstantsBundle\Model\ConstantsModel;

class ConstantsListener
{
    public function modifyDca(DataContainer $dc)
    {
        if (null === ($constant = ConstantsModel::findByPk($dc->id))) {
            return;
        }

        $dca = &$GLOBALS['TL_DCA']['tl_constants'];
        $bundleConfig = System::getContainer()->getParameter('trilobit_constants');

        if ($constant->useWysiwygEditor) {
            $dca['fields']['value']['eval']['rte'] = 'tinyMCE';
        }

        if (isset($bundleConfig['allow_html']) && true === $bundleConfig['allow_html']) {
            $dca['fields']['value']['eval']['decodeEntities'] = true;
            $dca['fields']['value']['eval']['allowHtml'] = true;
        }
    }
}
