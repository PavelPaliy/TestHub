<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;

class TeacherController extends Controller
{
    //
    public function __construct(Teacher $teacher)
    {
        $this->middleware('auth:teacher');
    }
    public function index()
    {
        echo "teacher dashboard";
    }
}
