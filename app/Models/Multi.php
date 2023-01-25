<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multi extends Model
{
    use HasFactory;
    protected $table = 'multi';
    protected $fillable = ['title', 'content', 'password', 'vorsion', 'created_id', 'del_flg'];

    public function readItems() {
        return $this::get();// 全てのデータが取得できる
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
