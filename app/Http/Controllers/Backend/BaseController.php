<?php

namespace App\Http\Controllers\Backend;

use App\Enum\CommonEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Lang;

class BaseController extends Controller
{
    protected $service;
    public function __construct(
        $service
    )
    {
        $this->service = $service;
    }

    public function handleAction($request, $response, string $redirectRoute): RedirectResponse {
        if ($response) {
            if ($request->input(CommonEnum::SAVE_AND_REDIRECT) ) {
                 return redirect()->intended(route($redirectRoute, absolute: false));
            }
            return redirect()->back(); 
        }
        return redirect()->back()->with('error', Lang::get('message.save_failed'));
    }

}
