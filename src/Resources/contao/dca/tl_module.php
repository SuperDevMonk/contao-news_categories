<?php

/*
 * News Categories bundle for Contao Open Source CMS.
 *
 * @copyright  Copyright (c) 2017, Codefog
 * @author     Codefog <https://codefog.pl>
 * @license    MIT
 */

$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][] = 'news_customCategories';
$GLOBALS['TL_DCA']['tl_module']['palettes']['newscategories'] = '{title_legend},name,headline,type;{config_legend},news_archives,news_showQuantity,news_resetCategories,news_showEmptyCategories,news_enableCanonicalUrls,news_includeSubcategories;{reference_legend:hide},news_categoriesRoot,news_customCategories;{redirect_legend:hide},news_forceCategoryUrl,jumpTo;{template_legend:hide},navigationTpl,customTpl;{image_legend:hide},news_categoryImgSize;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_module']['subpalettes']['news_customCategories'] = 'news_categories';

\Contao\CoreBundle\DataContainer\PaletteManipulator::create()
    ->addLegend('redirect_legend', 'config_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_AFTER)
    ->addField('news_filterCategories', 'config_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('news_relatedCategories', 'config_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('news_includeSubcategories', 'config_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('news_filterDefault', 'config_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('news_filterPreserve', 'config_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('news_categoryFilterPage', 'redirect_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('news_categoryImgSize', 'image_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('newslist', 'tl_module');

\Contao\CoreBundle\DataContainer\PaletteManipulator::create()
    ->addField('news_filterCategories', 'config_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('news_includeSubcategories', 'config_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('news_filterDefault', 'config_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('news_filterPreserve', 'config_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('news_categoryImgSize', 'image_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('newsarchive', 'tl_module')
    ->applyToPalette('newsmenu', 'tl_module');

\Contao\CoreBundle\DataContainer\PaletteManipulator::create()
    ->addLegend('redirect_legend', 'config_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_AFTER)
    ->addField('news_categoryFilterPage', 'redirect_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('newsarchive', 'tl_module');

\Contao\CoreBundle\DataContainer\PaletteManipulator::create()
    ->addLegend('redirect_legend', 'config_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_AFTER)
    ->addField('news_categoryFilterPage', 'redirect_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField('news_categoryImgSize', 'image_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('newsreader', 'tl_module');

/*
 * Add fields
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['news_categories'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['news_categories'],
    'exclude' => true,
    'inputType' => 'newsCategoriesPicker',
    'foreignKey' => 'tl_news_category.title',
    'eval' => ['multiple' => true, 'fieldType' => 'checkbox'],
    'sql' => ['type' => 'blob', 'notnull' => false],
];

$GLOBALS['TL_DCA']['tl_module']['fields']['news_customCategories'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['news_customCategories'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['submitOnChange' => true, 'tl_class' => 'clr'],
    'sql' => ['type' => 'boolean', 'default' => 0],
];

$GLOBALS['TL_DCA']['tl_module']['fields']['news_filterCategories'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['news_filterCategories'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['tl_class' => 'w50'],
    'sql' => ['type' => 'boolean', 'default' => 0],
];

$GLOBALS['TL_DCA']['tl_module']['fields']['news_relatedCategories'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['news_relatedCategories'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['tl_class' => 'w50'],
    'sql' => ['type' => 'boolean', 'default' => 0],
];

$GLOBALS['TL_DCA']['tl_module']['fields']['news_includeSubcategories'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['news_includeSubcategories'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['tl_class' => 'clr'],
    'sql' => ['type' => 'boolean', 'default' => 0],
];

$GLOBALS['TL_DCA']['tl_module']['fields']['news_enableCanonicalUrls'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['news_enableCanonicalUrls'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['tl_class' => 'w50'],
    'sql' => ['type' => 'boolean', 'default' => 0],
];

$GLOBALS['TL_DCA']['tl_module']['fields']['news_filterDefault'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['news_filterDefault'],
    'exclude' => true,
    'inputType' => 'newsCategoriesPicker',
    'foreignKey' => 'tl_news_category.title',
    'eval' => ['multiple' => true, 'fieldType' => 'checkbox', 'tl_class' => 'clr'],
    'sql' => ['type' => 'blob', 'notnull' => false],
];

$GLOBALS['TL_DCA']['tl_module']['fields']['news_filterPreserve'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['news_filterPreserve'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['tl_class' => 'clr'],
    'sql' => ['type' => 'boolean', 'default' => 0],
];

$GLOBALS['TL_DCA']['tl_module']['fields']['news_resetCategories'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['news_resetCategories'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['tl_class' => 'w50'],
    'sql' => ['type' => 'boolean', 'default' => 0],
];

$GLOBALS['TL_DCA']['tl_module']['fields']['news_showEmptyCategories'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['news_showEmptyCategories'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['tl_class' => 'w50'],
    'sql' => ['type' => 'boolean', 'default' => 0],
];

$GLOBALS['TL_DCA']['tl_module']['fields']['news_forceCategoryUrl'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['news_forceCategoryUrl'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['tl_class' => 'clr'],
    'sql' => ['type' => 'boolean', 'default' => 0],
];

$GLOBALS['TL_DCA']['tl_module']['fields']['news_categoriesRoot'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['news_categoriesRoot'],
    'exclude' => true,
    'inputType' => 'newsCategoriesPicker',
    'foreignKey' => 'tl_news_category.title',
    'eval' => ['fieldType' => 'radio', 'tl_class' => 'clr'],
    'sql' => ['type' => 'integer', 'unsigned' => true, 'default' => 0],
];

$GLOBALS['TL_DCA']['tl_module']['fields']['news_categoryFilterPage'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['news_categoryFilterPage'],
    'exclude' => true,
    'inputType' => 'pageTree',
    'eval' => ['fieldType' => 'radio', 'tl_class' => 'clr'],
    'sql' => ['type' => 'integer', 'unsigned' => true, 'default' => 0],
];

$GLOBALS['TL_DCA']['tl_module']['fields']['news_categoryImgSize'] = $GLOBALS['TL_DCA']['tl_module']['fields']['imgSize'];
unset($GLOBALS['TL_DCA']['tl_module']['fields']['news_categoryImgSize']['label']);
$GLOBALS['TL_DCA']['tl_module']['fields']['news_categoryImgSize']['label'] = &$GLOBALS['TL_LANG']['tl_module']['news_categoryImgSize'];
