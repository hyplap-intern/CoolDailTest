<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lead Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" rel="stylesheet">

    <style>
        #leadsTable {
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
                <h4>Leads List
                    <!-- Button to Open the Create Modal, floated to the end -->
                    <button type="button" class="btn btn-primary mb-3 float-end" data-bs-toggle="modal" 
                    data-bs-target="#createLeadModal">
                        Add New Lead
                    </button>                
                </h4>
            </div>
            <div class="card-body">

                <!-- Leads Table inside card -->
                <table class="table table-striped table-bordered" id="leadsTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Vendor UID</th>
                            <th>CP UID</th>
                            <th>Assigned To</th>
                            <th>Status</th>
                            <th>Next Follow-up</th>
                            <th>Trx Uid</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($leads as $lead)
                        <tr>
                            <td>{{ $lead->id }}</td>
                            <td>{{ $lead->vendor_uid }}</td>
                            <td>{{ $lead->cp_uid }}</td>
                            <td>{{ $lead->assigned_to }}</td>
                            <td>{{ $lead->status }}</td>
                            <td>{{ $lead->next_followup_date }}</td>
                            <td>{{ $lead->trx_uid }}</td>
                            <td>
                                {{-- <!-- Edit Button -->
                                <a href="{{url('/lead?id='.$lead->id)}}" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editLeadModal{{ $lead->id }}">
                                    View
                                </button> --}}
                                <!-- Edit Button -->
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editLeadModal{{ $lead->id }}">
                                    Edit
                                </button>

                                <!-- Delete Button -->
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteLeadModal{{ $lead->id }}">
                                    Delete
                                </button>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editLeadModal{{ $lead->id }}" tabindex="-1" aria-labelledby="editLeadLabel{{ $lead->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('lead.update', $lead->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editLeadLabel{{ $lead->id }}">Edit Lead</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group mb-2">
                                                <label for="vendor_uid">Vendor UID</label>
                                                <input type="text" name="vendor_uid" class="form-control" value="{{ $lead->vendor_uid }}" required>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="cp_uid">CP UID</label>
                                                <input type="text" name="cp_uid" class="form-control" value="{{ $lead->cp_uid }}" required>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="assigned_to">Assigned To</label>
                                                <input type="text" name="assigned_to" class="form-control" value="{{ $lead->assigned_to }}" required>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="status">Status</label>
                                                <input type="text" name="status" class="form-control" value="{{ $lead->status }}" required>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="next_followup_date">Next Follow-up Date</label>
                                                <input type="date" name="next_followup_date" class="form-control" value="{{ $lead->next_followup_date }}">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="trx_uid">Trx Uid</label>
                                                <input type="text" name="trx_uid" class="form-control" value="{{ $lead->trx_uid }}">
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-warning">Update Lead</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteLeadModal{{ $lead->id }}" tabindex="-1" aria-labelledby="deleteLeadLabel{{ $lead->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('lead.destroy', $lead->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteLeadLabel{{ $lead->id }}">Delete Lead</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this lead?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach <!-- Close the foreach loop -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Create Lead Modal -->
        <div class="modal fade" id="createLeadModal" tabindex="-1" aria-labelledby="createLeadLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('lead.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="createLeadLabel">Add New Lead</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group mb-2">
                                <label for="vendor_uid">Vendor UID</label>
                                <input type="text" name="vendor_uid" class="form-control" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="cp_uid">CP UID</label>
                                <input type="text" name="cp_uid" class="form-control" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="assigned_to">Assigned To</label>
                                <input type="text" name="assigned_to" class="form-control" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="status">Status</label>
                                <input type="text" name="status" class="form-control" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="next_followup_date">Next Follow-up Date</label>
                                <input type="date" name="next_followup_date" class="form-control">
                            </div>
                            <div class="form-group mb-2">
                                <label for="trx_uid">Trx Uid</label>
                                <input type="text" name="trx_uid" class="form-control">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Lead</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#leadsTable').DataTable({
                responsive: true,
                searching: true,
                ordering: true,
                paging: true
            });
        });
    </script>
</body>

</html>
<<<<<<< Tabnine <<<<<<<
/**undefined+
 * Function to initialize and configure the DataTables plugin for the leads table.undefined+
 *undefined+
 * @return voidundefined+
 */undefined+
$(document).ready(function() {undefined+
    $('#leadsTable').DataTable({undefined+
        responsive: true,undefined+
        searching: true,undefined+
        ordering: true,undefined+
        paging: trueundefined+
    });undefined+
});undefined+
>>>>>>> Tabnine >>>>>>>undefined {"conversationId":"d0047f32-63ab-4992-a76e-e806622919c8","source":"instruct"}