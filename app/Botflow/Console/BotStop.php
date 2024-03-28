<?php

namespace App\Botflow\Console;

use App\Botflow\Contracts\IBotService;
use Carbon\Carbon;
use DefStudio\Telegraph\Models\TelegraphBot;
use Illuminate\Console\Command;

class BotStop extends Command
{

    protected $signature = 'bot:stop';

    protected $description = 'Полная остановка бота: снятие веб-хука с остановкой регистрации сообщений';

    public function handle(): int
    {
        $botModel = config('telegraph.models.bot');
        $token = config('bot.token');
        $name = config('bot.name');

        if ($token) {
            /** @var TelegraphBot $bot */
            $bot = $botModel::query()->where('token', '=', $token)->first();

            if (empty($bot)) {
                $this->warn("Бот {$name} здесь не запускался");
            }  else {
                $this->info("Бот {$bot->name}, ID: {$bot->id}");
                $this->info('Снятие хука...');
                $bot->unregisterWebhook()->send();
                $until = Carbon::now()->addDay();
                $this->info('ВНИМАНИЕ: Запуск бота без потери событий возможен до ' . $until->toDateTimeString());
            }

            $this->info('Готово');
        } else {
            $this->warn('Не задан необходимый параметр .env: BOT_TOKEN');
        }

        return self::SUCCESS;
    }
}
