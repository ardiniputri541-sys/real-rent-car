<?php

namespace App\Enums;

enum CarStatus: string
{
    case AVAILABLE   = 'available';
    case RESERVED    = 'reserved';
    case RENTED      = 'rented';
    case MAINTENANCE = 'maintenance';
    case CLEANING    = 'cleaning';
    case UNAVAILABLE = 'unavailable';
    case RETIRED     = 'retired';

    public function label(): string
    {
        return match ($this) {
            self::AVAILABLE   => 'Tersedia',
            self::RESERVED    => 'Dipesan',
            self::RENTED      => 'Sedang Disewa',
            self::MAINTENANCE => 'Dalam Perbaikan',
            self::CLEANING    => 'Dalam Pembersihan',
            self::UNAVAILABLE => 'Tidak Tersedia',
            self::RETIRED     => 'Tidak Beroperasi',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::AVAILABLE   => 'Mobil siap untuk dipesan dan disewa.',
            self::RESERVED    => 'Mobil telah dipesan oleh pelanggan dan menunggu untuk pengambilan.',
            self::RENTED      => 'Mobil sedang disewa oleh pelanggan.',
            self::MAINTENANCE => 'Mobil sedang menjalani servis mekanik atau perbaikan.',
            self::CLEANING    => 'Mobil sedang dibersihkan/dipersiapkan sebelum tersedia kembali.',
            self::UNAVAILABLE => 'Mobil sementara tidak tersedia (alasan administratif atau teknis).',
            self::RETIRED     => 'Mobil telah dihapus secara permanen dari armada.',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::AVAILABLE   => '#10B981', // Green-500
            self::RESERVED    => '#3B82F6', // Blue-500
            self::RENTED      => '#F59E0B', // Amber-500
            self::MAINTENANCE => '#EF4444', // Red-500
            self::CLEANING    => '#8B5CF6', // Violet-500
            self::UNAVAILABLE => '#6B7280', // Gray-500
            self::RETIRED     => '#4B5563', // Gray-600
        };
    }
}
