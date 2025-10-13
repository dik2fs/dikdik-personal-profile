<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Project;

class ProfileController extends Controller
{
    public function index()
    {
    $profile = Profile::first();
    $featuredProjects = Project::where('featured', true)->take(3)->get();

    // Tambahkan kode ini 👇
    $featuredBooks = \App\Models\Book::where('is_featured', true)->take(4)->get();
    $recentBooks = \App\Models\Book::latest()->take(6)->get();

    return view('home', compact('profile', 'featuredProjects', 'featuredBooks', 'recentBooks'));
    }

    public function about()
    {
        $profile = Profile::first();
        return view('about', compact('profile'));
    }
}