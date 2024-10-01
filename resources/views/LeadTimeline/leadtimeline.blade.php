    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Lead Timeline Management</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" rel="stylesheet">

        <style>
            #leadtimelineTable {
                border-top: 1px solid #808080; /* Top border for the table */
            }
        </style>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    </head>

    <body>
        <div class="container">
            <!-- Success Message -->
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>Lead Timeline
                        <button type="button" class="btn btn-primary mb-3 float-end" data-bs-toggle="modal" data-bs-target="#createTimelineModal">
                            Add New Timeline
                        </button>
                    </h4>
                </div>
                <div class="card-body">
                    <!-- Lead Timeline Table -->
                    <table class="table table-striped table-bordered" id="leadtimelineTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Lead ID</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Message</th>
                                <th>Badge Color</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($leadstimeline as $timeline)
                            <tr>
                                <td>{{ $timeline->id }}</td>
                                <td>{{ $timeline->lead_id }}</td>
                                <td>{{ $timeline->title }}</td>
                                <td>{{ $timeline->status }}</td>
                                <td>{{ $timeline->message }}</td>
                                <td>
                                    <span class="badge" style="background-color: {{ $timeline->badge_color }};">
                                        {{ $timeline->badge_color }}
                                    </span>
                                </td>
                                <td>
                                    <!-- Edit Button -->
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editTimelineModal{{ $timeline->id }}">
                                        Edit
                                    </button>

                                    <!-- Delete Button -->
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteTimelineModal{{ $timeline->id }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editTimelineModal{{ $timeline->id }}" tabindex="-1" aria-labelledby="editTimelineLabel{{ $timeline->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('leadtimeline.update', $timeline->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editTimelineLabel{{ $timeline->id }}">Edit Timeline</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group mb-2">
                                                    <label for="lead_id">Lead ID</label>
                                                    <input type="text" name="lead_id" class="form-control" value="{{ $timeline->lead_id }}" required>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="title">Title</label>
                                                    <input type="text" name="title" class="form-control" value="{{ $timeline->title }}" required>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="status">Status</label>
                                                    <input type="text" name="status" class="form-control" value="{{ $timeline->status }}" required>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="message">Message</label>
                                                    <textarea name="message" class="form-control" required>{{ $timeline->message }}</textarea>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="badge_color">Badge Color</label>
                                                    <input type="color" name="badge_color" class="form-control" value="{{ $timeline->badge_color }}">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-warning">Update Timeline</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteTimelineModal{{ $timeline->id }}" tabindex="-1" aria-labelledby="deleteTimelineLabel{{ $timeline->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('leadtimeline.destroy', $timeline->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteTimelineLabel{{ $timeline->id }}">Delete Timeline</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete this timeline entry?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Create Timeline Modal -->
            <div class="modal fade" id="createTimelineModal" tabindex="-1" aria-labelledby="createTimelineLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('leadtimeline.store') }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="createTimelineLabel">Add New Timeline Entry</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group mb-2">
                                    <label for="lead_id">Lead ID</label>
                                    <input type="text" name="lead_id" class="form-control" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" class="form-control" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="status">Status</label>
                                    <input type="text" name="status" class="form-control" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="message">Message</label>
                                    <textarea name="message" class="form-control" required></textarea>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="badge_color">Badge Color</label>
                                    <input type="color" name="badge_color" class="form-control">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add Timeline</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#leadtimelineTable').DataTable({
                    responsive: true,
                    searching: true,
                    ordering: true,
                    paging: true
                });
            });
        </script>
    </body>

    </html>
