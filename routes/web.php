<?php

use App\Livewire\Form;
use Illuminate\Support\Facades\Route;

\Illuminate\Support\Facades\Route::get('form', Form::class);
Route::get('/shop/products/products/{product}/card/card-builder', function ($product) {
    return view('card.card-builder', ['record' => $product]);
})->name('card.card-builder');
