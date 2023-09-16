<?php

namespace App\Http\Controllers;

use App\Models\Ball;
use App\Models\Bucket;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class OutputController extends Controller
{
    /**
     * Display ball, buckets and suggestion form
     */
    public function index()
    {
        $balls = Ball::latest()->paginate(5);
        $buckets = Bucket::latest()->paginate(5);
        $filledBuckets = [];

        return view("index", compact('balls','buckets','filledBuckets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    public function showOutput(Request $request){

        $ballsByColor = $request->all()['records'];

        $buckets = Bucket::all();
        $balls = Ball::all();

        $filledBuckets = [];

        // Call the fillBuckets function and display the result
        $filledBuckets = $this->fillBuckets($ballsByColor, $buckets);

        return view('index',compact('balls','buckets','filledBuckets'));
    }

    /**
     * Function to fill the buckets with balls
     * @param array $ballsByColor
     * @param Collection $buckets
     * @return array
     */

    public function fillBuckets(array $ballsByColor, Collection $buckets): array
    {
        // Sort the buckets by capacity in descending order
       $buckets = collect($buckets)->sortBy('volume')->reverse()->toArray();
        
        // Iterate through each bucket and distribute the balls
        foreach ($buckets as $bucket) {
            $bucketCapacity = $bucket['volume'];
        
            // Create a new bucket
            $filledBucket = [
                'id' => $bucket['id'],
                'name' => $bucket['name'],
                'capacity' => $bucketCapacity,            ];
            // Iterate through each color of the balls
            foreach ($ballsByColor as $color => $ballData) {
                $count = $ballData['count'];
                $size = $ballData['volume'];
                $name = $ballData['name'];
                $id = $ballData['id'];

                // Calculate the number of balls that can fit in the bucket
                $ballsToAdd = min($count, floor($bucketCapacity / $size));
              
                // Add the balls to the bucket
                for ($i = 0; $i < $ballsToAdd; $i++) {
                    $filledBucket[$name] = $size;

                    $filledBucket['filled_balls'][$name] = ($filledBucket['filled_balls'][$name] ?? 0) + 1;
                    $bucketCapacity -= $size;
                    $count--;
                    $filledBucket['remaining'] = $bucketCapacity;
                }
        
                // Update the remaining balls count and bucket capacity
                $ballsByColor[$id]['count'] = $count;
                // Check if the bucket is full
                if ($bucketCapacity <= 0) {
                    break;
                }
            }
        
            // Add the filled bucket to the array of filled buckets
            $filledBuckets[] = $filledBucket;
        }
        return $filledBuckets;
    }

}
