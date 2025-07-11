@extends('layouts.vertical', ['title' => 'Calendar'])

@section('content')
    <!-- API Token Meta Tag for Sanctum Authentication -->
    <meta name="api-token" content="{{ Auth::user()->createToken('api-token')->plainTextToken }}">

    <!-- Search Modal -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-transparent">
                <div class="card mb-1">
                    <div class="px-3 py-2 d-flex flex-row align-items-center" id="top-search">
                        <i class="ti ti-search fs-22"></i>
                        <input type="search" class="form-control border-0" id="search-modal-input"
                            placeholder="Search for actions, people,">
                        <button type="button" class="btn p-0" data-bs-dismiss="modal" aria-label="Close">[esc]</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-title-head d-flex align-items-sm-center flex-sm-row flex-column gap-2">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold mb-0">Calendar</h4>
        </div>
        <div class="text-end">
            <ol class="breadcrumb m-0 py-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Osen</a></li>
                <li class="breadcrumb-item active">Calendar</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3">
            <div class="card">
                <div class="card-body">
                    <button class="btn btn-primary w-100" id="btn-new-event">
                        <i class="ti ti-plus me-2 align-middle"></i> Create New Event
                    </button>
                    <div id="external-events" class="mt-2">
                        <p class="text-muted">Drag and drop your event or click in the calendar</p>
                        <div class="external-event fc-event bg-success-subtle text-success" data-class="bg-success-subtle">
                            <i class="ti ti-circle-filled me-2"></i>New Event Planning
                        </div>
                        <div class="external-event fc-event bg-info-subtle text-info" data-class="bg-info-subtle">
                            <i class="ti ti-circle-filled me-2"></i>Meeting
                        </div>
                        <div class="external-event fc-event bg-warning-subtle text-warning" data-class="bg-warning-subtle">
                            <i class="ti ti-circle-filled me-2"></i>Generating Reports
                        </div>
                        <div class="external-event fc-event bg-danger-subtle text-danger" data-class="bg-danger-subtle">
                            <i class="ti ti-circle-filled me-2"></i>Create New Theme
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col-->

        <div class="col-xl-9">
            <div class="card">
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div><!-- end col -->
    </div>
    <!--end row-->

    <!-- Add/Edit Event Modal -->
    <div class="modal fade" id="event-modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="needs-validation" name="event-form" id="forms-event" novalidate>
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title">Create Event</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-2">
                                    <label class="control-label form-label" for="event-title">Event Name</label>
                                    <input class="form-control" placeholder="Insert Event Name" type="text"
                                        name="title" id="event-title" required />
                                    <div class="invalid-feedback">Please provide a valid event name</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-2">
                                    <label class="control-label form-label" for="event-category">Category</label>
                                    <select class="form-select" name="category" id="event-category" required>
                                        <option value="bg-primary">Blue</option>
                                        <option value="bg-secondary">Gray Dark</option>
                                        <option value="bg-success">Green</option>
                                        <option value="bg-info">Cyan</option>
                                        <option value="bg-warning">Yellow</option>
                                        <option value="bg-danger">Red</option>
                                        <option value="bg-dark">Dark</option>
                                    </select>
                                    <div class="invalid-feedback">Please select a valid event category</div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap align-items-center gap-2">
                            <button type="button" class="btn btn-info" id="btn-create-task">Create Task</button>
                            <button type="button" class="btn btn-danger" id="btn-delete-event">Delete</button>
                            <button type="button" class="btn btn-light ms-auto" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="btn-save-event">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add/Edit Task Modal -->
    <div class="modal fade" id="task-modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="needs-validation" name="task-form" id="task-form" novalidate>
                    <div class="modal-header">
                        <h4 class="modal-title" id="task-modal-title">Create Task</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-2">
                                    <label class="control-label form-label" for="task-title">Task Name</label>
                                    <input class="form-control" placeholder="Insert Task Name" type="text" name="title" id="task-title" required />
                                    <div class="invalid-feedback">Please provide a valid task name</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-2">
                                    <label class="control-label form-label" for="task-description">Description</label>
                                    <textarea class="form-control" placeholder="Task Description" name="description" id="task-description"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-2">
                                    <label class="control-label form-label" for="task-due-date">Due Date</label>
                                    <input class="form-control" type="datetime-local" name="due_date" id="task-due-date" required />
                                    <div class="invalid-feedback">Please provide a valid due date</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-2">
                                    <label class="control-label form-label" for="task-users">Assign Users</label>
                                    <select class="form-select" name="user_ids[]" id="task-users" multiple>
                                        <!-- Populated dynamically via JavaScript -->
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap align-items-center gap-2">
                            <button type="button" class="btn btn-light ms-auto" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="btn-save-task">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- FullCalendar and Dependencies -->
    @vite(['resources/js/pages/apps-calendar.js'])
    <!-- Include Bootstrap JS for modals (already included in app.js if set up as recommended) -->
@endsection