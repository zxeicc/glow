<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InvitationController extends Controller
{
    /**
     * Show the invitation page.
     */
    public function show(string $token)
    {
        $invitation = Invitation::where('token', $token)->first();

        if (!$invitation) {
            abort(404, 'Invitation not found.');
        }

        if ($invitation->accepted_at) {
            redirect('errors.404')->with('This invitation has already been accepted.');
        }

        if ($invitation->expires_at->isPast()) {
            abort(400, 'This invitation has expired.');
        }

        return view('admin.auth.PasswordInvitation', compact('invitation'));

    }


    /**
     * Accept invitation and create the user account.
     */
    public function accept(Request $request, string $token)
    {
        $invitation = Invitation::where('token', $token)->first();

        if (!$invitation) {
            abort(404, 'Invitation not found.');
        }

        if ($invitation->accepted_at) {
            abort(400,'This invitation has already been accepted.');
        }

        if ($invitation->expires_at->isPast()) {
            abort(400, 'This invitation has expired.');
        }

        $validated = $request->validate([
            'password' => [
                'required',
                'string',
                'min:8',
                // 'confirmed',
            ],


]);


        $user = DB::transaction(function () use ($invitation, $validated) {

            $user = User::create([
                'name' => $invitation->name,
                'email' => $invitation->email,
                'password' => Hash::make($validated['password']),
                'is_admin'=>$invitation->is_admin,
                'role' => $invitation->role,
            ]);

            $invitation->update([
                'accepted_at' => now(),
            ]);

            return $user;
        });

        return redirect()
            ->route('admin.login')
            ->with('success', 'Your account has been created successfully.');
    }
}
