<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdatePasswordRequest;

class PasswordController extends Controller
{
    public function edit()
    {
        return view('user/changepassword');
    }

    /**
 * @param UpdatePasswordRequest $request
 * @return \Illuminate\Http\RedirectResponse
 */
public function update(UpdatePasswordRequest $request)
{
    $request->user()->update([
        'password' => Hash::make($request->get('password'))
    ]);
    return redirect('/user/profile');


    // return redirect()->route('/user');
}
}
