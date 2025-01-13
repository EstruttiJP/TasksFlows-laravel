@component('mail::message')
# New Task Assigned

You have been assigned a new task **{{ $details['task_name'] }}**.

**Task Details:**

- **Name:** {{ $details['task_name'] }}
- **Description:** {{ $details['task_description'] }}
- **Launch Date:** {{ $details['task_launch_date'] }}
- **Deadline:** {{ $details['task_deadline'] }}
- **Project:** {{ $details['project_name'] }}
- **Status:** {{ $details['task_status'] }}

@component('mail::button', ['url' => 'https://adminlte.test/task/'.$details['task_id']])
View Task Details
@endcomponent

Thank you,<br>
{{ config('app.name') }}
@endcomponent
