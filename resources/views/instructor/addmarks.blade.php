<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Marks</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/instructor_dashboard.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/student.css') }}" />
</head>
<style>
.invalid-feedback{
    color: red;
}
</style>
<body>
    <header class="header">
        <div class="logo_navbar">
            <h2 class="logo_heading">Course Compass | Marks</h2>
        </div>
        <div class="header-right">
            <a class="logout-heading" href="{{ url('logout') }}">Logout</a>
        </div>
    </header>
    <div class="dashboard-container">
    @include('instructor.sidebar') 

        <section class="performance_data second-section">
    <h2><i class="fas fa-users"></i>Assign Test Marks</h2>

    <div class="container" style="width:50%">
    <form method="POST">
    @csrf
    <div class="form-group">
        <label for="assignment_id">Assignment:</label>
        <select name="assignment_id" id="assignment_id" class="form-control" required>
            <option value="">Select an assignment</option>
            @foreach($assignments as $assignment)
                <option value="{{ $assignment->id }}">{{ $assignment->title }}</option>
            @endforeach
        </select>
        @error('assignment_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="student_id">Student:</label>
        <select name="student_id" id="student_id" class="form-control" required>
            <option value="">Select a student</option>
        </select>
        @error('student_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="marks_obtained">Marks Obtained:</label>
        <input type="number" name="marks_obtained" id="marks_obtained" class="form-control" required>
        @error('marks_obtained')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="grade">Grade:</label>
        <input type="text" name="grade" id="grade" class="form-control" required>
        @error('grade')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Save Marks</button>
</form>
    </div>
    @if (session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif

@if (session('error'))
    <script>
        alert("{{ session('error') }}");
    </script>
@endif
        </section>
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
    document.addEventListener('DOMContentLoaded', function () {
        const assignmentDropdown = document.getElementById('assignment_id');
        const studentDropdown = document.getElementById('student_id');

        assignmentDropdown.addEventListener('change', function () {
            const assignmentId = this.value;

            // Fetch students based on the selected assignment
            fetch(`{{ route('get.students', '') }}/${assignmentId}`)
                .then(response => response.json())
                .then(data => {
                    // Clear existing options
                    studentDropdown.innerHTML = '<option value="">Select a student</option>';

                    // Populate students
                    data.forEach(student => {
                        const option = document.createElement('option');
                        option.value = student.student.id;
                        option.text = student.student.first_name; // Replace with the actual property for student name
                        studentDropdown.add(option);
                    });
                })
                .catch(error => console.error('Error:', error));
        });
    });
</script>
