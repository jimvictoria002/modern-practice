<?php

namespace App\Http\Controllers;


use App\Http\Requests\DrinkUpdateRequest;
use App\Http\Resources\DrinkResource;
use App\Models\Drink;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DrinksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Drink/Index', [
            'drinks' => DrinkResource::collection(Drink::latest()->paginate(7))
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Drink/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'price' => 'required|numeric',
        ]);

        Drink::create($validated);

        return redirect()->route('drinks.index')->with('success', 'Drink added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Drink $drink)
    {
        return Inertia::render('Drink/Edit', ['drink' => $drink]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Drink $drink)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'price' => 'required|numeric',
        ]);

        $drink->update($validated);

        return redirect()->route('drinks.index')->with('success', 'Drink updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Drink $drink)
    {
        $drink->delete();
    }
}
