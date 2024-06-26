<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Communication PC</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/instructor_dashboard.css') }}" /> 
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}" /> 
    
</head>
<style>
    .container {
    padding-top: 20px;
}

.box {
    border: 1px solid #ddd;
    margin-bottom: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.box-content {
    padding: 20px;
}

h3 {
    color: #333;
}

.button-container {
    margin-top: 15px;
}

.button {
    display: inline-block;
    padding: 8px 16px;
    margin-right: 10px;
    border: none;
    cursor: pointer;
    color: #fff;
    border-radius: 4px;
}

.button-syllabus {
    background-color: #3498db;
}

.button-assignment {
    background-color: #2ecc71;
}

.button-grade {
    background-color: #e74c3c;
}

.row {
    margin-left: -15px;
    margin-right: -15px;
}

.col-lg-4 {
    width: 25%;
    padding-left: 15px;
    padding-right: 15px;
    float: left;
    position: relative;
}

.support_btn{
    background-color: #2c3e50;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 16px;
    text-decoration: none;
    display: unset;
    /* margin-left: 12px; */
}
.modal {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      z-index: 1000;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      border-radius: 5px;
      overflow: hidden;
    }

    th, td {
      padding: 12px;
      text-align: left;
    }

    th {
      background-color: #4caf50;
      color: white;
    }

    tbody tr:hover {
      background-color: #f5f5f5;
    }

    .close-btn {
      cursor: pointer;
      float: right;
      font-size: 20px;
      color: #aaa;
    }

    .close-btn:hover {
      color: #555;
    }

.support_btn:hover {
    background-color: #2c3e50;
}
    </style>
<body>
<header class="header">
        <div class="logo_navbar">
            <h2 class="logo_heading">Course Compass | Program Coordinator</h2>
        </div>
        <div class="header-right">
            <a class="logout-heading" href="{{ url('logout') }}">Logout</a>
        </div>
    </header>
    <div class="dashboard-container">
    @include('qa.sidebar') 
    <section class="dashboard second-section">
        <div class="dashboard-header">
            <h2>Communication Tools</h2> <br>
            <div class="messaging">
                <h3>Messaging System</h3>
                <p>Stay in touch with instructors, administrators, and stakeholders.</p>
                <button class="support_btn" onclick="openFeedbackForm()">Open Feedback</button>
                <div id="feedbackModal" class="modal">
  <span onclick="closeFeedbackForm()" style="cursor: pointer; float: right;">&times;</span>
  <table id="feedbackTable">
    <thead>
      <tr>
        <th>User Name</th>
        <th>Feedback For</th>
        <th>Subject</th>
        <th>Feedback</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>
</div>
            </div><br><br><br>
            <div class="messaging">
                <h3>Discussion Forums</h3>
                <button class="support_btn" onclick="openPolicyForm()">Go to Policies</button>
            </div>
        </div>
</div>
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
  function openFeedbackForm() {
    // Fetch feedback data when the form is opened
    fetch('/pc/feedback')
      .then(response => response.json())
      .then(data => {
        populateFeedbackTable(data);
        document.getElementById('feedbackModal').style.display = 'block';
      })
      .catch(error => console.error('Error fetching feedback data:', error));
  }

  function closeFeedbackForm() {
    document.getElementById('feedbackModal').style.display = 'none';
  }

  function populateFeedbackTable(feedbackData) {
    const tbody = document.querySelector('#feedbackTable tbody');
    tbody.innerHTML = ''; // Clear existing rows

    feedbackData.forEach(feedback => {
      const row = document.createElement('tr');
      row.innerHTML = `
        <td>${feedback.user_name}</td>
        <td>${feedback.feedback_for_name}</td>
        <td>${feedback.subject}</td>
        <td>${feedback.feedback}</td>
      `;
      tbody.appendChild(row);
    });
  }
</script>