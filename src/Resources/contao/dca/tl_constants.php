<?php

declare(strict_types=1);

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 */

use Trilobit\ConstantsBundle\EventListener\DataContainer\ConstantsListener;

$GLOBALS['TL_DCA']['tl_constants'] = [
    // Config
    'config' => [
        'dataContainer' => 'Table',
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
            'icon' => 'modules.svg',
            'fields' => ['sorting'],
            'panelLayout' => 'filter;search,limit',
            'headerFields' => ['name', 'value'],
        ],
        'label' => [
            'fields' => ['name'],
            'format' => '<span style="color:#999">{{const::</span>%s<span style="color:#999">}}</span>',
        ],
        'global_operations' => [
            'all' => [
                'label' => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href' => 'act=select',
                'class' => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset();"',
            ],
        ],
        'operations' => [
            'edit' => [
                'label' => &$GLOBALS['TL_LANG']['tl_constants']['edit'],
                'href' => 'act=edit',
                'icon' => 'edit.svg',
            ],
            'copy' => [
                'label' => &$GLOBALS['TL_LANG']['tl_constants']['copy'],
                'href' => 'act=copy',
                'icon' => 'copy.svg',
            ],
            'copyChilds' => [
                'label' => &$GLOBALS['TL_LANG']['tl_constants']['copyChilds'],
                'href' => 'act=paste&amp;mode=copy&amp;childs=1',
                'icon' => 'copychilds.svg',
            ],
            'cut' => [
                'label' => &$GLOBALS['TL_LANG']['tl_constants']['cut'],
                'href' => 'act=paste&amp;mode=cut',
                'icon' => 'cut.svg',
            ],
            'delete' => [
                'label' => &$GLOBALS['TL_LANG']['tl_constants']['delete'],
                'href' => 'act=delete',
                'icon' => 'delete.svg',
                'attributes' => 'onclick="if (!confirm(\''.$GLOBALS['TL_LANG']['MSC']['deleteConfirm'].'\')) return false; Backend.getScrollOffset();"',
            ],
            'toggle' => [
                'label' => &$GLOBALS['TL_LANG']['tl_constants']['toggle'],
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
                'label' => &$GLOBALS['TL_LANG']['tl_constants']['show'],
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
            'label' => &$GLOBALS['TL_LANG']['tl_constants']['title'],
            'exclude' => true,
            'search' => true,
            'inputType' => 'text',
            'eval' => ['rgxp' => 'alias', 'maxlength' => 255, 'mandatory' => true, 'unique' => true, 'spaceToUnderscore' => true, 'preserveTags' => true, 'doNotCopy' => true, 'tl_class' => 'w50'],
            'sql' => "varchar(255) NOT NULL default ''",
        ],
        'useWysiwygEditor' => [
            'label' => &$GLOBALS['TL_LANG']['tl_constants']['useWysiwygEditor'],
            'exclude' => true,
            'inputType' => 'checkbox',
            'eval' => ['tl_class' => 'w50 m12', 'submitOnChange' => true],
            'sql' => "char(1) NOT NULL default ''",
        ],
        'value' => [
            'label' => &$GLOBALS['TL_LANG']['tl_constants']['value'],
            'exclude' => true,
            'search' => true,
            'filter' => true,
            'inputType' => 'textarea',
            'eval' => ['mandatory' => true, 'tl_class' => 'long clr', 'allowHtml' => true],
            'sql' => 'mediumtext NULL',
        ],
        'published' => [
            'label' => &$GLOBALS['TL_LANG']['tl_constants']['published'],
            'exclude' => true,
            'filter' => true,
            'inputType' => 'checkbox',
            'sql' => "char(1) NOT NULL default '1'",
        ],
        'start' => [
            'exclude' => true,
            'label' => &$GLOBALS['TL_LANG']['tl_constants']['start'],
            'inputType' => 'text',
            'eval' => ['rgxp' => 'datim', 'datepicker' => true, 'tl_class' => 'w50 wizard'],
            'sql' => "varchar(10) NOT NULL default ''",
        ],
        'stop' => [
            'exclude' => true,
            'label' => &$GLOBALS['TL_LANG']['tl_constants']['stop'],
            'inputType' => 'text',
            'eval' => ['rgxp' => 'datim', 'datepicker' => true, 'tl_class' => 'w50 wizard'],
            'sql' => "varchar(10) NOT NULL default ''",
        ],

        'id' => [
            'sql' => 'int(10) unsigned NOT NULL auto_increment',
        ],
        'pid' => [
            'sql' => "int(10) unsigned NOT NULL default '0'",
        ],
        'tstamp' => [
            'sql' => "int(10) unsigned NOT NULL default '0'",
        ],
        'sorting' => [
            'sorting' => true,
            'sql' => "int(10) unsigned NOT NULL default '0'",
        ],
    ],
];
