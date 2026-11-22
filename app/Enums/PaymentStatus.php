<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case PENDING = 'menunggu_pembayaran';
    case COMPLETED = 'berhasil';
    case FAILED = 'gagal';
    case CANCELLED = 'dibatalkan';
    case REFUNDED = 'dana_dikembalikan';
    case PARTIALLY_REFUNDED = 'pengembalian_dana_sebagian';

    public static function getMeta(): array
    {
        return array_map(function ($case) {
            return [
                'value' => $case->value,
                'label' => ucfirst(str_replace('_', ' ', $case->value)),
            ];
        }, self::cases());
    }

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Menunggu Pembayaran',
            self::COMPLETED => 'Berhasil',
            self::FAILED => 'Gagal',
            self::CANCELLED => 'Dibatalkan',
            self::REFUNDED => 'Dana Dikembalikan',
            self::PARTIALLY_REFUNDED => 'Pengembalian Dana Sebagian',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::PENDING => '#FFC107', // yellow
            self::COMPLETED => '#28A745', // green
            self::FAILED => '#DC3545', // red
            self::CANCELLED => '#6C757D', // gray
            self::REFUNDED => '#007bff', // blue
            self::PARTIALLY_REFUNDED => '#fd7e14', // orange
        };
    }

    
}
