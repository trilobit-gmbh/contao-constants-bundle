<?php

declare(strict_types=1);

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 */

use Trilobit\ConstantsBundle\EventListener\InsertTagListener;
use Trilobit\ConstantsBundle\Model\ConstantsModel;

$GLOBALS['BE_MOD']['trilobit']['tl_constants'] = [
    'tables' => ['tl_constants'],
];

/*
 * Register hook
 */
$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = [InsertTagListener::class, '__invoke'];

/*
 * Models
 */
$GLOBALS['TL_MODELS']['tl_constants'] = ConstantsModel::class;
