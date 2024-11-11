@extends('layouts.app')

@section('content')
<div class="container my-5">
    <!-- Header Section -->
    <div class="bg-primary text-white rounded shadow p-4 mb-4 text-center">
        <h2 class="display-5 fw-bold">Dashboard</h2>
        <p class="lead">Welcome back, {{ Auth::user()->name }}! Here's a quick overview of your activities.</p>
    </div>

    <!-- Dashboard Content -->
    <div class="row">
        <!-- Profile Summary Card -->
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">Your Profile</h5>
                </div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    <p><strong>Role:</strong> {{ Auth::user()->role ?? 'User' }}</p>
                </div>
            </div>
        </div>

        <!-- Quick Links Card -->
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-0">Quick Links</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li><a href="{{ route('tenders.create') }}" class="text-decoration-none">Create New Tender</a></li>
                        <li><a href="{{ route('contractors.index') }}" class="text-decoration-none">View Contractors</a></li>
                        <li><a href="{{ route('suppliers.index') }}" class="text-decoration-none">View Suppliers</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-5">
        <p class="text-muted">Thank you for being part of our platform. Let's make things happen!</p>
    </div>
</div>
@endsection