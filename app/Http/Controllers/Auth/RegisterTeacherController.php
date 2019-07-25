<?php

namespace App\Http\Controllers\Auth;

use App\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RegisterTeacherController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest:teacher');
    }
    public function showRegistrationForm()
    {
        return view('auth.teacher.register');
    }
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'surname'     => 'required|string|max:255',
            'name'     => 'required|string|max:255',
            'patronymic'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        try {
            $validatedData['password']        = bcrypt(array_get($validatedData, 'password'));
            $teacher = app(Teacher::class)->create($validatedData);
            if (Auth::guard('teacher')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
                // if successful, then redirect to their intended location
                return redirect()->intended(route('teacher.dashboard'));
            }


        } catch (\Exception $exception) {
            logger()->error($exception);
            return redirect()->back()->with('message', 'Невозможно создать нового преподавателя.');
        }
    }
}
