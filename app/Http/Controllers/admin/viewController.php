<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\episode;
use App\Models\post;
use App\Models\season;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class viewController extends Controller
{
    public function loginView()
    {
        return view('admin.account.login');
    }

    public function createView()
    {
        return view('admin.account.create');
    }

    public function adminView()
    {
        return view('admin.admin');
    }

    public function newsView()
    {
        $posts = post::all();
        return view('admin.news', [
            'posts' => $posts
        ]);
    }

    public function episodesView()
    {
        
        $episodes = episode::all();
        $seasons = $episodes->unique('season');
        return view('admin.episodes', [
            'seasons' => $seasons,  
            'episodes' => $episodes
        ]);
    }

    public function currentEpisodeView($idEpisode)
    {
        $seasons = season::all();
        $episode = episode::find($idEpisode);
        $allEpisodes = episode::all();

        $prevEpisode = episode::find($episode->prev_episode);
        $nextEpisode = episode::find($episode->next_episode);        
        return view('admin.current-episode', [
            'prevEpisode' => $prevEpisode,
            'nextEpisode' => $nextEpisode,
            'allEpisodes' => $allEpisodes,
            'seasons' => $seasons,
            'episode' => $episode
        ]);
    }

}
