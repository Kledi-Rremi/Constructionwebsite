<?php
require_once '../db.php'; // Ensure this path is correct for your db.php

$upload_dir = '../assets/img/projects/'; // Relative to this admin script
$upload_dir_for_db = 'assets/img/projects/'; // Path to store in DB (relative to site root)

// Function to handle file upload and return new image path or null/error
function handle_image_upload($file_input_name, $current_image_path_for_db = null) {
    global $upload_dir, $upload_dir_for_db;

    if (isset($_FILES[$file_input_name]) && $_FILES[$file_input_name]['error'] == UPLOAD_ERR_OK) {
        $file_tmp_path = $_FILES[$file_input_name]['tmp_name'];
        $file_name = basename($_FILES[$file_input_name]['name']); // Sanitize filename
        $file_size = $_FILES[$file_input_name]['size'];
        $file_type = $_FILES[$file_input_name]['type'];
        $file_ext_arr = explode('.', $file_name);
        $file_ext = strtolower(end($file_ext_arr));

        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $max_file_size = 5 * 1024 * 1024; // 5MB

        if (!in_array($file_ext, $allowed_extensions)) {
            $_SESSION['error_message'] = "Invalid file type. Only JPG, JPEG, PNG, GIF are allowed.";
            return ['error' => $_SESSION['error_message']];
        }
        if ($file_size > $max_file_size) {
            $_SESSION['error_message'] = "File is too large. Maximum size is 5MB.";
            return ['error' => $_SESSION['error_message']];
        }

        // Ensure upload directory exists
        if (!is_dir($upload_dir) && !mkdir($upload_dir, 0777, true)) {
             $_SESSION['error_message'] = "Failed to create upload directory.";
             return ['error' => $_SESSION['error_message']];
        }


        $new_file_name = uniqid('project_', true) . '.' . $file_ext;
        $destination_path_on_server = $upload_dir . $new_file_name;

        if (move_uploaded_file($file_tmp_path, $destination_path_on_server)) {
            // If updating and there was an old image, delete it
            if ($current_image_path_for_db && file_exists('../' . $current_image_path_for_db)) {
                unlink('../' . $current_image_path_for_db);
            }
            return ['path' => $upload_dir_for_db . $new_file_name];
        } else {
            $_SESSION['error_message'] = "Failed to move uploaded file.";
            return ['error' => $_SESSION['error_message']];
        }
    } elseif (isset($_FILES[$file_input_name]) && $_FILES[$file_input_name]['error'] != UPLOAD_ERR_NO_FILE) {
        $_SESSION['error_message'] = "Error uploading file: " . $_FILES[$file_input_name]['error'];
        return ['error' => $_SESSION['error_message']];
    }
    return ['path' => $current_image_path_for_db]; // No new file uploaded or error, return current/null
}

// Handle Create
if (isset($_POST['create_project'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $created_at = $_POST['created_at'];
    
    $image_upload_result = handle_image_upload('image');
    if (isset($image_upload_result['error'])) {
        // Error message already set in session by handle_image_upload
    } else {
        $image_path = $image_upload_result['path'] ?? ''; // Default to empty if no image
        $stmt = $pdo->prepare("INSERT INTO projects (name, description, created_at, image_path) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$name, $description, $created_at, $image_path])) {
            $_SESSION['success_message'] = "Project created successfully.";
        } else {
            $_SESSION['error_message'] = "Failed to create project.";
        }
    }
    header("Location: projects.php");
    exit;
}

// Handle Delete
if (isset($_GET['delete_project'])) {
    $id = intval($_GET['delete_project']);
    
    // Fetch image_path to delete the file
    $stmt_select = $pdo->prepare("SELECT image_path FROM projects WHERE id = ?");
    $stmt_select->execute([$id]);
    $project_to_delete = $stmt_select->fetch(PDO::FETCH_ASSOC);

    $stmt_delete = $pdo->prepare("DELETE FROM projects WHERE id = ?");
    if ($stmt_delete->execute([$id])) {
        if ($project_to_delete && !empty($project_to_delete['image_path']) && file_exists('../' . $project_to_delete['image_path'])) {
            unlink('../' . $project_to_delete['image_path']);
        }
        $_SESSION['success_message'] = "Project deleted successfully.";
    } else {
        $_SESSION['error_message'] = "Failed to delete project.";
    }
    header("Location: projects.php");
    exit;
}

// Handle Edit - Fetch data for the form
$editProject = null;
if (isset($_GET['edit_project'])) {
    $id = intval($_GET['edit_project']);
    $stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ?");
    $stmt->execute([$id]);
    $editProject = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Handle Update
if (isset($_POST['update_project'])) {
    $id = intval($_POST['id']);
    $name = $_POST['name'];
    $description = $_POST['description'];
    $created_at = $_POST['created_at'];
    $current_image_path = $_POST['current_image_path']; // Existing image path

    $image_upload_result = handle_image_upload('image', $current_image_path);
     if (isset($image_upload_result['error'])) {
        // Error message already set in session
    } else {
        $image_path = $image_upload_result['path'];
        $stmt = $pdo->prepare("UPDATE projects SET name=?, description=?, created_at=?, image_path=? WHERE id=?");
        if ($stmt->execute([$name, $description, $created_at, $image_path, $id])) {
            $_SESSION['success_message'] = "Project updated successfully.";
        } else {
            $_SESSION['error_message'] = "Failed to update project.";
        }
    }
    header("Location: projects.php");
    exit;
}

// Fetch all projects for the table
$stmt = $pdo->query("SELECT * FROM projects ORDER BY created_at DESC, id DESC");
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Start session if not already started for flash messages
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('includes/header.php'); // Ensure this path is correct
?>

<!-- Hamburger menu button for mobile -->
<button id="sidebarToggle" class="d-lg-none btn btn-dark p-2"
  style="position:fixed;top:16px;right:16px;z-index:2000;width:38px;height:38px;display:flex;align-items:center;justify-content:center;">
  <span style="font-size:1.3rem;line-height:1;">&#9776;</span>
</button>
<div id="sidebarOverlay"></div>


<style>
.table th, .table td { vertical-align: middle !important; }
.btn-edit { background: #ff3e6c !important; color: #fff !important; border: none; border-radius: 8px; font-weight: bold; padding: 0.3rem 1.2rem; }
.btn-delete { background: #dc3545 !important; color: #fff !important; border: none; border-radius: 8px; font-weight: bold; padding: 0.3rem 1.2rem; }
.project-image-thumbnail { max-width: 100px; max-height: 70px; object-fit: cover; border-radius: 4px; }
.current-project-image { max-width: 200px; max-height: 150px; object-fit: cover; border-radius: 4px; margin-bottom: 10px; display: block; }

/* Styles for custom file input button */
.custom-file-input-container {
    position: relative;
    overflow: hidden;
    display: inline-block; /* Or block, depending on layout needs */
    margin-bottom: 0.5rem; /* Spacing */
}
.custom-file-input-container input[type="file"] {
    position: absolute;
    left: 0;
    top: 0;
    opacity: 0; /* Make the actual input invisible */
    width: 100%;
    height: 100%;
    cursor: pointer;
}
.custom-file-button {
    /* Mimic Bootstrap button styles */
    display: inline-block;
    font-weight: 400;
    color: #212529;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-color: #e9ecef; /* Light gray, adjust as needed */
    border: 1px solid #ced4da;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: .25rem;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
.custom-file-button:hover {
    background-color: #dde1e5; /* Slightly darker on hover */
}
.file-name-display {
    margin-left: 10px;
    font-style: italic;
    color: #6c757d; /* Bootstrap muted color */
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
  .btn, .btn-edit, .btn-delete { /* General button sizing for mobile */
    font-size: 0.75rem !important;
    padding: 0.15rem 0.4rem !important;
  }
   input, textarea, select, .form-label { 
    font-size: 0.85rem !important; 
  }
  .custom-file-button { /* Adjust custom file button for mobile */
    font-size: 0.85rem !important;
    padding: .25rem .5rem !important;
  }
  .file-name-display {
    font-size: 0.8rem;
  }
  .project-image-thumbnail { max-width: 60px; max-height: 40px; }
  .current-project-image { max-width: 150px; max-height: 100px; }
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

<div class="container mt-4">
    <?php
    if (isset($_SESSION['success_message'])) {
        echo '<div class="alert alert-success">' . htmlspecialchars($_SESSION['success_message']) . '</div>';
        unset($_SESSION['success_message']);
    }
    if (isset($_SESSION['error_message'])) {
        echo '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['error_message']) . '</div>';
        unset($_SESSION['error_message']);
    }
    ?>
    <div class="row">
        <!-- Table Section -->
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header" style="font-weight:bold; font-size:1.2rem;">
                    Manage Projects
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($projects as $project): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($project['id']) ?></td>
                                        <td>
                                            <?php if (!empty($project['image_path']) && file_exists('../' . $project['image_path'])): ?>
                                                <img src="../<?= htmlspecialchars($project['image_path']) ?>" alt="<?= htmlspecialchars($project['name']) ?>" class="project-image-thumbnail">
                                            <?php else: ?>
                                                No Image
                                            <?php endif; ?>
                                        </td>
                                        <td><?= htmlspecialchars($project['name']) ?></td>
                                        <td><?= nl2br(htmlspecialchars(substr($project['description'], 0, 100))) . (strlen($project['description']) > 100 ? '...' : '') ?></td>
                                        <td><?= htmlspecialchars(date("M d, Y", strtotime($project['created_at']))) ?></td>
                                        <td>
                                            <a href="?edit_project=<?= $project['id'] ?>" class="btn btn-sm btn-edit">EDIT</a>
                                            <a href="?delete_project=<?= $project['id'] ?>" class="btn btn-sm btn-delete" onclick="return confirm('Are you sure you want to delete this project and its image?')">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php if (empty($projects)): ?>
                                    <tr><td colspan="6" class="text-center">No projects found.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Section -->
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header" style="font-weight:bold; font-size:1.1rem;">
                    <?php if ($editProject): ?>
                        Edit Project (ID: <?= htmlspecialchars($editProject['id']) ?>)
                    <?php else: ?>
                        Add New Project
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
                        <?php if ($editProject): ?>
                            <input type="hidden" name="id" value="<?= htmlspecialchars($editProject['id']) ?>">
                            <input type="hidden" name="current_image_path" value="<?= htmlspecialchars($editProject['image_path'] ?? '') ?>">
                        <?php endif; ?>
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Project Name</label>
                            <input type="text" name="name" id="name" class="form-control" required value="<?= htmlspecialchars($editProject['name'] ?? '') ?>">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="4" required><?= htmlspecialchars($editProject['description'] ?? '') ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="created_at" class="form-label">Created At</label>
                            <input type="date" name="created_at" id="created_at" class="form-control" required value="<?= htmlspecialchars($editProject['created_at'] ?? date('Y-m-d')) ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label d-block"><?= $editProject && !empty($editProject['image_path']) ? 'Change Image (Optional)' : 'Project Image' ?></label>
                            <?php if ($editProject && !empty($editProject['image_path']) && file_exists('../' . $editProject['image_path'])): ?>
                                <img src="../<?= htmlspecialchars($editProject['image_path']) ?>" alt="Current Image" class="current-project-image">
                            <?php endif; ?>
                            
                            <div class="custom-file-input-container">
                                <label for="image" class="custom-file-button">Choose File</label>
                                <input type="file" name="image" id="image" class="form-control" <?= !$editProject ? 'required' : '' ?> onchange="document.getElementById('fileNameDisplay').textContent = this.files[0] ? this.files[0].name : 'No file chosen';">
                            </div>
                            <span id="fileNameDisplay" class="file-name-display">No file chosen</span>

                            <?php if ($editProject): ?>
                                <small class="form-text text-muted d-block">Leave empty to keep the current image.</small>
                            <?php endif; ?>
                        </div>
                        
                        <button type="submit" name="<?= $editProject ? 'update_project' : 'create_project' ?>" class="btn btn-primary">
                            <?= $editProject ? 'Update Project' : 'Create Project' ?>
                        </button>
                        <?php if ($editProject): ?>
                            <a href="projects.php" class="btn btn-secondary">Cancel Edit</a>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const sidebar = document.getElementById('sidenav-main');
  const overlay = document.getElementById('sidebarOverlay');
  const toggleBtn = document.getElementById('sidebarToggle');

  if (toggleBtn && sidebar && overlay) {
    toggleBtn.onclick = function() {
      sidebar.classList.toggle('open');
      overlay.classList.toggle('active');
      document.body.classList.toggle('g-sidenav-pinned'); // This class might be specific to a theme, ensure it's needed or remove if not.
    };

    overlay.onclick = function() {
      sidebar.classList.remove('open');
      overlay.classList.remove('active');
      document.body.classList.remove('g-sidenav-pinned'); // This class might be specific to a theme, ensure it's needed or remove if not.
    };

    // Optional: Close sidebar on window resize if it's open and screen is larger than mobile breakpoint
    window.addEventListener('resize', function() {
      if (window.innerWidth > 991) { // Corresponds to d-lg-none breakpoint
        if (sidebar.classList.contains('open')) {
          sidebar.classList.remove('open');
        }
        if (overlay.classList.contains('active')) {
          overlay.classList.remove('active');
        }
        if (document.body.classList.contains('g-sidenav-pinned')) { // This class might be specific to a theme
            document.body.classList.remove('g-sidenav-pinned');
        }
      }
    });
  }
});
</script>

<?php include('includes/footer.php'); // Ensure this path is correct ?>