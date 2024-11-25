<?php

use App\Livewire\Pages\Home;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', Home::class)->name('home');

Route::post('/upload-temporary-video', function (Request $request) {
    $request->validate([
        'video' => 'required|mimes:mp4|max:51200', // 50 MB de limite
    ]);

    $path = $request->file('video')->store('videos/tmp');

    return response()->json(['success' => true, 'path' => $path]);
});
