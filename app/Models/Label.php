<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Label extends Model
{
    use HasFactory;

    public $incrementing = true;

    protected $table = 'labels';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'description'
    ];

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }
}
