<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::all();

        return response()->json([
            'portfolios' => $portfolios,

        ], 200);
    }

    // Store a newly created portfolio in storage
    public function store(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'service_id' => 'required|exists:services,id',
            'img_path' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        $imagePath = $request->file('img_path')->store('portfolio_images', 'public');

        // Create a new portfolio entry
        $portfolio = Portfolio::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'service_id' => $validated['service_id'],
            'img_path' => $imagePath,
        ]);

        return response()->json([
            'message' => 'Portfolio created successfully!',
            'portfolio' => $portfolio
        ], 201);
    }

    // Display the specified portfolio
    public function show($id)
    {
        // Find portfolio by ID
        $portfolio = Portfolio::findOrFail($id);

        return response()->json($portfolio);
    }

    // Update the specified portfolio in storage
    public function update(Request $request, $id)
    {
        // Find portfolio by ID
        $portfolio = Portfolio::findOrFail($id);

        // Validate incoming request
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'service_id' => 'nullable|exists:services,id',
            'img_path' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update fields only if provided
        if ($request->has('title')) {
            $portfolio->title = $validated['title'];
        }
        if ($request->has('description')) {
            $portfolio->description = $validated['description'];
        }
        if ($request->has('service_id')) {
            $portfolio->service_id = $validated['service_id'];
        }
        if ($request->hasFile('img_path')) {
            // Handle new image upload if provided
            $imagePath = $request->file('img_path')->store('portfolio_images', 'public');
            $portfolio->img_path = $imagePath;
        }

        // Save the updated portfolio
        $portfolio->save();

        return response()->json([
            'message' => 'Portfolio updated successfully!',
            'portfolio' => $portfolio
        ]);
    }

    // Remove the specified portfolio from storage
    public function destroy($id)
    {
        // Find portfolio by ID
        $portfolio = Portfolio::findOrFail($id);

        // Delete the portfolio
        $portfolio->delete();

        return response()->json([
            'message' => 'Portfolio deleted successfully!',
        ]);
    }
}
