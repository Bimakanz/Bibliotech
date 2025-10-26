<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $books = Book::latest()->paginate(10);

        return view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        $data['slug'] = $this->generateSlug($data['title']);
        $data['cover_image_path'] = $this->storeCover($request);
        unset($data['cover']);

        Book::create($data);

        return redirect()
            ->route('admin.books.index')
            ->with('status', 'Book added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book): View
    {
        return view('admin.books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book): View
    {
        return view('admin.books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book): RedirectResponse
    {
        $data = $this->validatedData($request, $book);
        unset($data['cover']);

        if ($book->title !== $data['title']) {
            $data['slug'] = $this->generateSlug($data['title'], $book->id);
        }

        if ($request->hasFile('cover')) {
            if ($book->cover_image_path) {
                Storage::disk('public')->delete($book->cover_image_path);
            }

            $data['cover_image_path'] = $this->storeCover($request);
        }

        $book->update($data);

        return redirect()
            ->route('admin.books.index')
            ->with('status', 'Book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book): RedirectResponse
    {
        if ($book->cover_image_path) {
            Storage::disk('public')->delete($book->cover_image_path);
        }

        $book->delete();

        return redirect()
            ->route('admin.books.index')
            ->with('status', 'Book deleted successfully.');
    }

    /**
     * Validate incoming request data.
     *
     * @return array<string, mixed>
     */
    protected function validatedData(Request $request, ?Book $book = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['nullable', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'quantity' => ['required', 'integer', 'min:0'],
            'description' => ['required', 'string'],
            'cover' => [
                $book ? 'nullable' : 'required',
                'image',
                'max:2048',
            ],
        ]);
    }

    /**
     * Generate a unique slug from the title.
     */
    protected function generateSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($title);
        $slug = $baseSlug;
        $counter = 1;

        while (
            Book::where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        return $slug;
    }

    /**
     * Store the uploaded cover image and return its path.
     */
    protected function storeCover(Request $request): ?string
    {
        if (! $request->hasFile('cover')) {
            return null;
        }

        return $request->file('cover')->store('books', 'public');
    }
}