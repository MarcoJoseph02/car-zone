<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
    use HasFactory;
    // protected $appends = ['comments'];
    protected $appends = ['reactions_summary'];

    public function getReactionsSummaryAttribute()
    {
        $data = DB::table('comment_reactions')
            ->select('type', DB::raw('count(*) as total'))
            ->where('comment_id', $this->id)
            ->groupBy('type')
            ->get();

        $result = [];

        foreach ($data as $reaction) {
            $result[$reaction->type] = $reaction->total;
        }

        return (object) $result;
    }

    protected $fillable = [
        'user_id',
        'body',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reactions()
    {
        return $this->hasMany(CommentReaction::class);
    }
}
