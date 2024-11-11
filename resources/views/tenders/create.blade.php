@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0">Create Tender</h3>
                </div>
                <div class="card-body p-4">
                    <!-- Bootstrap Alert -->
                    <div id="message" class="alert d-none" role="alert"></div>

                    <form id="tenderForm">
                        @csrf

                        <!-- Title -->
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="title" name="title" required placeholder="Enter tender title">
                            <label for="title">Title</label>
                        </div>

                        <!-- Description -->
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="description" name="description" rows="4" required placeholder="Provide a description for the tender"></textarea>
                            <label for="description">Description</label>
                        </div>

                        <!-- Visibility -->
                        <div class="mb-3">
                            <label for="visibility" class="form-label fw-bold">Visibility:</label>
                            <select class="form-select" id="visibility" name="visibility">
                                <option value="Public">Public</option>
                                <option value="Private">Private</option>
                            </select>
                        </div>

                        <!-- Invited Suppliers -->
                        <div class="mb-3">
                            <label for="supplierEmail" class="form-label fw-bold">Invited Supplier Email:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="supplierEmail" placeholder="Enter supplier email">
                                <button type="button" class="btn btn-outline-secondary" id="addSupplier">Add Supplier</button>
                            </div>
                            <small class="form-text text-muted">Click "Add Supplier" to include multiple email addresses.</small>
                        </div>

                        <!-- Suppliers List -->
                        <ul id="suppliersList" class="list-group mb-3"></ul>

                        <!-- Submit Button -->
                        <button type="button" class="btn btn-success w-100" id="openConfirmModal">Create Tender</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirm Create Tender</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to create this tender?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmSubmit">Yes, Create</button>
            </div>
        </div>
    </div>
</div>

<!-- jQuery and Bootstrap Bundle JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        const suppliers = [];

        // Add supplier email to list
        $('#addSupplier').on('click', function() {
            const email = $('#supplierEmail').val().trim();
            if (email && !suppliers.includes(email)) {
                suppliers.push(email);
                $('#suppliersList').append(`<li class="list-group-item d-flex justify-content-between align-items-center">
                    ${email}
                    <button class="btn btn-sm btn-danger remove-supplier" data-email="${email}">&times;</button>
                </li>`);
                $('#supplierEmail').val(''); // Clear input after adding
            }
        });

        // Remove supplier from list
        $(document).on('click', '.remove-supplier', function() {
            const email = $(this).data('email');
            suppliers.splice(suppliers.indexOf(email), 1);
            $(this).closest('li').remove();
        });

        // Open confirmation modal on form submit
        $('#openConfirmModal').on('click', function() {
            $('#confirmModal').modal('show');
        });

        // AJAX form submission on modal confirmation
        $('#confirmSubmit').on('click', function() {
            // Hide the modal
            $('#confirmModal').modal('hide');

            // Gather form data
            const formData = {
                _token: '{{ csrf_token() }}',
                title: $('#title').val(),
                description: $('#description').val(),
                visibility: $('#visibility').val(),
                invited_suppliers: suppliers, // Send as array
            };

            // Perform AJAX request
            $.ajax({
                url: '{{ route("tenders.store") }}',
                type: 'POST',
                data: JSON.stringify(formData),
                contentType: 'application/json',
                success: function(response) {
                    $('#message').removeClass('d-none alert-danger').addClass('alert-success').text(response.message || 'Tender created successfully!');
                    $('#tenderForm')[0].reset();
                    $('#suppliersList').empty();
                    suppliers.length = 0; // Clear suppliers array
                },
                error: function(error) {
                    $('#message').removeClass('d-none alert-success').addClass('alert-danger').text('Failed to create tender. Please try again.');
                }
            });
        });
    });
</script>
@endsection