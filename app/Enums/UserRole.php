<?php

namespace App\Enums;

enum UserRole: string
{
    /** создатель */
    case Root = "root";

    /** хозяин или хозяйка */
    case Master = "master";

    /** неизвестный гражданин или гражданка */
    case Unknown = "unknown";
}
