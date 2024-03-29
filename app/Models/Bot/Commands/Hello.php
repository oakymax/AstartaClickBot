<?php

namespace App\Models\Bot\Commands;

use App\Botflow\Contracts\CommonBotCommand;
use App\Botflow\Flows\SetFunnyReactionToJustReceivedMessage;
use App\Enums\UserRole;
use App\Facades\Auth;
use App\Models\Bot\Actions\SayHello;
use DefStudio\Telegraph\Enums\ChatActions;

class Hello extends CommonBotCommand
{

    public function commonBehavior(): void
    {
        $this->botService->addAction(SayHello::class);
    }

    public function alias(): string
    {
        return 'hello';
    }

    public function helpMessage(): string
    {
        return 'Команда приветствия';
    }
}
