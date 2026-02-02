<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function edit()
    {
        $settings = Setting::first();

        // create default row if not exists
        if (!$settings) {
            $settings = Setting::create([
                'site_name' => 'MyBlog',
                'accent_color' => '#7c5cff',
                'posts_per_page' => 10,
            ]);
        }

        return view('settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = Setting::firstOrFail();

        $data = $request->validate([
            'site_name' => ['required','string','max:60'],
            'tagline' => ['nullable','string','max:120'],

            'accent_color' => ['required','string','max:20'],
            'posts_per_page' => ['required','integer','min:1','max:50'],

            'allow_guest_posts' => ['nullable'],
            'comments_enabled' => ['nullable'],
            'comments_require_approval' => ['nullable'],

            'meta_title' => ['nullable','string','max:70'],
            'meta_description' => ['nullable','string','max:200'],

            'facebook_url' => ['nullable','url','max:255'],
            'instagram_url' => ['nullable','url','max:255'],
            'twitter_url' => ['nullable','url','max:255'],
            'youtube_url' => ['nullable','url','max:255'],

            'logo' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
        ]);

        // checkbox fixes (unchecked = not sent)
        $data['allow_guest_posts'] = $request->boolean('allow_guest_posts');
        $data['comments_enabled'] = $request->boolean('comments_enabled');
        $data['comments_require_approval'] = $request->boolean('comments_require_approval');

        // logo upload
        if ($request->hasFile('logo')) {
            $data['logo_path'] = $request->file('logo')->store('branding', 'public');
        }

        $settings->update($data);

        return back()->with('success', 'Settings saved ✅');
    }
}
