<?php

namespace App\Botflow\Contracts;

use App\Botflow\Eloquent\FlowState;
use Illuminate\Support\Collection;

interface IFlowStateRepository
{

    /**
     * @param int|null $telegramUserId
     * @param int|null $telegramChatId
     *
     * @return Collection<FlowState>
     */
    public function getActiveFlowStates(?int $telegramUserId = null, ?int $telegramChatId = null): Collection;

    public function restoreFlow(int $stateId): CommonBotFlowWithState;
}
