<?php

namespace App\Http\Controllers\Api\admin;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Mail\InvitationMail;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function AddUser(Request $request)
    {
        $invitation = Invitation::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'is_admin' => $request->role === 'admin',
            'token' => Str::random(64),
            'expires_at' => now()->addDays(3),
            'invited_by' => $request->user()->id,
        ]);

        Mail::to($invitation->email)
            ->send(new InvitationMail($invitation));

        return back()->with('success', 'Invitation sent successfully.');
    }
    public function deleted($id)
    {


        $data['header_title'] = 'Delete';
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()
            ->route('admin.list', $data)
            ->with('success', 'User deleted successfully.');
    }
    public function update(Request $request, $id)
{
    $data['header_title'] = 'Update';

    $user = User::findOrFail($id);

    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],

        'email' => [
            'required',
            'email',
            Rule::unique('users', 'email')->ignore($user->id),
        ],

        'role' => [
            'required',
            'in:user,editor,admin',
        ],
    ]);


    $validated['is_admin'] = $request->role === 'admin';

    $user->update($validated);

    return redirect()
        ->route('admin.list', $data)
        ->with('success', 'User updated successfully.');

}
}
