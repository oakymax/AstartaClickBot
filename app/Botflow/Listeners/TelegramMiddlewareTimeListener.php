<?php

namespace App\Botflow\Listeners;

use App\Botflow\Contracts\IBotService;
use App\Botflow\Events\TelegramMiddlewareTime;
use App\Botflow\Telegraph\DTO\Update;

class TelegramMiddlewareTimeListener
{

    public function __construct(protected IBotService $botService, protected Update $update)
    {
        //
    }

    public function handle(TelegramMiddlewareTime $event): void
    {
        while ($middleware = $this->botService->nextMiddleware()) {
            $middleware->handle($this->update);
        }
    }
}
