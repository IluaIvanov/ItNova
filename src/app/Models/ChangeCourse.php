<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $camera_tag_id
 * @property int $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property Currency $currency
 */
class ChangeCourse extends Model
{
    use HasFactory;

    protected $table = 'change_courses';

    /**
     * @var array
     */
    protected $fillable = ['date', 'value', 'currency_id', 'change', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo('App\Models\Currency');
    }

    public function getLastModel($currencyId)
    {
        return $this->where('currency_id', $currencyId)
            ->orderByDesc('id')
            ->first();
    }

    public function getCourseLastModel($currencyId)
    {
        $model = $this->getLastModel($currencyId);
        if(isset($model->value)) return $model->value;
        return 0;
    }
}
