<?php

namespace App\Enums;

enum UserRole: string
{
    use EnumToArray;

    /** создатель */
    case Root = "root";

    /** хозяин или хозяйка */
    case Master = "master";

    /** неизвестный гражданин или гражданка */
    case Unknown = "unknown";
}
