<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Borrowing extends Model
{
    use HasFactory;

    public const STATUS_PROCESSING = 'processing';
    public const STATUS_BORROWED = 'borrowed';
    public const STATUS_RETURNED = 'returned';

    /**
     * Attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'book_id',
        'borrower_name',
        'quantity',
        'status',
        'borrowed_at',
        'return_date',
        'status_updated_at',
        'notes',
    ];

    /**
     * Attribute casting rules.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'quantity' => 'integer',
        'borrowed_at' => 'date',
        'return_date' => 'date',
        'status_updated_at' => 'datetime',
    ];

    /**
     * Supported borrowing statuses.
     *
     * @return list<string>
     */
    public static function statuses(): array
    {
        return [
            self::STATUS_PROCESSING,
            self::STATUS_BORROWED,
            self::STATUS_RETURNED,
        ];
    }

    /**
     * Map of status labels for UI.
     *
     * @return array<string, string>
     */
    public static function statusLabels(): array
    {
        return [
            self::STATUS_PROCESSING => 'Processing',
            self::STATUS_BORROWED => 'Dipinjam',
            self::STATUS_RETURNED => 'Dikembalikan',
        ];
    }

    /**
     * Borrowing belongs to a student user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Borrowing belongs to a book.
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Determine if the borrowing has been marked as returned.
     */
    public function isReturned(): bool
    {
        return $this->status === self::STATUS_RETURNED;
    }

    /**
     * Human readable label for the current status.
     */
    public function statusLabel(): string
    {
        return self::statusLabels()[$this->status] ?? $this->status;
    }
}
