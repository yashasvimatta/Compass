<nav class="side-nav">
    <ul>
        <li><a class="{{ Request::is('/qa/dashboard') ? 'active' : '' }}" href="{{ url('/qa/dashboard') }}">Dashboard</a></li>
        <li><a class="{{ Request::is('/qa/policy') ? 'active' : '' }}" href="{{ url('/qa/policy') }}">Policies and Procedures</a></li>
        <li><a class="{{ Request::is('/qa/feedback') ? 'active' : '' }}" href="{{ url('/qa/feedback') }}">Instructor Feedback</a></li>
        <li><a class="{{ Request::is('/qa/chat') ? 'active' : '' }}" href="{{ url('/qa/chat') }}">Chat</a></li>
    </ul>
</nav>
