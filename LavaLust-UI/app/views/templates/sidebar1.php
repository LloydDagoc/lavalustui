<nav id="sidebar" class="custom-sidebar">
    <div class="position-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="/home">
                    <i class="fas fa-home me-2"></i> Home
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/user-management">
                    <i class="fas fa-users me-2"></i> User Management
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/exam-management">
                    <i class="fas fa-file-alt me-2"></i> Exam Management
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/question-management">
                    <i class="fas fa-question-circle me-2"></i> Question Management
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/view-result">
                    <i class="fas fa-chart-bar me-2"></i> View Result
                </a>
            </li>
        </ul>
    </div>
</nav>

<!-- Toggle Button for Smaller Screens -->
<button class="btn btn-primary d-md-none" id="sidebarToggle" type="button">
    <i class="fas fa-bars"></i> Menu
</button>

<style>
/* Sidebar container */
.custom-sidebar {
    height: 100vh;
    width: 250px;  /* Set a fixed width for the sidebar */
    background-color: white;  /* Set background color to white */
    color: #333;  /* Change text color to dark for better contrast */
    box-shadow: 0px 0 5px rgba(0, 0, 0, 0.1);
    z-index: 100;
    position: fixed;  /* Position the sidebar fixed to the left */
    top: 42px;
    left: 0;  /* Align the sidebar to the left edge */
    transition: transform 0.3s ease-in-out;
    margin: 0;  /* Remove any margin */
}

/* Sidebar links */
.custom-sidebar .nav-link {
    color: #333;  /* Set text color to dark */
    padding: 10px 0px;
    font-size: 1rem;
    transition: background-color 0.3s ease, color 0.3s ease;
}

/* Hover and active states */
.custom-sidebar .nav-link:hover,
.custom-sidebar .nav-link.active {
    background-color: #3b4a58;  /* Dark background for hover and active states */
    color: #e67e22;  /* Highlight text color */
    border-left: 3px solid #f39c12;  /* Add a left border for emphasis */
}

/* Sidebar icons */
.custom-sidebar .nav-link i {
    font-size: 1.2rem;
    color: #f39c12;
}

/* Responsive adjustments for smaller screens */
@media (max-width: 768px) {
    /* Sidebar behavior for small screens */
    .custom-sidebar {
        position: absolute;
        top: 0;
        left: -250px;  /* Initially hide sidebar off-screen */
        width: 250px;
        height: 100%;
        transition: left 0.3s ease-in-out;
    }

    /* When sidebar is toggled open */
    .custom-sidebar.open {
        left: 0;  /* Slide in sidebar */
    }

    /* Sidebar links for small screens */
    .custom-sidebar .nav-link {
        text-align: center;
    }

    /* Toggle Button */
    #sidebarToggle {
        position: absolute;
        top: 15px;
        left: 15px;
        z-index: 9999;
    }
}
</style>

<script>
// Toggle sidebar on mobile screens
document.getElementById('sidebarToggle').addEventListener('click', function () {
    document.getElementById('sidebar').classList.toggle('open');
});

// Add active class on click and handle current page
document.querySelectorAll('.nav-link').forEach(function (link) {
    // Set active link based on current URL
    if (window.location.pathname === link.getAttribute('href')) {
        link.classList.add('active');
    }

    // Add click event to dynamically add/remove active class
    link.addEventListener('click', function () {
        // Remove active class from all links
        document.querySelectorAll('.nav-link').forEach(function (el) {
            el.classList.remove('active');
        });
        // Add active class to clicked link
        link.classList.add('active');
    });
});
</script>
