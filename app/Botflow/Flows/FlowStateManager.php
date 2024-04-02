<?php

namespace App\Botflow\Flows;

use App\Botflow\Contracts\CommonBotFlow;
use App\Botflow\Contracts\IBotService;
use App\Botflow\Contracts\IFlowStateRepository;
use App\Botflow\Telegraph\DTO\Update;
use App\Facades\Auth;

class FlowStateManager extends CommonBotFlow
{

    protected IFlowStateRepository $flowStateRepository;

    public function __construct(IBotService $botService, array $params = [])
    {
        parent::__construct($botService, $params);

        $this->flowStateRepository = app(IFlowStateRepository::class);
    }

    public function handleUpdate(Update $update): void
    {
        parent::handleUpdate($update);

        $activeFlowStates = $this->flowStateRepository->getActiveFlowStates(
            Auth::user()?->telegram_id,
            $this->botService->chat()?->id
        );

        $monopolized = false;
        foreach ($activeFlowStates as $activeFlowState) {
            if ($activeFlowState->monopolizing) {
                if ($monopolized) {
                    continue;
                } else {
                    $monopolized = true;
                }
            }
            $this->botService->addFlow($activeFlowState->class, ['id' => $activeFlowState->id]);
        }
    }
}
