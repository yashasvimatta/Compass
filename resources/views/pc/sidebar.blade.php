<nav class="side-nav">
    <ul>
        <li><a class="{{ Request::is('/pc/dashboard') ? 'active' : '' }}" href="{{ url('/pc/dashboard') }}">Dashboard</a></li>
        <li><a class="{{ Request::is('/pc/communications') ? 'active' : '' }}" href="{{ url('/pc/communications') }}">Communications</a></li>
        <li><a class="{{ Request::is('/pc/performancedata') ? 'active' : '' }}" href="{{ url('/pc/performancedata') }}">Performance Data</a></li>
        <li><a class="{{ Request::is('/chat') ? 'active' : '' }}" href="{{ url('chat') }}">Chat</a></li>
    </ul>
</nav>
