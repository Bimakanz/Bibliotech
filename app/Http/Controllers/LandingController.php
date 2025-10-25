<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LandingController extends Controller
{
    /**
     * Display the public catalogue landing page.
     */
    public function __invoke(Request $request): View
    {
        $search = trim((string) $request->input('q', ''));
        $category = trim((string) $request->input('category', ''));

        $books = Book::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('author', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->when($category !== '', fn ($query) => $query->where('category', $category))
            ->orderBy('title')
            ->paginate(10)
            ->withQueryString();

        $categories = Book::query()
            ->select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('welcome', [
            'books' => $books,
            'categories' => $categories,
            'search' => $search,
            'activeCategory' => $category,
        ]);
    }

    /**
     * Display a single book for visitors.
     */
    public function show(Book $book): View
    {
        return view('landing.book', [
            'book' => $book,
        ]);
    }
}
