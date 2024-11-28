<?php

namespace App\Services;

use App\Database\DB;

class CourseService
{
    public function getAll($categoryId = null)
    {
        $query = "
            SELECT courses.id, courses.name, courses.description, categories.name AS main_category
            FROM courses
            INNER JOIN categories ON courses.category_id = categories.id
        ";

        if ($categoryId) {
            $query .= " WHERE courses.category_id = :category_id";
            return DB::query($query, ['category_id' => $categoryId]);
        }

        return DB::query($query);
    }
}
