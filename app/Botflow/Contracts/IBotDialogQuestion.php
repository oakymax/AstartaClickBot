<?php

namespace App\Botflow\Contracts;

use Illuminate\Support\MessageBag;

interface IBotDialogQuestion
{

    public function name(): string;

    public function ask(): void;

    public function validate(string $answer): MessageBag;
}
