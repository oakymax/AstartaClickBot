<?php

namespace App\Botflow\Contracts;

use App\Botflow\Contracts\CommonBotFlowWithState;

abstract class CommonBotDialog extends CommonBotFlowWithState
{


    /**
     * @return array
     *
     *  [
     *      [
     *           'name' => 'date',
     *           'message' => 'Дата платежа',
     *           'rules' => ['date'],
     *      ],
     *      [
     *           'name' => 'amount',
     *           'message' => 'Сумма платежа',
     *           'rules' => ['money'],
     *      ],
     *      [
     *           'name' => 'link_to_check',
     *           'message' => 'Ссылка на чек',
     *           'rules' => ['url'],
     *      ],
     *  ]
     */
    protected abstract function questions(): array;



}