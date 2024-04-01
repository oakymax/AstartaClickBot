<?php

namespace App\Botflow\Contracts;

interface IBotDialogQuestion
{

    public function name(): string;

    public function message(): string;

    public function rules(): array;
}