<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Pastikan seluruh kolom ini didaftarkan dengan benar
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'total_price',
        'address',
        'phone',
        'status',
        'payment_proof', // <--- WAJIB TAMBAHKAN INI SEKARANG
    ];

    // Hubungan relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Hubungan relasi ke product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}