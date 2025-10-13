<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\Project;

class DatabaseSeeder extends Seeder
{
    public function run()
{
    // Create Admin User
    \App\Models\User::create([
        'name' => 'Administrator',
        'email' => 'admin@example.com',
        'password' => bcrypt('password123'),
        'is_admin' => true,
    ]);

    // Profile
    \App\Models\Profile::create([
        'name' => 'Nama Anda',
        'title' => 'Web Developer',
        'email' => 'email@example.com',
        'phone' => '+62 812-3456-7890',
        'location' => 'Jakarta, Indonesia',
        'bio' => 'Saya adalah seorang web developer dengan pengalaman dalam mengembangkan aplikasi web menggunakan Laravel, Vue.js, dan teknologi modern lainnya. Saya passionate dalam menciptakan solusi digital yang efektif dan user-friendly.',
    ]);

    // Projects dengan data yang lebih realistis
$projects = [
    [
        'title' => 'Sistem Manajemen Inventori',
        'description' => 'Aplikasi web lengkap untuk mengelola stok barang, penjualan, dan laporan keuangan. Dilengkapi dengan dashboard real-time dan notifikasi stok rendah.',
        'technologies' => ['Laravel', 'MySQL', 'Bootstrap', 'JavaScript', 'Chart.js'],
        'project_url' => 'https://inventory-demo.example.com',
        'github_url' => 'https://github.com/username/inventory-system',
        'featured' => true,
    ],
    [
        'title' => 'Platform E-Commerce',
        'description' => 'Marketplace modern dengan sistem multi-vendor, pembayaran digital, dan manajemen produk yang lengkap. Mendukung berbagai metode pembayaran.',
        'technologies' => ['Laravel', 'Vue.js', 'MySQL', 'Tailwind CSS', 'REST API'],
        'project_url' => 'https://ecommerce-demo.example.com',
        'github_url' => 'https://github.com/username/ecommerce-platform',
        'featured' => true,
    ],
    [
        'title' => 'Aplikasi Task Management',
        'description' => 'Tools kolaborasi tim untuk manajemen project dengan fitur kanban board, time tracking, dan reporting.',
        'technologies' => ['React', 'Node.js', 'MongoDB', 'Express.js', 'Socket.io'],
        'project_url' => 'https://taskmanager-demo.example.com',
        'github_url' => 'https://github.com/username/task-manager',
        'featured' => false,
    ],
];

foreach ($projects as $project) {
    \App\Models\Project::create($project);
}
// Sample Books
$books = [
    [
        'title' => 'Mastering Laravel: From Zero to Hero',
        'author' => 'John Doe',
        'description' => 'Buku komprehensif untuk mempelajari Laravel dari dasar hingga tingkat lanjut. Dilengkapi dengan studi kasus real-world project.',
        'isbn' => '978-1234567890',
        'price' => 125000,
        'discount_price' => 99000,
        'stock' => 50,
        'categories' => ['Pemrograman', 'Web Development', 'Laravel'],
        'pages' => 350,
        'publisher' => 'Tech Publishing',
        'published_date' => '2024-01-15',
        'language' => 'Indonesia',
        'is_available' => true,
        'is_featured' => true, // Tandai sebagai featured
        'is_ebook' => false,
    ],
    [
        'title' => 'JavaScript Modern untuk Pemula',
        'author' => 'Jane Smith',
        'description' => 'Panduan lengkap untuk mempelajari JavaScript modern dengan ES6+, async/await, dan framework terkini.',
        'isbn' => '978-0987654321',
        'price' => 89000,
        'stock' => 30,
        'categories' => ['Pemrograman', 'JavaScript', 'Web Development'],
        'pages' => 280,
        'publisher' => 'Code Academy',
        'published_date' => '2024-02-20',
        'language' => 'Indonesia',
        'is_available' => true,
        'is_featured' => true, // Tandai sebagai featured
        'is_ebook' => true,
    ],
    [
        'title' => 'UI/UX Design Principles',
        'author' => 'Michael Chen',
        'description' => 'Prinsip-prinsip dasar desain UI/UX untuk membuat aplikasi yang user-friendly dan engaging.',
        'isbn' => '978-1122334455',
        'price' => 75000,
        'discount_price' => 65000,
        'stock' => 25,
        'categories' => ['Design', 'UI/UX', 'Web Design'],
        'pages' => 200,
        'publisher' => 'Design Press',
        'published_date' => '2024-03-10',
        'language' => 'Indonesia',
        'is_available' => true,
        'is_featured' => false,
        'is_ebook' => false,
    ],
    [
        'title' => 'Vue.js untuk Aplikasi Modern',
        'author' => 'Sarah Johnson',
        'description' => 'Panduan lengkap Vue.js dari dasar hingga pembuatan aplikasi single-page yang powerful.',
        'isbn' => '978-4455667788',
        'price' => 95000,
        'stock' => 20,
        'categories' => ['Pemrograman', 'Vue.js', 'Frontend'],
        'pages' => 320,
        'publisher' => 'Frontend Masters',
        'published_date' => '2024-04-05',
        'language' => 'Indonesia',
        'is_available' => true,
        'is_featured' => true, // Tandai sebagai featured
        'is_ebook' => true,
    ],
    // ... tambahkan lebih banyak buku jika perlu
];

foreach ($books as $book) {
    \App\Models\Book::create($book);
}
}
}