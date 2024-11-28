<?php

namespace App\Controllers;

use App\Services\CourseService;

class CourseController
{
    public function list($categoryId = null)
    {
        $service = new CourseService();
        $courses = $service->getAll($categoryId);
        echo json_encode($courses);
    }
}
