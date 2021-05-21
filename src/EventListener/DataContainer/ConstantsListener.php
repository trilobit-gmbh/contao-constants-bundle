<?php

namespace Trilobit\ConstantsBundle\EventListener\DataContainer;

use Contao\DataContainer;
use Contao\System;
use Trilobit\ConstantsBundle\ConstantsModel;

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
