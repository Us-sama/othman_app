<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index' , compact('users'));
    }

    public function create(){
        return view('users.create');
    }
    public function edit($user){
        $user = User::findOrFail($user);
        return view('users.create',compact('user'));
    }
    public function store(Request $request, $id = null)
    {

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($id)],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        if (is_null($id)) {
            // Creating a new user
            $user = User::create($data);
            $user->assignRole($request->role);
            $user->save();

            return redirect()->route('user.list')->with('success', 'Utilisateur créé avec succès');
        } else {
            // Updating an existing user
            $user = User::findOrFail($id);
            $user->update($data);

            // Update the user's role
            $user->removeRole($user->roles->first()->name);
            $user->assignRole($request->role);

            return redirect()->route('user.list')->with('success', 'Utilisateur mis à jour avec succès');
        }
    }

    public function destroy($user){

        $user = User::findOrFail($user);

        if ($user->id === Auth::id()){
            return abort(403);
        }

        $user->active = false;
        $user->save();

        return redirect()->route('user.list')->with('success', 'Utilisateur supprimée avec succès');
    }











    // public function update(Request $request,$user)
    // {
    //     $user = User::findOrFail($user);
    //     if($user->name != $request->input('email')){
    //         $request->validate([
    //             'name' => ['required', 'string', 'max:255'],
    //             'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
    //             'password' => ['required', 'confirmed', Rules\Password::defaults()],
    //         ]);
    //     }

    //     $user->name = $request->input('name');
    //     if($user->name != $request->input('email'))
    //     {
    //         $user->name = $request->input('email');
    //     }
    //     if($request->input('password')){
    //         $user->name = Hash::make($request->input('passsword'));
    //     }
    //     $user->assignRole($request->role);

    //     $user->save();

    //     return redirect()->route('user.list')->with('success','utilisateur modifié avec success');
    // }

}
