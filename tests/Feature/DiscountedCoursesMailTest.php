<?php

use App\Mail\NewPurchasedMail;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

it('includes discount details', function () {
    // Arrange
    $course = Course::factory()->create(['discount' => 20]);
    $discountedCourses = collect([$course]);


    // Act
    $mail = new \App\Mail\DiscountedCoursesEmail($discountedCourses);

    // Assert
    $mail->AssertSeeInText("# Discounted Courses");
    $mail->AssertSeeInText("20% off");
    $mail->AssertSeeInText('Login');
    $mail->AssertSeeInHtml(route('login'));

});
