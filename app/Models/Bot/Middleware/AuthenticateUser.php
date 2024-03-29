<?php

namespace App\Models\Bot\Middleware;

use App\Botflow\Contracts\CommonBotMiddleware;
use App\Botflow\Telegraph\DTO\Update;
use App\Facades\UserRepositoryFacade;
use Illuminate\Support\Facades\Auth;

class AuthenticateUser extends CommonBotMiddleware
{


    public function handle(Update $update): void
    {
        $telegramId =
            $update->message()?->from()?->id() ?:
            $update->editedMessage()?->from()?->id() ?:
            $update->channelPost()?->from()?->id() ?:
            $update->editedChannelPost()?->from()?->id() ?:
            $update->callbackQuery()?->from()?->id() ?:
            $update->inlineQuery()?->from()?->id();

        if ($user = UserRepositoryFacade::getByTelegramId($telegramId)) {
            Auth::login($user);
        }
    }
}
