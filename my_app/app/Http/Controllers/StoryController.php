<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller; // ✅ Add t
class StoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'story_image' => 'nullable|file|max:102400',
            'story_video' => 'nullable|file|max:102400',
            'story_text'  => 'nullable|string|max:1000',
            'media'       => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov,avi|max:102400',
        ]);
        

        $media = $request->file('media');
        $path = $media->store('stories', 'public');

        $mediaType = in_array($media->getClientOriginalExtension(), ['mp4', 'mov', 'avi']) ? 'video' : 'image';

        Story::create([
            'user_id' => Auth::id(),
            'media_url' => Storage::url($path),
            'media_type' => $mediaType,
            'text' => $request->input('text'),
        ]);

        return back()->with('success', 'Story uploaded!');
    }
}
