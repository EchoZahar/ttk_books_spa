<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadCoverController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png,pdf|max:512'
        ]);
        if ($request->hasFile('cover')) {
            return $request->file('cover')->store('covers');
        }
    }
}
