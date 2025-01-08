<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class TestingController extends Controller
{
    public function testing()
    {
        // User::create([
        //     'name' => 'testing3',
        //     'email' => 'testing4@gmail.com',
        //     'password' => '123456789',
        // ]);

        //    upsert

        // $users = [
        //     ['name' => 'test1update', 'email' => 'test1@gmail.com', 'password' => '123456789000'],
        //     ['name' => 'test4', 'email' => 'test4@gmail.com', 'password' => '123456789'],
        // ];
        // User::upsert($users, ['email'], ['name', 'password']);
        //attribute internal state
        // dump($user->wasChanged());
        // dump($user->isDirty());
        // dump($user->isClean());

        // find or && find or fail
        // $user =  User::findOr(100, function () {
        //     return "user not found";
        // });
        // $user =  User::findOrFail(100);

        // first or && first or fail
        // $user =  User::where('id', 400)->firstOrFail();
        // $user =  User::where('id', 4)->firstOr(function(){
        //     return "user not found";
        // });
        ////////////////////////AGREGATES///////////////////
        // sum
        // $courses = Course::sum('price');
        // avg
        // $courses = Course::avg('price');
        // min and max
        // $courses = Course::min('price');
        $courses = Course::max('price');
        dd($courses);
    }
}
