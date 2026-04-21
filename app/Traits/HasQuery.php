<?php

namespace App\Traits;

trait HasQuery {
    public function scopeSimpleFilter($query, array $filters = []) {
        if (is_array($filters) && count($filters)) {
            foreach($filters as $field => $value) {
                if (!empty($value) || $value === 0 || $value === '0') {
                    $query->where($field, $value);
                }
            }
        }
        return $query;
    }
}
