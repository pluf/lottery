<?php

/*
 * This file is part of Pluf Framework, a simple PHP Application Framework.
 * Copyright (C) 2010-2020 Phoinex Scholars Co. http://dpq.co.ir
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Profile information of an account in the Lottery module
 *
 */
class Lottery_Profile extends Pluf_Model
{

    function init()
    {
        $this->_a['verbose'] = 'Lottery Profile';
        $this->_a['table'] = 'lottery_profiles';
        $this->_a['cols'] = array(
            // It is mandatory to have an "id" column.
            'id' => array(
                'type' => 'Sequence',
                // It is automatically added.
                'is_null' => true,
                'editable' => false,
                'readable' => true
            ),
            'bets' => array(
                'type' => 'Integer',
                'is_null' => true,
                'default' => 0,
                'editable' => false
            ),
            'wins' => array(
                'type' => 'Integer',
                'is_null' => true,
                'default' => 0,
                'editable' => false
            ),
            /*
             * Foreign keys
             */
            'account_id' => array(
                'type' => 'Foreignkey',
                'model' => 'Lottery_Account',
                'name' => 'account',
                'relate_name' => 'profiles',
                'graphql_name' => 'account',
                'is_null' => false,
                'editable' => false
            )
        );
    }
    
}
