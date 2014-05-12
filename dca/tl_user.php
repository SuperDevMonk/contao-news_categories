<?php

/**
 * news_categories extension for Contao Open Source CMS
 *
 * Copyright (C) 2011-2014 Codefog
 *
 * @package news_categories
 * @author  Webcontext <http://webcontext.com>
 * @author  Codefog <info@codefog.pl>
 * @author  Kamil Kuzminski <kamil.kuzminski@codefog.pl>
 * @license LGPL
 */

/**
 * Add a palette to tl_user
 */
$GLOBALS['TL_DCA']['tl_user']['palettes']['extend'] = str_replace('newsfeedp;', 'newsfeedp,newscategories;', $GLOBALS['TL_DCA']['tl_user']['palettes']['extend']);
$GLOBALS['TL_DCA']['tl_user']['palettes']['custom'] = str_replace('newsfeedp;', 'newsfeedp,newscategories;', $GLOBALS['TL_DCA']['tl_user']['palettes']['custom']);

/**
 * Add a new field to tl_user
 */
$GLOBALS['TL_DCA']['tl_user']['fields']['newscategories'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_user']['newscategories'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'sql'                     => "char(1) NOT NULL default ''"
);
