<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class BorrowingController extends Controller
{
    /**
     * Display the current student's borrowing history.
     */
    public function index(): View
    {
        $borrowings = Auth::user()
            ->borrowings()
            ->with('book')
            ->latest('borrowed_at')
            ->paginate(12);

        return view('student.borrowings.index', compact('borrowings'));
    }

    /**
     * Store a new borrowing request.
     */
    public function store(Request $request, Book $book): RedirectResponse
    {
        $data = $request->validate([
            'borrower_name' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'integer', 'min:1'],
            'borrowed_at' => ['required', 'date'],
            'return_date' => ['required', 'date', 'after_or_equal:borrowed_at'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        DB::transaction(function () use ($book, $data): void {
            $lockedBook = Book::whereKey($book->id)->lockForUpdate()->first();

            if ($lockedBook->quantity < $data['quantity']) {
                throw ValidationException::withMessages([
                    'quantity' => 'Jumlah buku melebihi stok yang tersedia.',
                ]);
            }

            $lockedBook->decrement('quantity', $data['quantity']);

            Borrowing::create([
                'user_id' => Auth::id(),
                'book_id' => $lockedBook->id,
                'borrower_name' => $data['borrower_name'],
                'quantity' => $data['quantity'],
                'status' => Borrowing::STATUS_PROCESSING,
                'borrowed_at' => $data['borrowed_at'],
                'return_date' => $data['return_date'],
                'status_updated_at' => now(),
                'notes' => $data['notes'] ?? null,
            ]);
        });

        return redirect()
            ->route('student.borrowings.index')
            ->with('status', 'Permintaan peminjaman berhasil dikirim. Silakan menunggu konfirmasi admin.');
    }
}
