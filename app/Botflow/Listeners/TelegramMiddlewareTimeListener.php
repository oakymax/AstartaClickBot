<?php

namespace App\Botflow\Listeners;

use App\Botflow\Contracts\IBotService;
use App\Botflow\Contracts\IFlowStateRepository;
use App\Botflow\Events\TelegramMiddlewareTime;
use App\Botflow\Telegraph\DTO\Update;
use App\Facades\Auth;

class TelegramMiddlewareTimeListener
{

    public function __construct(
        protected IBotService $botService,
        protected Update $update,
        protected IFlowStateRepository $flowStateRepository
    )
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
