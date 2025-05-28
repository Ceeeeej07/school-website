<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;


class NewsApiController extends Controller
{
    public function getLatest(Request $request)
    {
        $limit = $request->get('limit', 5);
        $news = News::latest()
            ->take($limit)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $news
        ]);
    }
    public function getNewsItem($id)
    {
        $news = News::find($id);

        if (!$news) {
            return response()->json([
                'success' => false,
                'message' => 'News item not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $news
        ]);
    }

    /**
     * Get featured news
     */
    public function getFeatured()
    {

        $news = News::where('featured', true)
            ->orWhere('id', 1) // Fallback to show at least one item
            ->latest()
            ->take(3)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $news
        ]);
    }
}
