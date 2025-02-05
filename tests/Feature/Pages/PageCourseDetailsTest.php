<?php

use App\Models\Course;
use App\Models\Video;

use function Pest\Laravel\get;

it('does not find unreleased course', function () {
    // Arrange
    $course = Course::factory()->create();

    // Act & Assert
    get(route('pages.course-details', $course))
        ->assertNotFound();
});

it('shows course details', function () {
    // Arrange
    $course = Course::factory()->released()->create();

    // Act & Assert
    get(route('pages.course-details', $course))
        ->assertOk()
        ->assertSeeText([
            $course->title,
            $course->description,
            $course->tagline,
            ...$course->learnings,
        ])
        ->assertSee(asset("images/{$course->image_name}"));
});

it('shows course video count', function () {
    // Arrange
    $course = Course::factory()
        ->released()
        ->has(Video::factory()->count(3))
        ->create();

    // Act & Assert
    get(route('pages.course-details', $course))
        ->assertOk()
        ->assertSeeText('3 videos');
});

it('includes paddle checkout button', function () {
    // Arrange
    config()->set('services.paddle.vendor-id', 'vendor-id');
    $course = Course::factory()
        ->released()
        ->create([
            'paddle_product_id' => 'pri_01j449tat6p71xg1yx22pwnrjt',
        ]);

    // Act & Assert
    get(route('pages.course-details', $course))
        ->assertOk()
        ->assertSee('<script src="https://cdn.paddle.com/paddle/v2/paddle.js"></script>', false)
        ->assertSee('Paddle.Initialize({ token: "vendor-id" });', false)
        ->assertSee('<a href="#" data-theme="light" class="paddle_button mt-8 inline-flex items-center rounded-md border border-transparent bg-yellow-400 py-3 px-6 text-base font-medium text-gray-900 shadow hover:text-red-500"', false);
});

it('includes a title', function () {
    // Arrange
    $course = Course::factory()->released()->create();
    $expectedTitle = config('app.name') . ' - ' . $course->title;

    // Act & Assert
    get(route('pages.course-details', $course))
        ->assertOk()
        ->assertSee("<title>$expectedTitle</title>", false);
});

it('includes social tags', function () {
    // Act & Assert
    $course = Course::factory()->released()->create();
    get(route('pages.course-details', $course))
        ->assertOk()
        ->assertSee([
            '<meta name="description" content="' . $course->description . '">',
            '<meta property="og:type" content="website">',
            '<meta property="og:url" content="' . route('pages.course-details', $course) . '">',
            '<meta property="og:title" content="' . $course->title . '">',
            '<meta property="og:description" content="' . $course->description . '">',
            '<meta property="og:image" content="' . asset("images/{$course->image_name}") . '">',
            '<meta name="twitter:card" content="summary_large_image">',
        ], false);
});
