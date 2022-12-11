<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\episode;
use Illuminate\Http\Request;

class episodeController extends Controller
{
    public function remove(Request $request)
    {
        dd($request);
    }

    public function change(Request $request, $id)
    {
        $episode = episode::find($id);
        // dd(!isset($request->tech_description));
        if(!isset($request->tech_description)){
            $episode->tech_description = null;
        }
        foreach($request->input() as $key => $value){
            if($key === '_token'){
                continue;
            }

            if($episode[$key] === $request->input($key)){
                continue;
            }else {
                $episode[$key] = $request->input($key);
            }
        }
        $episode->save();

        return redirect()->back();
    }

    public function publish($id)
    {
        $episode = episode::find($id);
        $episode->published = 1;
        $episode->save();
        return redirect()->back();
    }
}
