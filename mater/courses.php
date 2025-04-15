<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DebateSkills - Courses</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-color: #2563EB;
            --primary-light: #EFF6FF;
            --success-color: #10B981;
            --success-light: #ECFDF5;
            --warning-color: #F59E0B;
            --warning-light: #FFFBEB;
            --danger-color: #EF4444;
            --danger-light: #FEF2F2;
            --purple-color: #8B5CF6;
            --purple-light: #F5F3FF;
            --dark-color: #1F2937;
            --gray-color: #9CA3AF;
            --light-gray: #F9FAFB;
            --border-color: #E5E7EB;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #F9FAFB;
            color: #1F2937;
        }

        .navbar {
            background-color: #FFFFFF;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color);
        }

        .nav-link {
            color: #4B5563;
            font-weight: 500;
            padding: 0.75rem 1rem;
        }

        .nav-link.active {
            color: var(--primary-color);
        }

        .search-container {
            max-width: 600px;
            margin: 0 auto;
            position: relative;
        }

        .search-input {
            padding: 12px 20px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            width: 100%;
            font-size: 16px;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-color);
        }

        .filter-select {
            padding: 10px 16px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            background-color: white;
            font-size: 14px;
            font-weight: 500;
        }

        .filter-button {
            padding: 10px 16px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            background-color: white;
            font-size: 14px;
            font-weight: 500;
        }

        .section-title {
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 24px;
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .view-all {
            font-size: 14px;
            font-weight: 500;
            color: var(--primary-color);
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .view-all i {
            margin-left: 4px;
        }

        .category-card {
            background-color: white;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            padding: 24px;
            display: flex;
            flex-direction: column;
            transition: all 0.2s ease;
            height: 100%;
        }

        .category-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .category-icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
        }

        .category-icon.blue {
            background-color: var(--primary-light);
            color: var(--primary-color);
        }

        .category-icon.purple {
            background-color: var(--purple-light);
            color: var(--purple-color);
        }

        .category-icon.green {
            background-color: var(--success-light);
            color: var(--success-color);
        }

        .category-icon.orange {
            background-color: #FEF3C7;
            color: #D97706;
        }

        .category-title {
            font-weight: 600;
            font-size: 18px;
            margin-bottom: 8px;
        }

        .category-count {
            color: var(--gray-color);
            font-size: 14px;
        }

        .course-card {
            background-color: white;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            overflow: hidden;
            transition: all 0.2s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .course-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .course-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .course-content {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .course-level {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            margin-bottom: 12px;
        }

        .course-level.beginner {
            background-color: var(--success-light);
            color: var(--success-color);
        }

        .course-level.intermediate {
            background-color: var(--warning-light);
            color: var(--warning-color);
        }

        .course-level.advanced {
            background-color: var(--danger-light);
            color: var(--danger-color);
        }

        .course-title {
            font-weight: 600;
            font-size: 18px;
            margin-bottom: 12px;
            color: var(--dark-color);
        }

        .course-description {
            font-size: 14px;
            color: #6B7280;
            margin-bottom: 16px;
            flex-grow: 1;
        }

        .instructor {
            display: flex;
            align-items: center;
            margin-bottom: 16px;
        }

        .instructor-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 12px;
        }

        .instructor-name {
            font-size: 14px;
            font-weight: 500;
        }

        .course-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid var(--border-color);
            padding-top: 16px;
        }

        .course-rating {
            display: flex;
            align-items: center;
            font-size: 14px;
            font-weight: 500;
        }

        .rating-star {
            color: #FBBF24;
            margin-right: 4px;
        }

        .course-students {
            color: var(--gray-color);
            font-size: 14px;
        }

        .btn-enroll {
            background-color: var(--primary-color);
            color: white;
            font-weight: 500;
            border-radius: 6px;
            padding: 8px 16px;
            border: none;
        }

        .btn-enroll:hover {
            background-color: #1D4ED8;
            color: white;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .notification-icon {
            position: relative;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background-color: var(--danger-color);
            color: white;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="index.html">DebateSkills</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.html">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="courses.html">Courses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="practice.html">Practice</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="community.html">Community</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <div class="notification-icon me-3">
                        <i class="bi bi-bell fs-5"></i>
                        <span class="notification-badge">3</span>
                    </div>
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User Avatar" class="user-avatar">
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container py-4">
        <!-- Search and Filters -->
        <div class="row mb-4">
            <div class="col-md-8">
                <div class="search-container">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="Search for courses...">
                </div>
            </div>
            <div class="col-md-4 d-flex justify-content-end">
                <select class="filter-select me-2">
                    <option>All Levels</option>
                    <option>Beginner</option>
                    <option>Intermediate</option>
                    <option>Advanced</option>
                </select>
                <button class="filter-button">
                    <i class="bi bi-sliders me-2"></i> Filters
                </button>
            </div>
        </div>

        <!-- Featured Categories -->
        <div class="section-title">
            <span>Featured Categories</span>
            <a href="#" class="view-all">View All <i class="bi bi-arrow-right"></i></a>
        </div>

        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="category-card">
                    <div class="category-icon blue">
                        <i class="bi bi-people fs-4"></i>
                    </div>
                    <h3 class="category-title">Public Speaking</h3>
                    <div class="category-count">12 Courses</div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="category-card">
                    <div class="category-icon purple">
                        <i class="bi bi-lightbulb fs-4"></i>
                    </div>
                    <h3 class="category-title">Critical Thinking</h3>
                    <div class="category-count">8 Courses</div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="category-card">
                    <div class="category-icon green">
                        <i class="bi bi-clipboard-data fs-4"></i>
                    </div>
                    <h3 class="category-title">Argumentation</h3>
                    <div class="category-count">15 Courses</div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="category-card">
                    <div class="category-icon orange">
                        <i class="bi bi-chat-quote fs-4"></i>
                    </div>

                    <?php
// Start session for user authentication if needed
session_start();

// Database connection details
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'education_portal');

// Attempt to connect to MySQL database
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Initialize variables for filtering and pagination
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$category = isset($_GET['category']) ? trim($_GET['category']) : '';
$price_min = isset($_GET['price_min']) ? (float)$_GET['price_min'] : 0;
$price_max = isset($_GET['price_max']) ? (float)$_GET['price_max'] : 1000; // Set a reasonable default max
$sort = isset($_GET['sort']) ? trim($_GET['sort']) : 'newest';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$per_page = 12; // Number of courses per page

// Get all available categories for filter
function getCategories($conn) {
    $sql = "SELECT DISTINCT category FROM courses ORDER BY category";
    $result = mysqli_query($conn, $sql);
    
    $categories = array();
    if($result && mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $categories[] = $row['category'];
        }
    }
    
    return $categories;
}

// Count total courses with filters
function countFilteredCourses($conn, $search, $category, $price_min, $price_max) {
    $sql = "SELECT COUNT(*) as total FROM courses WHERE 1=1";
    $params = array();
    $types = "";
    
    if(!empty($search)){
        $sql .= " AND (title LIKE ? OR description LIKE ?)";
        $searchParam = "%{$search}%";
        $params[] = $searchParam;
        $params[] = $searchParam;
        $types .= "ss";
    }
    
    if(!empty($category)){
        $sql .= " AND category = ?";
        $params[] = $category;
        $types .= "s";
    }
    
    $sql .= " AND price >= ? AND price <= ?";
    $params[] = $price_min;
    $params[] = $price_max;
    $types .= "dd";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        if(!empty($params)){
            mysqli_stmt_bind_param($stmt, $types, ...$params);
        }
        
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
            return $row['total'];
        }
    }
    
    return 0;
}

// Get filtered courses with pagination
function getFilteredCourses($conn, $search, $category, $price_min, $price_max, $sort, $page, $per_page) {
    $offset = ($page - 1) * $per_page;
    
    $sql = "SELECT id, title, description, instructor, price, image_url, rating, category, created_at 
            FROM courses WHERE 1=1";
    $params = array();
    $types = "";
    
    if(!empty($search)){
        $sql .= " AND (title LIKE ? OR description LIKE ?)";
        $searchParam = "%{$search}%";
        $params[] = $searchParam;
        $params[] = $searchParam;
        $types .= "ss";
    }
    
    if(!empty($category)){
        $sql .= " AND category = ?";
        $params[] = $category;
        $types .= "s";
    }
    
    $sql .= " AND price >= ? AND price <= ?";
    $params[] = $price_min;
    $params[] = $price_max;
    $types .= "dd";
    
    // Add sorting
    switch($sort) {
        case 'price_low':
            $sql .= " ORDER BY price ASC";
            break;
        case 'price_high':
            $sql .= " ORDER BY price DESC";
            break;
        case 'rating':
            $sql .= " ORDER BY rating DESC";
            break;
        case 'oldest':
            $sql .= " ORDER BY created_at ASC";
            break;
        case 'newest':
        default:
            $sql .= " ORDER BY created_at DESC";
    }
    
    $sql .= " LIMIT ? OFFSET ?";
    $params[] = $per_page;
    $params[] = $offset;
    $types .= "ii";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        if(!empty($params)){
            mysqli_stmt_bind_param($stmt, $types, ...$params);
        }
        
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            
            $courses = array();
            while($row = mysqli_fetch_assoc($result)){
                $courses[] = $row;
            }
            
            return $courses;
        }
    }
    
    return array();
}

// Get all categories
$allCategories = getCategories($conn);

// Count total courses with filters
$totalCourses = countFilteredCourses($conn, $search, $category, $price_min, $price_max);

// Calculate total pages
$totalPages = ceil($totalCourses / $per_page);

// Ensure current page is within valid range
$page = max(1, min($page, $totalPages));

// Get filtered courses for current page
$courses = getFilteredCourses($conn, $search, $category, $price_min, $price_max, $sort, $page, $per_page);

// Page title
$pageTitle = "Browse Courses";
if(!empty($category)) {
    $pageTitle = ucfirst($category) . " Courses";
}
if(!empty($search)) {
    $pageTitle = "Search Results for '" . htmlspecialchars($search) . "'";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> - E-Learning Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Header/Navigation -->
    <?php include 'includes/header.php'; ?>
    
    <!-- Page Header -->
    <section class="page-header bg-light py-4">
        <div class="container">
            <h1><?php echo $pageTitle; ?></h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Courses</li>
                    <?php if(!empty($category)): ?>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars(ucfirst($category)); ?></li>
                    <?php endif; ?>
                </ol>
            </nav>
        </div>
    </section>
    
    <!-- Courses Section -->
    <section class="courses-section py-5">
        <div class="container">
            <div class="row">
                <!-- Filters Sidebar -->
                <div class="col-lg-3 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Filters</h5>
                        </div>
                        <div class="card-body">
                            <form action="courses.php" method="GET" id="filter-form">
                                <!-- Search -->
                                <div class="mb-3">
                                    <label for="search" class="form-label">Search</label>
                                    <input type="text" class="form-control" id="search" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Keywords...">
                                </div>
                                
                                <!-- Categories -->
                                <div class="mb-3">
                                    <label class="form-label">Category</label>
                                    <select class="form-select" name="category">
                                        <option value="">All Categories</option>
                                        <?php foreach($allCategories as $cat): ?>
                                        <option value="<?php echo htmlspecialchars($cat); ?>" <?php echo ($category == $cat) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars(ucfirst($cat)); ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                                <!-- Price Range -->
                                <div class="mb-3">
                                    <label class="form-label">Price Range</label>
                                    <div class="d-flex align-items-center">
                                        <input type="number" class="form-control me-2" name="price_min" value="<?php echo $price_min; ?>" min="0" placeholder="Min">
                                        <span>-</span>
                                        <input type="number" class="form-control ms-2" name="price_max" value="<?php echo $price_max; ?>" min="0" placeholder="Max">
                                    </div>
                                </div>
                                
                                <!-- Sort By -->
                                <div class="mb-3">
                                    <label class="form-label">Sort By</label>
                                    <select class="form-select" name="sort">
                                        <option value="newest" <?php echo ($sort == 'newest') ? 'selected' : ''; ?>>Newest First</option>
                                        <option value="oldest" <?php echo ($sort == 'oldest') ? 'selected' : ''; ?>>Oldest First</option>
                                        <option value="price_low" <?php echo ($sort == 'price_low') ? 'selected' : ''; ?>>Price: Low to High</option>
                                        <option value="price_high" <?php echo ($sort == 'price_high') ? 'selected' : ''; ?>>Price: High to Low</option>
                                        <option value="rating" <?php echo ($sort == 'rating') ? 'selected' : ''; ?>>Highest Rated</option>
                                    </select>
                                </div>
                                
                                <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                                <a href="courses.php" class="btn btn-outline-secondary w-100 mt-2">Reset Filters</a>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Courses Grid -->
                <div class="col-lg-9">
                    <!-- Results Summary -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <p class="mb-0">Showing <strong><?php echo count($courses); ?></strong> of <strong><?php echo $totalCourses; ?></strong> courses</p>
                        
                        <div class="view-options">
                            <button class="btn btn-sm btn-outline-secondary me-2 active" id="grid-view-btn">
                                <i class="bi bi-grid-3x3-gap-fill"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-secondary" id="list-view-btn">
                                <i class="bi bi-list-ul"></i>
                            </button>
                        </div>
                    </div>
                    
                    <?php if(empty($courses)): ?>
                    <div class="alert alert-info">
                        <p class="mb-0">No courses found matching your criteria. Try adjusting your filters.</p>
                    </div>
                    <?php else: ?>
                    
                    <!-- Grid View (Default) -->
                    <div class="row" id="grid-view">
                        <?php foreach($courses as $course): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <img src="<?php echo htmlspecialchars($course['image_url']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($course['title']); ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($course['title']); ?></h5>
                                    <p class="card-text small text-muted"><?php echo htmlspecialchars(ucfirst($course['category'])); ?></p>
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="me-2">
                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                <i class="bi bi-star-fill <?php echo ($i <= $course['rating']) ? 'text-warning' : 'text-muted'; ?>"></i>
                                            <?php endfor; ?>
                                        </div>
                                        <span class="small text-muted">(<?php echo $course['rating']; ?>)</span>
                                    </div>
                                    <p class="card-text small mb-3"><?php echo htmlspecialchars(substr($course['description'], 0, 100)) . '...'; ?></p>
                                    <div class="d-flex justify-content-between align-items-center mt-auto">
                                        <p class="text-primary fw-bold mb-0">$<?php echo htmlspecialchars($course['price']); ?></p>
                                        <a href="course-details.php?id=<?php echo $course['id']; ?>" class="btn btn-sm btn-outline-primary">View Details</a>
                                    </div>
                                </div>
                                <div class="card-footer bg-white">
                                    <small class="text-muted">Instructor: <?php echo htmlspecialchars($course['instructor']); ?></small>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <!-- List View (Hidden by Default) -->
                    <div class="d-none" id="list-view">
                        <?php foreach($courses as $course): ?>
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-3">
                                    <img src="<?php echo htmlspecialchars($course['image_url']); ?>" class="img-fluid rounded-start h-100 object-fit-cover" alt="<?php echo htmlspecialchars($course['title']); ?>">
                                </div>
                                <div class="col-md-9">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="card-title"><?php echo htmlspecialchars($course['title']); ?></h5>
                                            <span class="badge bg-primary"><?php echo htmlspecialchars(ucfirst($course['category'])); ?></span>
                                        </div>
                                        <p class="card-text"><?php echo htmlspecialchars(substr($course['description'], 0, 200)) . '...'; ?></p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <p class="mb-0"><small class="text-muted">Instructor: <?php echo htmlspecialchars($course['instructor']); ?></small></p>
                                                <div class="d-flex align-items-center">
                                                    <div class="me-2">
                                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                                            <i class="bi bi-star-fill <?php echo ($i <= $course['rating']) ? 'text-warning' : 'text-muted'; ?>"></i>
                                                        <?php endfor; ?>
                                                    </div>
                                                    <span class="small text-muted">(<?php echo $course['rating']; ?>)</span>
                                                </div>
                                            </div>
                                            <div class="text-end">
                                                <p class="text-primary fw-bold mb-2">$<?php echo htmlspecialchars($course['price']); ?></p>
                                                <a href="course-details.php?id=<?php echo $course['id']; ?>" class="btn btn-outline-primary">View Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <!-- Pagination -->
                    <?php if($totalPages > 1): ?>
                    <nav aria-label="Course pagination" class="mt-4">
                        <ul class="pagination justify-content-center">
                            <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo $page-1; ?>&search=<?php echo urlencode($search); ?>&category=<?php echo urlencode($category); ?>&price_min=<?php echo $price_min; ?>&price_max=<?php echo $price_max; ?>&sort=<?php echo $sort; ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            
                            <?php for($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>&category=<?php echo urlencode($category); ?>&price_min=<?php echo $price_min; ?>&price_max=<?php echo $price_max; ?>&sort=<?php echo $sort; ?>">
                                    <?php echo $i; ?>
                                </a>
                            </li>
                            <?php endfor; ?>
                            
                            <li class="page-item <?php echo ($page >= $totalPages) ? 'disabled' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo $page+1; ?>&search=<?php echo urlencode($search); ?>&category=<?php echo urlencode($category); ?>&price_min=<?php echo $price_min; ?>&price_max=<?php echo $price_max; ?>&sort=<?php echo $sort; ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <?php endif; ?>
                    
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>
    
    <!-- Bootstrap JS and custom scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle between grid and list view
        document.addEventListener('DOMContentLoaded', function() {
            const gridViewBtn = document.getElementById('grid-