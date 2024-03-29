<?php

namespace App\Models\Bot\Actions;

use App\Botflow\Contracts\CommonBotAction;

class SendCabinetMenu extends CommonBotAction
{

    public function commonBehavior(): void
    {
        //
    }

    public function telegramBehavior(): void
    {
        $this->botService->telegraph()->markdown('Добро пожаловать в кабинет!')->send();
    }
}
