@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="bg-primary text-white rounded shadow p-4 mb-4 text-center">
        <h1 class="display-5 fw-bold">Edit Tender</h1>
        <p class="lead">Update the details of your tender below.</p>
    </div>

    <!-- Form chỉnh sửa tender -->
    <form action="{{ route('tenders.update', $tender->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <!-- Title -->
        <div class="form-group mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $tender->title) }}" required>
        </div>

        <!-- Description -->
        <div class="form-group mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" rows="4" class="form-control" required>{{ old('description', $tender->description) }}</textarea>
        </div>

        <!-- Visibility -->
        <div class="form-group mb-3">
            <label for="visibility" class="form-label">Visibility</label>
            <select name="visibility" id="visibility" class="form-select" required>
                <option value="Public" {{ $tender->visibility == 'Public' ? 'selected' : '' }}>Public</option>
                <option value="Private" {{ $tender->visibility == 'Private' ? 'selected' : '' }}>Private</option>
            </select>
        </div>

        <!-- Nút cập nhật -->
        <button type="submit" class="btn btn-primary">Update Tender</button>
    </form>
</div>
@endsection