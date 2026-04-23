<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const STATUS_PENDING = 'pending';
    const STATUS_VALIDATED = 'validated';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_SHIPPED = 'shipped';
    const STATUS_DELIVERED = 'delivered';

    protected $fillable = [
        'user_id',
        'status',
        'total_amount',
        'shipping_address',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'total_amount' => 'decimal:2',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            self::STATUS_PENDING    => ['label' => 'En attente',  'class' => 'bg-yellow-100 text-yellow-800'],
            self::STATUS_VALIDATED  => ['label' => 'Validée',     'class' => 'bg-green-100 text-green-800'],
            self::STATUS_CANCELLED  => ['label' => 'Annulée',     'class' => 'bg-red-100 text-red-800'],
            self::STATUS_SHIPPED    => ['label' => 'Expédiée',    'class' => 'bg-blue-100 text-blue-800'],
            self::STATUS_DELIVERED  => ['label' => 'Livrée',      'class' => 'bg-purple-100 text-purple-800'],
            default                 => ['label' => 'Inconnu',     'class' => 'bg-gray-100 text-gray-800'],
        };
    }

    public static function statusLabels(): array
    {
        return [
            self::STATUS_PENDING   => 'En attente',
            self::STATUS_VALIDATED => 'Validée',
            self::STATUS_CANCELLED => 'Annulée',
            self::STATUS_SHIPPED   => 'Expédiée',
            self::STATUS_DELIVERED => 'Livrée',
        ];
    }
}
