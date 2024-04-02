<?php

namespace App\Botflow\Contracts;

use App\Botflow\Contracts\CommonBotFlowWithState;

abstract class CommonBotDialog extends CommonBotFlowWithState
{


    /**
     * @return IBotDialogQuestion[]
     */
    protected abstract function questions(): array;

}
