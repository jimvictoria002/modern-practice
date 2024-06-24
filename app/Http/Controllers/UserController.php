<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response 
    {

        return Inertia::render('Users/Index', [
            'users' => UserResource::collection(User::where('access', '!=', '1')->latest()->paginate(7))
        ]); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return Inertia::render('Users/Edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user)
    {

        // Check if the user email is being changed
        if ($request->validated()['email'] != $user->email) {
            // Reset email verification
            $user->email_verified_at = null;

            // Update the user with validated data
            $user->update($request->validated());

            // Send a new email verification notification
            $user->sendEmailVerificationNotification();

            return redirect()->route('users.index')->with('success', 'User updated successfully!');
        }

        // Update the user with validated data
        $user->update($request->validated());

        // Add a flash message and redirect to users index
        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        
    }
}
