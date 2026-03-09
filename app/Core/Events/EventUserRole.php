<?php

namespace App\Core\Events;

enum EventUserRole: string
{
    case OWNER       = 'owner';
    case ADMIN       = 'admin';
    case USER        = 'user';
    case COORDINATOR = 'coordinator';
    case DESIGNER    = 'designer';
    case STAFF       = 'staff';
}
