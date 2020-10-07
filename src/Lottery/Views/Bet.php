<?php
Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');

class Lottery_Views_Bet
{

    /**
     * Creates a new bet
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @return Lottery_Bet
     */
    public static function create($request, $match)
    {
        $obj = Pluf::factory('Lottery_Bet');
        $obj->_a['cols']['game']['editable'] = true;
        $obj->_a['cols']['bet']['editable'] = true;
        $obj->_a['cols']['account_id']['editable'] = true;
        $user = $request->user;
        $request->REQUEST['account_id'] = $user->id;
        Pluf::loadFunction('Pluf_Shortcuts_GetFormForModel');
        $form = Pluf_Shortcuts_GetFormForModel($obj, $request->REQUEST);
        /**
         *
         * @var Lottery_Bet $bet
         */
        $bet = $form->save();
        // if (isset($user)) {
        // $bet->account_id = $user;
        // }
        // $bet->update();
        $game = $bet->getGame();
        $game->apply($bet, 'create');
        return $bet;
    }

    /**
     * Lists all requests
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @return
     */
    public static function find($request, $match)
    {
        $bet = new Lottery_Bet();
        $game = $bet->getGame();
        $sql = $game->createBetFilter($request);
        $builder = new Pluf_Paginator_Builder($bet);
        return $builder->setRequest($request)
            ->setWhereClause($sql)
            ->build();
    }

    /**
     * یک درخواست را با شناسه تعیین می‌کند
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @return Lottery_Bet
     */
    public static function get($request, $match)
    {
        // Get bet
        $bet = Pluf_Shortcuts_GetObjectOr404('Lottery_Bet', $match['betId']);
        // check access
        if (! Lottery_Precondition::canViewBet($request, $bet)) {
            return new Pluf_Exception_Unauthorized('You are not allowed to do this action.');
        }
        return $bet;
    }

    // ***********************************************************
    // Workflow
    // **********************************************************
    /**
     * Gets list of possible actions
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @return array an array of transitions
     */
    public function actions($request, $match)
    {
        $bet = Pluf_Shortcuts_GetObjectOr404('Lottery_Bet', $match['betId']);
        $items = $bet->getGame()->transitions($bet);
        $page = array(
            'items' => $items,
            'counts' => count($items),
            'current_page' => 1,
            'items_per_page' => count($items),
            'page_number' => 1
        );

        return $page;
    }

    public static function doAction($request, $match)
    {
        $bet = Pluf_Shortcuts_GetObjectOr404('Lottery_Bet', $match['betId']);
        $action = $request->REQUEST['action'];
        $game = $bet->getGame();
        if ($game->apply($bet, $action, true)) {
            $updatedBet = Pluf_Shortcuts_GetObjectOr404('Lottery_Bet', $bet->id);
            return $updatedBet;
        }
        return new \Pluf\Exception('An error is occurred while processing bet');
    }
}
