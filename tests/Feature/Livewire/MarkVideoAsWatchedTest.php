<?php

use App\Http\Livewire\MarkVideoAsWatched;
use App\Models\Course;
use App\Models\Video;
use Livewire\Livewire;

beforeEach(function () {
    $this->logguedInUser = loginAsUser();
});

it('marks video as watched', function () {
    // Arrange
    $course = createCourseAndVideos();
    $video = $course->videos->first();

    $this->logguedInUser->purchasedCourses()->attach($course);

    // Assert
    expect($this->logguedInUser->watchedVideos)->toHaveCount(0);

    // Act & Assert
    Livewire::test(MarkVideoAsWatched::class, ['video_id' => $video->id])
        ->call('markAsWatched');

    // Assert
    $this->logguedInUser->refresh();
    expect($this->logguedInUser->watchedVideos)
        ->toHaveCount(1)
        ->first()->id->toEqual($video->id);
});
