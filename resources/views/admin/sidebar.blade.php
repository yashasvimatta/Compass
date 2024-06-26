<nav class="side-nav">
    <ul>
        <li><a class="{{ Request::is('admin/dashboard') ? 'active' : '' }}" href="{{ url('admin/dashboard') }}">Dashboard</a></li>
        <li><a class="{{ Request::is('admin/manageusers') ? 'active' : '' }}" href="{{ url('admin/manageusers') }}">Manage Users</a></li>
        <!-- Add more list items as needed -->
        <li><a class="{{ Request::is('admin/managestudents') ? 'active' : '' }}" href="{{ url('admin/managestudents') }}">Students</a></li>
        <li><a class="{{ Request::is('admin/manageinstructors') ? 'active' : '' }}" href="{{ url('admin/manageinstructors') }}">Instructors</a></li>
        <li><a class="{{ Request::is('admin/manageqa') ? 'active' : '' }}" href="{{ url('admin/manageqa') }}">QAO</a></li>
        <li><a class="{{ Request::is('admin/managepc') ? 'active' : '' }}" href="{{ url('admin/managepc') }}">Program Coordinator</a></li>
        <li><a class="{{ Request::is('admin/manage_courses_admin') ? 'active' : '' }}" href="{{ url('admin/manage_courses_admin') }}">Courses</a></li>
        <li><a class="{{ Request::is('admin/courses_admin') ? 'active' : '' }}" href="{{ url('admin/courses_admin') }}">Manage Courses</a></li>
        <li><a class="{{ Request::is('admin/issueresolutionadmin') ? 'active' : '' }}" href="{{ url('admin/issueresolutionadmin') }}">Issue Resolution</a></li>
        <li><a class="{{ Request::is('chat') ? 'active' : '' }}" href="{{ url('chat') }}">Chat</a></li>
    </ul>
</nav>