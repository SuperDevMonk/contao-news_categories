<?php

/**
 * news_categories extension for Contao Open Source CMS
 *
 * Copyright (C) 2013 Codefog
 *
 * @package news_categories
 * @author  Webcontext <http://webcontext.com>
 * @author  Codefog <info@codefog.pl>
 * @author  Kamil Kuzminski <kamil.kuzminski@codefog.pl>
 * @license LGPL
 */


/**
 * Register the namespace
 */
ClassLoader::addNamespace('NewsCategories');


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'NewsCategories\News'                 => 'system/modules/news_categories/classes/News.php',

	// Models
	'NewsCategories\NewsCategoryModel'    => 'system/modules/news_categories/models/NewsCategoryModel.php',
	'NewsCategories\NewsModel'            => 'system/modules/news_categories/models/NewsModel.php',

	// Modules
	'NewsCategories\ModuleNewsCategories' => 'system/modules/news_categories/modules/ModuleNewsCategories.php',
	'NewsCategories\ModuleNewsArchive'    => 'system/modules/news_categories/modules/ModuleNewsArchive.php',
	'NewsCategories\ModuleNewsList'       => 'system/modules/news_categories/modules/ModuleNewsList.php',
	'NewsCategories\ModuleNewsMenu'       => 'system/modules/news_categories/modules/ModuleNewsMenu.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_newscategories' => 'system/modules/news_categories/templates'
));
