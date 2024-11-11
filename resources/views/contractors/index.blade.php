@extends('layouts.app')

@section('content')
<div class="container my-5">
    <!-- Header Section -->
    <div class="bg-primary text-white rounded shadow p-4 mb-4 text-center">
        <h1 class="display-5 fw-bold">Your Created Tenders</h1>
        <p class="lead">Manage and review all tenders that you have created here.</p>
    </div>

    <!-- Message Section -->
    <div id="message" class="alert d-none" role="alert"></div>

    <!-- Content Section -->
    @if($tenders->isEmpty())
        <div class="alert alert-info text-center">
            No tenders found for this user.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Visibility</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tenders as $tender)
                        <tr id="tender-{{ $tender->id }}">
                            <td class="fw-bold">{{ $tender->title }}</td>
                            <td>{{ Str::limit($tender->description, 50) }}</td>
                            <td class="text-center">
                                <span class="badge {{ $tender->visibility == 'Public' ? 'bg-success' : 'bg-warning' }}">
                                    {{ $tender->visibility }}
                                </span>
                            </td>
                            <td class="text-center">{{ $tender->created_at->format('Y-m-d H:i') }}</td>
                            <td class="text-center">{{ $tender->updated_at->format('Y-m-d H:i') }}</td>
                            <td class="text-center">
                                <div class="d-inline-flex">
                                    <a href="{{ route('tenders.edit', $tender->id) }}" class="btn btn-sm btn-warning me-2">Edit</a>
                                    <button class="btn btn-sm btn-danger" onclick="confirmDelete({{ $tender->id }})">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this tender?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">OK</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Delete Confirmation -->
<script>
    let tenderIdToDelete;

    function confirmDelete(id) {
        tenderIdToDelete = id;
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    }

    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (tenderIdToDelete) {
            fetch(`/tenders/${tenderIdToDelete}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                const messageElement = document.getElementById('message');
                if (data.success) {
                    document.getElementById(`tender-${tenderIdToDelete}`).remove();
                    messageElement.className = 'alert alert-success';
                    messageElement.textContent = 'Tender deleted successfully!';
                } else {
                    messageElement.className = 'alert alert-danger';
                    messageElement.textContent = 'Failed to delete the tender.';
                }
                messageElement.classList.remove('d-none');
                const deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
                deleteModal.hide();
            })
            .catch(error => {
                const messageElement = document.getElementById('message');
                messageElement.className = 'alert alert-danger';
                messageElement.textContent = 'An error occurred while trying to delete the tender.';
                messageElement.classList.remove('d-none');
                console.error('Error:', error);
            });
        }
    });
</script>
@endsection