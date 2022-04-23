<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadingDesignPhotosRequest;
use App\Models\MediaTag;
use App\Models\Post;
use App\Models\tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AdminController extends Controller
{
    public function createPost( )
    {
        $post = Post::create();

        return redirect('/post/' . $post->id.'/new');
//        $this->storePhotos($request , $post->id);
    }

    public function newPost()
    {
        $post_id = Str::before(Str::after(url()->current(), 'post/'),'/new');
        $user = auth()->user();
        $designers = User::role('Designer')->get();

        return view('new-post',compact('user','designers','post_id'));
    }
    public function storePost(UploadingDesignPhotosRequest $request ): void
    {
        Post::find($request->post_id)->update(['caption'=>$request->caption]);

        $designer = User::find($request->designer_id);

        $designer_photos = $request->file('file');

        $media = $designer->addMedia($designer_photos)->toMediaCollection('Design');

        if ($request->has('set_private_only')) {
            \App\Models\Media::find($media->id)->update(['privacy' => 'privateOnly']);
        }

        $tags = explode('،', $request->tag);
        foreach ($tags as $tag) {
            $tags_inserted = Tag::firstOrCreate(['name' => $tag]);
            MediaTag::updateOrCreate(['media_id' => $media->id, 'tag_id' => $tags_inserted->id]);
        }

        \App\Models\Media::find($media->id)->update(['post_id' => $request->post_id]);

    }

    public function setAsDesigner()
    {
//todo route
        // assign role designer to new user
        $user->assignRole('Designer');
    }
}
