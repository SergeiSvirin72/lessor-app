<?php

namespace App\Http\Controllers;

use App\Gateways\InviteGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class InviteController extends Controller
{
    /**
     * Создает ссылку приглашения в компанию.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function invite() {
        $url = URL::signedRoute('join', ['team_id' => Auth::user()->team_id]);
        return redirect('/employees')->with('invite_url', $url);
    }

    /**
     * Добавляет пользователя в компанию.
     *
     * @param Request $request
     * @param InviteGateway $gateway
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function join(Request $request, InviteGateway $gateway) {
        if (! $request->hasValidSignature()) {
            abort(401);
        }

        $gateway->join(Auth::user(), $request->team_id);
        return redirect('/');
    }
}
