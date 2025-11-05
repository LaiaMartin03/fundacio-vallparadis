<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'birthday' => 'nullable|date|before:today',
            'address' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:20',
            'curriculum' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'active' => 'nullable|boolean',
            'locker' => 'nullable|string|max:255',
            'code' => 'nullable|string|max:255',
            'info_id' => 'nullable|integer|exists:other_table,id', // ajusta el nombre de la tabla
        ]);

        $curriculumPath = null;
        if ($request->hasFile('curriculum')) {
            $curriculumPath = $request->file('curriculum')->store('curriculums', 'public');
        }

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birthday' => $request->birthday,
            'address' => $request->address,
            'phone' => $request->phone,
            'curriculum' => $curriculumPath,
            'active' => $request->active ?? true, // por defecto activo
            'locker' => $request->locker,
            'code' => $request->code,
            'info_id' => $request->info_id,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
