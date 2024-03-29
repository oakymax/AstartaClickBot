<?php

namespace App\Models\Bot\Commands;

use App\Botflow\Contracts\CommonBotCommand;
use App\Models\Bot\Actions\SayHello;

class Start extends CommonBotCommand
{

    public function commonBehavior(): void
    {
        $this->botService->addAction(SayHello::class);
    }

    public function alias(): string
    {
        return 'start';
    }

    public function helpMessage(): string
    {
        return 'Приветственное сообщение';
    }
}
