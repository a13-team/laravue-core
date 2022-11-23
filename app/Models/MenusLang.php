<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MenusLang
 *
 * @property int $id
 * @property string $name
 * @property string $lang
 * @property int $menus_id
 * @method static \Illuminate\Database\Eloquent\Builder|MenusLang newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MenusLang newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MenusLang query()
 * @method static \Illuminate\Database\Eloquent\Builder|MenusLang whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenusLang whereLang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenusLang whereMenusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenusLang whereName($value)
 * @mixin \Eloquent
 */
class MenusLang extends Model
{
    protected $table = 'menus_lang';
    public $timestamps = false; 
}
