<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DebateSkills - Master the Art of Debate</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-color: #2563EB;
            --primary-dark: #1D4ED8;
            --primary-light: #EFF6FF;
            --success-color: #10B981;
            --success-light: #ECFDF5;
            --warning-color: #F59E0B;
            --warning-light: #FFFBEB;
            --purple-color: #8B5CF6;
            --purple-light: #F5F3FF;
            --dark-color: #1F2937;
            --gray-color: #9CA3AF;
            --light-gray: #F9FAFB;
            --border-color: #E5E7EB;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: #1F2937;
        }

        .navbar {
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.5rem;
            display: flex;
            align-items: center;
        }

        .navbar-brand i {
            margin-right: 8px;
        }

        .nav-link {
            color: #4B5563;
            font-weight: 500;
            padding: 0.5rem 1rem;
        }

        .btn-login {
            background-color: white;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
            border-radius: 8px;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            margin-right: 1rem;
            transition: all 0.2s ease;
        }

        .btn-login:hover {
            background-color: var(--primary-light);
            color: var(--primary-color);
        }

        .btn-signup {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-signup:hover {
            background-color: var(--primary-dark);
            color: white;
        }

        .hero-section {
            padding: 6rem 0;
            background: linear-gradient(135deg, var(--primary-light) 0%, white 100%);
        }

        .hero-title {
            font-weight: 800;
            font-size: 3.5rem;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            color: var(--dark-color);
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: #6B7280;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .hero-cta {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.75rem;
            font-weight: 600;
            font-size: 1.125rem;
            transition: all 0.2s ease;
        }

        .hero-cta:hover {
            background-color: var(--primary-dark);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .hero-secondary {
            background-color: white;
            color: var(--dark-color);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 0.75rem 1.75rem;
            font-weight: 600;
            font-size: 1.125rem;
            margin-left: 1rem;
            transition: all 0.2s ease;
        }

        .hero-secondary:hover {
            background-color: var(--light-gray);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .hero-image {
            max-width: 100%;
            border-radius: 12px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .features-section {
            padding: 6rem 0;
        }

        .section-title {
            font-weight: 700;
            font-size: 2.25rem;
            margin-bottom: 1rem;
            text-align: center;
        }

        .section-subtitle {
            color: #6B7280;
            text-align: center;
            max-width: 600px;
            margin: 0 auto 4rem;
            font-size: 1.125rem;
            line-height: 1.6;
        }

        .feature-card {
            background-color: white;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            padding: 2rem;
            margin-bottom: 2rem;
            transition: all 0.3s ease;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .feature-icon {
            width: 64px;
            height: 64px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            font-size: 1.75rem;
        }

        .feature-icon.blue {
            background-color: var(--primary-light);
            color: var(--primary-color);
        }

        .feature-icon.green {
            background-color: var(--success-light);
            color: var(--success-color);
        }

        .feature-icon.purple {
            background-color: var(--purple-light);
            color: var(--purple-color);
        }

        .feature-icon.yellow {
            background-color: var(--warning-light);
            color: var(--warning-color);
        }

        .feature-title {
            font-weight: 600;
            font-size: 1.25rem;
            margin-bottom: 1rem;
        }

        .feature-description {
            color: #6B7280;
            line-height: 1.6;
        }

        .testimonials-section {
            padding: 6rem 0;
            background-color: var(--light-gray);
        }

        .testimonial-card {
            background-color: white;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            padding: 2rem;
            margin-bottom: 2rem;
            height: 100%;
        }

        .testimonial-content {
            color: #4B5563;
            font-size: 1.125rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            font-style: italic;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
        }

        .author-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 1rem;
        }

        .author-info h4 {
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 0.25rem;
        }

        .author-info p {
            color: #6B7280;
            font-size: 0.875rem;
            margin-bottom: 0;
        }

        .pricing-section {
            padding: 6rem 0;
        }

        .pricing-card {
            background-color: white;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            padding: 2rem;
            margin-bottom: 2rem;
            transition: all 0.3s ease;
            height: 100%;
        }

        .pricing-card.featured {
            border-color: var(--primary-color);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            position: relative;
            overflow: hidden;
        }

        .featured-badge {
            position: absolute;
            top: 12px;
            right: -30px;
            background-color: var(--primary-color);
            color: white;
            padding: 0.5rem 2rem;
            transform: rotate(45deg);
            font-weight: 500;
            font-size: 0.75rem;
        }

        .pricing-title {
            font-weight: 600;
            font-size: 1.25rem;
            margin-bottom: 1rem;
            color: var(--dark-color);
        }

        .pricing-price {
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            color: var(--dark-color);
        }

        .pricing-period {
            color: #6B7280;
            font-size: 1rem;
            margin-bottom: 1.5rem;
            display: block;
        }

        .pricing-features {
            list-style: none;
            padding: 0;
            margin-bottom: 2rem;
        }

        .pricing-features li {
            padding: 0.5rem 0;
            display: flex;
            align-items: center;
        }

        .pricing-features li i {
            color: var(--success-color);
            margin-right: 0.5rem;
        }

        .pricing-cta {
            width: 100%;
            padding: 0.75rem 0;
            font-weight: 500;
            border-radius: 8px;
        }

        .pricing-cta.primary {
            background-color: var(--primary-color);
            color: white;
            border: none;
        }

        .pricing-cta.primary:hover {
            background-color: var(--primary-dark);
        }

        .pricing-cta.secondary {
            background-color: white;
            color: var(--dark-color);
            border: 1px solid var(--border-color);
        }

        .pricing-cta.secondary:hover {
            background-color: var(--light-gray);
        }

        .cta-section {
            padding: 6rem 0;
            background: linear-gradient(135deg, var(--primary-color) 0%, #3B82F6 100%);
            color: white;
        }

        .cta-title {
            font-weight: 700;
            font-size: 2.25rem;
            margin-bottom: 1rem;
        }

        .cta-description {
            font-size: 1.125rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .cta-button {
            background-color: white;
            color: var(--primary-color);
            border: none;
            border-radius: 8px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            font-size: 1.125rem;
            transition: all 0.2s ease;
        }

        .cta-button:hover {
            background-color: var(--light-gray);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.2);
        }

        .footer {
            background-color: var(--dark-color);
            color: white;
            padding: 4rem 0 2rem;
        }

        .footer-logo {
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }

        .footer-logo i {
            margin-right: 8px;
        }

        .footer-description {
            color: #9CA3AF;
            margin-bottom: 2rem;
            max-width: 300px;
        }

        .footer-title {
            font-weight: 600;
            font-size: 1.125rem;
            margin-bottom: 1.5rem;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 0.75rem;
        }

        .footer-links a {
            color: #9CA3AF;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .footer-links a:hover {
            color: white;
        }

        .footer-bottom {
            border-top: 1px solid #374151;
            padding-top: 2rem;
            margin-top: 2rem;
            color: #9CA3AF;
            font-size: 0.875rem;
        }

        .social-links {
            display: flex;
        }

        .social-link {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: #374151;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.75rem;
            transition: all 0.2s ease;
        }

        .social-link:hover {
            background-color: var(--primary-color);
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-chat-square-text"></i> DebateSkills
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimonials">Testimonials</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pricing">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#faq">FAQ</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a href="login.html" class="btn btn-login">Log in</a>
                    <a href="signup.html" class="btn btn-signup">Sign up</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="hero-title">Master the Art of Debate</h1>
                    <p class="hero-subtitle">Enhance your critical thinking, persuasive speaking, and argumentation skills through our comprehensive platform designed for debaters of all levels.</p>
                    <div>
                        <a href="signup.html" class="btn hero-cta">Get Started For Free</a>
                        <a href="#features" class="btn hero-secondary">Learn More</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="https://cdn.pixabay.com/photo/2018/09/24/10/20/team-3699889_1280.jpg" alt="Debaters in action" class="hero-image mt-5 mt-lg-0">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section" id="features">
        <div class="container">
            <h2 class="section-title">Everything You Need to Excel in Debates</h2>
            <p class="section-subtitle">Our platform provides comprehensive tools and resources to help you develop strong debating skills and achieve success in competitions.</p>
            
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon blue">
                            <i class="bi bi-journal-text"></i>
                        </div>
                        <h3 class="feature-title">Structured Courses</h3>
                        <p class="feature-description">Learn from expert-designed courses covering all aspects of debate, from basics to advanced techniques.</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon green">
                            <i class="bi bi-mic"></i>
                        </div>
                        <h3 class="feature-title">Practice Sessions</h3>
                        <p class="feature-description">Refine your skills with timed practice debates on a wide range of topics across different formats.</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon purple">
                            <i class="bi bi-people"></i>
                        </div>
                        <h3 class="feature-title">Community Feedback</h3>
                        <p class="feature-description">Get constructive feedback from peers and experts to continuously improve your debating style.</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon yellow">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <h3 class="feature-title">Performance Analytics</h3>
                        <p class="feature-description">Track your progress with detailed analytics on your strengths and areas for improvement.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section" id="testimonials">
        <div class="container">
            <h2 class="section-title">What Our Members Say</h2>
            <p class="section-subtitle">Hear from students and educators who have transformed their debating skills with our platform.</p>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <p class="testimonial-content">"DebateSkills has been instrumental in my growth as a debater. The structured courses and practice opportunities helped me win our regional championship!"</p>
                        <div class="testimonial-author">
                            <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Sarah Johnson" class="author-avatar">
                            <div class="author-info">
                                <h4>Sarah Johnson</h4>
                                <p>College Debate Champion</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <p class="testimonial-content">"As a debate coach, I've seen remarkable improvement in my students' performance since we started using DebateSkills. The resources are exceptional."</p>
                        <div class="testimonial-author">
                            <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="Michael Roberts" class="author-avatar">
                            <div class="author-info">
                                <h4>Michael Roberts</h4>
                                <p>High School Debate Coach</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <p class="testimonial-content">"The community feedback feature is amazing! Getting constructive criticism from experienced debaters has helped me identify blind spots in my arguments."</p>
                        <div class="testimonial-author">
                            <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Emma Chen" class="author-avatar">
                            <div class="author-info">
                                <h4>Emma Chen</h4>
                                <p>University Debate Team Member</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="pricing-section" id="pricing">
        <div class="container">
            <h2 class="section-title">Simple, Transparent Pricing</h2>
            <p class="section-subtitle">Choose the plan that best fits your needs and start improving your debate skills today.</p>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="pricing-card">
                        <h3 class="pricing-title">Free</h3>
                        <div class="pricing-price">$0</div>
                        <span class="pricing-period">Forever free</span>
                        
                        <ul class="pricing-features">
                            <li><i class="bi bi-check-circle-fill"></i> Access to basic courses</li>
                            <li><i class="bi bi-check-circle-fill"></i> 5 practice sessions per month</li>
                            <li><i class="bi bi-check-circle-fill"></i> Community forum access</li>
                            <li><i class="bi bi-check-circle-fill"></i> Basic progress tracking</li>
                        </ul>
                        
                        <button class="btn pricing-cta secondary">Get Started</button>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="pricing-card featured">
                        <span class="featured-badge">Popular</span>
                        <h3 class="pricing-title">Pro</h3>
                        <div class="pricing-price">$19</div>
                        <span class="pricing-period">per month</span>
                        
                        <ul class="pricing-features">
                            <li><i class="bi bi-check-circle-fill"></i> All Free features</li>
                            <li><i class="bi bi-check-circle-fill"></i> Unlimited practice sessions</li>
                            <li><i class="bi bi-check-circle-fill"></i> Advanced courses & workshops</li>
                            <li><i class="bi bi-check-circle-fill"></i> Peer feedback on debates</li>
                            <li><i class="bi bi-check-circle-fill"></i> Advanced analytics</li>
                        </ul>
                        
                        <button class="btn pricing-cta primary">Start 7-Day Free Trial</button>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="pricing-card">
                        <h3 class="pricing-title">Teams</h3>
                        <div class="pricing-price">$49</div>
                        <span class="pricing-period">per month</span>
                        
                        <ul class="pricing-features">
                            <li><i class="bi bi-check-circle-fill"></i> All Pro features</li>
                            <li><i class="bi bi-check-circle-fill"></i> Up to 10 team members</li>
                            <li><i class="bi bi-check-circle-fill"></i> Team performance analytics</li>
                            <li><i class="bi bi-check-circle-fill"></i> Coach dashboard</li>
                            <li><i class="bi bi-check-circle-fill"></i> Priority support</li>
                        </ul>
                        
                        <button class="btn pricing-cta secondary">Contact Sales</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container text-center">
            <h2 class="cta-title">Ready to Become a Better Debater?</h2>
            <p class="cta-description">Join thousands of students and coaches who are improving their debate skills every day.</p>
            <a href="signup.html" class="btn cta-button">Sign Up Now</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="footer-logo">
                        <i class="bi bi-chat-square-text"></i> DebateSkills
                    </div>
                    <p class="footer-description">Empowering debaters with the skills, knowledge, and confidence to excel in any debate format.</p>
                    <div class="social-links">
                        <a href="#" class="social-link"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-link"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="social-link"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-link"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                    <h3 class="footer-title">Product</h3>
                    <ul class="footer-links">
                        <li><a href="#">Features</a></li>
                        <li><a href="#">Pricing</a></li>
                        <li><a href="#">Testimonials</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                    <h3 class="footer-title">Resources</h3>
                    <ul class="footer-links">
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Guides</a></li>
                        <li><a href="#">Community</a></li>
                        <li><a href="#">Events</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                    <h3 class="footer-title">Company</h3>
                    <ul class="footer-links">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Partners</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-4">
                    <h3 class="footer-title">Legal</h3>
                    <ul class="footer-links">
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Service</a></li>
                        <li><a href="#">Cookies</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="row footer-bottom">
                <div class="col-md-6 mb-3 mb-md-0">
                    &copy; 2025 DebateSkills. All rights reserved.
                </div>
                <div class="col-md-6 text-md-end">
                    Made with ❤️ for debaters worldwide
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js">
        
    </script>
</body>
</html>








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

// Get featured courses for homepage
function getFeaturedCourses($conn, $limit = 6) {
    $sql = "SELECT id, title, description, image_url, price FROM courses WHERE featured = 1 LIMIT ?";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $limit);
        
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            
            $courses = array();
            while($row = mysqli_fetch_assoc($result)){
                $courses[] = $row;
            }
            
            return $courses;
        } else{
            return false;
        }
    }
    
    return false;
}

// Get testimonials
function getTestimonials($conn, $limit = 3) {
    $sql = "SELECT name, role, content, rating FROM testimonials ORDER BY rating DESC LIMIT ?";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $limit);
        
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            
            $testimonials = array();
            while($row = mysqli_fetch_assoc($result)){
                $testimonials[] = $row;
            }
            
            return $testimonials;
        } else{
            return false;
        }
    }
    
    return false;
}

// Get featured courses
$featuredCourses = getFeaturedCourses($conn);

// Get testimonials
$testimonials = getTestimonials($conn);

// Page title
$pageTitle = "Welcome to E-Learning Portal";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Header/Navigation -->
    <?php include 'includes/header.php'; ?>
    
    <!-- Hero Section -->
    <section class="hero-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1>Expand Your Knowledge</h1>
                    <p class="lead">Discover top-quality courses taught by industry experts. Start your learning journey today!</p>
                    <div class="mt-4">
                        <a href="courses.php" class="btn btn-primary btn-lg">Browse Courses</a>
                        <a href="register.php" class="btn btn-outline-secondary btn-lg ms-2">Sign Up</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="images/hero-image.jpg" alt="E-Learning" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>
    
    <!-- Featured Courses Section -->
    <section class="featured-courses py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Featured Courses</h2>
            
            <div class="row">
                <?php 
                if($featuredCourses):
                    foreach($featuredCourses as $course): 
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="<?php echo htmlspecialchars($course['image_url']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($course['title']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($course['title']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars(substr($course['description'], 0, 100)) . '...'; ?></p>
                            <p class="text-primary fw-bold">$<?php echo htmlspecialchars($course['price']); ?></p>
                            <a href="course-details.php?id=<?php echo $course['id']; ?>" class="btn btn-outline-primary">View Details</a>
                        </div>
                    </div>
                </div>
                <?php 
                    endforeach;
                else:
                ?>
                <div class="col-12">
                    <p class="text-center">No featured courses available at this moment.</p>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="text-center mt-4">
                <a href="courses.php" class="btn btn-primary">View All Courses</a>
            </div>
        </div>
    </section>
    
    <!-- Categories Section -->
    <section class="categories-section py-5">
        <div class="container">
            <h2 class="text-center mb-5">Browse Categories</h2>
            
            <div class="row text-center">
                <div class="col-md-3 mb-4">
                    <div class="category-card p-4 rounded shadow-sm">
                        <i class="bi bi-code-square fs-1 text-primary"></i>
                        <h4 class="mt-3">Programming</h4>
                        <a href="courses.php?category=programming" class="stretched-link"></a>
                    </div>
                </div>
                
                <div class="col-md-3 mb-4">
                    <div class="category-card p-4 rounded shadow-sm">
                        <i class="bi bi-graph-up fs-1 text-success"></i>
                        <h4 class="mt-3">Business</h4>
                        <a href="courses.php?category=business" class="stretched-link"></a>
                    </div>
                </div>
                
                <div class="col-md-3 mb-4">
                    <div class="category-card p-4 rounded shadow-sm">
                        <i class="bi bi-palette fs-1 text-warning"></i>
                        <h4 class="mt-3">Design</h4>
                        <a href="courses.php?category=design" class="stretched-link"></a>
                    </div>
                </div>
                
                <div class="col-md-3 mb-4">
                    <div class="category-card p-4 rounded shadow-sm">
                        <i class="bi bi-robot fs-1 text-danger"></i>
                        <h4 class="mt-3">AI & Data Science</h4>
                        <a href="courses.php?category=ai-data-science" class="stretched-link"></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Testimonials Section -->
    <section class="testimonials-section py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">What Our Students Say</h2>
            
            <div class="row">
                <?php 
                if($testimonials):
                    foreach($testimonials as $testimonial): 
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 p-4">
                        <div class="testimonial-rating mb-3">
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <i class="bi bi-star-fill <?php echo ($i <= $testimonial['rating']) ? 'text-warning' : 'text-muted'; ?>"></i>
                            <?php endfor; ?>
                        </div>
                        <p class="card-text">"<?php echo htmlspecialchars($testimonial['content']); ?>"</p>
                        <div class="d-flex align-items-center mt-3">
                            <div class="testimonial-avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                <?php echo strtoupper(substr($testimonial['name'], 0, 1)); ?>
                            </div>
                            <div>
                                <h6 class="mb-0"><?php echo htmlspecialchars($testimonial['name']); ?></h6>
                                <small class="text-muted"><?php echo htmlspecialchars($testimonial['role']); ?></small>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                    endforeach;
                else:
                ?>
                <div class="col-12">
                    <p class="text-center">No testimonials available at this moment.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    
    <!-- CTA Section -->
    <section class="cta-section py-5 bg-primary text-white">
        <div class="container text-center">
            <h2 class="mb-4">Ready to Start Learning?</h2>
            <p class="lead mb-4">Join thousands of students already learning on our platform.</p>
            <a href="register.php" class="btn btn-light btn-lg">Sign Up Now</a>
        </div>
    </section>
    
    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>
    
    <!-- Bootstrap JS and custom scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>

<?php
// Close connection
mysqli_close($conn);
?>