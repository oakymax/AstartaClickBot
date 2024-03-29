<?php

namespace App\Models\Bot\Commands;

use App\Botflow\Contracts\CommonBotCommand;
use App\Facades\Auth;
use App\Models\Bot\Actions\SendCabinetMenu;
use App\Models\Bot\Flows\Registration;

class Cabinet extends CommonBotCommand
{

    public function commonBehavior(): void
    {
        //
    }

    public function telegramBehavior(): void
    {
        if (Auth::guest()) {
            $this->botService->telegraph()->markdown('Для входа в кабинет требуется регистрация')->send();
            $this->botService->addFlow(Registration::class);
        } else {
            $this->botService->addAction(SendCabinetMenu::class);
        }
    }

    public function alias(): string
    {
        return 'cabinet';
    }

    public function helpMessage(): string
    {
        return 'Кабинет пользователя';
    }
}
