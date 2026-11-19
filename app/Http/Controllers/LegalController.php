<?php

namespace App\Http\Controllers;

use App\Models\LegalPage;
use Illuminate\Http\Request;

class LegalController extends Controller
{
    /**
     * Show a legal page (Terms of Use or Privacy Policy) to any visitor.
     * The slug is bound via the route ->defaults('slug', ...) in web.php.
     */
    public function show(Request $request, string $slug)
    {
        $page = LegalPage::findBySlug($slug);

        abort_if(! $page, 404);

        // If the request wants JSON (e.g. an API/mobile client), return raw data.
        if ($request->wantsJson()) {
            return response()->json([
                'slug'       => $page->slug,
                'title'      => $page->title,
                'content'    => $page->content,
                'version'    => $page->version,
                'updated_at' => $page->updated_at,
            ]);
        }

        return view('legal.show', compact('page'));
    }
}
