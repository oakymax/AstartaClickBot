<?php

namespace App\Models\Bot\Flows;

use App\Botflow\Contracts\CommonBotFlow;
use DefStudio\Telegraph\DTO\Message;

class Calculator extends CommonBotFlow
{

    public function handleChatMessage(Message $message): void
    {
        if (preg_match('/^((\d*\.?\d*)([+-\/*]))*(\d*\.?\d*)$/', $message->text())) {
            try {
                $x = 0;
                eval("\$x={$message->text()};");
                $this->botService->telegraph()->markdown($x)->send();
            } catch (\Exception $e) {
                $this->botService->log()->error("Не удалось посчитать '{$message->text()}': " . $e->getMessage());
            }
        }
    }
}
