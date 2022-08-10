<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $valute_id
 * @property string $num_code
 * @property string $char_code
 * @property integer $nominal
 * @property string $name
 * @property boolean $view
 * @property string $created_at
 * @property string $updated_at
 * @property ChangeCourse $changeCourse
 */
class Currency extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['valute_id', 'num_code', 'char_code', 'nominal', 'name', 'view', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function changeCourse()
    {
        return $this->hasMany('App\Models\ChangeCourse');
    }

    public function lastCourse()
    {
        return $this->hasOne('App\Models\ChangeCourse', 'currency_id', 'id')
            ->orderByDesc('id');
    }
}
