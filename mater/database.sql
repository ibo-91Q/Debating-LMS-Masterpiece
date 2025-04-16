<?php
// Database connection details
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'education_portal');

// Attempt to connect to MySQL database
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Create the database
$sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
if(mysqli_query($conn, $sql)){
    echo "Database created successfully<br>";
} else{
    echo "ERROR: Could not execute $sql. " . mysqli_error($conn) . "<br>";
}

// Select the database
mysqli_select_db($conn, DB_NAME);

// Array of SQL statements - TABLES WITHOUT FOREIGN KEYS FIRST
$sql_statements = array(
    // Users table - no foreign keys
    "CREATE TABLE IF NOT EXISTS users (
        user_id INT AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(50) NOT NULL,
        last_name VARCHAR(50) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        password_hash VARCHAR(255) NOT NULL,
        profile_image VARCHAR(255) DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        last_login TIMESTAMP NULL
    )",
    
    // Categories table - no foreign keys
    "CREATE TABLE IF NOT EXISTS categories (
        category_id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        description TEXT,
        icon VARCHAR(50),
        icon_color VARCHAR(20) DEFAULT 'blue',
        course_count INT DEFAULT 0
    )",
    
    // Difficulty levels table - no foreign keys
    "CREATE TABLE IF NOT EXISTS difficulty_levels (
        level_id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL,
        description TEXT
    )",
    
    // Subscription plans table - no foreign keys
    "CREATE TABLE IF NOT EXISTS subscription_plans (
        plan_id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL,
        price DECIMAL(10,2) NOT NULL,
        billing_period VARCHAR(20) DEFAULT 'monthly',
        description TEXT,
        features TEXT,
        is_active BOOLEAN DEFAULT TRUE
    )",
    
    // TABLES WITH FOREIGN KEYS - ORDERED BY DEPENDENCY
    
    // Administrators table - depends on users
    "CREATE TABLE IF NOT EXISTS administrators (
        admin_id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL UNIQUE,
        role VARCHAR(50) DEFAULT 'admin',
        permissions TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(user_id)
    )",
    
    // Teachers table - depends on users
    "CREATE TABLE IF NOT EXISTS teachers (
        teacher_id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL UNIQUE,
        bio TEXT,
        expertise TEXT,
        qualifications TEXT,
        approved BOOLEAN DEFAULT FALSE,
        rating DECIMAL(3,2) DEFAULT 0,
        course_count INT DEFAULT 0,
        student_count INT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(user_id)
    )",
    
    // Courses table - depends on categories, difficulty_levels, users(instructors)
    "CREATE TABLE IF NOT EXISTS courses (
        course_id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT,
        category_id INT,
        level_id INT,
        instructor_id INT,
        duration_minutes INT DEFAULT 0,
        image_url VARCHAR(255),
        rating DECIMAL(3,2) DEFAULT 0,
        student_count INT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (category_id) REFERENCES categories(category_id),
        FOREIGN KEY (level_id) REFERENCES difficulty_levels(level_id),
        FOREIGN KEY (instructor_id) REFERENCES users(user_id)
    )",
    
    // Debate topics - depends on categories
    "CREATE TABLE IF NOT EXISTS debate_topics (
        topic_id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        category_id INT,
        duration_minutes INT DEFAULT 7,
        is_active BOOLEAN DEFAULT TRUE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (category_id) REFERENCES categories(category_id)
    )",
    
    // Events table - depends on users(organizers)
    "CREATE TABLE IF NOT EXISTS events (
        event_id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT,
        event_type VARCHAR(50) NOT NULL,
        start_time TIMESTAMP NOT NULL,
        end_time TIMESTAMP NOT NULL,
        max_participants INT DEFAULT NULL,
        organizer_id INT,
        is_active BOOLEAN DEFAULT TRUE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (organizer_id) REFERENCES users(user_id)
    )",
    
    // Teacher applications - depends on users and administrators
    "CREATE TABLE IF NOT EXISTS teacher_applications (
        application_id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        resume_url VARCHAR(255),
        application_text TEXT,
        status VARCHAR(20) DEFAULT 'pending',
        reviewer_id INT,
        review_notes TEXT,
        submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        reviewed_at TIMESTAMP NULL,
        FOREIGN KEY (user_id) REFERENCES users(user_id),
        FOREIGN KEY (reviewer_id) REFERENCES administrators(admin_id)
    )",
    
    // Modules table - depends on courses
    "CREATE TABLE IF NOT EXISTS modules (
        module_id INT AUTO_INCREMENT PRIMARY KEY,
        course_id INT NOT NULL,
        title VARCHAR(255) NOT NULL,
        description TEXT,
        sequence_order INT NOT NULL,
        FOREIGN KEY (course_id) REFERENCES courses(course_id) ON DELETE CASCADE
    )",
    
    // Enrollments table - depends on users and courses
    "CREATE TABLE IF NOT EXISTS enrollments (
        enrollment_id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        course_id INT NOT NULL,
        progress DECIMAL(5,2) DEFAULT 0,
        enrolled_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        completed_at TIMESTAMP NULL,
        FOREIGN KEY (user_id) REFERENCES users(user_id),
        FOREIGN KEY (course_id) REFERENCES courses(course_id),
        UNIQUE (user_id, course_id)
    )",
    
    // Course reviews - depends on courses and users
    "CREATE TABLE IF NOT EXISTS course_reviews (
        review_id INT AUTO_INCREMENT PRIMARY KEY,
        course_id INT NOT NULL,
        user_id INT NOT NULL,
        rating INT NOT NULL,
        comment TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (course_id) REFERENCES courses(course_id),
        FOREIGN KEY (user_id) REFERENCES users(user_id),
        UNIQUE (user_id, course_id)
    )",
    
    // Practice sessions - depends on users and debate_topics
    "CREATE TABLE IF NOT EXISTS practice_sessions (
        session_id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        topic_id INT NOT NULL,
        started_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        completed_at TIMESTAMP NULL,
        duration_seconds INT DEFAULT 0,
        recording_url VARCHAR(255) DEFAULT NULL,
        FOREIGN KEY (user_id) REFERENCES users(user_id),
        FOREIGN KEY (topic_id) REFERENCES debate_topics(topic_id)
    )",
    
    // Event participants - depends on events and users
    "CREATE TABLE IF NOT EXISTS event_participants (
        event_id INT NOT NULL,
        user_id INT NOT NULL,
        registered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        attended BOOLEAN DEFAULT FALSE,
        PRIMARY KEY (event_id, user_id),
        FOREIGN KEY (event_id) REFERENCES events(event_id),
        FOREIGN KEY (user_id) REFERENCES users(user_id)
    )",
    
    // Notifications - depends on users
    "CREATE TABLE IF NOT EXISTS notifications (
        notification_id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        content TEXT NOT NULL,
        notification_type VARCHAR(50) NOT NULL,
        related_id INT,
        is_read BOOLEAN DEFAULT FALSE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(user_id)
    )",
    
    // User subscriptions - depends on users and subscription_plans
    "CREATE TABLE IF NOT EXISTS user_subscriptions (
        subscription_id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        plan_id INT NOT NULL,
        start_date TIMESTAMP NOT NULL,
        end_date TIMESTAMP NULL,
        is_active BOOLEAN DEFAULT TRUE,
        payment_status VARCHAR(20) DEFAULT 'paid',
        FOREIGN KEY (user_id) REFERENCES users(user_id),
        FOREIGN KEY (plan_id) REFERENCES subscription_plans(plan_id)
    )",
    
    // User stats - depends on users
    "CREATE TABLE IF NOT EXISTS user_stats (
        stat_id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        course_progress DECIMAL(5,2) DEFAULT 0,
        practice_count INT DEFAULT 0,
        community_rating DECIMAL(3,2) DEFAULT 0,
        tracked_month DATE NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(user_id),
        UNIQUE (user_id, tracked_month)
    )",
    
    // Lessons - depends on modules
    "CREATE TABLE IF NOT EXISTS lessons (
        lesson_id INT AUTO_INCREMENT PRIMARY KEY,
        module_id INT NOT NULL,
        title VARCHAR(255) NOT NULL,
        content TEXT,
        video_url VARCHAR(255) DEFAULT NULL,
        duration_minutes INT DEFAULT 0,
        sequence_order INT NOT NULL,
        FOREIGN KEY (module_id) REFERENCES modules(module_id) ON DELETE CASCADE
    )",
    
    // Lesson progress - depends on users and lessons
    "CREATE TABLE IF NOT EXISTS lesson_progress (
        progress_id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        lesson_id INT NOT NULL,
        is_completed BOOLEAN DEFAULT FALSE,
        completion_date TIMESTAMP NULL,
        time_spent_seconds INT DEFAULT 0,
        FOREIGN KEY (user_id) REFERENCES users(user_id),
        FOREIGN KEY (lesson_id) REFERENCES lessons(lesson_id),
        UNIQUE (user_id, lesson_id)
    )",
    
    // Peer feedback - depends on practice_sessions and users
    "CREATE TABLE IF NOT EXISTS peer_feedback (
        feedback_id INT AUTO_INCREMENT PRIMARY KEY,
        session_id INT NOT NULL,
        reviewer_id INT NOT NULL,
        rating DECIMAL(3,2) DEFAULT 0,
        comment TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (session_id) REFERENCES practice_sessions(session_id),
        FOREIGN KEY (reviewer_id) REFERENCES users(user_id)
    )",
    
    // Admin activity log - depends on administrators
    "CREATE TABLE IF NOT EXISTS admin_activity_log (
        log_id INT AUTO_INCREMENT PRIMARY KEY,
        admin_id INT NOT NULL,
        action VARCHAR(100) NOT NULL,
        entity_type VARCHAR(50) NOT NULL,
        entity_id INT NOT NULL,
        details TEXT,
        ip_address VARCHAR(45),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (admin_id) REFERENCES administrators(admin_id)
    )"
);

// Execute each SQL statement
foreach($sql_statements as $index => $sql) {
    if(mysqli_query($conn, $sql)){
        echo "Table " . ($index + 1) . " created successfully<br>";
    } else{
        echo "ERROR: Could not execute $sql. " . mysqli_error($conn) . "<br>";
    }
}

// Insert initial data
$insert_statements = array(
    // Insert categories
    "INSERT INTO categories (name, description, icon, icon_color)
    VALUES 
    ('Public Speaking', 'Learn effective public speaking techniques', 'bi-people', 'blue'),
    ('Critical Thinking', 'Develop logical reasoning and analysis skills', 'bi-lightbulb', 'purple'),
    ('Argumentation', 'Master the art of constructing compelling arguments', 'bi-clipboard-data', 'green'),
    ('Rhetoric', 'Study persuasive speaking and writing techniques', 'bi-chat-quote', 'orange'),
    ('Technology', 'Topics related to technology and its impacts', 'bi-cpu', 'blue'),
    ('Politics', 'Topics related to political systems and governance', 'bi-flag', 'purple'),
    ('Education', 'Topics related to educational systems and policies', 'bi-book', 'green'),
    ('Environment', 'Topics related to environmental issues', 'bi-tree', 'green'),
    ('Economics', 'Topics related to economic systems and policies', 'bi-currency-exchange', 'orange')",
    
    // Insert difficulty levels
    "INSERT INTO difficulty_levels (name, description)
    VALUES 
    ('Beginner', 'For those new to debating with little to no experience'),
    ('Intermediate', 'For those with some debating experience looking to improve'),
    ('Advanced', 'For experienced debaters looking to master advanced techniques')",
    
    // Insert sample subscription plans
    "INSERT INTO subscription_plans (name, price, billing_period, description)
    VALUES 
    ('Free', 0.00, 'monthly', 'Basic access to the platform'),
    ('Pro', 19.00, 'monthly', 'Full access to all features and courses'),
    ('Teams', 49.00, 'monthly', 'For debate teams and educational institutions')"
);

// Execute each insert statement
foreach($insert_statements as $sql) {
    try {
        if(mysqli_query($conn, $sql)){
            echo "Data inserted successfully<br>";
        } else{
            echo "ERROR: Could not execute $sql. " . mysqli_error($conn) . "<br>";
        }
    } catch (Exception $e) {
        echo "Warning: " . $e->getMessage() . "<br>";
    }
}

echo "<br>Database setup completed!";

// Close connection
mysqli_close($conn);
?> 