<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = database_path('seeders/book-data.json');
        $coverDirectory = database_path('seeders/book_covers');

        if (! File::exists($jsonPath)) {
            $this->command?->warn('File book-data.json tidak ditemukan. Lewati seeding buku.');
            return;
        }

        $raw = File::get($jsonPath);
        $records = json_decode($raw, true);

        if (! is_array($records)) {
            $this->command?->warn('Format book-data.json tidak valid. Lewati seeding buku.');
            return;
        }

        Storage::disk('public')->makeDirectory('books');

        foreach ($records as $record) {
            $coverPath = $this->storeCover($record['cover_image_path'] ?? null, $coverDirectory);

            $book = Book::updateOrCreate(
                ['slug' => $record['slug']],
                [
                    'title' => $record['title'],
                    'author' => $record['author'] ?? null,
                    'category' => $record['category'] ?? 'Umum',
                    'quantity' => $record['quantity'] ?? 0,
                    'description' => $record['description'] ?? null,
                    'cover_image_path' => $coverPath,
                ]
            );

            $timestamps = $this->resolveTimestamps($record);

            if ($timestamps !== []) {
                $book->forceFill($timestamps)->save();
            }
        }
    }

    /**
     * Copy cover image to the public storage disk and return its relative path.
     */
    private function storeCover(?string $filename, string $coverDirectory): ?string
    {
        if (! $filename) {
            return null;
        }

        $sourcePath = $coverDirectory.DIRECTORY_SEPARATOR.$filename;

        if (! File::exists($sourcePath)) {
            $this->command?->warn("Cover {$filename} tidak ditemukan. Melewati file ini.");
            return null;
        }

        $storagePath = 'books/'.$filename;

        Storage::disk('public')->put($storagePath, File::get($sourcePath));

        return $storagePath;
    }

    /**
     * Prepare timestamps for the given record.
     *
     * @return array<string, \Illuminate\Support\Carbon>
     */
    private function resolveTimestamps(array $record): array
    {
        $timestamps = [];

        if (! empty($record['created_at'])) {
            $timestamps['created_at'] = Carbon::parse($record['created_at']);
        }

        if (! empty($record['updated_at'])) {
            $timestamps['updated_at'] = Carbon::parse($record['updated_at']);
        }

        return $timestamps;
    }
}
