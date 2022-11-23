<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Status
 *
 * @property int $id
 * @property string $name
 * @property string $class
 * @method static \Database\Factories\StatusFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Status newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Status newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Status query()
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereName($value)
 * @mixin \Eloquent
 */
class Status extends Model
{
    use HasFactory;

    protected $table = 'status';
    public $timestamps = false; 
    /**
     * Get the notes for the status.
     */
    public function notes()
    {
        return $this->hasMany('App\Modles\Notes');
    }
}
