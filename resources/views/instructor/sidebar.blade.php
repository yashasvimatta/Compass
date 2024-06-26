<nav class="side-nav">
    <ul>
        <li><a class="{{ Request::is('instructor/dashboard') ? 'active' : '' }}" href="{{ url('instructor/dashboard') }}">Dashboard</a></li>
        <li><a class="{{ Request::is('/instructor/addcourse') ? 'active' : '' }}" href="{{ url('/instructor/addcourse') }}">Create Course</a></li>
        <li><a class="{{ Request::is('instructor/managecourses') ? 'active' : '' }}" href="{{ url('instructor/managecourses') }}">Manage Courses</a></li>
        <li><a class="{{ Request::is('instructor/feedback') ? 'active' : '' }}" href="{{ url('instructor/feedback') }}">Feedback</a></li>
        <li><a class="{{ Request::is('/instructor/addmarks') ? 'active' : '' }}" href="{{ url('/instructor/addmarks') }}">Assign Marks</a></li>
        <li><a class="{{ Request::is('instructor/studentprogress') ? 'active' : '' }}" href="{{ url('instructor/studentprogress') }}">Student Progress</a></li>
        <li><a class="{{ Request::is('instructor/assignment') ? 'active' : '' }}" href="{{ url('instructor/assignment') }}">Assignment</a></li>
        <li><a class="{{ Request::is('instructor/chat') ? 'active' : '' }}" href="{{ url('instructor/chat') }}">Chat</a></li>
    </ul>
</nav>
