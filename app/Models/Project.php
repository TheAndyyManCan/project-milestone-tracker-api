<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'deadline', 'user_id', 'description'];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function milestones(): HasMany {
        return $this->hasMany(Milestone::class);
    }
}
