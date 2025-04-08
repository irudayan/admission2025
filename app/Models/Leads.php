<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DateTimeInterface;

class Leads extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'leads';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'name',
        'mobile',
        'email',
        'address',
        'purpose',
        'status',
        'source',
        'product_ids',
        'remarks',
        'mail_status',
        'assigned_name',
        'demo_date',
        'demo_time',
        'demo_mail_status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const MAIL_STATUS = [
        '1' => 'Yes',
        '0' => 'No',
    ];

    protected $casts = [
        'product_ids' => 'array',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }


    public function products()
    {
        return $this->belongsToMany(Products::class, 'lead_product', 'lead_id', 'product_id');
    }
    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
public function assign()
{
    return $this->belongsTo(User::class, 'assigned_name');
}

}
