<?php

namespace App\Botflow\Contracts;

enum FlowStatus: string
{

    case ACTIVE = 'active';

    case OK = 'ok';

    case INTERRUPTED = 'interrupted';
}
