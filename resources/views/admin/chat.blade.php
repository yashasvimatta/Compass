<!-- chat.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" type="text/css"  href="{{ asset('css/admin.css') }}" />
    <style>
        textarea {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            border: none;
            background: #f1f1f1;
        }
        body {
            display: flex;
            height: 100vh;
            margin: 0;
        }

        #userList {
            width: 75%;
            border-right: 1px solid #ccc;
            padding: 20px;
            box-sizing: border-box;
            overflow-y: auto;
        }

        #chatContainer {
            flex: 1;
            padding: 20px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
        }

        #messages {
            flex: 1;
            overflow-y: auto;
        }

        #messageInput {
            margin-top: 10px;
            display: flex;
        }

        #messageInput input {
            flex: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 8px;
        }

        #messageInput button {
            padding: 8px 12px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .chat-container {
            display: grid;
            grid-template-columns: 1fr 3fr;
            height: 75%;
            border: 5px solid black;
        }
        .user-card {
        border: 1px solid #ccc;
        list-style-type: none; /* Remove bullet point */
        border-radius: 8px;
        padding: 10px;
        margin-bottom: 10px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .user-card:hover {
        background-color: #f0f0f0;
    }

    .user-card.selected {
        background-color: #3498db;
        color: #fff;
    }
    </style>
</head>
<body>
<header class="header">
        <div class="logo_navbar">
            <h2 class="logo_heading">Course Compass | {{session()->get('user')->role}}</h2>
        </div>
        <div class="header-right">
            <a class="logout-heading" href="{{ url('logout') }}">Logout</a>
        </div>
    </header>
    <div class="dashboard-container">
    @if(session()->get('user')->role === 'Instructor')
    @include('instructor.sidebar')
@elseif(session()->get('user')->role === 'student')
    @include('student.sidebar')
    @elseif(session()->get('user')->role === 'admin')
    @include('admin.sidebar')
    @elseif(session()->get('user')->role === 'Quality_Assurance')
    @include('qa.sidebar')
    @elseif(session()->get('user')->role === 'Program_Coordinator')
    @include('pc.sidebar')
@endif
            <section class="performance_data second-section" style="align-items:normal">
            <h2><i class="fas fa-users"></i> Chat</h2>
            <div class="chat-container">
            <div id="userList">
    <h4>Users</h4> <br>
    <ul id="users" class="user-cards">
   
    </ul>
</div>
<div id="chatContainer">
                <h2>Messages </h2>
                <div id="messages" data-current-user-id = "{{session()->get('user')->id}}">
                </div>
                <div id="messageInput">
                    <input type="text" id="messageText" placeholder="Type your message...">
                    <button onclick="sendMessage()">Send</button>
                </div>
            </div>
    </div>
            </section>
    </div>
    </div>
    </div>

     <footer class="footer">
        &copy; 2023 WDM Group 7 | <a class="footer_anchor" href="contactUs">Contact Us</a> | <a
            class="footer_anchor" href="aboutUs">About Us</a> | <a class="footer_anchor"
            href="services">Services</a>
    </footer>
</body>
</html>
<script>
    let selectedUser = null; 
    
    function initChat() {
    const userList = document.getElementById('users');
    fetch('/chat/users')
        .then(response => response.json())
        .then(users => {
            users.forEach((user, index) => {
                const li = document.createElement('li');
                li.classList.add('user-card');
                li.textContent = user.first_name;
                li.setAttribute('data-user-id', user.id);
                userList.appendChild(li);

                li.addEventListener('click', () => selectUser(li));

                // Select the first user by default
                if (index === 0) {
                    selectUser(li);
                }
            });
        })
        .catch(error => console.error('Error fetching chat users:', error));
}
    function selectUser(userCard) {
        if (selectedUser) {
        // Clear existing messages
        const messagesContainer = document.getElementById('messages');
        messagesContainer.innerHTML = '';

        // Deselect the previously selected user
        selectedUser.classList.remove('selected');
    }

    // Select the clicked user
    userCard.classList.add('selected');
    selectedUser = userCard;

    // Fetch messages for the selected user
    const selectedUserId = selectedUser.dataset.userId;
    const currentUserID = document.getElementById('messages').dataset.currentUserId;

    fetch(`/chat/get/${selectedUserId}`)
        .then(response => response.json())
        .then(messages => {
            const messagesContainer = document.getElementById('messages');
            messages.messages.forEach(message => {
                const div = document.createElement('div');
                div.textContent = `${message.sender_id == currentUserID ? 'You' : message.sender.first_name}: ${message.content}`;
                div.style.textAlign = message.sender_id != currentUserID ? 'left' : 'right';
                messagesContainer.appendChild(div);
            });
        })
        .catch(error => console.error('Error fetching chat messages:', error));
    }
    function sendMessage() {
    // Get the selected user's ID
    const selectedUser = document.querySelector('.user-card.selected');
    if (!selectedUser || !selectedUser.dataset.userId) {
        console.log('No user selected.');
        return;
    }

    const selectedUserId = selectedUser.dataset.userId;
    const messageText = document.getElementById('messageText').value;
    
    if (selectedUserId && messageText.trim() !== '') {
        // Send AJAX request to save the message
        fetch('/chat/save', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}', // Add Laravel CSRF token
            },
            body: JSON.stringify({
                receiver_id: selectedUserId,
                content: messageText,
            }),
        })
        .then(response => response.json())
        .then(messages => {
            // Get the messages container
            const messagesContainer = document.getElementById('messages');

            // Append the current message to the messages container
            const div = document.createElement('div');
            const currentUserID = messagesContainer.dataset.currentUserId;
            div.textContent = `${selectedUser.dataset.userId == currentUserID ? 'You' : selectedUser.textContent}: ${messageText}`;
            div.style.textAlign = 'right'
            messagesContainer.appendChild(div);

            // Log the updated messages
            console.log(messages);
        })
        .catch(error => console.error('Error sending message:', error));

        // Clear the input
        document.getElementById('messageText').value = '';
    }
}
    function getMessages() {
       // Check if a user is selected
    const selectedUser = document.querySelector('.user-card.selected');
    if (!selectedUser || !selectedUser.dataset.userId) {
        console.log('No user selected.');
        return;
    }

    // Clear existing messages
    const messagesContainer = document.getElementById('messages');
    messagesContainer.innerHTML = '';

    const selectedUserId = selectedUser.dataset.userId;
    const currentUserID = document.getElementById('messages').dataset.currentUserId;

    fetch(`/chat/get/${selectedUserId}`)
        .then(response => response.json())
        .then(messages => {
            messages.messages.forEach(message => {
                const div = document.createElement('div');
                div.textContent = `${message.sender_id == currentUserID ? 'You' : message.sender.first_name}: ${message.content}`;
                div.style.textAlign = message.sender_id != currentUserID ? 'left' : 'right';
                messagesContainer.appendChild(div);
            });
        })
        .catch(error => console.error('Error fetching chat messages:', error));
    }

    initChat();
    // Set up a timer to fetch messages every 5 seconds
    setInterval(getMessages, 15000);
</script>