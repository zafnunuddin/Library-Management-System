<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LegalPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LegalPageController extends Controller
{
    /**
     * List Terms of Use / Privacy Policy so the admin can pick one to edit.
     */
    public function index()
    {
        $pages = LegalPage::orderBy('title')->get();

        return view('admin.legal.index', compact('pages'));
    }

    /**
     * Show the edit form for a single legal page.
     */
    public function edit(string $slug)
    {
        $page = LegalPage::findBySlug($slug);

        abort_if(! $page, 404);

        return view('admin.legal.edit', compact('page'));
    }

    /**
     * Save updated content for a legal page.
     */
    public function update(Request $request, string $slug)
    {
        $page = LegalPage::findBySlug($slug);

        abort_if(! $page, 404);

        $validated = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $page->update([
            'title'      => $validated['title'],
            'content'    => $validated['content'],
            'version'    => $page->version + 1,
            'updated_by' => Auth::id(),
        ]);

        return redirect()
            ->route('admin.legal.index')
            ->with('success', $page->title.' was updated successfully.');
    }
}
