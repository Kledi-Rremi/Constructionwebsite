<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// Placeholder data for charts (replace with actual data from your database)
$projectStatusData = [
    'labels' => ['Ongoing', 'Completed', 'On Hold', 'Pending'],
    'data' => [5, 18, 2, 3] // Example: 5 ongoing, 18 completed, etc.
];

$monthlyLeadsData = [
    'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'], // Example: Last 6 months
    'data' => [10, 15, 8, 20, 25, 18] // Example: Number of leads per month
];

?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" />
<?php include('includes/header.php'); ?>

<!-- Hamburger menu button for mobile -->
<button id="sidebarToggle" class="d-lg-none btn btn-dark p-2"
  style="position:fixed;top:16px;right:16px;z-index:2000;width:40px;height:40px;display:flex;align-items:center;justify-content:center;">
  <span style="font-size:1.5rem;line-height:1;">&#9776;</span>
</button>

<div id="sidebarOverlay"></div>

<!-- Sidebar and overlay CSS -->
<style>
@media (max-width: 991.98px) {
  #sidenav-main {
    position: fixed !important;
    top: 0 !important;
    left: -260px !important;
    width: 240px !important;
    height: 100vh !important;
    background: #232323 !important;
    z-index: 2500 !important;
    transition: left 0.3s ease !important;
    transform: none !important; /* Override Material Dashboard transforms */
    will-change: left !important; /* Override Material Dashboard effects */
  }
  #sidenav-main.open {
    left: 0 !important;
    transform: none !important;
  }
  #sidebarOverlay {
    display: none !important;
    position: fixed !important;
    top: 0 !important; 
    left: 0 !important; 
    right: 0 !important; 
    bottom: 0 !important;
    background: rgba(0,0,0,0.3) !important;
    z-index: 2400 !important;
  }
  #sidebarOverlay.active {
    display: block !important;
  }
}
.chart-container {
    position: relative;
    margin: auto;
    height: 300px; /* Adjust as needed */
    width: 100%;   /* Adjust as needed */
}
</style>

<div class="container" style="margin-left:0;" id="mainContent">
    <h2>Welcome admin!</h2>
    <div class="ms-3">
        <h3 class="mb-0 h4 font-weight-bolder">Dashboard</h3>
        <p class="mb-4">
            Here you can manage your website, view statistics, and access various admin features. Use the sidebar to navigate through different sections.
        </p>
    </div>
    <div class="row dashboard-card">
        <!-- Today's Website Views -->
        <div class="col-xl-3 col-sm-6 col-12 mb-4">
            <div class="card">
                <div class="card-header p-2 ps-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="text-sm mb-0 text-capitalize">Today's Website Views</p>
                            <h4 class="mb-0">1,245</h4>
                        </div>
                        <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                            <i class="material-symbols-rounded opacity-10">visibility</i>
                        </div>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-2 ps-3">
                    <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+8% </span>than yesterday</p>
                </div>
            </div>
        </div>
        <!-- Today's Contacts -->
        <div class="col-xl-3 col-sm-6 col-12 mb-4">
            <div class="card">
                <div class="card-header p-2 ps-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="text-sm mb-0 text-capitalize">Today's Contacts</p>
                            <h4 class="mb-0">12</h4>
                        </div>
                        <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                            <i class="material-symbols-rounded opacity-10">mail</i>
                        </div>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-2 ps-3">
                    <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+2 </span>new today</p>
                </div>
            </div>
        </div>
        <!-- Ongoing Projects -->
        <div class="col-xl-3 col-sm-6 col-12 mb-4">
            <div class="card">
                <div class="card-header p-2 ps-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="text-sm mb-0 text-capitalize">Ongoing Projects</p>
                            <h4 class="mb-0"><?= htmlspecialchars($projectStatusData['data'][0] ?? 0) ?></h4>
                        </div>
                        <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                            <i class="material-symbols-rounded opacity-10">construction</i>
                        </div>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-2 ps-3">
                    <p class="mb-0 text-sm"><span class="text-info font-weight-bolder">+1 </span>new this week</p>
                </div>
            </div>
        </div>
        <!-- Completed Projects -->
        <div class="col-xl-3 col-sm-6 col-12 mb-4">
            <div class="card">
                <div class="card-header p-2 ps-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="text-sm mb-0 text-capitalize">Completed Projects</p>
                            <h4 class="mb-0"><?= htmlspecialchars($projectStatusData['data'][1] ?? 0) ?></h4>
                        </div>
                        <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                            <i class="material-symbols-rounded opacity-10">check_circle</i>
                        </div>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-2 ps-3">
                    <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+3 </span>this month</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row mt-4">
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h6 class="mb-0">Project Status Overview</h6>
                </div>
                <div class="card-body p-3">
                    <div class="chart-container">
                        <canvas id="projectStatusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h6 class="mb-0">Monthly Leads</h6>
                </div>
                <div class="card-body p-3">
                    <div class="chart-container">
                        <canvas id="monthlyLeadsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Charts Section -->

</div>

<?php include('includes/footer.php'); ?>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const sidebar = document.getElementById('sidenav-main');
  const overlay = document.getElementById('sidebarOverlay');
  const toggleBtn = document.getElementById('sidebarToggle');

  if (toggleBtn && sidebar && overlay) { // Ensure elements exist
    toggleBtn.onclick = function() {
      sidebar.classList.toggle('open');
      overlay.classList.toggle('active');
      document.body.classList.toggle('g-sidenav-pinned');
    };

    overlay.onclick = function() {
      sidebar.classList.remove('open');
      overlay.classList.remove('active');
      document.body.classList.remove('g-sidenav-pinned');
    };
  }

  window.addEventListener('resize', function() {
    if (window.innerWidth > 991) {
      if (sidebar) sidebar.classList.remove('open');
      if (overlay) overlay.classList.remove('active');
      document.body.classList.remove('g-sidenav-pinned');
    }
  });

  // Chart.js Initialization
  // 1. Monthly Website Views Chart (Line Chart)
  const websiteViewsCtx = document.getElementById('projectStatusChart');
  if (websiteViewsCtx) {
    new Chart(websiteViewsCtx, {
      type: 'line',
      data: {
        labels: <?php echo json_encode($monthlyLeadsData['labels']); ?>, // Use same months as leads
        datasets: [{
          label: "Website Views",
          data: [1200, 1350, 1100, 1500, 1700, 1600], // Example data, replace with real values
          backgroundColor: 'rgba(255, 99, 132, 0.2)',
          borderColor: 'rgba(255, 99, 132, 1)',
          borderWidth: 2,
          fill: true,
          tension: 0.4
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: true,
            position: 'top'
          },
          title: {
            display: false
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              stepSize: 200 // Adjust as needed
            }
          }
        }
      }
    });
  }

  // 2. Monthly Leads Chart (Bar Chart)
  const monthlyLeadsCtx = document.getElementById('monthlyLeadsChart');
  if (monthlyLeadsCtx) {
    new Chart(monthlyLeadsCtx, {
      type: 'bar',
      data: {
        labels: <?php echo json_encode($monthlyLeadsData['labels']); ?>,
        datasets: [{
          label: 'Number of Leads',
          data: <?php echo json_encode($monthlyLeadsData['data']); ?>,
          backgroundColor: 'rgba(54, 162, 235, 0.7)', // Blue
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
                stepSize: 5 // Adjust step size as needed
            }
          }
        },
        plugins: {
          legend: {
            display: false // Can be true if you want to show 'Number of Leads'
          },
          title: {
            display: false, // Already have a card header
            text: 'Monthly Leads'
          }
        }
      }
    });
  }
});
</script>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}