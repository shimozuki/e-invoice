<?php

namespace App\Enum;

enum PermissionResource: string
{
    case USER = 'user';
    case ROLE = 'role';
    case CUSTOMER = 'customer';
    case INVOICE  = 'invoice';
    case REPORT = 'report';
    case LOG_ACTIVITY = 'log_activity';
}
