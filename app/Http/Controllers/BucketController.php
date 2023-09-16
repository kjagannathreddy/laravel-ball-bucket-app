<?php

namespace App\Http\Controllers;

use App\Models\Bucket;
use Illuminate\Http\Request;

class BucketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buckets = Bucket::latest()->paginate(5);
        return view("bucket_index", compact('buckets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create-bucket');

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

        $bucket = Bucket::create($request->all());

        if(!is_null($bucket)) {
            return back()->with("success", "Success! Bucket created");
        }
        else {
            return back()->with("failed", "Alert! Bucket not created");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('show-bucket', compact('bucket'));

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
        Bucket::find($id)->delete();

        return redirect()->route('buckets.index')
            ->with('success', 'Bucket deleted successfully.');
    }
}
