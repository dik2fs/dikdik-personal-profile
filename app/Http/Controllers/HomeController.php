<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Book;

class HomeController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        $featuredProjects = Project::where('featured', true)
                                 ->orderBy('created_at', 'desc')
                                 ->take(3)
                                 ->get();
        
        $featuredBooks = Book::available()
                           ->featured()
                           ->orderBy('created_at', 'desc')
                           ->take(4)
                           ->get();

        $recentBooks = Book::available()
                         ->orderBy('created_at', 'desc')
                         ->take(6)
                         ->get();
        
        return view('home', compact('profile', 'featuredProjects', 'featuredBooks', 'recentBooks'));
    }

    public function about()
    {
        $profile = Profile::first();
        return view('about', compact('profile'));
    }
}