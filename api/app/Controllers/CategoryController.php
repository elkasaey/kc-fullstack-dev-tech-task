<?php

namespace App\Controllers;

use App\Services\CategoryService;

class CategoryController
{
    public function list()
    {
        $service = new CategoryService();
        $categories = $service->getAllWithCourseCounts();
        echo json_encode($categories);
    }

    public function show($id)
    {
        $service = new CategoryService();
        $category = $service->getByIdWithCourses($id);
        if ($category) {
            echo json_encode($category);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Category not found']);
        }
    }
}
