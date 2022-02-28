<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadingDesignPhotosRequest;
use App\Models\MediaTag;
use App\Models\tag;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AdminController extends Controller
{
    public function storePhotos(UploadingDesignPhotosRequest $request) : void
    {

        $designer_photos = $request->file('file');

        $designer = User::find($request->designer_id);

        $media = $designer->addMedia($designer_photos)->toMediaCollection('Design');

        $tags = explode('،', $request->tag);
        foreach ($tags as $tag) {
            $tags_inserted = Tag::firstOrCreate(['name' => $tag]);
            MediaTag::updateOrCreate(['media_id' => $media->id, 'tag_id' => $tags_inserted->id]);

        }
    }
}
