<?php

namespace App\Botflow\Eloquent;

use App\Botflow\Contracts\CommonBotFlowWithState;
use App\Botflow\Contracts\FlowStatus;
use App\Botflow\Contracts\IFlowStateRepository;
use App\Botflow\Exceptions\RuntimeDataInconsistencyErrorException;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

class FlowStateRepository implements IFlowStateRepository
{

    /**
     * @inheritdoc
     */
    public function getActiveFlowStates(?int $telegramUserId = null, ?int $telegramChatId = null): Collection
    {
        $flows = FlowState::query()->where('status', '=', FlowStatus::ACTIVE)
            ->where(function (Builder $query) use ($telegramUserId) {
                $query->where('telegram_user_id', '=', null);

                if ($telegramUserId) {
                    $query->orWhere('telegram_user_id', '=', $telegramUserId);
                }
            })
            ->where(function (Builder $query) use ($telegramChatId) {
                $query->where('telegram_chat_id', '=', null);

                if ($telegramChatId) {
                    $query->orWhere('telegram_chat_id', '=', $telegramChatId);
                }
            })
            ->orderBy('created_at')
            ->get()->all();

        return collect($flows);
    }

    public function restoreFlow(int $stateId): CommonBotFlowWithState
    {
        /** @var FlowState $state */
        $state = FlowState::query()->findOrFail($stateId);

        if (empty($state)) {
            throw new RuntimeDataInconsistencyErrorException('Requested flow state does not exist');
        }

        if (!is_subclass_of($state->class, CommonBotFlowWithState::class)) {
            throw new RuntimeDataInconsistencyErrorException('Flow state record contains invalid class');
        }

        return new $state->class(app('telegram'), ['id' => $stateId]);
    }
}
