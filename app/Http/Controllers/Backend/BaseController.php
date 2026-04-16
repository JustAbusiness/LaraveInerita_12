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
    ) {
        $this->service = $service;
    }

    public function handleAction($request, $response, string $redirectRoute, ?string $editRoute = ' '): RedirectResponse
    {
        if ($response) {
            if ($request->input(CommonEnum::SAVE_AND_REDIRECT) && $request->input(CommonEnum::SAVE_AND_REDIRECT) === CommonEnum::REDIRECT) {
                return to_route($redirectRoute);
            }
 
            if (!empty($editRoute)) {
                return to_route($editRoute, $response->id)->with('success', Lang::get('message.save_success'));
            }
            return redirect()->back();
        }
        return redirect()->back()->with('error', Lang::get('message.save_failed'));
    }

}
