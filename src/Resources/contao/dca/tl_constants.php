<?php

declare(strict_types=1);

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 */

use Contao\DC_Table;
use Trilobit\ConstantsBundle\EventListener\DataContainer\ConstantsListener;

$GLOBALS['TL_DCA']['tl_constants'] = [
    // Config
    'config' => [
        'dataContainer' => DC_Table::class,
        'enableVersioning' => true,
        'onload_callback' => [
            [ConstantsListener::class, 'modifyDca'],
        ],
        'sql' => [
            'keys' => [
                'id' => 'primary',
                'pid' => 'index',
            ],
        ],
    ],

    // List
    'list' => [
        'sorting' => [
            'mode' => 5,
            'rootPaste' => true,
            'icon' => 'modules.svg',
            'fields' => ['sorting'],
            'panelLayout' => 'filter;search,limit',
            'headerFields' => ['name', 'value'],
        ],
        'label' => [
            'fields' => ['name'],
            'label_callback' => (static function($item) {
                return '<span style="color:#999">{{const::</span>'.$item['name'].'<span style="color:#999">}}</span>';
            }),
        ],
        'global_operations' => [
            'all' => [
                'href' => 'act=select',
                'class' => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset();"',
            ],
        ],
        'operations' => [
            'edit' => [
                'href' => 'act=edit',
                'icon' => 'edit.svg',
            ],
            'copy' => [
                'href' => 'act=copy',
                'icon' => 'copy.svg',
            ],
            'copyChilds' => [
                'href' => 'act=paste&amp;mode=copy&amp;childs=1',
                'icon' => 'copychilds.svg',
            ],
            'cut' => [
                'href' => 'act=paste&amp;mode=cut',
                'icon' => 'cut.svg',
            ],
            'delete' => [
                'href' => 'act=delete',
                'icon' => 'delete.svg',
                'attributes' => 'onclick="if (!confirm(\''.($GLOBALS['TL_LANG']['MSC']['deleteConfirm'] ?? null).'\')) return false; Backend.getScrollOffset();"',
            ],
            'toggle' => [
                'attributes' => 'onclick="Backend.getScrollOffset();"',
                'haste_ajax_operation' => [
                    'field' => 'published',
                    'options' => [
                        [
                            'value' => '',
                            'icon' => 'invisible.svg',
                        ],
                        [
                            'value' => '1',
                            'icon' => 'visible.svg',
                        ],
                    ],
                ],
            ],
            'show' => [
                'href' => 'act=show',
                'icon' => 'show.gif',
            ],
        ],
    ],

    // Palettes
    'palettes' => [
        'default' => '{key_legend},name,useWysiwygEditor,value;{published_legend:hide},published,start,stop',
    ],

    // Subpalettes
    'subpalettes' => [],

    // Fields
    'fields' => [
        'name' => [
            'exclude' => true,
            'search' => true,
            'inputType' => 'text',
            'eval' => ['rgxp' => 'alias', 'maxlength' => 255, 'mandatory' => true, 'unique' => true, 'spaceToUnderscore' => true, 'preserveTags' => true, 'doNotCopy' => true, 'tl_class' => 'w50'],
            'sql' => "varchar(255) NOT NULL default ''",
            'label_callback' => null,
        ],
        'useWysiwygEditor' => [
            'exclude' => true,
            'inputType' => 'checkbox',
            'eval' => ['tl_class' => 'w50 m12', 'submitOnChange' => true],
            'sql' => "char(1) NOT NULL default ''",
        ],
        'value' => [
            'exclude' => true,
            'search' => true,
            'filter' => true,
            'inputType' => 'textarea',
            'eval' => ['mandatory' => true, 'tl_class' => 'long clr', 'allowHtml' => true],
            'sql' => 'mediumtext NULL',
        ],
        'published' => [
            'toggle' => true,
            'exclude' => true,
            'filter' => true,
            'inputType' => 'checkbox',
            'sql' => "char(1) NOT NULL default '1'",
        ],
        'start' => [
            'exclude' => true,
            'inputType' => 'text',
            'eval' => ['rgxp' => 'datim', 'datepicker' => true, 'tl_class' => 'w50 wizard'],
            'sql' => "varchar(10) NOT NULL default ''",
        ],
        'stop' => [
            'exclude' => true,
            'inputType' => 'text',
            'eval' => ['rgxp' => 'datim', 'datepicker' => true, 'tl_class' => 'w50 wizard'],
            'sql' => "varchar(10) NOT NULL default ''",
        ],
        'id' => [
            'search' => true,
            'sql' => 'int(10) unsigned NOT NULL auto_increment',
        ],
        'pid' => [
            'sql' => "int(10) unsigned NOT NULL default '0'",
        ],
        'tstamp' => [
            'flag' => 6,
            'sql' => "int(10) unsigned NOT NULL default '0'",
        ],
        'sorting' => [
            'sorting' => true,
            'sql' => "int(10) unsigned NOT NULL default '0'",
        ],
    ],
];

if (method_exists(DC_Table::class, 'toggle')) {
    $GLOBALS['TL_DCA']['tl_constants']['list']['operations']['toggle'] = [
        'href' => 'act=toggle&amp;field=published',
        'icon' => 'visible.svg',
        'showInHeader' => true,
    ];
}
