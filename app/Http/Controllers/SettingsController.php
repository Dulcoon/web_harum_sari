<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings.index', [
            'settings' => [
                'store_name' => Setting::get('store_name', 'HOMELIVING'),
                'store_tagline' => Setting::get('store_tagline', 'Modern Furniture for Modern Living'),
                'contact_email' => Setting::get('contact_email', ''),
                'whatsapp_number' => Setting::get('whatsapp_number', ''),
                'default_currency' => Setting::get('default_currency', 'IDR'),
                'store_logo' => Setting::get('store_logo'),
            ],
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'store_name' => ['required', 'string', 'max:255'],
            'store_tagline' => ['nullable', 'string', 'max:500'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'whatsapp_number' => ['nullable', 'string', 'max:20'],
            'default_currency' => ['required', 'string', 'max:10'],
            'store_logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        if ($request->hasFile('store_logo')) {
            $path = $request->file('store_logo')->store('settings', 'public');
            Setting::set('store_logo', $path, 'image');
        }

        foreach (['store_name', 'store_tagline', 'contact_email', 'whatsapp_number', 'default_currency'] as $key) {
            Setting::set($key, $request->$key);
        }

        return redirect()->route('settings.index')->with('success', 'Settings updated successfully.');
    }
}
