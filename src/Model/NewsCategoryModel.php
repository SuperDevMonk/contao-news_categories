<?php

namespace Codefog\NewsCategoriesBundle\Model;

use Contao\Database;
use Contao\Date;
use Contao\Model\Collection;
use Contao\NewsModel;
use Contao\System;
use Haste\Model\Model;
use Haste\Model\Relations;

/**
 * Use the multilingual model if available
 */
if (MultilingualHelper::isActive()) {
    class ParentModel extends \Terminal42\DcMultilingualBundle\Model\Multilingual {}
} else {
    class ParentModel extends \Contao\Model {}
}

class NewsCategoryModel extends ParentModel
{
    /**
     * Table name
     * @var string
     */
    protected static $strTable = 'tl_news_category';

    /**
     * Find published news categories by news criteria
     *
     * @param array $archives
     * @param array $ids
     *
     * @return Collection|null
     */
    public static function findPublishedByArchives(array $archives, array $ids = [])
    {
        if (count($archives) === 0 || ($relation = Relations::getRelation('tl_news', 'categories')) === false) {
            return null;
        }

        $t = static::getTableAlias();
        $values = [];

        // Start sub select query for relations
        $subSelect = "SELECT {$relation['related_field']} 
FROM {$relation['table']} 
WHERE {$relation['reference_field']} IN (SELECT id FROM tl_news WHERE pid IN (" . implode(',', array_map('intval', $archives)) . ")";

        // Include only the published news items
        if (!BE_USER_LOGGED_IN) {
            $time = Date::floorToMinute();
            $subSelect .= " AND (start=? OR start<=?) AND (stop=? OR stop>?) AND published=?";
            $values = array_merge($values, ['', $time, '', $time + 60, 1]);
        }

        // Finish sub select query for relations
        $subSelect .= ")";

        // Columns definition start
        $columns = ["$t.id IN ($subSelect)"];

        // Filter by custom categories
        if (count($ids) > 0) {
            $columns[] = "$t.id IN (" . implode(',', array_map('intval', $ids)) . ")";
        }

        if (!BE_USER_LOGGED_IN) {
            $columns[] = "$t.published=?";
            $values[] = 1;
        }

        return static::findBy($columns, $values, ['order' => "$t.sorting"]);
    }

    /**
     * Find published category by ID or alias
     *
     * @param string $idOrAlias
     *
     * @return NewsCategoryModel|null
     */
    public static function findPublishedByIdOrAlias($idOrAlias)
    {
        $t = static::getTableAlias();
        $columns = ["($t.id=? OR $t.alias=?)"];
        $values = [$idOrAlias, $idOrAlias];

        if (!BE_USER_LOGGED_IN) {
            $columns[] = "$t.published=?";
            $values[] = 1;
        }

        return static::findOneBy($columns, $values);
    }

    /**
     * Find published news categories by parent ID and IDs
     *
     * @param integer $pid
     * @param array   $ids
     *
     * @return Collection|null
     */
    public static function findPublishedByPidAndIds($pid, array $ids)
    {
        if (count($ids) === 0) {
            return null;
        }

        $t = static::getTableAlias();
        $columns = ["$t.pid=?", "$t.id IN (" . implode(',', array_map('intval', $ids)) . ")"];
        $values = [$pid];

        if (!BE_USER_LOGGED_IN) {
            $columns[] = "$t.published=?";
            $values[] = 1;
        }

        return static::findBy($columns, $values, ['order' => "$t.sorting"]);
    }

    /**
     * Find the published categories by news
     *
     * @param int|array $newsId
     *
     * @return Collection|null
     */
    public static function findPublishedByNews($newsId)
    {
        if (count($ids = Model::getRelatedValues('tl_news', 'categories', $newsId)) === 0) {
            return null;
        }

        $t = static::getTableAlias();
        $columns = ["$t.id IN (" . implode(',', array_map('intval', array_unique($ids))) . ")"];
        $values = [];

        if (!BE_USER_LOGGED_IN) {
            $columns[] = "$t.published=?";
            $values[] = 1;
        }

        return static::findBy($columns, $values, ['order' => "$t.sorting"]);
    }

    /**
     * Count the published news by archives
     *
     * @param array    $archives
     * @param int|null $category
     *
     * @return int
     */
    public static function getUsage(array $archives = [], $category = null)
    {
        $t = NewsModel::getTable();

        if (count($ids = Model::getReferenceValues($t, 'categories', $category)) === 0) {
            return 0;
        }

        $columns = ["$t.id IN (" . implode(',', array_unique($ids)) . ")"];
        $values = [];

        // Filter by archives
        if (count($archives)) {
            $columns[] = "$t.pid IN (" . implode(',', array_map('intval', $archives)) . ")";
        }

        if (!BE_USER_LOGGED_IN) {
            $time = Date::floorToMinute();
            $columns[] = "($t.start=? OR $t.start<=?) AND ($t.stop=? OR $t.stop>?) AND $t.published=?";
            $values = array_merge($values, ['', $time, '', $time + 60, 1]);
        }

        return NewsModel::countBy($columns, $values);
    }

    /**
     * @inheritDoc
     */
    public static function findMultipleByIds($arrIds, array $arrOptions = [])
    {
        if (!MultilingualHelper::isActive()) {
            return parent::findMultipleByIds($arrIds, $arrOptions);
        }

        $t = static::getTableAlias();

        if (!isset($arrOptions['order'])) {
            $arrOptions['order'] = Database::getInstance()->findInSet("$t.id", $arrIds);
        }

        return static::findBy(["$t.id IN (" . implode(',', array_map('intval', $arrIds)) . ")"], null);
    }

    /**
     * Get the table alias
     *
     * @return string
     */
    public static function getTableAlias()
    {
        if (MultilingualHelper::isActive()) {
            return 't1';
        }

        return static::$strTable;
    }
}
