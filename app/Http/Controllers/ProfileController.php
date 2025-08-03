<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\ImageService;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\{Auth, Hash, Storage};

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('admin.profiles.index', compact('user'));
    }

    public function updateProfile(ProfileUpdateRequest $request, ImageService $imageService)
    {
        $user = Auth::user();
        $data = $request->validated();

        if ($request->hasFile('profile_image')) {
            $imageService->deleteImage($user->profile_image);
            $data['profile_image'] = $imageService->storeImage($request->file('profile_image'), $user->id);
        }

        $user->update($data);
        return back()->with('success', 'Profile updated successfully!');
    }
}
