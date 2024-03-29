<?php

namespace App\Botflow;

use App\Botflow\Console\BotCommand;
use App\Botflow\Console\BotStart;
use App\Botflow\Console\BotStop;
use App\Botflow\Contracts\IBotService;
use App\Botflow\Contracts\IFlowStateRepository;
use App\Botflow\Eloquent\FlowStateRepository;
use App\Botflow\Events\TelegramActionTime;
use App\Botflow\Events\TelegramCommandReceived;
use App\Botflow\Events\TelegramMessageReceived;
use App\Botflow\Events\TelegramMiddlewareTime;
use App\Botflow\Listeners\TelegramActionTimeListener;
use App\Botflow\Listeners\TelegramCommandListener;
use App\Botflow\Listeners\TelegramMessageListener;
use App\Botflow\Listeners\TelegramMiddlewareTimeListener;
use App\Botflow\Telegraph\BotflowTelegraph;
use App\Botflow\Telegraph\DTO\Update;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use Illuminate\Http\Request;

class BotflowServiceProvider extends EventServiceProvider
{

    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        TelegramMessageReceived::class => [
            TelegramMessageListener::class,
        ],
        TelegramCommandReceived::class => [
            TelegramCommandListener::class,
        ],
        TelegramActionTime::class => [
            TelegramActionTimeListener::class,
        ],
        TelegramMiddlewareTime::class => [
            TelegramMiddlewareTimeListener::class,
        ],
    ];

    public function boot()
    {
        $this->app->bind('telegraph', fn () => new BotflowTelegraph());

        $this->app->bind(Update::class, function (Application $app) {
            $request = $app->make(Request::class);
            return Update::fromArray($request->all());
        });

        $this->app->bind(IFlowStateRepository::class, fn () => new FlowStateRepository());

        $this->app->singleton(IBotService::class, fn () =>
             new BotService(
                config('bot.middleware', []),
                config('bot.commands', []),
                config('bot.flows', []),
                config('bot.unknownCommandAction'),
                config('bot.logChannel'),
            )
        );

        $this->commands([
            BotCommand::class,
            BotStart::class,
            BotStop::class,
        ]);
    }

    public function shouldDiscoverEvents()
    {
        return false;
    }
}
