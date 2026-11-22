<?php

namespace App\Enums;

enum TicketStatus: string
{
    case NEW = "terbaru";
    case IN_PROGRESS = "sedang_ditangani";
    case CLOSED = "selesai";

    public function label(): string
    {
        return match ($this) {
            TicketStatus::NEW => 'Terbaru',
            TicketStatus::IN_PROGRESS => 'Sedang Ditangani',
            TicketStatus::CLOSED => 'Selesai',
        };
    }

    public function color(): string
    {
        return match ($this) {
            TicketStatus::NEW => '#007bff', // blue
            TicketStatus::IN_PROGRESS => '#FFC107', // yellow
            TicketStatus::CLOSED => '#28A745', // green
        };
    }
}
