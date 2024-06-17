<?php

namespace App\Http\Controllers\User;

use App\Exceptions\UserNotFoundException;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id)
    {

        $user = User::find($id);
        if (!$user) {
            throw new UserNotFoundException('User not founds');
        }
        dd($user);

        // try {
        //     $user = User::findOrFail($id);
        //     dd($user);
        // } catch (\Exception $e) {
        //     dd($e->getMessage());
        // }
    }
}
