<?php

namespace App\Botflow\Listeners;

use App\Botflow\Contracts\IBotService;
use App\Botflow\Events\TelegramMessageReceived;
use App\Botflow\Telegraph\DTO\Update;

class TelegramMessageListener
{

    public function __construct(protected IBotService $botService, protected Update $update)
    {
        //
    }

    public function handle(TelegramMessageReceived $event): void
    {
        while ($flow = $this->botService->nextFlow()) {
            $flow->handleChatMessage($event->message);
            $flow->handleUpdate($this->update);
        }
    }
}
