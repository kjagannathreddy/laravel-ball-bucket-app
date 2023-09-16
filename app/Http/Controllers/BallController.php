<?php

namespace App\Http\Controllers;
use App\Models\Ball;

use Illuminate\Http\Request;

class BallController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $balls = Ball::latest()->paginate(5);
        return view("ball_index", compact('balls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create-ball');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                "name" => "required",
                "volume" => "required"
            ]
        );

        $ball = Ball::create($request->all());

        if(!is_null($ball)) {
            return back()->with("success", "Success! Ball created");
        }
        else {
            return back()->with("failed", "Alert! Ball not created");
        }
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the item by ID and delete it
        Ball::find($id)->delete();

        return redirect()->route('balls.index')
            ->with('success', 'Ball deleted successfully.');
    }
}
