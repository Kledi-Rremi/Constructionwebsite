<?php
require_once '../db.php';

// Handle mark as answered BEFORE any output
if (isset($_GET['mark_answered']) && isset($_GET['email'])) {
    $id = intval($_GET['mark_answered']);
    $email = $_GET['email'];
    $stmt = $pdo->prepare("UPDATE contacts SET status = 'handled' WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: contact.php?open_gmail=1&email=" . urlencode($email));
    exit;
}

$openGmail = isset($_GET['open_gmail']) && isset($_GET['email']);
$gmailEmail = $openGmail ? $_GET['email'] : '';

include('includes/header.php');
?>

<!-- Hamburger menu button for mobile -->
<button id="sidebarToggle" class="d-lg-none btn btn-dark p-2"
  style="position:fixed;top:16px;right:16px;z-index:2000;width:38px;height:38px;display:flex;align-items:center;justify-content:center;">
  <span style="font-size:1.3rem;line-height:1;">&#9776;</span>
</button>
<div id="sidebarOverlay"></div>

<style>
/* Even smaller and more compact for mobile */
@media (max-width: 767.98px) {
  .container {
    padding-left: 2px !important;
    padding-right: 2px !important;
  }
  .card {
    margin: 0 !important;
  }
  .card-header {
    font-size: 0.95rem !important;
    padding: 0.4rem 0.7rem !important;
  }
  .card-body {
    padding: 0.4rem !important;
  }
  .table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }
  table.table {
    font-size: 0.75rem !important;
    min-width: 520px;
  }
  th, td {
    padding: 0.22rem !important;
    word-break: break-word;
  }
  .btn {
    font-size: 0.75rem !important;
    padding: 0.15rem 0.4rem !important;
  }
}
/* Sidebar and overlay for mobile */
@media (max-width: 991.98px) {
  #sidenav-main {
    position: fixed !important;
    top: 0 !important;
    left: -260px !important;
    width: 220px !important;
    height: 100vh !important;
    background: #232323 !important;
    z-index: 2500 !important;
    transition: left 0.3s ease !important;
    transform: none !important;
    will-change: left !important;
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
</style>

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Leads
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                try {
                                    $stmt = $pdo->query("SELECT id, name, email, subject, message, created_at, status FROM contacts ORDER BY created_at DESC");
                                    $leads = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    if ($leads) {
                                        foreach ($leads as $row) {
                                            echo "<tr>";
                                            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['subject']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['message']) . "</td>";
                                            echo "<td>" . htmlspecialchars(date('Y-m-d H:i:s', strtotime($row['created_at']))) . "</td>";
                                            $isAnswered = (isset($row['status']) && $row['status'] === 'handled');
                                            $status = $isAnswered ? 'Answered' : 'Unanswered';
                                            echo "<td>";
                                            echo htmlspecialchars($status);
                                            if (!$isAnswered) {
                                                $link = "?mark_answered=" . urlencode($row['id']) . "&email=" . urlencode($row['email']);
                                                echo " <a href='$link' class='btn btn-sm btn-primary'>Contact</a>";
                                            }
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='7'>No leads found.</td></tr>";
                                    }
                                } catch (PDOException $e) {
                                    echo "<tr><td colspan='7'>Error fetching leads: " . $e->getMessage() . "</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

<?php if ($openGmail && !empty($gmailEmail)): ?>
<script>
    // Open Gmail compose in a new tab after status is updated, then remove params from URL
    window.onload = function() {
        window.open("https://mail.google.com/mail/?view=cm&fs=1&to=<?php echo urlencode($gmailEmail); ?>", "_blank");
        window.location.href = "contact.php";
    };
</script>
<?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const sidebar = document.getElementById('sidenav-main');
  const overlay = document.getElementById('sidebarOverlay');
  const toggleBtn = document.getElementById('sidebarToggle');

  if (toggleBtn && sidebar && overlay) {
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

    window.addEventListener('resize', function() {
      if (window.innerWidth > 991) {
        sidebar.classList.remove('open');
        overlay.classList.remove('active');
      }
    });
  }
});
</script>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    session_destroy();
    header('Location: login.php');
    exit;
}
?>