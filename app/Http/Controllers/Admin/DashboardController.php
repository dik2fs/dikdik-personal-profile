<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Contact;
use App\Models\Profile;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_projects' => Project::count(),
            'unread_messages' => Contact::where('read', false)->count(),
            'total_messages' => Contact::count(),
            'featured_projects' => Project::where('featured', true)->count()
        ];

        $recentMessages = Contact::latest()->take(5)->get();
        $recentProjects = Project::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentMessages', 'recentProjects'));
    }
}