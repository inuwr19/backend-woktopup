<?php

namespace App\Http\Controllers\Api\Auth\Spa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function __invoke(Request $request)
    {
        // Invalidate the session token
        $request->session()->invalidate();

        // Regenerate the CSRF token
        $request->session()->regenerateToken();

        // Logout the user using the web guard
        auth('web')->logout();

        return response()->json(['message' => 'Successfully logged out'], 200);
    }
}
