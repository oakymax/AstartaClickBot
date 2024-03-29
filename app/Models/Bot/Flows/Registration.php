<?php

namespace App\Models\Bot\Flows;

use App\Botflow\Contracts\CommonBotFlowWithState;
use DefStudio\Telegraph\DTO\Message;

class Registration extends CommonBotFlowWithState
{

    public function start(): void
    {
        parent::start();

        $this->state->data = [];
        $this->botService->telegraph()->markdown('Как тебя зовут?');
    }

    public function finish(): void
    {
        parent::finish();

        $this->botService->telegraph()->markdown('Ура! Теперь тебе доступен кабинет!')->send();
    }

    public function handleCommand(string $command, string $parameter): void
    {

    }

    public function handleChatMessage(Message $message): void
    {
        $this->finish();
    }
}
