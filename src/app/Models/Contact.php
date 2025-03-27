<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Builder;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function scopeSerach(Builder $query, array $params): Builder
    {
        if (!empty($params['gender'])) $query->where('gender', $params['gender']);

        if (!empty($params['category_id'])) $query->where('category_id', $params['category_id']);

        if (!empty($params['category_id'])) $query->where('category_id', $params['category_id']);

        if (!empty($params['date'])) $query->where('created_at', $params['date']);

        if (!empty($params['keyword'])) {
            $query->where(function ($query) use ($params) {
                $query->where('email', 'like', '%' . $params['keyword'] . '%')
                    ->orWhere('first_name', 'like', '%' . $params['keyword'] . '%')
                    ->orWhere('last_name', 'like', '%' . $params['keyword'] . '%');
            });
        }

        return $query;
    }
}
