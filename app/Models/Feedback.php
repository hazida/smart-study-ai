<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Feedback extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     */
    protected $primaryKey = 'feedback_id';

    /**
     * The "type" of the primary key ID.
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     */
    public $incrementing = false;

    /**
     * Indicates if the model should be timestamped.
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'feedback_id',
        'user_id',
        'question_id',
        'answer_id',
        'rating',
        'comments',
    ];

    /**
     * The attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'rating' => 'integer',
            'created_at' => 'datetime',
        ];
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->feedback_id)) {
                $model->feedback_id = (string) Str::uuid();
            }
        });
    }

    /**
     * Get the user that provided the feedback.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * Get the question that the feedback is for.
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'question_id', 'question_id');
    }

    /**
     * Get the answer that the feedback is for.
     */
    public function answer(): BelongsTo
    {
        return $this->belongsTo(Answer::class, 'answer_id', 'answer_id');
    }

    /**
     * Scope a query to only include positive feedback (rating >= 4).
     */
    public function scopePositive($query)
    {
        return $query->where('rating', '>=', 4);
    }

    /**
     * Scope a query to only include negative feedback (rating <= 2).
     */
    public function scopeNegative($query)
    {
        return $query->where('rating', '<=', 2);
    }

    /**
     * Scope a query to filter by rating.
     */
    public function scopeByRating($query, $rating)
    {
        return $query->where('rating', $rating);
    }

    /**
     * Check if the feedback is positive.
     */
    public function isPositive(): bool
    {
        return $this->rating >= 4;
    }

    /**
     * Check if the feedback is negative.
     */
    public function isNegative(): bool
    {
        return $this->rating <= 2;
    }

    /**
     * Get the feedback type based on rating.
     */
    public function getTypeAttribute(): string
    {
        if ($this->rating >= 4) {
            return 'positive';
        } elseif ($this->rating <= 2) {
            return 'negative';
        } else {
            return 'neutral';
        }
    }
}
