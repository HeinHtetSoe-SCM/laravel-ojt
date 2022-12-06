@extends('layouts.app')

@section('title')
Home
@endsection

@section('content')
<div class="px-4 py-5 my-5 text-center">
    <h1 class="display-5 fw-bold">Laravel CRUD OJT</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        <a type="button" href="{{ route('posts.index') }}" class="btn btn-primary btn-lg px-4 gap-3">Posts</a>
        <a type="button" href="{{ route('categories.index') }}" class="btn btn-outline-primary btn-lg px-4">Categories</a>
      </div>
    </div>
  </div>
@endsection

