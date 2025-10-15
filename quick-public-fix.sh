#!/bin/bash

echo "🚀 QUICK FIX: Moving to Public Folder"

cd /var/www/html

echo "1. Creating uploads directories..."
mkdir -p public/uploads/projects
mkdir -p public/uploads/books/covers
mkdir -p public/uploads/books/files
mkdir -p public/uploads/profile

echo "2. Setting permissions..."
chmod -R 755 public/uploads

echo "3. Move existing files from storage to public..."
# Pindahkan file yang sudah ada
cp -r storage/app/public/projects/* public/uploads/projects/ 2>/dev/null || true
cp -r storage/app/public/books/covers/* public/uploads/books/covers/ 2>/dev/null || true
cp -r storage/app/public/books/files/* public/uploads/books/files/ 2>/dev/null || true
cp -r storage/app/public/profile/* public/uploads/profile/ 2>/dev/null || true

echo "4. Update database paths..."
php artisan tinker << EOF
// Update project images
\\App\\Models\\Project::whereNotNull('image')->update([
    'image' => \\DB::raw("REPLACE(image, 'projects/', 'uploads/projects/')")
]);

// Update book covers
\\App\\Models\\Book::whereNotNull('cover_image')->update([
    'cover_image' => \\DB::raw("REPLACE(cover_image, 'books/covers/', 'uploads/books/covers/')")
]);

// Update book files
\\App\\Models\\Book::whereNotNull('book_file')->update([
    'book_file' => \\DB::raw("REPLACE(book_file, 'books/files/', 'uploads/books/files/')")
]);

echo "Database paths updated!\\n";
EOF

echo "5. Fixing view files..."
# Update semua asset('storage/') menjadi asset()
find resources/views -name "*.blade.php" -exec sed -i "s|asset('storage/|asset(|g" {} \;
find resources/views -name "*.blade.php" -exec sed -i "s|{{ asset('storage/|{{ asset(|g" {} \;

echo "✅ QUICK FIX COMPLETED!"
echo "📸 Images should now work at: https://dikdikfirmansidik.com/uploads/projects/"