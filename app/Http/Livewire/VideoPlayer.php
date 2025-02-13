<?php

namespace App\Http\Livewire;

use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VideoPlayer extends Component
{
    public $video;

    public $courseVideos;

//    protected $listeners = ['videoEnded' => 'markAsWatched'];
//
//    public function markAsWatched(): void
//    {
//        $user = Auth::user();
//        $user->watchedVideos()->attach($this->video->id);
//        $this->emit('videoWatched', $this->video->id);
//    }

    public function mount(): void
    {
        $this->courseVideos = $this->video->course->videos;
    }

    public function markVideoAsCompleted(): void
    {
        auth()->user()->watchedVideos()->attach($this->video);
    }

    public function markVideoAsNotCompleted(): void
    {
        auth()->user()->watchedVideos()->detach($this->video);
    }

    public function isCurrentVideo(Video $videoToCheck): bool
    {
        return $this->video->id === $videoToCheck->id;
    }

    public function render()
    {
        return view('livewire.video-player');
    }
}
