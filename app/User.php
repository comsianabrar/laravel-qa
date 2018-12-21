<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function favorities()
    {
        return $this->belongsToMany(Question::class, 'favorities')->withTimestamps(); //'user_id', 'question_id'
    }

    public function getUrlAttribute()
    {
//        return route('questions.show', $this->id);
        return '#';
    }

    public function getAvatarAttribute()
    {
        $email = $this->email;
        $size = 40;

        return "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?s=" . $size;
    }

    public function voteQuestions()
    {
        return $this->morphedByMany(Question::class, 'voteable');
    }

    public function voteAnswers()
    {
        return $this->morphedByMany(Answer::class, 'voteable');
    }

    public function voteQuestion(Question $question, $vote)
    {
        $voteQuestions = $this->voteQuestions();
        if ($voteQuestions->where('voteable_id', $question->id)->exists()) {
            // update existing vote
            $voteQuestions->updateExistingPivot($question->id, ['vote' => $vote]);
        } else {
            $voteQuestions->attach($question, ['vote' => $vote]);
        }

        $question->load('votes');
//        $downVotes = (int)$question->votes()->wherePivot('vote', -1)->sum('vote');
//        $upVotes = (int)$question->votes()->wherePivot('vote', 1)->sum('vote');

        $downVotes = (int)$question->downVotes()->sum('vote');
        $upVotes = (int)$question->upVotes()->sum('vote');

        $question->votes_count = $upVotes + $downVotes;
        $question->save();
    }


    public function voteAnswer(Answer $answer, $vote)
    {
        $voteAnswers = $this->voteAnswers();
        if ($voteAnswers->where('voteable_id', $answer->id)->exists()) {
            // update existing vote
            $voteAnswers->updateExistingPivot($answer->id, ['vote' => $vote]);
        } else {
            $voteAnswers->attach($answer, ['vote' => $vote]);
        }

        $answer->load('votes');
//        $downVotes = (int)$question->votes()->wherePivot('vote', -1)->sum('vote');
//        $upVotes = (int)$question->votes()->wherePivot('vote', 1)->sum('vote');

        $downVotes = (int)$answer->downVotes()->sum('vote');
        $upVotes = (int)$answer->upVotes()->sum('vote');

        $answer->votes_count = $upVotes + $downVotes;
        $answer->save();
    }

}
