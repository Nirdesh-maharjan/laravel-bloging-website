<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');

        $media = Media::query()
            ->when($q, function ($query) use ($q) {
                $query->where('file_name', 'like', "%{$q}%");
            })
            ->latest()
            ->paginate(18)
            ->withQueryString();

        return view('media.index', compact('media', 'q'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'files' => ['required'],
            'files.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        foreach ($request->file('files') as $file) {
            $path = $file->store('media', 'public');

            Media::create([
                'user_id' => auth()->id(),
                'file_path' => $path,
                'file_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getClientMimeType(),
                'size' => $file->getSize(),
            ]);
        }

        return back()->with('success', 'Media uploaded ✅');
    }

    public function destroy(Media $medium)
    {
        // optional: only owner can delete
        if ($medium->user_id !== auth()->id()) {
            abort(403);
        }

        Storage::disk('public')->delete($medium->file_path);
        $medium->delete();

        return back()->with('success', 'Media deleted ✅');
    }
}
