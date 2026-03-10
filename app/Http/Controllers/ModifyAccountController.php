<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

/**
 * Controller responsible for modifying authenticated users' account details.
 * Provides methods to update the user's name, change their password and
 * permanently delete the account. To use this controller, register the
 * appropriate routes in your `routes/web.php` file and protect them with
 * authentication middleware.
 */
class ModifyAccountController extends Controller
{
    /**
     * Show the modify account form.
     */
    public function edit()
    {
        return view('modify-account');
    }

    /**
     * Update the user's name.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->save();

        return back()->with('success', 'Name updated successfully.');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = Auth::user();

        // Verify current password
        if (! Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password is incorrect.');
        }

        $user->password = $request->password;
        $user->save();

        return back()->with('success', 'Password updated successfully.');
    }

    /**
     * Permanently delete the authenticated user's account.
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Your account has been deleted.');
    }
}
