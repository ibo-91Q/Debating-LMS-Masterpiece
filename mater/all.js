/**
 * DebateSkills LMS - Main JavaScript
 * 
 * This file contains the core JavaScript functionality for the DebateSkills LMS,
 * including user authentication, course management, practice features, and dashboard analytics.
 */

// ===== User Authentication =====
const AuthModule = (function() {
    // Private variables
    let currentUser = null;
    
    // Check if user is logged in (from localStorage)
    const checkAuthStatus = () => {
      const storedUser = localStorage.getItem('debateSkillsUser');
      if (storedUser) {
        currentUser = JSON.parse(storedUser);
        updateUIForLoggedInUser();
        return true;
      }
      return false;
    };
  
    // Login function
    const login = (email, password) => {
      // In a real app, this would make an API call
      return new Promise((resolve, reject) => {
        // Simulate API delay
        setTimeout(() => {
          // Simple validation for demo
          if (!email || !password) {
            reject('Email and password are required');
            return;
          }
          
          // Mock successful login
          const user = {
            id: 'usr_' + Math.random().toString(36).substr(2, 9),
            name: email.split('@')[0],
            email: email,
            avatar: 'https://randomuser.me/api/portraits/men/32.jpg',
            role: 'student'
          };
          
          // Save to localStorage
          localStorage.setItem('debateSkillsUser', JSON.stringify(user));
          currentUser = user;
          
          // Update UI
          updateUIForLoggedInUser();
          
          resolve(user);
        }, 800);
      });
    };
  
    // Sign up function
    const signup = (firstName, lastName, email, password) => {
      // In a real app, this would make an API call
      return new Promise((resolve, reject) => {
        // Simulate API delay
        setTimeout(() => {
          // Simple validation
          if (!firstName || !lastName || !email || !password) {
            reject('All fields are required');
            return;
          }
          
          // Mock successful signup
          const user = {
            id: 'usr_' + Math.random().toString(36).substr(2, 9),
            name: `${firstName} ${lastName}`,
            email: email,
            avatar: 'https://randomuser.me/api/portraits/men/32.jpg',
            role: 'student'
          };
          
          // Save to localStorage
          localStorage.setItem('debateSkillsUser', JSON.stringify(user));
          currentUser = user;
          
          // Update UI
          updateUIForLoggedInUser();
          
          resolve(user);
        }, 800);
      });
    };
  
    // Logout function
    const logout = () => {
      localStorage.removeItem('debateSkillsUser');
      currentUser = null;
      
      // Redirect to login page
      window.location.href = 'login.html';
    };
  
    // Update UI elements when user is logged in
    const updateUIForLoggedInUser = () => {
      if (!currentUser) return;
      
      // Update avatar if it exists
      const avatarElements = document.querySelectorAll('.user-avatar');
      avatarElements.forEach(el => {
        el.src = currentUser.avatar;
        el.alt = currentUser.name;
      });
      
      // Update any user name displays
      const userNameElements = document.querySelectorAll('.user-name');
      userNameElements.forEach(el => {
        el.textContent = currentUser.name;
      });
    };
  
    // Public API
    return {
      initialize: checkAuthStatus,
      login,
      signup,
      logout,
      getCurrentUser: () => currentUser
    };
  })();
  
  // ===== Course Management =====
  const CourseModule = (function() {
    // Private variables
    let courses = [];
    let enrolledCourses = [];
    
    // Fetch all available courses
    const fetchCourses = () => {
      // In a real app, this would make an API call
      return new Promise((resolve) => {
        // Simulate API delay
        setTimeout(() => {
          // Mock courses data
          courses = [
            {
              id: 'course_1',
              title: 'Introduction to Debating',
              description: 'Learn the fundamentals of structured debates and argumentation.',
              level: 'beginner',
              category: 'Fundamentals',
              instructor: 'Sarah Johnson',
              instructorAvatar: 'https://randomuser.me/api/portraits/women/32.jpg',
              duration: '6 hours',
              rating: 4.8,
              students: 2412,
              image: 'https://cdn.pixabay.com/photo/2018/09/24/10/20/team-3699889_1280.jpg'
            },
            {
              id: 'course_2',
              title: 'Advanced Argumentation',
              description: 'Develop sophisticated argumentation techniques for competitive debating.',
              level: 'advanced',
              category: 'Argumentation',
              instructor: 'Michael Roberts',
              instructorAvatar: 'https://randomuser.me/api/portraits/men/54.jpg',
              duration: '10 hours',
              rating: 4.9,
              students: 1834,
              image: 'https://cdn.pixabay.com/photo/2017/08/30/12/45/girl-2696947_1280.jpg'
            },
            {
              id: 'course_3',
              title: 'Public Speaking Mastery',
              description: 'Master the art of confident and persuasive public speaking.',
              level: 'intermediate',
              category: 'Public Speaking',
              instructor: 'Emma Chen',
              instructorAvatar: 'https://randomuser.me/api/portraits/women/65.jpg',
              duration: '8 hours',
              rating: 4.7,
              students: 3156,
              image: 'https://cdn.pixabay.com/photo/2019/11/03/20/11/lecture-4599797_1280.jpg'
            }
          ];
          
          resolve(courses);
        }, 500);
      });
    };
    
    // Fetch enrolled courses for current user
    const fetchEnrolledCourses = () => {
      const currentUser = AuthModule.getCurrentUser();
      if (!currentUser) return Promise.resolve([]);
      
      // In a real app, this would make an API call with user ID
      return new Promise((resolve) => {
        // Simulate API delay
        setTimeout(() => {
          // Mock enrolled courses (subset of all courses)
          enrolledCourses = [courses[0], courses[2]];
          resolve(enrolledCourses);
        }, 500);
      });
    };
    
    // Enroll in a course
    const enrollInCourse = (courseId) => {
      const currentUser = AuthModule.getCurrentUser();
      if (!currentUser) {
        window.location.href = 'login.html';
        return Promise.reject('User not logged in');
      }
      
      // In a real app, this would make an API call
      return new Promise((resolve) => {
        // Simulate API delay
        setTimeout(() => {
          const course = courses.find(c => c.id === courseId);
          if (course && !enrolledCourses.some(c => c.id === courseId)) {
            enrolledCourses.push(course);
            
            // Show success message
            showNotification('Successfully enrolled in ' + course.title, 'success');
          }
          resolve(enrolledCourses);
        }, 800);
      });
    };
    
    // Get course progress
    const getCourseProgress = (courseId) => {
      // In a real app, this would make an API call
      return new Promise((resolve) => {
        // Simulate progress data (random for demo)
        const progress = Math.floor(Math.random() * 100);
        resolve(progress);
      });
    };
    
    // Public API
    return {
      fetchCourses,
      fetchEnrolledCourses,
      enrollInCourse,
      getCourseProgress
    };
  })();
  
  // ===== Practice Module =====
  const PracticeModule = (function() {
    let debateTopics = [];
    let currentTopic = null;
    let timer = null;
    let timeLeft = 7 * 60; // 7 minutes in seconds
    let isRunning = false;
    
    // Get all available debate topics
    const fetchDebateTopics = () => {
      // In a real app, this would make an API call
      return new Promise((resolve) => {
        // Simulate API delay
        setTimeout(() => {
          // Mock topics data
          debateTopics = [
            {
              id: 'topic_1',
              title: 'This house believes that social media has done more harm than good',
              category: 'Technology',
              duration: '7 minutes'
            },
            {
              id: 'topic_2',
              title: 'This house would ban private schools',
              category: 'Education',
              duration: '7 minutes'
            },
            {
              id: 'topic_3',
              title: 'This house believes that cryptocurrencies do more harm than good',
              category: 'Economics',
              duration: '5 minutes'
            },
            {
              id: 'topic_4',
              title: 'This house supports universal basic income',
              category: 'Economics',
              duration: '6 minutes'
            },
            {
              id: 'topic_5',
              title: 'This house believes that artificial intelligence will do more good than harm',
              category: 'Technology',
              duration: '7 minutes'
            }
          ];
          resolve(debateTopics);
        }, 500);
      });
    };
    
    // Select a debate topic to practice
    const selectTopic = (topicId) => {
      const topic = debateTopics.find(t => t.id === topicId);
      if (topic) {
        currentTopic = topic;
        
        // Set timer based on topic duration
        const durationInMinutes = parseInt(topic.duration.split(' ')[0]);
        timeLeft = durationInMinutes * 60;
        updateTimerDisplay();
        
        return topic;
      }
      return null;
    };
    
    // Timer functions
    const startTimer = () => {
      if (isRunning) {
        // Pause the timer
        clearInterval(timer);
        isRunning = false;
        return false;
      } else {
        // Start the timer
        if (timeLeft > 0) {
          timer = setInterval(function() {
            timeLeft--;
            updateTimerDisplay();
            
            if (timeLeft <= 0) {
              clearInterval(timer);
              isRunning = false;
              // Notify user that time is up
              if ("Notification" in window && Notification.permission === "granted") {
                new Notification("Time's Up!", {
                  body: "Your debate practice time has ended."
                });
              }
            }
          }, 1000);
          
          isRunning = true;
          return true;
        }
      }
    };
    
    const resetTimer = () => {
      clearInterval(timer);
      if (currentTopic) {
        const durationInMinutes = parseInt(currentTopic.duration.split(' ')[0]);
        timeLeft = durationInMinutes * 60;
      } else {
        timeLeft = 7 * 60; // Default 7 minutes
      }
      updateTimerDisplay();
      isRunning = false;
    };
    
    const updateTimerDisplay = () => {
      const timerDisplay = document.querySelector('.timer-display');
      if (timerDisplay) {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        timerDisplay.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
      }
    };
    
    // Submit practice recording (in a real app, this would upload an audio file)
    const submitPractice = (audioBlob, notes) => {
      if (!currentTopic) return Promise.reject('No topic selected');
      
      // In a real app, this would upload the audio file to a server
      return new Promise((resolve) => {
        setTimeout(() => {
          // Mock successful submission
          showNotification('Practice submitted successfully!', 'success');
          resolve({
            success: true,
            topic: currentTopic.title,
            date: new Date().toISOString()
          });
        }, 1000);
      });
    };
    
    // Public API
    return {
      fetchDebateTopics,
      selectTopic,
      startTimer,
      resetTimer,
      submitPractice,
      getCurrentTopic: () => currentTopic
    };
  })();
  
  // ===== Dashboard Module =====
  const DashboardModule = (function() {
    // Fetch user stats
    const fetchUserStats = () => {
      const currentUser = AuthModule.getCurrentUser();
      if (!currentUser) return Promise.resolve(null);
      
      // In a real app, this would make an API call
      return new Promise((resolve) => {
        // Simulate API delay
        setTimeout(() => {
          // Mock stats data
          const stats = {
            courseProgress: 75,
            practiceDebates: 12,
            communityRating: 4.8,
            upcomingEvents: [
              {
                title: 'Mock Debate: Climate Change',
                time: 'Tomorrow, 2:00 PM',
                link: '#'
              },
              {
                title: 'Workshop: Advanced Arguments',
                time: 'Friday, 3:30 PM',
                link: '#'
              }
            ],
            recommendedCourses: [
              {
                title: 'Public Speaking Mastery',
                level: 'Intermediate',
                duration: '8 hours',
                icon: 'bi-people'
              },
              {
                title: 'Logical Fallacies',
                level: 'Advanced',
                duration: '6 hours',
                icon: 'bi-diagram-3'
              }
            ]
          };
          resolve(stats);
        }, 500);
      });
    };
    
    // Update dashboard UI with the latest stats
    const updateDashboardUI = (stats) => {
      if (!stats) return;
      
      // Update progress indicators
      document.querySelectorAll('.progress-bar').forEach(el => {
        el.style.width = `${stats.courseProgress}%`;
        el.setAttribute('aria-valuenow', stats.courseProgress);
      });
      
      // Update stat values
      const courseProgressEl = document.querySelector('.stats-value.blue');
      if (courseProgressEl) courseProgressEl.textContent = `${stats.courseProgress}%`;
      
      const practiceDebatesEl = document.querySelector('.stats-value.green');
      if (practiceDebatesEl) practiceDebatesEl.textContent = stats.practiceDebates;
      
      const communityRatingEl = document.querySelector('.stats-value.purple');
      if (communityRatingEl) communityRatingEl.textContent = stats.communityRating;
    };
    
    // Public API
    return {
      fetchUserStats,
      updateDashboardUI
    };
  })();
  
  // ===== UI Utilities =====
  
  // Show notification
  function showNotification(message, type = 'info') {
    // Create notification element if it doesn't exist
    let notificationContainer = document.querySelector('.notification-container');
    
    if (!notificationContainer) {
      notificationContainer = document.createElement('div');
      notificationContainer.className = 'notification-container';
      notificationContainer.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
      `;
      document.body.appendChild(notificationContainer);
    }
    
    // Create notification
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.style.cssText = `
      background-color: ${type === 'success' ? 'var(--success-color)' : type === 'error' ? 'var(--danger-color)' : 'var(--primary-color)'};
      color: white;
      padding: 12px 20px;
      border-radius: 8px;
      margin-bottom: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: opacity 0.3s ease, transform 0.3s ease;
      opacity: 0;
      transform: translateY(-20px);
    `;
    
    notification.textContent = message;
    
    // Add to container
    notificationContainer.appendChild(notification);
    
    // Trigger animation
    setTimeout(() => {
      notification.style.opacity = '1';
      notification.style.transform = 'translateY(0)';
    }, 10);
    
    // Auto remove after 4 seconds
    setTimeout(() => {
      notification.style.opacity = '0';
      notification.style.transform = 'translateY(-20px)';
      
      setTimeout(() => {
        notification.remove();
      }, 300);
    }, 4000);
  }
  
  // Search functionality
  function setupSearch(inputSelector, itemsSelector, searchKeys) {
    const searchInput = document.querySelector(inputSelector);
    if (!searchInput) return;
    
    searchInput.addEventListener('input', function() {
      const searchTerm = this.value.toLowerCase().trim();
      const items = document.querySelectorAll(itemsSelector);
      
      items.forEach(item => {
        let matchFound = false;
        
        // If no search term, show all
        if (searchTerm === '') {
          matchFound = true;
        } else {
          // Check each key for a match
          searchKeys.forEach(key => {
            const content = item.querySelector(key)?.textContent.toLowerCase() || '';
            if (content.includes(searchTerm)) {
              matchFound = true;
            }
          });
        }
        
        // Show/hide based on match
        item.style.display = matchFound ? 'block' : 'none';
      });
    });
  }
  
  // Filter functionality
  function setupFilter(selectSelector, itemsSelector, attributeName) {
    const filterSelect = document.querySelector(selectSelector);
    if (!filterSelect) return;
    
    filterSelect.addEventListener('change', function() {
      const filterValue = this.value;
      const items = document.querySelectorAll(itemsSelector);
      
      items.forEach(item => {
        // If "All Categories" or matches the filter, show the item
        if (filterValue === 'All Categories' || item.getAttribute(attributeName) === filterValue) {
          item.style.display = 'block';
        } else {
          item.style.display = 'none';
        }
      });
    });
  }
  
  // ===== Page Initialization =====
  
  // Detect current page and initialize appropriate modules
  document.addEventListener('DOMContentLoaded', function() {
    // Initialize auth status
    AuthModule.initialize();
    
    // Get current page
    const currentPage = window.location.pathname.split('/').pop() || 'index.html';
    
    // Initialize page-specific functionality
    switch (currentPage) {
      case 'index.html':
        // Homepage initialization
        initHomepage();
        break;
        
      case 'login.html':
        // Login page initialization
        initLoginPage();
        break;
        
      case 'signup.html':
        // Signup page initialization
        initSignupPage();
        break;
        
      case 'dashboard.html':
        // Dashboard initialization
        initDashboard();
        break;
        
      case 'courses.html':
        // Courses page initialization
        initCoursesPage();
        break;
        
      case 'practice.html':
        // Practice page initialization
        initPracticePage();
        break;
        
      default:
        // Default initialization for any other page
        break;
    }
    
    // Setup universal elements like notifications
    setupNotificationPermission();
  });
  
  // Initialize Homepage
  function initHomepage() {
    // Add smooth scrolling to anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function(e) {
        e.preventDefault();
        
        const targetId = this.getAttribute('href');
        const targetElement = document.querySelector(targetId);
        
        if (targetElement) {
          window.scrollTo({
            top: targetElement.offsetTop - 80, // Account for fixed header
            behavior: 'smooth'
          });
        }
      });
    });
    
    // Animate elements on scroll
    const animateOnScroll = () => {
      const elements = document.querySelectorAll('.feature-card, .testimonial-card, .pricing-card');
      
      elements.forEach(el => {
        const elementTop = el.getBoundingClientRect().top;
        const elementVisible = 150;
        
        if (elementTop < window.innerHeight - elementVisible) {
          el.classList.add('animated');
        }
      });
    };
    
    window.addEventListener('scroll', animateOnScroll);
    animateOnScroll(); // Run once on page load
  }
  
  // Initialize Login Page
  function initLoginPage() {
    const loginForm = document.querySelector('form');
    if (!loginForm) return;
    
    loginForm.addEventListener('submit', function(e) {
      e.preventDefault();
      
      const email = document.getElementById('email').value;
      const password = document.getElementById('password').value;
      
      // Show loading state
      const submitButton = this.querySelector('button[type="submit"]');
      const originalText = submitButton.innerHTML;
      submitButton.innerHTML = '<i class="bi bi-arrow-repeat"></i> Signing in...';
      submitButton.disabled = true;
      
      AuthModule.login(email, password)
        .then(user => {
          // Redirect to dashboard
          window.location.href = 'dashboard.html';
        })
        .catch(error => {
          showNotification(error, 'error');
          // Reset button
          submitButton.innerHTML = originalText;
          submitButton.disabled = false;
        });
    });
    
    // Switch between sign in and sign up
    const formTabs = document.querySelectorAll('.form-tab');
    formTabs.forEach(tab => {
      tab.addEventListener('click', function() {
        formTabs.forEach(t => t.classList.remove('active'));
        this.classList.add('active');
        
        if (this.textContent.includes('Sign Up')) {
          window.location.href = 'signup.html';
        }
      });
    });
  }
  
  // Initialize Signup Page
  function initSignupPage() {
    const signupForm = document.querySelector('form');
    if (!signupForm) return;
    
    signupForm.addEventListener('submit', function(e) {
      e.preventDefault();
      
      const firstName = document.getElementById('firstName').value;
      const lastName = document.getElementById('lastName').value;
      const email = document.getElementById('email').value;
      const password = document.getElementById('password').value;
      
      // Check terms agreement
      const termsAgree = document.getElementById('termsAgree');
      if (termsAgree && !termsAgree.checked) {
        showNotification('Please agree to the Terms of Service and Privacy Policy', 'error');
        return;
      }
      
      // Show loading state
      const submitButton = this.querySelector('button[type="submit"]');
      const originalText = submitButton.innerHTML;
      submitButton.innerHTML = '<i class="bi bi-arrow-repeat"></i> Creating account...';
      submitButton.disabled = true;
      
      AuthModule.signup(firstName, lastName, email, password)
        .then(user => {
          // Redirect to dashboard
          window.location.href = 'dashboard.html';
        })
        .catch(error => {
          showNotification(error, 'error');
          // Reset button
          submitButton.innerHTML = originalText;
          submitButton.disabled = false;
        });
    });
  }
  
  // Initialize Dashboard
  function initDashboard() {
    // Fetch and display user stats
    DashboardModule.fetchUserStats()
      .then(stats => {
        DashboardModule.updateDashboardUI(stats);
      })
      .catch(error => {
        console.error('Error loading dashboard data:', error);
      });
    
    // Make quick action cards clickable
    document.querySelectorAll('.quick-action').forEach(card => {
      card.addEventListener('click', function() {
        const actionTitle = this.querySelector('h3').textContent.trim();
        
        switch (actionTitle) {
          case 'Start Practice':
            window.location.href = 'practice.html';
            break;
          case 'Get Feedback':
            window.location.href = 'community.html';
            break;
          case 'Join Discussion':
            window.location.href = 'community.html';
            break;
          case 'Resources':
            window.location.href = 'courses.html';
            break;
        }
      });
    });
  }
  
  // Initialize Courses Page
  function initCoursesPage() {
    // Fetch and display courses
    CourseModule.fetchCourses()
      .then(courses => {
        // In a real implementation, this would populate the courses dynamically
        console.log('Courses loaded:', courses.length);
        
        // Make category cards clickable
        document.querySelectorAll('.category-card').forEach(card => {
          card.addEventListener('click', function() {
            const categoryTitle = this.querySelector('.category-title').textContent;
            // In a real app, this would filter courses by category
            showNotification(`Viewing ${categoryTitle} courses`, 'info');
          });
        });
      })
      .catch(error => {
        console.error('Error loading courses:', error);
      });
    
    // Setup search functionality
    setupSearch('.search-input', '.course-card', ['.course-title', '.course-description']);
    
    // Setup filter functionality
    setupFilter('.filter-select', '.course-card', 'data-level');
  }
  
  // Initialize Practice Page
  function initPracticePage() {
    // Fetch debate topics
    PracticeModule.fetchDebateTopics()
      .then(topics => {
        // In a real implementation, this would populate the topics dynamically
        console.log('Topics loaded:', topics.length);
        
        // Make topic cards clickable
        document.querySelectorAll('.topic-card').forEach((card, index) => {
          card.addEventListener('click', function() {
            document.querySelectorAll('.topic-card').forEach(c => c.classList.remove('border-primary'));
            this.classList.add('border-primary');
            
            // Select the topic
            PracticeModule.selectTopic('topic_' + (index + 1));
          });
        });
      })
      .catch(error => {
        console.error('Error loading debate topics:', error);
      });
    
    // Setup timer controls
    const startButton = document.querySelector('.btn-timer-start');
    if (startButton) {
      startButton.addEventListener('click', function() {
        const isRunning = PracticeModule.startTimer();
        
        if (isRunning) {
          this.innerHTML = '<i class="bi bi-pause-fill"></i> Pause';
        } else {
          this.innerHTML = '<i class="bi bi-play-fill"></i> Start';
        }
      });
    }
    
    const resetButton = document.querySelector('.btn-timer-reset');
    if (resetButton) {
      resetButton.addEventListener('click', function() {
        PracticeModule.resetTimer();
        
        const startButton = document.querySelector('.btn-timer-start');
        if (startButton) {
          startButton.innerHTML = '<i class="bi bi-play-fill"></i> Start';
        }
      });
    }
    
    // Setup practice start button
    const startPracticeButton = document.querySelector('.btn-start-practice');
    if (startPracticeButton) {
      startPracticeButton.addEventListener('click', function() {
        const currentTopic = PracticeModule.getCurrentTopic();
        
        if (!currentTopic) {
          showNotification('Please select a debate topic first', 'error');
          return;
        }
        
        // In a real app, this would start recording or open a practice modal
        showNotification(`Starting practice on: ${currentTopic.title}`, 'success');
        
        // Start the timer automatically
        PracticeModule.resetTimer();
        PracticeModule.startTimer();
        
        const startButton = document.querySelector('.btn-timer-start');
        if (startButton) {
          startButton.innerHTML = '<i class="bi bi-pause-fill"></i> Pause';
        }
      });
    }
    
    // Setup search functionality
    setupSearch('.search-input', '.topic-card', ['.topic-title']);
    
    // Setup filter functionality
    setupFilter('.filter-select', '.topic-card', 'data-category');
  }
  
  // Setup notification permission
  function setupNotificationPermission() {
    // Request notification permission for practice timer alerts
    if ("Notification" in window && Notification.permission !== "granted" && Notification.permission !== "denied") {
      // Wait for user interaction before requesting
      document.addEventListener('click', function requestNotificationPermission() {
        Notification.requestPermission();
        document.removeEventListener('click', requestNotificationPermission);
      }, { once: true });
    }
  }