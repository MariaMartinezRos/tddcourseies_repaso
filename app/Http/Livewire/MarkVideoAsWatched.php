<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MarkVideoAsWatched extends Component
{
    public $video_id;

    public function markAsWatched(): void
    {
        $user = Auth::user();
        $user->watchedVideos()->attach($this->video_id);
    }
    public function render(): Factory|Application|View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.mark-video-as-watched');
    }
}
