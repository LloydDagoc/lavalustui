<?php
include APP_DIR.'views/templates/header.php';
?>
<body>
    <?php
    include APP_DIR.'views/templates/nav.php';
    ?>  
    <div id="app" class="container-fluid">
        <div class="row">
            <!-- Sidebar (takes 3 columns width on medium screens and full width on smaller screens) -->
            <div class="col-md-3 col-12">
                <?php include APP_DIR.'views/templates/sidebar1.php'; ?>
            </div>

            <!-- Main Content (Dashboard) - takes 9 columns width on medium screens and full width on smaller screens -->
            <div class="col-md-9 col-12">
                <div class="card custom-card">
                    <div class="card-header custom-card-header">Dashboard</div>
                    <div class="card-body custom-card-body">
                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</body>
</html>

<style>
/* Main container styling */
.custom-main {
    background-color: #f8f9fa;
    min-height: 10px;
    padding-top: 5px;
}

/* Styling for the container */
.custom-container {
    margin-top: 15px;  /* Adds 5px margin on top */
}

/* Centered card styling */
.custom-card {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    overflow: hidden;
    width:400px;
    margin-left:28%;
    margin-top: 8%;

}

/* Card header styling */
.custom-card-header {
    background-color: #007bff;
    color: #fff;
    font-weight: bold;
    text-align: center;
    padding:10px;
}

/* Card body styling */
.custom-card-body {
    font-size: 1.1rem;
    color: #333;
    text-align: center;
    padding: 5rem;
}
</style>
