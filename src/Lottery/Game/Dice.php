<?php
use Pluf\Workflow;

Pluf::loadFunction('Pluf_Shortcuts_GetFormForModel');
Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');
Pluf::loadFunction('Pluf_Shortcuts_GetRequestParamOr403');
Pluf::loadFunction('Pluf_Shortcuts_GetRequestParam');

/**
 * Default Order manager
 *
 * @author hadi<mohammad.hadi.mansouri@dpq.co.ir>
 * @author maso<mostafa.barmshory@dpq.co.ir>
 */
class Lottery_Game_Dice extends Lottery_Game_Abstract
{

    /**
     * State machine of the manager
     */
    public function getStates()
    {
        return array(
            Workflow\Machine::STATE_UNDEFINED => array(
                'next' => 'new'
            ),
            // State
            'new' => array(
                'roll' => array(
                    'next' => 'finish',
                    'title' => 'Roll',
                    'visible' => true,
                    'action' => Lottery_Game_Event::ROLL_ACTION,
                    'properties' => Lottery_Game_Event::ROLL_PROPERTIES,
                    'preconditions' => array()
                ),
            ),
            'finish' => array()
        );
    }

    /**
     *
     * {@inheritdoc}
     * @see Lottery_Game_GameInterface::createOrderFilter()
     */
    public function createOrderFilter($request)
    {
        
    }
}
