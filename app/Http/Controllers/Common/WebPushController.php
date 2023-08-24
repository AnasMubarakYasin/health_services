<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\Common\SubscribeRequest;
use App\Models\Patient;
use Illuminate\Http\Request;

class WebPushController extends Controller
{
    public function public_key()
    {
        return response()->json(env('VAPID_PUBLIC_KEY'));
    }
    public function subscribe(SubscribeRequest $request)
    {
        /** @var Patient */
        $user = auth()->user();
        $data = $request->validated();
        $endpoint = $data['endpoint'];
        $key = $data['keys']['p256dh'];
        $token = $data['keys']['auth'];
        $user->updatePushSubscription($endpoint, $key, $token, 'aesgcm');
        return response()->json(status: 201);
    }
    public function unsubscribe(Request $request)
    {
        /** @var User */
        $user = auth()->user();
        $user->deletePushSubscription(request()->input('endpoint'));
        return response()->json(status: 200);
    }
}
