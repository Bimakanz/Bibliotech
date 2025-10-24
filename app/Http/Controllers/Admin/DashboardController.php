<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display an overview of the library statistics.
     */
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'totalBooks' => Book::count(),
            'availableBooks' => Book::available()->count(),
            'totalStudents' => User::where('role', 'student')->count(),
            'processingBorrowings' => Borrowing::where('status', Borrowing::STATUS_PROCESSING)->count(),
            'activeBorrowings' => Borrowing::where('status', Borrowing::STATUS_BORROWED)->count(),
            'recentBorrowings' => Borrowing::with(['book', 'user'])
                ->latest()
                ->limit(5)
                ->get(),
        ]);
    }
}
