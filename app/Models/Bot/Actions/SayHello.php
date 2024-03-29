<?php

namespace App\Models\Bot\Actions;

use App\Botflow\Contracts\CommonBotAction;
use App\Botflow\Flows\SetFunnyReactionToJustReceivedMessage;
use App\Enums\UserRole;
use App\Facades\Auth;
use DefStudio\Telegraph\Enums\ChatActions;

class SayHello extends CommonBotAction
{

    protected string $message;

    public function commonBehavior(): void
    {

        if (Auth::guest()) {
            $this->message = 'Привет!';
        } else {
            $user = Auth::user();
            switch ($user->role) {
                case UserRole::Root:
                    $this->message = "Приветствую тебя, {$user->name}!";
                    break;
                case UserRole::Master:
                    $this->message = "Здравствуйте, {$user->name}!";
                    break;
                case UserRole::Unknown:
                    $this->message = "Привет, {$user->name}!";
                    break;
            }
        }

        $this->botService->log()->info($this->message);
    }

    public function consoleBehavior(): void
    {
        $this->info($this->message);
    }

    public function telegramBehavior(): void
    {
        $this->botService->telegraph()->chatAction(ChatActions::TYPING)->send();

        $this->botService->chat()
            ->markdown($this->message)
            ->dispatch()->delay(1);

        $this->botService->addFlow(SetFunnyReactionToJustReceivedMessage::class);
    }
}
