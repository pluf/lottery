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

    public const PROPERTY_SUM = array(
        'name' => 'sum',
        'type' => 'String',
        'unit' => 'none',
        'title' => 'Sum',
        'description' => 'The sum of the values appeared on the dices',
        'editable' => true,
        'visible' => true,
        'priority' => 5,
        'defaultValue' => '',
        'validators' => []
    );

    public const PROPERTY_CHANCE = array(
        'name' => 'chance',
        'type' => 'String',
        'unit' => 'none',
        'title' => 'Chance',
        'description' => 'Select your chance: under, over, or equal?',
        'editable' => true,
        'visible' => true,
        'priority' => 5,
        'defaultValue' => '',
        'validators' => []
    );

    public const PROPERTY_AUTOPLAY = array(
        'name' => 'autoplay',
        'type' => 'String',
        'unit' => 'none',
        'title' => 'Autoplay Action',
        'description' => 'The action to be applied automatically',
        'editable' => true,
        'visible' => true,
        'priority' => 5,
        'defaultValue' => '',
        'validators' => []
    );

    /**
     * State machine of the manager
     */
    public function getStates()
    {
        return array(
            Workflow\Machine::STATE_UNDEFINED => array(
                'next' => 'ready',
                'action' => array(
                    'Lottery_Game_Dice',
                    'initBet'
                ),
                'properties' => array(
                    Lottery_Game_Dice::PROPERTY_SUM,
                    Lottery_Game_Dice::PROPERTY_CHANCE
                )
            ),
            // State
            'ready' => array(
                'roll' => array(
                    'next' => 'finished',
                    'title' => 'Roll',
                    'visible' => true,
                    'action' => array(
                        'Lottery_Game_Dice',
                        'roll'
                    ),
                    'properties' => array(),
                    'preconditions' => array()
                ),
                'cancel' => array(
                    'next' => 'canceled',
                    'title' => 'Cancel',
                    'visible' => true
                )
            ),
            'finished' => array(),
            'canceled' => array()
        );
    }

    /**
     *
     * {@inheritdoc}
     * @see Lottery_Game_GameInterface::createOrderFilter()
     */
    public function createBetFilter($request)
    {}

    public static function initBet($request, $bet)
    {
        // Add game parameters as meta
        // sum
        $meta = new Lottery_BetMeta();
        $meta->key = 'sum';
        $meta->value = $request->REQUEST['sum'];
        $meta->bet_id = $bet;
        $meta->create();
        // chance
        $meta = new Lottery_BetMeta();
        $meta->key = 'chance';
        $meta->value = $request->REQUEST['chance'];
        $meta->bet_id = $bet;
        $meta->create();

        // reward
        $bet->reward = self::computeReward($request, $bet);
        $bet->update();
        return $bet;
    }

    public static function roll($request, $bet)
    {
        // Toss dices and save the result
        $dice1 = mt_rand(1, 6);
        $dice2 = mt_rand(1, 6);
        // Save secure metas
        $meta = new Lottery_BetSecMeta();
        $meta->key = 'dice1';
        $meta->value = $dice1;
        $meta->bet_id = $bet;
        $meta->create();
        // chance
        $meta = new Lottery_BetSecMeta();
        $meta->key = 'dice2';
        $meta->value = $dice2;
        $meta->bet_id = $bet;
        $meta->create();

        $chanceMeta = Lottery_BetMeta::getMeta('chance', $bet->id);
        $chance = $chanceMeta->value;
        $sumMeta = Lottery_BetMeta::getMeta('sum', $bet->id);
        $sum = $sumMeta->value;
        $mySum = $dice1 + $dice2;

        switch ($chance) {
            case 'under':
                $bet->is_win = $mySum < $sum;
                break;
            case 'over':
                $bet->is_win = $mySum > $sum;
                break;
            default:
                $bet->is_win = $mySum == $sum;
                break;
        }
        $bet->update();
        return $bet;
    }
    
    public static function computeReward($request, $bet){
        return 2;
    }
}
