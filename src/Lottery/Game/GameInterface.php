<?php

/**
 * Manages bets in different states and handles events on bets.
 * 
 * The game should manage bets in different states and handle events on bets.
 * Each implementation could define its own states and events for bets. 
 * However all implementations should handle the following events:
 * <ul>
 * <li>create: to create a new bet this event will be occured</li>
 * <li>update: to update an bet this event will be occured</li>
 * <li>delete: to delete an bet this event will be occured</li>
 * </ul>
 * 
 */
interface Lottery_Game_GameInterface
{

    /**
     * Creates an bet filter
     * 
     * This filter is used to list bets based on states and the request. For
     * example, all bets will be displayed to the owner of the system.
     *
     * @param Pluf_HTTP_Request $request
     * @return Pluf_SQL
     */
    public function createBetFilter ($request);

    /**
     * Apply action on bet
     *
     * @param Lottery_Bet $bet
     * @param String $action
     * @param Boolean $save to save or not the bet
     * @return Lottery_Bet
     */
    public function apply ($bet, $action, $save = false);

    /**
     * Returns possible transitions for given bet
     * 
     * Returns possible transitions respect to currecnt state of given bet.
     *
     * @param Lottery_Bet $bet
     * @return array array of transitions
     */
    public function transitions ($bet);
}