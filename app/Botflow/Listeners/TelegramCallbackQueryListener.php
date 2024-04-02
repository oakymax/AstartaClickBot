<?php

namespace App\Botflow\Listeners;

use App\Botflow\Contracts\IBotService;
use App\Botflow\Events\TelegramCallbackQueryReceived;
use App\Botflow\Telegraph\DTO\Update;

class TelegramCallbackQueryListener
{

    public function __construct(protected IBotService $botService, protected Update $update)
    {
        //
    }

    public function handle(TelegramCallbackQueryReceived $event): void
    {
        while ($flow = $this->botService->nextFlow()) {
            $flow->handleCallbackQuery($event->callbackQuery);
            $flow->handleUpdate($this->update);
        }
    }
}
