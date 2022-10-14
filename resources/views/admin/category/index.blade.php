@extends('layouts.admin')

@section('title', 'Category')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Category
                <a href="{{ route('category.create') }}" class="btn btn-primary float-right">Add Category</a>
            </h4>
        </div>
    </div>
@endsection
