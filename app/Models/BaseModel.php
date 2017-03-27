<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class BaseModel extends Model {

    /**
     * Returns sql string with bind values
     * @param  object $query query Builder object
     * @return query Builder object
     * @internal param string $sort
     */
    public function scopeToSqlWithBindings($query) {
        $sql = $query->toSql();
        
        $sql = str_replace(['%', '?', '"'], ['%%', '%s', ''], $sql);
        $sql = vsprintf($sql, $query->getBindings());

        return $sql;
    }

    /**
     * Add 'order by' statement in the query Builder object
     * @param  object $query query Builder object
     * @param  string $sort
     * @param mixed $nulls Sets NULLS {FIRST | LAST} to order by statement
     * @return query Builder object
     */
    public function scopeRestOrderBy($query, $sort, $nulls = null) {
        if(!$sort || trim($sort) == '') {
            $query = $query->orderBy($this->table . '.' . $this->primaryKey, 'desc');
            return $query;
    	}
        
        //$sort could be for example: -priority,created_at
        $arrSortData = $this->processSortData($sort);

        for ($i = 0; $i < count($arrSortData); $i++) {
            switch (strtolower($nulls)) {
                case 'first':
                    $nullsStr = ' nulls first';
                    break;
                case 'last':
                    $nullsStr = ' nulls last';
                    break;
                default:
                    $nullsStr = '';
            }

            $option = '"' . $arrSortData[$i]['column'] . '" ' . $arrSortData[$i]['direction'] . $nullsStr;

            $query = $query->orderByRaw($option);
        }

        return $query;
    }
}

?>