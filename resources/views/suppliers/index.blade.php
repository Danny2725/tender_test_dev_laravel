@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <!-- Header Section -->
        <div class="bg-primary text-white rounded shadow p-4 mb-4 text-center">
            <h1 class="display-5 fw-bold">Tenders Available to You</h1>
            <p class="lead">Browse through public tenders or view private tenders you’ve been invited to.</p>
        </div>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="tenderTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="public-tab" data-bs-toggle="tab" data-bs-target="#public" type="button" role="tab" aria-controls="public" aria-selected="true">
                    Public Tenders
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="private-tab" data-bs-toggle="tab" data-bs-target="#private" type="button" role="tab" aria-controls="private" aria-selected="false">
                    Private Tenders
                </button>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content mt-4">
            <!-- Public Tenders Tab -->
            <div class="tab-pane fade show active" id="public" role="tabpanel" aria-labelledby="public-tab">
                @if($publicTenders->isEmpty())
                    <div class="alert alert-info text-center">
                        No public tenders available at the moment.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle">
                            <thead class="table-dark">
                                <tr class="text-center">
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($publicTenders as $tender)
                                    <tr>
                                        <td class="fw-bold">{{ $tender->title }}</td>
                                        <td>{{ Str::limit($tender->description, 50) }}</td>
                                        <td class="text-center">{{ $tender->created_at->format('Y-m-d H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <!-- Private Tenders Tab -->
            <div class="tab-pane fade" id="private" role="tabpanel" aria-labelledby="private-tab">
                @if($privateTenders->isEmpty())
                    <div class="alert alert-info text-center">
                        No private tenders available at the moment.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle">
                            <thead class="table-dark">
                                <tr class="text-center">
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($privateTenders as $tender)
                                    <tr>
                                        <td class="fw-bold">{{ $tender->title }}</td>
                                        <td>{{ Str::limit($tender->description, 50) }}</td>
                                        <td class="text-center">{{ $tender->created_at->format('Y-m-d H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection