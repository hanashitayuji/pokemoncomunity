<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    use HasFactory;
    protected $table = 'exchange';
    protected $fillable = ['title', 'want', 'give', 'vorsion', 'body', 'created_id', 'del_flg'];

    public function readItems() {
        return $this::get();// 全てのデータが取得できる
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
