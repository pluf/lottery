<?php

class Lottery_Game_Event
{

    /*
     * Properties
     */
    public const PROPERTY_BET = array(
        'name' => 'bet',
        'type' => 'Float',
        'unit' => 'none',
        'title' => 'Bet',
        'description' => 'Value of the bet',
        'editable' => true,
        'visible' => true,
        'priority' => 5,
        'defaultValue' => '',
        'validators' => []
    );

    // End of properties

    /*
     * Actions
     */
    public const ROLL_ACTION = array(
        'Lottery_Game_Event',
        'roll'
    );

    public const ROLL_PROPERTIES = array(
        self::PROPERTY_BET
    );

    // End of actions
    
    /**
     * Roll for a bet
     *
     * @param Pluf_HTTP_Request $request
     * @param Lottery_Bet $object
     */
    public static function roll($request, $object)
    {
        
    }
    
}