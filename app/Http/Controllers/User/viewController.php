<?php

namespace App\Http\Controllers\User;

use App\Models\comment;
use App\Models\episode;
use App\Http\Controllers\Controller;
use App\Models\season;
use Illuminate\Http\Request;

class viewController extends Controller
{
    public function watchView($season, $episode)
    {
        $episodes = episode::where('published', '=', '1')->select('season', 'number', 'name')->get();
        $seasons = $episodes->unique('season');

        $currentEpisode = episode::where('season', '=', $season)->where('number', '=', $episode)->get()[0];
        $prevEpisode = episode::find($currentEpisode->prev_episode);
        $nextEpisode = episode::find($currentEpisode->next_episode);

        
        // Выборка из БД всех комментариев текущей записи с `$id`.
        $comments = comment::where('post_id', '=', $currentEpisode->id)->orderBy('created_at', 'desc')->get();

        // Изменяем коллекцию.
        $comments->transform(function ($comment) use ($comments) {
        // Добавляем к каждому комментарию дочерние комментарии.
        $comment->children = $comments->where('parent_id', $comment->id);
        if($comment->parent_id){
            $comment->setAttribute('parent_name', comment::find($comment->parent_id)->name);
        }
        return $comment;
        });

        // Удаляем из коллекции комментарии у которых есть родители.
        $comments = $comments->reject(function ($comment) {
        return $comment->parent_id !== null;
        });

        // dd($comments);

        return view('watch', [
            'currentEpisode' => $currentEpisode,
            'prevEpisode' => $prevEpisode,
            'nextEpisode' => $nextEpisode,
            'seasons' => $seasons,
            'episodes' => $episodes,
            'comments' => $comments
        ]);
    }

    public function welcomeView()
    {
        $seasons = season::all();
        // dd($seasons);
        return view('welcome', [
            'seasons' => $seasons
        ]);
        
    }

    public function videoView(Request $request, $season, $episode)
    {
        $currentEpisode = episode::where('season', '=', $season)->where('number', '=', $episode)->get()[0];
        return view('layouts.video', [
            'currentEpisode' => $currentEpisode,
        ]);
    }

    public function newsWelcomeView()
    {
        return view('news.news', []);
    }

    public function timetableView()
    {
        $episodes = episode::select('season', 'number', 'name', 'published', 'date_published')->orderBy('id', 'desc')->get();
        $seasons = $episodes->unique('season');
        return view('news.timetable', [
            'episodes' => $episodes,
            'seasons' => $seasons
        ]);
    }
}
