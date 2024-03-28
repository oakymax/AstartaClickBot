<?php

namespace App\Models\Bot\Commands;

use App\Botflow\Contracts\CommonBotCommand;

class Help extends CommonBotCommand
{

    private string $helpText;

    public function commonBehavior(): void
    {
        $this->helpText =<<<MD
Привет!

Я бот-дворецкий *Захар*.
_Помогаю по вопросикам, решаю задачки, мечусь кабанчиком._

Я только учусь быть полезным, но уже кое-что умею:
- *Могу посчитать простое выражение*: просто напиши без пробелов что надо посчитать (например `2+2` или `100*7/365`)
- *Знаю команды*:
    /help
    /hello
    /start
MD;
    }

    public function telegramBehavior(): void
    {
        $this->botService->telegraph()->markdown($this->helpText)->send();
    }

    public function consoleBehavior(): void
    {
        $this->info($this->helpText);
    }

    public function alias(): string
    {
        return 'help';
    }

    public function helpMessage(): string
    {
        return 'Справка по боту';
    }
}
