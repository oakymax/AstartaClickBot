<?php

namespace App\Botflow\Contracts;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class SimpleConfigurableDialogQuestion implements IBotDialogQuestion
{


    /**
     * Configuration template:
     * ```
     *  [
     *      'name' => 'first_name',
     *      'question' => 'Как тебя зовут?',
     *      'rules' => ['string|max:255']
     *  ]
     * ```
     * @param array $configuration
     */
    public function __construct(array $configuration)
    {

        $configurationValidator = Validator::make($configuration, [
            'name' => ['required|string|max:255|regex:/[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*/'],
            'question' => ['required|string'],
            'rules' => ['required|array'],
        ]);

        if ($configurationValidator->fails()) {
            // @todo: implement
        }
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
}
