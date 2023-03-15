<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'questions';
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'correct_answer',
        'time_limit'
    ];

    public function answers()
    {
        return $this->hasMany('App\Models\Answer','question_id','id');
    }
}
