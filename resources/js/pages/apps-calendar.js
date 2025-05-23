document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        editable: true,
        droppable: true,
        selectable: true,
        events: '/api/events',
        eventDrop: function (info) {
            updateEvent(info.event);
        },
        eventResize: function (info) {
            updateEvent(info.event);
        },
        select: function (info) {
            openEventModal(info.startStr, info.endStr);
        },
        eventClick: function (info) {
            openEventModal(info.event.startStr, info.event.endStr, info.event);
        },
        drop: function (info) {
            var eventData = {
                title: info.draggedEl.getAttribute('data-title') || 'New Event',
                category: info.draggedEl.getAttribute('data-class'),
                start: info.dateStr,
                end: null
            };
            saveEvent(eventData);
        }
    });
    calendar.render();

    // External events
    document.querySelectorAll('.external-event').forEach(function (item) {
        new FullCalendar.Draggable(item, {
            itemSelector: '.external-event',
            eventData: function (eventEl) {
                return {
                    title: eventEl.innerText.trim(),
                    className: eventEl.getAttribute('data-class')
                };
            }
        });
    });

    // Modal handling
    var eventModal = new bootstrap.Modal(document.getElementById('event-modal'));
    var eventForm = document.getElementById('forms-event');
    var eventTitle = document.getElementById('event-title');
    var eventCategory = document.getElementById('event-category');
    var btnSaveEvent = document.getElementById('btn-save-event');
    var btnDeleteEvent = document.getElementById('btn-delete-event');
    var currentEventId = null;

    function openEventModal(start, end, event = null) {
        eventForm.reset();
        currentEventId = event ? event.id : null;
        eventTitle.value = event ? event.title : '';
        eventCategory.value = event ? event.className : 'bg-primary';
        btnDeleteEvent.style.display = event ? 'block' : 'none';
        eventModal.show();
    }

    function saveEvent(eventData) {
        axios({
            method: currentEventId ? 'put' : 'post',
            url: currentEventId ? `/api/events/${currentEventId}` : '/api/events',
            data: eventData,
            headers: {
                'Authorization': 'Bearer ' + document.querySelector('meta[name="api-token"]').content
            }
        }).then(function (response) {
            calendar.refetchEvents();
            eventModal.hide();
        }).catch(function (error) {
            console.error(error);
        });
    }

    function updateEvent(event) {
        axios.put(`/api/events/${event.id}`, {
            title: event.title,
            category: event.className,
            start: event.start.toISOString(),
            end: event.end ? event.end.toISOString() : null
        }, {
            headers: {
                'Authorization': 'Bearer ' + document.querySelector('meta[name="api-token"]').content
            }
        }).then(function () {
            calendar.refetchEvents();
        }).catch(function (error) {
            console.error(error);
        });
    }

    btnSaveEvent.addEventListener('click', function () {
        if (eventForm.checkValidity()) {
            var eventData = {
                title: eventTitle.value,
                category: eventCategory.value,
                start: calendar.getCurrentData().dateProfile.activeRange.start,
                end: null
            };
            saveEvent(eventData);
        } else {
            eventForm.classList.add('was-validated');
        }
    });

    btnDeleteEvent.addEventListener('click', function () {
        if (currentEventId) {
            axios.delete(`/api/events/${currentEventId}`, {
                headers: {
                    'Authorization': 'Bearer ' + document.querySelector('meta[name="api-token"]').content
                }
            }).then(function () {
                calendar.refetchEvents();
                eventModal.hide();
            }).catch(function (error) {
                console.error(error);
            });
        }
    });

    // Task Modal (Add this to your Blade template)
    var taskModal = new bootstrap.Modal(document.getElementById('task-modal')); // Add task modal HTML
    var taskForm = document.getElementById('task-form');
    var taskTitle = document.getElementById('task-title');
    var taskDescription = document.getElementById('task-description');
    var taskDueDate = document.getElementById('task-due-date');
    var taskUsers = document.getElementById('task-users');
    var btnSaveTask = document.getElementById('btn-save-task');
    var currentTaskId = null;

    function openTaskModal(eventId) {
        taskForm.reset();
        currentTaskId = null;
        taskModal.show();
        // Populate users dropdown (fetch via API)
        axios.get('/api/users', {
            headers: {
                'Authorization': 'Bearer ' + document.querySelector('meta[name="api-token"]').content
            }
        }).then(function (response) {
            taskUsers.innerHTML = response.data.map(user => `<option value="${user.id}">${user.name}</option>`).join('');
        });
    }

    btnSaveTask.addEventListener('click', function () {
        if (taskForm.checkValidity()) {
            var taskData = {
                title: taskTitle.value,
                description: taskDescription.value,
                due_date: taskDueDate.value,
                user_ids: Array.from(taskUsers.selectedOptions).map(option => option.value)
            };
            axios({
                method: currentTaskId ? 'put' : 'post',
                url: currentTaskId ? `/api/tasks/${currentTaskId}` : `/api/events/${currentEventId}/tasks`,
                data: taskData,
                headers: {
                    'Authorization': 'Bearer ' + document.querySelector('meta[name="api-token"]').content
                }
            }).then(function () {
                taskModal.hide();
            }).catch(function (error) {
                console.error(error);
            });
        } else {
            taskForm.classList.add('was-validated');
        }
    });
});