<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the projects.
     */
    public function index()
    {
        $projects = Project::latest()->get();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new project.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created project in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'technologies' => 'required|array|min:1',
            'technologies.*' => 'string|max:50',
            'project_url' => 'nullable|url|max:255',
            'github_url' => 'nullable|url|max:255',
            'featured' => 'boolean'
        ], [
            'title.required' => 'Judul proyek wajib diisi',
            'description.required' => 'Deskripsi proyek wajib diisi',
            'description.min' => 'Deskripsi minimal 10 karakter',
            'technologies.required' => 'Minimal satu teknologi harus dipilih',
            'technologies.min' => 'Minimal satu teknologi harus dipilih',
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau webp',
            'image.max' => 'Ukuran gambar maksimal 2MB',
            'project_url.url' => 'Format URL tidak valid',
            'github_url.url' => 'Format URL GitHub tidak valid'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
            $validated['image'] = $imagePath;
        }

        $validated['featured'] = $request->has('featured');

        Project::create($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Proyek berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified project.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified project in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'technologies' => 'required|array|min:1',
            'technologies.*' => 'string|max:50',
            'project_url' => 'nullable|url|max:255',
            'github_url' => 'nullable|url|max:255',
            'featured' => 'boolean'
        ], [
            'title.required' => 'Judul proyek wajib diisi',
            'description.required' => 'Deskripsi proyek wajib diisi',
            'description.min' => 'Deskripsi minimal 10 karakter',
            'technologies.required' => 'Minimal satu teknologi harus dipilih',
            'technologies.min' => 'Minimal satu teknologi harus dipilih',
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau webp',
            'image.max' => 'Ukuran gambar maksimal 2MB',
            'project_url.url' => 'Format URL tidak valid',
            'github_url.url' => 'Format URL GitHub tidak valid'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            
            $imagePath = $request->file('image')->store('projects', 'public');
            $validated['image'] = $imagePath;
        }

        $validated['featured'] = $request->has('featured');

        $project->update($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Proyek berhasil diperbarui!');
    }

    /**
     * Remove the specified project from storage.
     */
    public function destroy(Project $project)
    {
        // Delete image if exists
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }
        
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Proyek berhasil dihapus!');
    }

    /**
     * Toggle featured status for a project.
     */
    public function toggleFeatured(Project $project)
    {
        $project->update([
            'featured' => !$project->featured
        ]);

        $status = $project->featured ? 'ditandai sebagai unggulan' : 'dihapus dari unggulan';
        
        return redirect()->route('admin.projects.index')
            ->with('success', "Proyek berhasil {$status}!");
    }
}