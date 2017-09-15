<?php

/**
 * Back end modules
 */
$GLOBALS['BE_MOD']['content']['news']['tables'][] = 'tl_news_category';

/**
 * Front end modules
 */
$GLOBALS['FE_MOD']['news']['newsarchive'] = \Codefog\NewsCategoriesBundle\FrontendModule\NewsArchiveModule::class;
$GLOBALS['FE_MOD']['news']['newscategories'] = \Codefog\NewsCategoriesBundle\FrontendModule\NewsCategoriesModule::class;
$GLOBALS['FE_MOD']['news']['newslist'] = \Codefog\NewsCategoriesBundle\FrontendModule\NewsListModule::class;
$GLOBALS['FE_MOD']['news']['newsmenu'] = \Codefog\NewsCategoriesBundle\FrontendModule\NewsMenuModule::class;

/**
 * Content elements
 */
$GLOBALS['TL_CTE']['includes']['newsfilter'] = \Codefog\NewsCategoriesBundle\ContentElement\NewsFilterElement::class;

/**
 * Models
 */
// @todo – use multilingual if needed?
$GLOBALS['TL_MODELS']['tl_news_category'] = \Codefog\NewsCategoriesBundle\Model\NewsCategoryModel::class;

/**
 * Hooks
 */
$GLOBALS['TL_HOOKS']['changelanguageNavigation'][] = [
    'codefog_news_categories.listener.change_language',
    'onChangeLanguageNavigation',
];
$GLOBALS['TL_HOOKS']['parseArticles'][] = ['codefog_news_categories.listener.template', 'onParseArticles'];
$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = ['codefog_news_categories.listener.insert_tags', 'onReplace'];

/**
 * Add permissions
 */
$GLOBALS['TL_PERMISSIONS'][] = 'newscategories';
$GLOBALS['TL_PERMISSIONS'][] = 'newscategories_default';
