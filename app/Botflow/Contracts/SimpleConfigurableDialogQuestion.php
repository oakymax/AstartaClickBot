<?php

namespace App\Botflow\Contracts;

use App\Botflow\Exceptions\RuntimeConfigurationErrorException;
use DefStudio\Telegraph\DTO\InlineQuery;
use DefStudio\Telegraph\DTO\Message;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class SimpleConfigurableDialogQuestion implements IBotDialogQuestion
{


    protected string $name;

    protected string $question;

    protected array $rules;

    public function __construct(array $configuration)
    {

        $configurationValidator = Validator::make($configuration, [
            'name' => ['required|string|max:255|regex:/[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*/'],
            'question' => ['required|string'],
            'rules' => ['required|array'],
            'optional' => ['boolean'],
        ]);

        if ($configurationValidator->fails()) {
            throw new RuntimeConfigurationErrorException(
                "SimpleConfigurableDialogQuestion configuration errors: " .
                $configurationValidator->errors()->toJson()
            );
        }

        $validatedConfig = $configurationValidator->validated();

        $this->name = $validatedConfig['name'];
        $this->question = $validatedConfig['question'];
    }

    public function name(): string
    {
        return '';
    }

    public function ask(): void
    {
        // TODO: Implement ask() method.
    }

    public function validate(string $answer): MessageBag
    {
        // @todo: implement
        return new MessageBag();
    }

    public function askAgain(): void
    {
        // TODO: Implement askAgain() method.
    }

    public function handleMessage(Message $message): void
    {
        // TODO: Implement handleMessage() method.
    }

    public function handleInlineQuery(InlineQuery $inlineQuery): void
    {
        // TODO: Implement handleInlineQuery() method.
    }
}
