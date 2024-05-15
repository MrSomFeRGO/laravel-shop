<?php

namespace App\Http\Middleware;

use App\Data\AuthData;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $auth = $request->user() ? $request->user()->toArray() : null;
        if ($auth != null) {
            $auth['isVerified'] = $request->user()->hasVerifiedEmail();
            $auth['canEditOrders'] = $request->user()->hasPermissionTo('edit orders');
            $auth = AuthData::from($auth);
        }
        return [
            ...parent::share($request),
            'auth' => $auth,
            'flash' => [
                'status' => session('status')
            ],
        ];
    }
}
