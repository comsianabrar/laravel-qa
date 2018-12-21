<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['body', 'user_id'];

    use VoteableTrait;

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getBodyHtmlAttribute()
    {
        return \Parsedown::instance()->text($this->body);
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getUpdatedDateAttribute()
    {
        return $this->updated_at->diffForHumans();
    }

    public function getStatusAttribute()
    {
        return $this->isAccepted() ? 'vote-accepted' : '';
    }

    public function getIsAcceptedAttribute()
    {
        return $this->isAccepted();
    }

    public function isAccepted()
    {
        return $this->id === $this->question->best_answer ? 'vote-accepted' : '';
    }

    public function votes()
    {
        return $this->morphToMany(User::class, 'voteable');
    }

}
