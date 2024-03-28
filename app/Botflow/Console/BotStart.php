<?php

namespace App\Botflow\Console;

use App\Botflow\Contracts\IBotService;
use DefStudio\Telegraph\Models\TelegraphBot;
use Illuminate\Console\Command;

class BotStart extends Command
{

    protected $signature = 'bot:start {--get-updates : получить обновления}';

    protected $description = 'Запуск бота: регистрация веб-хука и меню';

    public function handle(IBotService $botService): int
    {
        $botModel = config('telegraph.models.bot');
        $token = config('bot.token');
        $name = config('bot.name');
        $url = env('APP_URL');

        $getUpdates = $this->option('get-updates', false);

        $this->info('Имя бота: ' . $name);
        $this->info('URL: ' . $url);

        if ($token && $name && $url) {
            /** @var TelegraphBot $bot */
            $bot = $botModel::query()->where('token', '=', $token)->first();

            if (empty($bot)) {
                $bot = $botModel::create([
                    'token' => $token,
                    'name' => $name,
                ]);
                $this->info('Зарегистрирован новый бот, ID: ' . $bot->id);
            } else {
                $this->info('Найден бот, ID: ' . $bot->id);
            }

            $botService->setBot($bot);

            $this->info('Регистрация хука...');
            $botService->telegraph()->registerWebhook(!$getUpdates)->send();

            if ($getUpdates) {
                $this->info('Запуск обработки обновлений...');
            }

            if ($menu = config('bot.menu')) {
                $this->info('Регистрация меню...');
                $bot->registerCommands($menu)->send();
            }

            $this->info('Готово');
        } else {
            $this->warn('Для запуска бота необходимо задать параметры .env: BOT_TOKEN, BOT_NAME и APP_URL');
        }

        return self::SUCCESS;
    }
}
