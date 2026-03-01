<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of tags
     */
    public function index(): View
    {
        $tags = Tag::withCount('products')->paginate(10);
        return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new tag
     */
    public function create(): View
    {
        return view('tags.create');
    }

    /**
     * Store a newly created tag in storage
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|unique:tags|max:255',
        ]);

        Tag::create($validated);
        return redirect()->route('tags.index')->with('success', 'Tag created successfully!');
    }

    /**
     * Display the specified tag
     */
    public function show(Tag $tag): View
    {
        $tag->load('products');
        return view('tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified tag
     */
    public function edit(Tag $tag): View
    {
        return view('tags.edit', compact('tag'));
    }

    /**
     * Update the specified tag in storage
     */
    public function update(Request $request, Tag $tag): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|unique:tags,name,' . $tag->id . '|max:255',
        ]);

        $tag->update($validated);
        return redirect()->route('tags.index')->with('success', 'Tag updated successfully!');
    }

    /**
     * Remove the specified tag from storage
     */
    public function destroy(Tag $tag): RedirectResponse
    {
        $tag->delete();
        return redirect()->route('tags.index')->with('success', 'Tag deleted successfully!');
    }
}
