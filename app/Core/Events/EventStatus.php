<?php

namespace App\Core\Events;

enum EventStatus: string
{
    case DRAFT = 'draft';
    case QUOTED = 'quoted';
    case QUALIFIED = 'qualified';
    case CONTRACTED = 'contacted';
    case ACTIVE = 'active';
    case EXPIRED = 'expired';
    case CANCELLED = 'cancelled';
    case ENDED = 'ended';
}
