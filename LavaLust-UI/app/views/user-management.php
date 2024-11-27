<?php include APP_DIR.'views/templates/header.php'; ?>
<body>
    <?php include APP_DIR.'views/templates/nav.php'; ?>  
    <div id="app" class="container-fluid">
        <div class="row">
            <!-- Sidebar (takes 3 columns width on medium screens and full width on smaller screens) -->
            <div class="col-md-3 col-12">
                <?php include APP_DIR.'views/templates/sidebar1.php'; ?>
            </div>

            <!-- Main Content (Dashboard) - takes 9 columns width on medium screens and full width on smaller screens -->
            <div class="col-md-9 col-12">
                <h2>Logged In Students</h2>

                <!-- Always display the table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Login Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($students)): ?>
                                <!-- If there are logged-in students, loop through them -->
                                <?php foreach ($students as $student): ?>
                                    <tr>
                                        <td><?php echo $student['id']; ?></td>
                                        <td><?php echo $student['name']; ?></td>
                                        <td><?php echo $student['email']; ?></td>
                                        <td><?php echo $student['login_status'] ? 'Logged In' : 'Logged Out'; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <!-- If no logged-in students, display a message in the table -->
                                <tr>
                                    <td colspan="4" class="text-center">No students are currently logged in.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery for functionality -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <!-- Custom Table and Responsive Styling -->
    <style>
    /* Style the table container for responsiveness */
    .table-responsive {
        margin-top: 20px; /* Adds some space on top */
    }

    /* Table styling */
    .table {
    width: 100% !important;
    margin-left: 0 !important;
    color: #333 !important;
    border-collapse: collapse !important;
}


    /* Table header style */
    .table thead {
        background-color: gray;
        color: black; /* White text on dark background */
    }

    .table thead th {
        padding: 2px; /* Adds padding for better spacing */
        text-align: left; /* Align text to the left */
        font-size: 1rem; /* Slightly smaller text */
    }

    /* Table body styling */
    .table tbody tr {
        background-color: #fff;
    }

    .table tbody td {
        padding: 5px;
        vertical-align: middle; /* Center content vertically */
        font-size: 0.95rem; /* Slightly smaller text for table data */
    }

    /* Table row hover effect */
    .table tbody tr:hover {
        background-color: #f1f1f1; /* Light grey background on hover */
    }

    /* Styling for 'No data' row */
    .table tbody td.text-center {
        color: #888; /* Grey text for empty message */
        font-style: italic; /* Italicize the 'No students' message */
    }

    /* Responsive table */
    @media (max-width: 768px) {
        .table thead th {
            font-size: 0.9rem; /* Slightly smaller font on small screens */
        }

        .table tbody td {
            font-size: 0.85rem; /* Smaller text for mobile */
            padding: 8px; /* Less padding for mobile */
        }
    }
    </style>
</body>
</html>
