<?php

/*
 * This file is part of Pluf Framework, a simple PHP Application Framework.
 * Copyright (C) 2010-2020 Phoinex Scholars Co. (http://dpq.co.ir)
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
 * Lottery pre-condetions 
 *
 */
class Lottery_Precondition
{

    /**
     * Check if the user is logged in.
     *
     * Returns a redirection to the login page, but if not active
     * returns a forbidden error.
     *
     * @param
     *            Pluf_HTTP_Request
     * @return mixed
     */
    static public function loginRequired ($request)
    {
        if (! isset($request->user) or $request->user->isAnonymous()) {
            throw new Pluf_Exception_Unauthorized('Login required', null, '', 
                    'login is required, or cocki is not enabled');
        }
        if (! $request->user->isActive()) {
            throw new \Pluf\Exception('user is not active', 4002, null, 400, '', 
                    'user is not active');
        }
        return true;
    }
    
    /**
     * Check if the user is logged in.
     *
     * Returns true if user is loged in and is active
     *
     * @param
     *            Pluf_HTTP_Request
     * @return boolean
     */
    static public function isLogedIn ($request)
    {
        if (! isset($request->user) or $request->user->isAnonymous()) {
            return false;
        }
        if (! $request->user->isActive()) {
            return false;
        }
        return true;
    }

    /**
     * Check if the user has a given permission..
     *
     * @param
     *            Pluf_HTTP_Request
     * @param
     *            string Permission
     * @return mixed
     */
    static public function hasPerm ($request, $permission)
    {
        $res = self::loginRequired($request);
        if (true !== $res) {
            return $res;
        }
        if ($request->user->hasPerm($permission)) {
            return true;
        }
        throw new \Pluf\Exception('you do not have permission', 4005, null, 400, 
                '', 'you do not have permission');
    }

    static public function ownerRequired ($request)
    {
        $res = Lottery_Precondition::loginRequired($request);
        if (true !== $res) {
            return $res;
        }
        if ($request->user->hasPerm('tenant.owner')) {
            return true;
        }
        throw new Pluf_Exception_PermissionDenied();
    }

    
    static public function isOwner ($request)
    {
        if (! isset($request->user) or $request->user->isAnonymous()) {
            return false;
        }
        // Note: Permission 'Pluf.owner' is deprecated. It is used here for backward compatibility.
        if ($request->user->hasPerm('tenant.owner') || $request->user->hasPerm('Pluf.owner')) {
            return true;
        }
        return false;
    }
    
    
    /**
     * Returns true if user (sending request) can view information of the bet.
     *
     * The creator of an bet or owner of tenant can view the information of the bet
     *
     * @param Pluf_HTTP_Request $request
     * @param Lottery_Bet $bet
     * @return boolean
     */
    public static function canViewBet($request, $order)
    {
        if (self::isOwner($request)) {
            return true;
        }
        if (isset($request->user) && $request->user->id === $order->customer_id) {
            return true;
        }
        return false;
    }

}
