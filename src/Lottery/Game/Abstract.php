<?php
use Pluf\Workflow;

Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');
Pluf::loadFunction('Pluf_Shortcuts_GetRequestParamOr403');
Pluf::loadFunction('Pluf_Shortcuts_GetRequestParam');

/**
 * Abstract lottery game
 */
abstract class Lottery_Game_Abstract implements Lottery_Game_GameInterface
{

    /**
     *
     * {@inheritdoc}
     * @see Lottery_Game_GameInterface::apply()
     */
    public function apply($order, $action, $save = false)
    {
        $machine = new Workflow\Machine();
        $machine->setStates($this->getStates())
            ->setSignals(array(
            'Lottery_Bet::stateChange'
        ))
            ->setProperty('state')
            ->apply($order, $action);
        if ($save) {
            return $order->update();
        }
        return true;
    }

    /**
     *
     * {@inheritdoc}
     * @see Lottery_Game_GameInterface::transitions()
     */
    public function transitions($order)
    {
        $states = $this->getStates();
        $transtions = array();
        if (! array_key_exists($order->state, $states) || (! is_array($states[$order->state]) && ! is_object($states[$order->state]))) {
            return $transtions;
        }
        foreach ($states[$order->state] as $id => $trans) {
            $trans['id'] = $id;
            // TODO: chech preconditions and return only verified transitions
            unset($trans['preconditions']);
            unset($trans['action']);
            $transtions[] = $trans;
        }
        return $transtions;
    }

    /**
     * Gets list of states
     */
    abstract function getStates();

}
