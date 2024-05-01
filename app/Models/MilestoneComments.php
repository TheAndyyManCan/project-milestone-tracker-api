<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MilestoneComments extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'milestone_id', 'content'];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function milestone(): BelongsTo {
        return $this->belongsTo(Milestone::class);
    }
}
