<nav class="side-nav">
    <ul>
        <li><a class="{{ Request::is('/student/dashboard') ? 'active' : '' }}" href="{{ url('/student/dashboard') }}">Dashboard</a></li>
        <li><a class="{{ Request::is('/student/enroll') ? 'active' : '' }}" href="{{ url('/student/enroll') }}">Enroll</a></li>
        <li><a class="{{ Request::is('/student/getprofile') ? 'active' : '' }}" href="{{ url('/student/getprofile') }}">User Profile</a></li>
        <li><a class="{{ Request::is('/student/feedback') ? 'active' : '' }}" href="{{ url('/student/feedback') }}">Feedback</a></li>
        <li><a class="{{ Request::is('/chat') ? 'active' : '' }}" href="{{ url('chat') }}">Chat</a></li>
    </ul>
</nav>
