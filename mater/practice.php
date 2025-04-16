<?php
// Start the session
session_start();

// Check if the user is logged in, if not redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Database connection parameters
$host = "localhost";
$dbname = "debateskills";
$username = "root";
$password = "";

// Establish database connection
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Get debate topics
$topics = [];
$categories = [];

// Get all categories
try {
    $stmt = $conn->prepare("SELECT id, name FROM categories");
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    // Handle error silently
}

// Get debate topics with filter if provided
$category_filter = isset($_GET['category']) ? $_GET['category'] : null;
$search_query = isset($_GET['search']) ? '%' . $_GET['search'] . '%' : null;

try {
    $sql = "SELECT t.id, t.title, t.duration, c.name as category 
            FROM debate_topics t 
            JOIN categories c ON t.category_id = c.id 
            WHERE 1=1";
    
    $params = [];
    
    // Add category filter if provided
    if ($category_filter) {
        $sql .= " AND c.id = :category_id";
        $params[':category_id'] = $category_filter;
    }
    
    // Add search query if provided
    if ($search_query) {
        $sql .= " AND t.title LIKE :search";
        $params[':search'] = $search_query;
    }
    
    $sql .= " ORDER BY t.id DESC";
    
    $stmt = $conn->prepare($sql);
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    
    $stmt->execute();
    $topics = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    // Default topics if database query fails
    $topics = [
        ['id' => 1, 'title' => 'This house believes that social media has done more harm than good', 'category' => 'Technology', 'duration' => 7],
        ['id' => 2, 'title' => 'This house would ban private schools', 'category' => 'Education', 'duration' => 7],
        ['id' => 3, 'title' => 'This house believes that cryptocurrencies do more harm than good', 'category' => 'Economics', 'duration' => 5],
        ['id' => 4, 'title' => 'This house supports universal basic income', 'category' => 'Economics', 'duration' => 6]
    ];
}

// Handle topic selection via AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'select_topic') {
    $topic_id = $_POST['topic_id'];
    
    try {
        // Log topic selection in the database
        $stmt = $conn->prepare("INSERT INTO user_topic_selections (user_id, topic_id, selected_at) 
                              VALUES (:user_id, :topic_id, NOW())");
        $stmt->bindParam(':user_id', $_SESSION["id"], PDO::PARAM_INT);
        $stmt->bindParam(':topic_id', $topic_id, PDO::PARAM_INT);
        $stmt->execute();
        
        // Get the topic details to send back
        $stmt = $conn->prepare("SELECT t.title, t.duration, c.name as category 
                              FROM debate_topics t 
                              JOIN categories c ON t.category_id = c.id 
                              WHERE t.id = :topic_id");
        $stmt->bindParam(':topic_id', $topic_id, PDO::PARAM_INT);
        $stmt->execute();
        $topic = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Return JSON response
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'topic' => $topic]);
        exit;
    } catch(PDOException $e) {
        // Return error
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Database error']);
        exit;
    }
}

// Handle timer recording
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'record_practice') {
    $topic_id = $_POST['topic_id'];
    $duration = $_POST['duration'];
    
    try {
        // Record practice session
        $stmt = $conn->prepare("INSERT INTO practice_sessions (user_id, topic_id, duration, date_completed) 
                              VALUES (:user_id, :topic_id, :duration, NOW())");
        $stmt->bindParam(':user_id', $_SESSION["id"], PDO::PARAM_INT);
        $stmt->bindParam(':topic_id', $topic_id, PDO::PARAM_INT);
        $stmt->bindParam(':duration', $duration, PDO::PARAM_INT);
        $stmt->execute();
        
        // Return success
        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
        exit;
    } catch(PDOException $e) {
        // Return error
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Database error']);
        exit;
    }
}

// Close connection
unset($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DebateSkills - Practice</title>

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

        .filter-select {
            padding: 10px 16px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            background-color: white;
            font-size: 14px;
            font-weight: 500;
            height: 100%;
        }

        .topic-card {
            background-color: white;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            padding: 20px;
            margin-bottom: 16px;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .topic-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .topic-card.selected {
            border-color: var(--primary-color);
            box-shadow: 0 5px 15px -3px rgba(37, 99, 235, 0.2);
        }

        .topic-title {
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .topic-tag {
            display: inline-flex;
            align-items: center;
            background-color: var(--light-gray);
            color: var(--gray-color);
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 13px;
            margin-right: 8px;
        }

        .topic-tag i {
            margin-right: 4px;
            font-size: 12px;
        }

        .btn-start-practice {
            background-color: var(--primary-color);
            color: white;
            font-weight: 500;
            border-radius: 8px;
            padding: 10px 18px;
            border: none;
            display: flex;
            align-items: center;
        }

        .btn-start-practice:hover {
            background-color: #1D4ED8;
            color: white;
        }

        .btn-start-practice:disabled {
            background-color: var(--gray-color);
            cursor: not-allowed;
        }

        .btn-start-practice i {
            margin-right: 8px;
        }

        .timer-card {
            background-color: white;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            padding: 24px;
        }

        .timer-display {
            font-size: 3rem;
            font-weight: 700;
            color: var(--primary-color);
            text-align: center;
            margin: 20px 0;
        }

        .timer-controls {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .btn-timer-start {
            background-color: var(--success-color);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px 24px;
            font-weight: 500;
            display: flex;
            align-items: center;
        }

        .btn-timer-start i {
            margin-right: 8px;
        }

        .btn-timer-reset {
            background-color: var(--light-gray);
            color: var(--dark-color);
            border: none;
            border-radius: 8px;
            padding: 10px 24px;
            font-weight: 500;
            display: flex;
            align-items: center;
        }

        .btn-timer-reset i {
            margin-right: 8px;
        }

        .tips-card {
            background-color: white;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            padding: 24px;
            margin-top: 24px;
        }

        .tips-title {
            font-weight: 600;
            font-size: 18px;
            margin-bottom: 16px;
        }

        .tip-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .tip-item:last-child {
            margin-bottom: 0;
        }

        .tip-icon {
            color: var(--success-color);
            margin-right: 12px;
            margin-top: 4px;
        }

        .tip-text {
            font-size: 14px;
            color: #6B7280;
        }

        .page-title {
            font-weight: 700;
            font-size: 24px;
            margin-bottom: 24px;
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
        
        .dropdown-menu {
            border-radius: 8px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--border-color);
            padding: 0.5rem;
        }

        .dropdown-item {
            border-radius: 6px;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        .dropdown-item:hover {
            background-color: var(--primary-light);
        }

        .dropdown-divider {
            margin: 0.5rem 0;
        }
        
        #practiceCompletedModal .modal-content {
            border-radius: 12px;
            border: none;
        }
        
        #practiceCompletedModal .modal-header {
            border-bottom: none;
            padding-bottom: 0;
        }
        
        #practiceCompletedModal .modal-body {
            padding: 1.5rem;
            text-align: center;
        }
        
        .success-icon {
            width: 80px;
            height: 80px;
            background-color: var(--success-light);
            color: var(--success-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">DebateSkills</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">
                            <i class="bi bi-house-door me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="courses.php">
                            <i class="bi bi-journal-text me-1"></i> Courses
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="practice.php">
                            <i class="bi bi-mic me-1"></i> Practice
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="community.php">
                            <i class="bi bi-people me-1"></i> Community
                        </a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <div class="notification-icon me-3">
                        <i class="bi bi-bell fs-5"></i>
                        <span class="notification-badge">3</span>
                    </div>
                    <div class="dropdown">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User Avatar" class="user-avatar dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><span class="dropdown-item fw-bold">User Name</span></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="profile.php"><i class="bi bi-person me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="settings.php"><i class="bi bi-gear me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container py-4">
        <div class="row">
            <!-- Left Column: Debate Topics -->
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="page-title mb-0">Practice Debate</h1>
                    <button class="btn-start-practice" id="startPracticeBtn" disabled>
                        <i class="bi bi-mic-fill"></i> Start Practice
                    </button>
                </div>

                <div class="row mb-4">
                    <div class="col-md-8">
                        <form id="searchForm" method="get" action="practice.php">
                            <input type="text" name="search" class="search-input" placeholder="Search motions..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                        </form>
                    </div>
                    <div class="col-md-4">
                        <select class="filter-select w-100" id="categoryFilter" name="category">
                            <option value="">All Categories</option>
                            <?php foreach($categories as $category): ?>
                                <option value="<?php echo $category['id']; ?>" <?php echo (isset($_GET['category']) && $_GET['category'] == $category['id']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($category['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Debate Topics List -->
                <div id="topicsList">
                    <?php if (count($topics) > 0): ?>
                        <?php foreach($topics as $topic): ?>
                            <div class="topic-card" data-topic-id="<?php echo $topic['id']; ?>">
                                <h3 class="topic-title"><?php echo htmlspecialchars($topic['title']); ?></h3>
                                <div class="d-flex align-items-center">
                                    <div class="topic-tag">
                                        <?php 
                                        $icon = 'cpu';
                                        if ($topic['category'] == 'Education') {
                                            $icon = 'book';
                                        } elseif ($topic['category'] == 'Economics') {
                                            $icon = 'currency-exchange';
                                        } elseif ($topic['category'] == 'Politics') {
                                            $icon = 'flag';
                                        } elseif ($topic['category'] == 'Environment') {
                                            $icon = 'tree';
                                        }
                                        ?>
                                        <i class="bi bi-<?php echo $icon; ?>"></i> <?php echo htmlspecialchars($topic['category']); ?>
                                    </div>
                                    <div class="topic-tag">
                                        <i class="bi bi-clock"></i> <?php echo $topic['duration']; ?> minutes
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="alert alert-info">No debate topics found. Try adjusting your search criteria.</div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Right Column: Timer and Tips -->
            <div class="col-lg-4">
                <div class="timer-card">
                    <h3 class="tips-title">Timer</h3>
                    <div class="timer-display" id="timerDisplay">07:00</div>
                    <div class="timer-controls">
                        <button class="btn-timer-start" id="timerStartBtn" disabled>
                            <i class="bi bi-play-fill"></i> Start
                        </button>
                        <button class="btn-timer-reset" id="timerResetBtn" disabled>
                            <i class="bi bi-arrow-repeat"></i> Reset
                        </button>
                    </div>
                </div>

                <div class="tips-card">
                    <h3 class="tips-title">Quick Tips</h3>
                    <div class="tip-item">
                        <i class="bi bi-check-circle-fill tip-icon"></i>
                        <div class="tip-text">Structure your argument clearly</div>
                    </div>
                    <div class="tip-item">
                        <i class="bi bi-check-circle-fill tip-icon"></i>
                        <div class="tip-text">Use evidence to support claims</div>
                    </div>
                    <div class="tip-item">
                        <i class="bi bi-check-circle-fill tip-icon"></i>
                        <div class="tip-text">Address counterarguments</div>
                    </div>
                    <div class="tip-item">
                        <i class="bi bi-check-circle-fill tip-icon"></i>
                        <div class="tip-text">Maintain confident body language</div>
                    </div>
                    <div class="tip-item">
                        <i class="bi bi-check-circle-fill tip-icon"></i>
                        <div class="tip-text">Practice effective time management</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Practice Completed Modal -->
    <div class="modal fade" id="practiceCompletedModal" tabindex="-1" aria-labelledby="practiceCompletedModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="success-icon">
                        <i class="bi bi-check-lg"></i>
                    </div>
                    <h2 class="mb-3">Practice Completed!</h2>
                    <p class="mb-4">Great job! You've completed your practice session. Would you like to get feedback on your debate?</p>
                    <div class="d-flex justify-content-center gap-3">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Not Now</button>
                        <a href="feedback.php" class="btn btn-primary">Get Feedback</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const topicCards = document.querySelectorAll('.topic-card');
            const startPracticeBtn = document.getElementById('startPracticeBtn');
            const timerDisplay = document.querySelector('.timer-display');
            const timerStartBtn = document.getElementById('timerStartBtn');
            const timerResetBtn = document.getElementById('timerResetBtn');
            const categoryFilter = document.getElementById('categoryFilter');
            const searchForm = document.getElementById('searchForm');
            
            let selectedTopicId = null;
            let timer;
            let timeLeft = 7 * 60; // 7 minutes in seconds
            let isRunning = false;
            let originalTime = timeLeft;
            let practiceCompletedModal = new bootstrap.Modal(document.getElementById('practiceCompletedModal'));
            
            // Apply category filter
            categoryFilter.addEventListener('change', function() {
                searchForm.action = `practice.php${this.value ? '?category=' + this.value : ''}`;
                searchForm.submit();
            });
            
            // Topic selection
            topicCards.forEach(card => {
                card.addEventListener('click', function() {
                    // Remove selected class from all cards
                    topicCards.forEach(c => c.classList.remove('selected'));
                    
                    // Add selected class to clicked card
                    this.classList.add('selected');
                    
                    // Get topic ID and update selected topic
                    selectedTopicId = this.dataset.topicId;
                    
                    // Enable practice button
                    startPracticeBtn.disabled = false;
                    
                    // Record selection in database via AJAX
                    fetch('practice.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `action=select_topic&topic_id=${selectedTopicId}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success && data.topic) {
                            // Update timer based on topic duration
                            timeLeft = data.topic.duration * 60;
                            originalTime = timeLeft;
                            updateTimerDisplay();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                });
            });
            
            // Start practice button
            startPracticeBtn.addEventListener('click', function() {
                if (selectedTopicId) {
                    // Enable timer buttons
                    timerStartBtn.disabled = false;
                    timerResetBtn.disabled = false;
                    
                    // Scroll to timer
                    document.querySelector('.timer-card').scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
            
            // Update timer display
            function updateTimerDisplay() {
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                timerDisplay.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
            }
            
            // Timer start/pause button
            timerStartBtn.addEventListener('click', function() {
                if (isRunning) {
                    // Pause the timer
                    clearInterval(timer);
                    timerStartBtn.innerHTML = '<i class="bi bi-play-fill"></i> Start';
                    isRunning = false;
                } else {
                    // Start the timer
                    if (timeLeft > 0) {
                        timer = setInterval(function() {
                            timeLeft--;
                            updateTimerDisplay();
                            
                            if (timeLeft <= 0) {
                                clearInterval(timer);
                                timerStartBtn.innerHTML = '<i class="bi bi-play-fill"></i> Start';
                                isRunning = false;
                                
                                // Record practice session
                                recordPracticeSession();
                                
                                // Show completion modal
                                practiceCompletedModal.show();
                            }
                        }, 1000);
                        
                        timerStartBtn.innerHTML = '<i class="bi bi-pause-fill"></i> Pause';
                        isRunning = true;
                    }
                }
            });
            
            // Timer reset button
            timerResetBtn.addEventListener('click', function() {
                clearInterval(timer);
                timeLeft = originalTime;
                updateTimerDisplay();
                timerStartBtn.innerHTML = '<i class="bi bi-play-fill"></i> Start';
                isRunning = false;
            });
            
            // Record practice session
            function recordPracticeSession() {
                fetch('practice.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `action=record_practice&topic_id=${selectedTopicId}&duration=${originalTime - timeLeft}`
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Practice recorded:', data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        });