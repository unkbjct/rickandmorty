<?php

namespace App\Http\Controllers\User;

use App\Models\comment;
use App\Models\episode;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class commentCorntroller extends Controller
{
    public function create(Request $request, $season, $episode)
    {

        if(isset($request->saveData)) {
            session(['name' => $request->name, 'email' => $request->email]);
        }

        $currentEpisode = episode::where('season', '=', $season)->where('number', '=', $episode)->get()[0];
        $comment = new comment();

        $oldUser = comment::where('email', '=', $request->email)->get();
        if (!sizeof($oldUser)) {
            $dir = opendir(storage_path('app\public\img\avatars'));
            $count = 0;
            while ($file = readdir($dir)) {
                if ($file == '.' || $file == '..' || is_dir('path/to/dir' . $file)) {
                    continue;
                }
                $count++;
            }
            $comment->img = asset('public/storage/img/avatars\\') . rand(1, $count) . '.png';
        } else {
            $comment->img = $oldUser[0]->img;
        }


        $dir = opendir(storage_path('app\public\img\avatars'));
        $count = 0;
        while ($file = readdir($dir)) {
            if ($file == '.' || $file == '..' || is_dir('path/to/dir' . $file)) {
                continue;
            }
            $count++;
        }

        if($request->parent_id){
            $comment->parent_id = $request->parent_id;
        }

        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->message = $request->message;
        $comment->post_id = $currentEpisode->id;
        $comment->save();


        return redirect()->back();
        dd($comment);
    }
}
