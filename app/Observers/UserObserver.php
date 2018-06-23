<?php

namespace App\Observers;

use App\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class UserObserver
{
    public function creating(User $user)
    {
        $this->uploadPhoto($user);
    }

    public function updating(User $user)
    {
        $this->uploadPhoto($user);
    }

    public function deleting(User $user)
    {
        $this->deletePhoto($user->photo);
    }

    private function uploadPhoto(User $user)
    {
        if (is_a($user->photo, UploadedFile::class) && $user->photo->isValid()) {
            $this->deletePhoto($user->getOriginal('photo'));
            $this->createThumbnail($user->photo);
            $user->photo->store(User::AVATARS_PATH, ['disk' => 'public']);
            $user->photo = $user->photo->hashName();
        }
    }

    private function createThumbnail(UploadedFile $imageFile)
    {
        $img = Image::make($imageFile->getRealPath());
        $img->fit(250, 250)->save();
    }
    private function deletePhoto($imagePath)
    {
        $path = User::AVATARS_PATH . $imagePath;
        if (file_exists(public_path($path))) {
            Storage::disk('public')->delete($path);
        }
    }
}
