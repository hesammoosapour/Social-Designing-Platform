<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadingDesignPhotosRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\MediaTag;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Models\Role;

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

        \App\Models\Media::find($media->id)->update(['post_id' => $request->post_id]);

        $tags_for_explosion =  explode('،', $request->tag);
        foreach ($tags_for_explosion as $tag) {

            $tagsExploded[] = preg_split('/[\s,-]+/', $tag);
        }
        $tagsExploded = Arr::flatten($tagsExploded);
        foreach ($tagsExploded as $tag) {
            $tags_inserted = Tag::firstOrCreate(['name' => $tag]);
            MediaTag::updateOrCreate(['media_id' => $media->id, 'tag_id' => $tags_inserted->id]);
        }



    }

    public function setAsDesigner()
    {
//todo route
        // assign role designer to new user
        $user->assignRole('Designer');
    }

    public function users()
    {
        $admin = auth()->user();
        $users = User::withTrashed()->paginate(15);
        return view('admin.users',compact('users','admin'));
    }

    public function userEdit()
    {
        $admin = auth()->user();
        $user_username = Str::after(url()->current(),route('admin') . '/');

        $user = User::whereUsername($user_username)->first();

        $roles_available = Role::where('name','!=','Admin')->pluck('name','id');

        $user_role_id =  $user->roles->first()->id;

        return view('admin.user-edit',compact('user','admin','roles_available','user_role_id'));
    }

    public function userUpdate(UserEditRequest $request)
    {
        $user_username = Str::after(url()->current(),route('admin') . '/');
        $user_username = Str::before($user_username, '/update');
        $user = User::whereUsername($user_username)->first();

// get first role if only user can 1 role at same the time.
        $user->roles->first()->pivot->update(['role_id'=>$request->role_id]);

        $data = ['name' => $request->name, 'username' => $request->username];
        if ($user->update($data)) {
            Session::flash('updated_user', 'با موفقیت کاربر آپدیت شد.');
        }
        return back();
    }
}
