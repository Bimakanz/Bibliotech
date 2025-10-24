<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class BorrowingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $borrowings = Borrowing::with(['book', 'user'])
            ->latest('borrowed_at')
            ->paginate(12);

        return view('admin.borrowings.index', [
            'borrowings' => $borrowings,
            'statuses' => Borrowing::statuses(),
        ]);
    }

    /**
     * Update the borrowing status.
     */
    public function update(Request $request, Borrowing $borrowing): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(Borrowing::statuses())],
        ]);

        if ($borrowing->status === $data['status']) {
            return back()->with('status', 'Status is already set to the selected value.');
        }

        DB::transaction(function () use ($borrowing, $data): void {
            $previousStatus = $borrowing->status;
            $book = $borrowing->book()->lockForUpdate()->first();

            if ($previousStatus === Borrowing::STATUS_RETURNED && $data['status'] !== Borrowing::STATUS_RETURNED) {
                if ($book->quantity < $borrowing->quantity) {
                    throw ValidationException::withMessages([
                        'status' => 'Stok buku tidak mencukupi untuk mengubah status peminjaman ini.',
                    ]);
                }

                $book->decrement('quantity', $borrowing->quantity);
            }

            if ($previousStatus !== Borrowing::STATUS_RETURNED && $data['status'] === Borrowing::STATUS_RETURNED) {
                $book->increment('quantity', $borrowing->quantity);
            }

            $borrowing->status = $data['status'];
            $borrowing->status_updated_at = now();
            $borrowing->save();
        });

        return back()->with('status', 'Borrowing status updated.');
    }
}
