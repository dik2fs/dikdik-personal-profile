<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Book;
use App\Models\Project;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate sitemap.xml for SEO';

    public function handle()
    {
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        // Static pages
        $pages = [
            ['url' => route('home'), 'priority' => '1.0'],
            ['url' => route('about'), 'priority' => '0.8'],
            ['url' => route('projects'), 'priority' => '0.8'],
            ['url' => route('books.index'), 'priority' => '0.9'],
            ['url' => route('contact'), 'priority' => '0.7'],
        ];

        foreach ($pages as $page) {
            $sitemap .= $this->generateUrlEntry($page['url'], $page['priority']);
        }

        // Books
        $books = Book::available()->get();
        foreach ($books as $book) {
            $sitemap .= $this->generateUrlEntry(
                route('books.show', $book),
                '0.8',
                $book->updated_at
            );
        }

        // Projects
        $projects = Project::all();
        foreach ($projects as $project) {
            $sitemap .= $this->generateUrlEntry(
                route('projects.show', $project),
                '0.7',
                $project->updated_at
            );
        }

        $sitemap .= '</urlset>';

        // Save sitemap
        file_put_contents(public_path('sitemap.xml'), $sitemap);

        $this->info('Sitemap generated successfully!');
        return Command::SUCCESS;
    }

    private function generateUrlEntry($url, $priority, $lastmod = null)
    {
        $lastmod = $lastmod ? $lastmod->toDateString() : now()->toDateString();
        
        return "  <url>" . PHP_EOL .
               "    <loc>{$url}</loc>" . PHP_EOL .
               "    <lastmod>{$lastmod}</lastmod>" . PHP_EOL .
               "    <priority>{$priority}</priority>" . PHP_EOL .
               "  </url>" . PHP_EOL;
    }
}