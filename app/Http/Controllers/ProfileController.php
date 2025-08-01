<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\{Auth, Hash, Storage};
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('admin.profiles.index', compact('user'));
    }

    public function updateProfile(ProfileUpdateRequest $request)
    {
        $user = Auth::user();

        $data = $request->validated();

        if ($request->hasFile('profile_image')) {
            $this->deleteOldImage($user->profile_image);
            $data['profile_image'] = $this->storeImage($request->file('profile_image'));
        }

        $user->update($data);

        return back()->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::userOrFail();

        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password updated successfully!');
    }

    public static function getProfileImageUrl(User $user): string
    {
        return $user->profile_image && Storage::disk('public')->exists("profile-images/{$user->profile_image}")
            ? asset("storage/profile-images/{$user->profile_image}")
            : asset('images/default-avatar.png');
    }

    private function deleteOldImage(?string $imageName): void
    {
        if ($imageName && Storage::disk('public')->exists("profile-images/{$imageName}")) {
            Storage::disk('public')->delete("profile-images/{$imageName}");
        }
    }

    private function storeImage($image): string
    {
        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('profile-images', $imageName, 'public');
        return $imageName;
    }
}
