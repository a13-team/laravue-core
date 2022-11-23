<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MenuLangList
 *
 * @property int $id
 * @property string $name
 * @property string $short_name
 * @property int|null $is_default
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|MenuLangList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuLangList newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuLangList query()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuLangList whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuLangList whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuLangList whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuLangList whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuLangList whereShortName($value)
 * @mixin \Eloquent
 */
class MenuLangList extends Model
{
    protected $table = 'menu_lang_lists';
    public $timestamps = false; 
}
