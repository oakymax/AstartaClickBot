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
                $formula = str_replace(',', '.', $message->text());
                $x = 0;
                eval("\$x={$formula};");
                $this->botService->telegraph()->markdown($x)->send();
                $this->botService->bot()->storage()->set("message.{$message->id()}.processed", true);
            } catch (\Exception $e) {
                $this->botService->log()->error("Не удалось посчитать '{$message->text()}': " . $e->getMessage());
            }
        }
    }
}
