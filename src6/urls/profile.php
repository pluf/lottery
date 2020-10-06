<?php
return array(
    // ************************************************** Lottery Profile of account
    array( // Read (list)
        'regex' => '#^/accounts/(?P<parentId>\d+)/profiles$#',
        'model' => 'Pluf_Views',
        'method' => 'findManyToOne',
        'http-method' => 'GET',
        'precond' => array(
            'Lottery_Precondition::loginRequired'
        ),
        'params' => array(
            'parent' => 'Lottery_Account',
            'parentKey' => 'account_id',
            'model' => 'Lottery_Profile'
        )
    ),
    array( // Read
        'regex' => '#^/accounts/(?P<parentId>\d+)/profiles/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'getManyToOne',
        'http-method' => 'GET',
        'precond' => array(
            'Lottery_Precondition::loginRequired'
        ),
        'params' => array(
            'parent' => 'Lottery_Account',
            'parentKey' => 'account_id',
            'model' => 'Lottery_Profile'
        )
    ),
);