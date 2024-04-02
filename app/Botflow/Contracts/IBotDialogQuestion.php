<?php

namespace App\Botflow\Contracts;

use App\Botflow\Telegraph\DTO\Update;
use DefStudio\Telegraph\DTO\InlineQuery;
use DefStudio\Telegraph\DTO\Message;
use Illuminate\Support\MessageBag;

interface IBotDialogQuestion
{

    public function name(): string;

    public function ask(): void;

    public function askAgain(): void;

    public function handleMessage(Message $message): void;

    public function handleInlineQuery(InlineQuery $inlineQuery): void;
}
