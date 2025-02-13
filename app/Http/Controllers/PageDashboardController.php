<?php

namespace App\Http\Controllers;

class PageDashboardController extends Controller
{
    public function __invoke()
    {
        // Cargar los videos relacionados con lo s cursos en una sola consulta
        $purchasedCourses = auth()->user()->purchasedCourses()->with('videos')->get();

        return view('pages.dashboard', compact('purchasedCourses'));
    }
}
