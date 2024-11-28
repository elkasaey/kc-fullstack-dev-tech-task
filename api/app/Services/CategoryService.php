<?php

namespace App\Services;

use App\Database\DB;

class CategoryService
{
    public function getAllWithCourseCounts()
    {
        $query = "
            SELECT c.id, c.name, c.parent_id,
            (
                SELECT COUNT(*)
                FROM courses
                WHERE category_id = c.id
            ) AS course_count
            FROM categories c
        ";

        return DB::query($query);
    }

    public function getByIdWithCourses($id)
    {
        $query = "
            SELECT id, name
            FROM categories
            WHERE id = :id
        ";
        $category = DB::query($query, ['id' => $id], true);

        if ($category) {
            $query = "
                SELECT id, name, description
                FROM courses
                WHERE category_id = :id
            ";
            $category['courses'] = DB::query($query, ['id' => $id]);
        }

        return $category;
    }
}
