<?php

use App\Botflow\Flows\FlowStateManager;
use App\Models\Bot\Commands\Hello;
use App\Models\Bot\Commands\Help;
use App\Models\Bot\Commands\Start;
use App\Models\Bot\Flows\Calculator;
use App\Models\Bot\Flows\UnprocessedMessageResponse;
use App\Models\Bot\Middleware\AuthenticateUser;

return [
    'token' => env('BOT_TOKEN'),

    'name' => env('BOT_NAME'),

    'menu' => [
        'help' => 'Что умеет Захар',
    ],

    'middleware' => [
        AuthenticateUser::class,
    ],

    'commands' => [
        Hello::class,
        Help::class,
        Start::class,
    ],

    'flows' => [
        FlowStateManager::class,
        Calculator::class,
        UnprocessedMessageResponse::class,
    ],

    'unknownCommandAction' => null,

    'logChannel' => 'telegraph',
];
