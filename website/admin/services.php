<?php
require_once '../db.php'; // Ensure this path is correct for your db.php

// Handle Create
if (isset($_POST['create'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $icon = $_POST['icon'];
    $display_order = intval($_POST['display_order']);
    $is_active = isset($_POST['is_active']) ? 1 : 0;
    $stmt = $pdo->prepare("INSERT INTO services (title, description, icon, display_order, is_active) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$title, $description, $icon, $display_order, $is_active]);
    header("Location: services.php");
    exit;
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $pdo->prepare("DELETE FROM services WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: services.php");
    exit;
}

// Handle Edit - Fetch data for the form
$editService = null;
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $stmt = $pdo->prepare("SELECT * FROM services WHERE id = ?");
    $stmt->execute([$id]);
    $editService = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Handle Update
if (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $title = $_POST['title'];
    $description = $_POST['description'];
    $icon = $_POST['icon'];
    $display_order = intval($_POST['display_order']);
    $is_active = isset($_POST['is_active']) ? 1 : 0;
    $stmt = $pdo->prepare("UPDATE services SET title=?, description=?, icon=?, display_order=?, is_active=? WHERE id=?");
    $stmt->execute([$title, $description, $icon, $display_order, $is_active, $id]);
    header("Location: services.php");
    exit;
}

// Fetch all services for the table
$stmt = $pdo->query("SELECT * FROM services ORDER BY display_order ASC, id ASC");
$services = $stmt->fetchAll(PDO::FETCH_ASSOC);

include('includes/header.php'); // Ensure this path is correct
?>

<!-- Hamburger menu button for mobile -->
<button id="sidebarToggle" class="d-lg-none btn btn-dark p-2"
  style="position:fixed;top:16px;right:16px;z-index:2000;width:38px;height:38px;display:flex;align-items:center;justify-content:center;">
  <span style="font-size:1.3rem;line-height:1;">&#9776;</span>
</button>
<div id="sidebarOverlay"></div>

<style>
.table th, .table td {
    vertical-align: middle !important;
}
.btn-edit {
    background: #ff3e6c !important; /* Example color, adjust as needed */
    color: #fff !important;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    padding: 0.3rem 1.2rem;
}
.btn-delete {
    background: #dc3545 !important; /* Bootstrap danger color */
    color: #fff !important;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    padding: 0.3rem 1.2rem;
}

/* Custom Icon Checkbox Styles */
.icon-checkbox-container {
    display: flex;
    align-items: center;
    gap: 0.5rem; /* Space between icon and text label */
    margin-bottom: 1rem; /* Matches .mb-2 */
}
.icon-checkbox-clickable-area {
    cursor: pointer;
    display: inline-block;
    width: 24px; /* Adjust size of clickable icon area */
    height: 24px; /* Adjust size of clickable icon area */
    position: relative;
    vertical-align: middle;
}
.icon-checkbox-clickable-area input[type="checkbox"] {
    opacity: 0; /* Hide the actual checkbox visually */
    width: 0;
    height: 0;
    position: absolute;
}
.icon-checkbox-clickable-area .icon-indicator {
    font-size: 1.5rem; /* Size of the tick/cross icon */
    font-weight: bold;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    line-height: 1; /* Helps center icon */
}
.icon-checkbox-clickable-area input[type="checkbox"] + .icon-indicator .ri-check-line {
    display: none; /* Hidden by default */
    color: #28a745; /* Green for active */
}
.icon-checkbox-clickable-area input[type="checkbox"] + .icon-indicator .ri-close-line {
    display: inline-block; /* Shown by default (for inactive) */
    color: #dc3545; /* Red for inactive */
}
.icon-checkbox-clickable-area input[type="checkbox"]:checked + .icon-indicator .ri-check-line {
    display: inline-block; /* Show green tick when checked */
}
.icon-checkbox-clickable-area input[type="checkbox"]:checked + .icon-indicator .ri-close-line {
    display: none; /* Hide red cross when checked */
}
.icon-checkbox-text-label {
    cursor: pointer; /* Make text label clickable too */
    vertical-align: middle;
    margin-bottom: 0; 
}

/* Even smaller and more compact for mobile */
@media (max-width: 767.98px) {
  .container { 
    padding-left: 2px !important;
    padding-right: 2px !important;
  }
  .card { 
    margin: 0 !important; 
  }
  .btn-edit, .btn-delete { 
    font-size: 0.75rem !important; /* Adjusted from 0.8rem */
    padding: 0.15rem 0.4rem !important; /* Adjusted from 0.2rem 0.6rem */
  }
  input, textarea, select, .form-label { 
    font-size: 0.85rem !important; /* Adjusted from 0.9rem */
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
    min-width: 520px; /* Ensures table is scrollable if content is too wide */
  }
  th, td {
    padding: 0.22rem !important;
    word-break: break-word; /* Helps prevent overly wide cells */
  }
  .btn { /* General button sizing for mobile */
    font-size: 0.75rem !important;
    padding: 0.15rem 0.4rem !important;
  }
  .icon-checkbox-clickable-area { /* Adjust icon checkbox for mobile */
    width: 20px;
    height: 20px;
  }
  .icon-checkbox-clickable-area .icon-indicator {
    font-size: 1.2rem;
  }
}

/* Sidebar and overlay for mobile */
@media (max-width: 991.98px) {
  #sidenav-main {
    position: fixed !important;
    top: 0 !important;
    left: -260px !important; /* Adjust width if your sidebar is different */
    width: 220px !important; /* Adjust width */
    height: 100vh !important;
    background: #232323 !important; /* Or your sidebar background */
    z-index: 2500 !important;
    transition: left 0.3s ease !important;
    transform: none !important; /* Overriding existing transform if any */
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
<div class="container mt-4">
    <div class="row">
        <!-- Table Section - Full Width - MOVED TO TOP -->
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header" style="font-weight:bold; font-size:1.2rem;">
                    Services
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle" style="background:#f9fbfc;">
                            <thead style="background:#f5f7fa;">
                                <tr>
                                    <th style="width:40px;">ID</th>
                                    <th>Name</th>
                                    <th style="width:70px;">Icon</th>
                                    <th style="width:70px;">Order</th>
                                    <th style="width:70px;">Active</th>
                                    <th style="width:150px;">Created At</th>
                                    <th style="width:90px;">Status</th>
                                    <th style="width:110px;">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($services as $service): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($service['id']) ?></td>
                                        <td><?= htmlspecialchars($service['title']) ?></td>
                                        <td>
                                            <span style="display:inline-block;width:40px;height:40px;text-align:center;">
                                                <i class="<?= htmlspecialchars($service['icon']) ?>" style="font-size:2rem;"></i>
                                            </span>
                                        </td>
                                        <td><?= htmlspecialchars($service['display_order']) ?></td>
                                        <td>
                                            <?php if ($service['is_active']): ?>
                                                <i class="ri-check-line" style="color:#28a745;font-size:1.5rem;font-weight:bold;"></i>
                                            <?php else: ?>
                                                <i class="ri-close-line" style="color:#dc3545;font-size:1.5rem;font-weight:bold;"></i>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= htmlspecialchars($service['created_at']) ?></td>
                                        <td>
                                            <?php if ($service['is_active']): ?>
                                                <span style="color:#28a745;font-weight:500;">Visible</span>
                                            <?php else: ?>
                                                <span style="color:#dc3545;font-weight:500;">Hidden</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="?edit=<?= $service['id'] ?>" class="btn btn-sm btn-edit">EDIT</a>
                                            <a href="?delete=<?= $service['id'] ?>" class="btn btn-sm btn-delete" onclick="return confirm('Are you sure you want to delete this service?')">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php if (empty($services)): ?>
                                    <tr><td colspan="8" class="text-center">No services found.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Section - Full Width - MOVED TO BOTTOM -->
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    <?php if ($editService): ?>
                        Edit Service (ID: <?= htmlspecialchars($editService['id']) ?>)
                    <?php else: ?>
                        Add New Service
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <form method="post">
                        <?php if ($editService): ?>
                            <input type="hidden" name="id" value="<?= htmlspecialchars($editService['id']) ?>">
                        <?php endif; ?>
                        <div class="mb-2">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" required value="<?= htmlspecialchars($editService['title'] ?? '') ?>">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" required><?= htmlspecialchars($editService['description'] ?? '') ?></textarea>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Remix Icon class (e.g. ri-tools-line)</label>
                            <input type="text" name="icon" class="form-control" required value="<?= htmlspecialchars($editService['icon'] ?? '') ?>">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Display Order</label>
                            <input type="number" name="display_order" class="form-control" min="1" required value="<?= htmlspecialchars($editService['display_order'] ?? '1') ?>">
                        </div>
                        
                        <div class="icon-checkbox-container">
                            <label class="icon-checkbox-clickable-area" for="is_active_input">
                                <input type="checkbox" name="is_active" id="is_active_input"
                                    <?= (isset($editService['is_active']) ? ($editService['is_active'] ? 'checked' : '') : 'checked') ?>>
                                <span class="icon-indicator">
                                    <i class="ri-check-line"></i>
                                    <i class="ri-close-line"></i>
                                </span>
                            </label>
                            <label class="icon-checkbox-text-label" for="is_active_input">Active</label>
                        </div>
                        
                        <button type="submit" name="<?= $editService ? 'update' : 'create' ?>" class="btn btn-primary">
                            <?= $editService ? 'Update Service' : 'Create Service' ?>
                        </button>
                        <?php if ($editService): ?>
                            <a href="services.php" class="btn btn-secondary">Cancel Edit</a>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); // Ensure this path is correct ?>