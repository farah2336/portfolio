<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        // Database se real projects latest order mein fetch kar rahe hain
        $projects = Project::latest()->get();
        
        // Resume ki setting fetch kar rahe hain
        $setting = Setting::first();
        
        return view('welcome', compact('projects', 'setting'));
    }
}