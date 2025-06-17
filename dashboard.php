<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}

$user = $_SESSION['user'];

// Debug: Log session data
error_log('Session user data: ' . print_r($user, true));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="ITA Exam Portal">
    <meta name="author" content="ITA">
    <meta name="keywords" content="ITA Exam Portal">

    <!-- Title Page-->
    <title>ITA Exam Portal - Dashboard</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

    <style>
        .exam-container {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        
        .timer-container {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .timer {
            font-size: 1.5rem;
            font-weight: bold;
            color: #dc3545;
        }
        
        .question-container {
            margin-bottom: 2rem;
        }
        
        .question-text {
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            color: #333;
        }
        
        .options-container {
            margin-bottom: 2rem;
        }
        
        .option-item {
            padding: 1rem;
            margin-bottom: 0.5rem;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .option-item:hover {
            background-color: #f8f9fa;
        }
        
        .option-item.selected {
            background-color: #e3f2fd;
            border-color: #2196f3;
        }
        
        .option-item input[type="radio"] {
            margin-right: 1rem;
        }
        
        .navigation-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 2rem;
        }
        
        .btn-navigation {
            min-width: 120px;
        }
        
        .progress-container {
            margin-bottom: 2rem;
        }
        
        .progress {
            height: 10px;
        }
        
        .question-number {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 0.5rem;
        }
        
        .warning-time {
            color: #dc3545;
            animation: blink 1s infinite;
        }
        
        @keyframes blink {
            50% { opacity: 0.5; }
        }

        /* Mobile menu styles */
        .header-mobile {
            background: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }

        .header-mobile__bar {
            padding: 1rem 0;
        }

        .header-mobile-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-mobile {
            background: #fff;
            border-top: 1px solid #eee;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-mobile__list {
            padding: 1rem 0;
        }

        .navbar-mobile__list li {
            border-bottom: 1px solid #f5f5f5;
        }

        .navbar-mobile__list li:last-child {
            border-bottom: none;
        }

        .navbar-mobile__list a {
            display: block;
            padding: 1rem 1.5rem;
            color: #333;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .navbar-mobile__list a:hover {
            background-color: #f8f9fa;
            color: #007bff;
        }

        .navbar-mobile__list i {
            margin-right: 0.5rem;
            width: 20px;
        }

        /* Adjust main content for mobile header */
        @media (max-width: 991.98px) {
            .page-container2 {
                padding-top: 70px;
            }
            
            .menu-sidebar2 {
                display: none;
            }
        }

        /* Hamburger menu animation */
        .hamburger {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0.5rem;
        }

        .hamburger-box {
            width: 24px;
            height: 24px;
            display: inline-block;
            position: relative;
        }

        .hamburger-inner {
            display: block;
            top: 50%;
            margin-top: -2px;
        }

        .hamburger-inner,
        .hamburger-inner::before,
        .hamburger-inner::after {
            width: 24px;
            height: 3px;
            background-color: #333;
            border-radius: 4px;
            position: absolute;
            transition-property: transform;
            transition-duration: 0.15s;
            transition-timing-function: ease;
        }

        .hamburger-inner::before,
        .hamburger-inner::after {
            content: "";
            display: block;
        }

        .hamburger-inner::before {
            top: -8px;
        }

        .hamburger-inner::after {
            bottom: -8px;
        }

        .hamburger.is-active .hamburger-inner {
            transform: rotate(45deg);
        }

        .hamburger.is-active .hamburger-inner::before {
            top: 0;
            opacity: 0;
        }

        .hamburger.is-active .hamburger-inner::after {
            bottom: 0;
            transform: rotate(-90deg);
                 }

         /* Universal Modal System Styles */
         .universal-modal {
             position: fixed;
             top: 0;
             left: 0;
             width: 100%;
             height: 100%;
             background: rgba(0, 0, 0, 0.8);
             display: none;
             justify-content: center;
             align-items: center;
             z-index: 10000;
         }

         .universal-modal-content {
             background: white;
             border-radius: 15px;
             max-width: 500px;
             width: 90%;
             box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
             animation: modalSlideIn 0.3s ease-out;
             overflow: hidden;
         }

         @keyframes modalSlideOut {
             from {
                 opacity: 1;
                 transform: translateY(0) scale(1);
             }
             to {
                 opacity: 0;
                 transform: translateY(-50px) scale(0.9);
             }
         }

         .universal-modal-header {
             padding: 2rem;
             text-align: center;
             color: white;
         }

         .universal-modal-header.success {
             background: linear-gradient(135deg, #4CAF50, #45a049);
         }

         .universal-modal-header.error {
             background: linear-gradient(135deg, #f44336, #d32f2f);
         }

         .universal-modal-header.warning {
             background: linear-gradient(135deg, #ff9800, #f57c00);
         }

         .universal-modal-header.info {
             background: linear-gradient(135deg, #2196F3, #1976D2);
         }

         .universal-modal-header.confirm {
             background: linear-gradient(135deg, #9C27B0, #7B1FA2);
         }

         .modal-icon {
             font-size: 3rem;
             margin-bottom: 1rem;
             display: block;
         }

         .universal-modal-header h3 {
             margin: 0;
             font-size: 1.5rem;
             font-weight: 600;
         }

         .universal-modal-body {
             padding: 2rem;
             text-align: center;
         }

         .universal-modal-body p {
             margin: 0;
             font-size: 1.1rem;
             line-height: 1.6;
             color: #333;
         }

         .universal-modal-footer {
             padding: 1.5rem 2rem;
             text-align: center;
             border-top: 1px solid #eee;
             display: flex;
             gap: 1rem;
             justify-content: center;
         }

         .universal-modal-footer .btn {
             min-width: 100px;
             padding: 0.75rem 1.5rem;
             border-radius: 25px;
             font-weight: 600;
             transition: all 0.3s ease;
         }

         .universal-modal-footer .btn:hover {
             transform: translateY(-2px);
             box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
         }

         /* Results Modal Styles */
        .results-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 10000;
        }

        .results-modal-content {
            background: white;
            border-radius: 15px;
            max-width: 600px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            animation: modalSlideIn 0.3s ease-out;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-50px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .results-header {
            padding: 2rem;
            text-align: center;
            border-radius: 15px 15px 0 0;
        }

        .results-header.pass {
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white;
        }

        .results-header.fail {
            background: linear-gradient(135deg, #f44336, #d32f2f);
            color: white;
        }

        .results-header h2 {
            margin: 0 0 0.5rem 0;
            font-size: 2rem;
        }

        .status-text {
            margin: 0;
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .results-body {
            padding: 2rem;
        }

        .score-section {
            display: flex;
            align-items: center;
            gap: 2rem;
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid #eee;
        }

        .score-circle {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.5rem;
            color: white;
            flex-shrink: 0;
        }

        .score-circle.pass {
            background: linear-gradient(135deg, #4CAF50, #45a049);
        }

        .score-circle.fail {
            background: linear-gradient(135deg, #f44336, #d32f2f);
        }

        .score-details {
            flex: 1;
        }

        .score-details p {
            margin: 0.5rem 0;
            font-size: 1.1rem;
        }

        .status.pass {
            color: #4CAF50;
            font-weight: bold;
        }

        .status.fail {
            color: #f44336;
            font-weight: bold;
        }

        .reschedule-section {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            text-align: center;
        }

        .reschedule-section h3 {
            color: #333;
            margin-bottom: 1rem;
        }

        .appointment-date {
            background: #007bff;
            color: white;
            padding: 1rem;
            border-radius: 8px;
            font-size: 1.2rem;
            font-weight: bold;
            margin: 1rem 0;
        }

        .reschedule-note {
            color: #666;
            font-style: italic;
            margin-bottom: 0;
        }

        .answers-section h3 {
            color: #333;
            margin-bottom: 1rem;
        }

        .answer-stats {
            display: flex;
            gap: 1rem;
            justify-content: center;
        }

        .correct-count {
            background: #4CAF50;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: bold;
        }

        .incorrect-count {
            background: #f44336;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: bold;
        }

        .results-footer {
            padding: 1.5rem 2rem;
            text-align: center;
            border-top: 1px solid #eee;
        }

        .results-footer .btn {
            min-width: 150px;
            padding: 0.75rem 2rem;
            font-size: 1.1rem;
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .results-modal-content {
                width: 95%;
                margin: 1rem;
            }

            .score-section {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }

            .score-circle {
                width: 100px;
                height: 100px;
                font-size: 1.3rem;
            }

            .results-header h2 {
                font-size: 1.5rem;
            }

            .answer-stats {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar2">
            <div class="logo">
                <a href="#">
                    <img src="images/icon/logo-white.png" alt="ITA Exam Portal" />
                </a>
            </div>
            <div class="menu-sidebar2__content js-scrollbar1">
                <div class="account2">
                    <div class="image img-cir">
                        <img src="https://ui-avatars.com/api/?name=<?= $user['avatar_name'] ?>&color=7F9CF5&background=EBF4FF" alt="User Avatar" />
                    </div>
                    <h4 class="name"><?= htmlspecialchars($user['full_name']) ?></h4>
                    <a href="logout.php">Sign out</a>
                </div>
                <nav class="navbar-sidebar2">
                    <ul class="list-unstyled navbar__list">
                        <li class="active">
                            <a href="#exam">
                                <i class="fas fa-file-alt"></i>Exam</a>
                        </li>
                        <!-- <li>
                            <a href="#results">
                                <i class="fas fa-chart-bar"></i>Results</a>
                        </li>
                        <li>
                            <a href="#profile">
                                <i class="fas fa-user"></i>Profile</a>
                        </li> -->
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container2">
            <!-- HEADER MOBILE-->
            <header class="header-mobile d-block d-lg-none">
                <div class="header-mobile__bar">
                    <div class="container-fluid">
                        <div class="header-mobile-inner">
                            <a class="logo" href="#">
                                <img src="images/icon/logo.png" alt="ITA Exam Portal" />
                            </a>
                            <button class="hamburger hamburger--slider" type="button" onclick="toggleMobileMenu()">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <nav class="navbar-mobile" id="mobileNav" style="display: none;">
                    <div class="container-fluid">
                        <ul class="navbar-mobile__list list-unstyled">
                            <li>
                                <a href="#exam">
                                    <i class="fas fa-file-alt"></i>Exam</a>
                            </li>
                            <!-- <li>
                                <a href="#results">
                                    <i class="fas fa-chart-bar"></i>Results</a>
                            </li>
                            <li>
                                <a href="#profile">
                                    <i class="fas fa-user"></i>Profile</a>
                            </li> -->
                            <li>
                                <a href="logout.php">
                                    <i class="fas fa-sign-out-alt"></i>Logout</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- END HEADER MOBILE-->

            <!-- HEADER DESKTOP-->
            <header class="header-desktop2">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap2">
                            <div class="logo d-block d-lg-none">
                                <a href="#">
                                    <img src="images/icon/logo-white.png" alt="ITA Exam Portal" />
                                </a>
                            </div>
                            <div class="header-button2">
<!--                                <div class="header-button-item js-item-menu">-->
<!--                                    <i class="zmdi zmdi-search"></i>-->
<!--                                    <div class="search-dropdown js-dropdown">-->
<!--                                        <form action="">-->
<!--                                            <input class="au-input au-input--full au-input--h65" type="text" placeholder="Search for datas &amp; reports..." />-->
<!--                                            <span class="search-dropdown__focus">-->
<!--                                                <i class="zmdi zmdi-search"></i>-->
<!--                                            </span>-->
<!--                                        </form>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="header-button-item has-noti js-item-menu">-->
<!--                                    <i class="zmdi zmdi-notifications"></i>-->
<!--                                    <div class="notifi-dropdown js-dropdown">-->
<!--                                        <div class="notifi__title">-->
<!--                                            <p>You have 3 Notifications</p>-->
<!--                                        </div>-->
<!--                                        <div class="notifi__item">-->
<!--                                            <div class="bg-c1 img-cir img-40">-->
<!--                                                <i class="zmdi zmdi-email-open"></i>-->
<!--                                            </div>-->
<!--                                            <div class="content">-->
<!--                                                <p>You got a email notification</p>-->
<!--                                                <span class="date">April 12, 2018 06:50</span>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="notifi__item">-->
<!--                                            <div class="bg-c2 img-cir img-40">-->
<!--                                                <i class="zmdi zmdi-account-box"></i>-->
<!--                                            </div>-->
<!--                                            <div class="content">-->
<!--                                                <p>Your account has been blocked</p>-->
<!--                                                <span class="date">April 12, 2018 06:50</span>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="notifi__item">-->
<!--                                            <div class="bg-c3 img-cir img-40">-->
<!--                                                <i class="zmdi zmdi-file-text"></i>-->
<!--                                            </div>-->
<!--                                            <div class="content">-->
<!--                                                <p>You got a new file</p>-->
<!--                                                <span class="date">April 12, 2018 06:50</span>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="notifi__footer">-->
<!--                                            <a href="#">All notifications</a>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- END HEADER DESKTOP-->

            <!-- BREADCRUMB-->
            <section class="au-breadcrumb m-t-75">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="au-breadcrumb-content">
                                    <div class="au-breadcrumb-left">
                                        <span class="au-breadcrumb-span">You are here:</span>
                                        <ul class="list-unstyled list-inline au-breadcrumb__list">
                                            <li class="list-inline-item active">
                                                <a href="#">Home</a>
                                            </li>
                                            <li class="list-inline-item seprate">
                                                <span>/</span>
                                            </li>
                                            <li class="list-inline-item">Dashboard</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END BREADCRUMB-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content">
                    <div class="container-fluid">
                        <!-- Exam Tab Content -->
                        <div id="exam" class="tab-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Exam</h3>
                                        </div>
                                        <div class="card-body ">
                                            <div class="exam-instructions ">
                                                <h4>Important Instructions:</h4>
                                                <br>
                                                <ol class="exam-instructions pl-3">
                                                    <li>The exam consists of multiple-choice questions.</li>
                                                    <li>You will have 20 minutes to complete the exam.</li>
                                                    <li>Each question carries equal marks.</li>
                                                    <li>There is no negative marking.</li>
                                                    <li>You can go back to previous questions.</li>
                                                    <li>Do not refresh the page during the exam.</li>
                                                    <li>Ensure you have a stable internet connection.</li>
                                                    <li>Your answers will be automatically saved.</li>
                                                </ol>
                                                <div class="text-center mt-4">
                                                    <button id="startExam" class="btn btn-primary btn-lg">Start Exam</button>
                                                </div>
                                            </div>
                                            <div id="examContent" style="display: none;">
                                                <!-- Exam content will be loaded here -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/slick/slick.min.js"></script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js"></script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/select2/select2.min.js"></script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const startExamBtn = document.getElementById('startExam');
            const examInstructions = document.querySelector('.exam-instructions');
            const examContent = document.getElementById('examContent');
            
            let currentQuestionIndex = 0;
            let questions = [];
            let answers = new Array(20).fill(null);
            let timeLeft = 20 * 60; // 20 minutes in seconds
            let timerInterval = null;
            let isExamSubmitted = false;
            let testAttemptId = null; // Store the test attempt ID

            startExamBtn.addEventListener('click', async function() {
                console.log('Start exam button clicked');
                try {
                    // Disable the start button to prevent multiple clicks
                    startExamBtn.disabled = true;
                    startExamBtn.textContent = 'Starting Exam...';
                    
                    // First, call the API to start the test
                    await startTestAttempt();
                    
                    // Hide instructions and show exam content
                    examInstructions.style.display = 'none';
                    examContent.style.display = 'block';
                    
                    // Load exam content
                    loadExamContent();
                } catch (error) {
                    console.error('Error starting exam:', error);
                    showError(error.message, 'Failed to Start Exam');
                    
                    // Re-enable the start button if there's an error
                    startExamBtn.disabled = false;
                    startExamBtn.textContent = 'Start Exam';
                }
            });

            async function startTestAttempt() {
                console.log('Starting test attempt...');
                try {
                    const response = await fetch('http://127.0.0.1:8000/api/test/start', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            applicant_id: <?= $_SESSION['user']['id']?>,
                            trn: '<?= $_SESSION['user']['trn']?>'
                        })
                    });

                    const result = await response.json();
                    console.log('API Response:', result);

                    if (response.ok && result.success) {
                        testAttemptId = result.attempt_id;
                        console.log('Test attempt ID stored:', testAttemptId);
                        // You can show success message if needed
                        // alert(result.message || 'Test started successfully');
                    } else {
                        // Display the actual API error message
                        const errorMessage = result.message || result.error || 'Unknown error occurred';
                        throw new Error(errorMessage);
                    }
                } catch (error) {
                    console.error('Error starting test attempt:', error);
                    // If it's a network error, provide a more specific message
                    if (error.name === 'TypeError' && error.message.includes('fetch')) {
                        throw new Error('Network error: Unable to connect to the server. Please check your internet connection.');
                    }
                    throw error;
                }
            }

            function loadExamContent() {
                // Create exam container
                const examContainer = document.createElement('div');
                examContainer.className = 'exam-container';
                
                // Add timer container
                const timerContainer = document.createElement('div');
                timerContainer.className = 'timer-container';
                timerContainer.innerHTML = `
                    <div class="timer" id="timer">20:00</div>
                    <div class="question-number">Question <span id="currentQuestion">1</span> of 20</div>
                `;
                
                // Add progress container
                const progressContainer = document.createElement('div');
                progressContainer.className = 'progress-container';
                progressContainer.innerHTML = `
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 5%" id="progressBar"></div>
                    </div>
                `;
                
                // Add question container
                const questionContainer = document.createElement('div');
                questionContainer.className = 'question-container';
                questionContainer.innerHTML = `
                    <div class="question-text" id="questionText"></div>
                    <div class="options-container" id="optionsContainer"></div>
                `;
                
                // Add navigation buttons
                const navigationButtons = document.createElement('div');
                navigationButtons.className = 'navigation-buttons';
                navigationButtons.innerHTML = `
                    <button class="btn btn-secondary btn-navigation" id="prevBtn" disabled>Previous</button>
                    <button class="btn btn-primary btn-navigation" id="nextBtn">Next</button>
                    <button class="btn btn-success btn-navigation" id="submitBtn" style="display: none;">Submit Test</button>
                `;
                
                // Append all elements to exam container
                examContainer.appendChild(timerContainer);
                examContainer.appendChild(progressContainer);
                examContainer.appendChild(questionContainer);
                examContainer.appendChild(navigationButtons);
                
                // Append exam container to exam content
                examContent.appendChild(examContainer);

                // Add event listeners for navigation buttons
                document.getElementById('prevBtn').addEventListener('click', previousQuestion);
                document.getElementById('nextBtn').addEventListener('click', nextQuestion);
                document.getElementById('submitBtn').addEventListener('click', submitExam);
                
                // Start the exam timer
                startTimer();
                
                // Fetch and load questions
                fetchQuestions();
            }

            async function fetchQuestions() {
                console.log('Fetching questions from API...');
                try {
                    const response = await fetch('http://127.0.0.1:8000/api/test/questions');
                    console.log('API Response status:', response.status);
                    
                    const result = await response.json();
                    console.log('API Response data:', result);
                    
                    if (response.ok && result.status === 'success') {
                        questions = result.data.questions;
                        console.log('Questions loaded:', questions.length);
                        loadQuestion(currentQuestionIndex);
                    } else {
                        // Display the actual API error message
                        const errorMessage = result.message || result.error || 'Failed to load questions from server';
                        throw new Error(errorMessage);
                    }
                } catch (error) {
                    console.error('Error fetching questions:', error);
                    // Handle different types of errors
                    let displayMessage;
                    if (error.name === 'TypeError' && error.message.includes('fetch')) {
                        displayMessage = 'Network error: Unable to connect to the server. Please check your internet connection.';
                    } else {
                        displayMessage = error.message;
                    }
                    showError(displayMessage, 'Failed to Load Questions');
                }
            }

            function loadQuestion(questionIndex) {
                if (isExamSubmitted) return; // Prevent loading questions after submission

                const question = questions[questionIndex];
                const questionText = document.getElementById('questionText');
                const optionsContainer = document.getElementById('optionsContainer');
                const prevBtn = document.getElementById('prevBtn');
                const nextBtn = document.getElementById('nextBtn');
                const submitBtn = document.getElementById('submitBtn');
                const currentQuestionSpan = document.getElementById('currentQuestion');
                const progressBar = document.getElementById('progressBar');

                // Update question text
                questionText.textContent = question.question_text;

                // Clear and populate options
                optionsContainer.innerHTML = '';
                ['A', 'B', 'C', 'D'].forEach((option, index) => {
                    const optionDiv = document.createElement('div');
                    optionDiv.className = `option-item ${answers[questionIndex] === index ? 'selected' : ''}`;
                    
                    const radio = document.createElement('input');
                    radio.type = 'radio';
                    radio.name = 'answer';
                    radio.value = index;
                    radio.checked = answers[questionIndex] === index;
                    radio.disabled = isExamSubmitted; // Disable radio buttons after submission
                    
                    const label = document.createElement('label');
                    label.textContent = `${option}. ${question.options[option]}`;
                    
                    optionDiv.appendChild(radio);
                    optionDiv.appendChild(label);
                    
                    if (!isExamSubmitted) {
                        optionDiv.addEventListener('click', () => selectAnswer(index));
                    }
                    optionsContainer.appendChild(optionDiv);
                });

                // Update navigation buttons
                prevBtn.disabled = questionIndex === 0 || isExamSubmitted;
                nextBtn.style.display = questionIndex === 19 ? 'none' : 'block';
                submitBtn.style.display = questionIndex === 19 ? 'block' : 'none';
                if (isExamSubmitted) {
                    submitBtn.disabled = true;
                }

                // Update progress
                currentQuestionSpan.textContent = questionIndex + 1;
                progressBar.style.width = `${((questionIndex + 1) / 20) * 100}%`;
            }

            function selectAnswer(answerIndex) {
                if (isExamSubmitted) return; // Prevent selecting answers after submission
                answers[currentQuestionIndex] = answerIndex;
                loadQuestion(currentQuestionIndex);
            }

            function previousQuestion() {
                if (currentQuestionIndex > 0 && !isExamSubmitted) {
                    currentQuestionIndex--;
                    loadQuestion(currentQuestionIndex);
                }
            }

            function nextQuestion() {
                if (currentQuestionIndex < 19 && !isExamSubmitted) {
                    currentQuestionIndex++;
                    loadQuestion(currentQuestionIndex);
                }
            }

            function startTimer() {
                const timerDisplay = document.getElementById('timer');
                
                timerInterval = setInterval(() => {
                    const minutes = Math.floor(timeLeft / 60);
                    const seconds = timeLeft % 60;
                    
                    timerDisplay.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                    
                    if (timeLeft <= 300) { // 5 minutes remaining
                        timerDisplay.classList.add('warning-time');
                    }
                    
                    if (timeLeft <= 0) {
                        clearInterval(timerInterval);
                        submitExam();
                    }
                    
                    timeLeft--;
                }, 1000);
            }

            async function submitExam() {
                if (isExamSubmitted) return; // Prevent multiple submissions

                // Check if we have a test attempt ID
                if (!testAttemptId) {
                    showError('No test attempt ID found. Please refresh the page and start the exam again.', 'Test Error');
                    return;
                }

                const unanswered = answers.filter(answer => answer === null).length;
                
                if (unanswered > 0) {
                    showConfirm(
                        `You have ${unanswered} unanswered questions. Are you sure you want to submit?`,
                        'Confirm Submission',
                        () => {
                            // Continue with submission
                            proceedWithSubmission();
                        },
                        () => {
                            // Cancel submission - re-enable interface
                            isExamSubmitted = false;
                            return;
                        }
                    );
                    return;
                }

                proceedWithSubmission();
            }

            async function proceedWithSubmission() {
                isExamSubmitted = true;
                clearInterval(timerInterval);
                
                // Disable all interactive elements
                document.querySelectorAll('input[type="radio"]').forEach(radio => radio.disabled = true);
                document.querySelectorAll('.option-item').forEach(item => item.style.pointerEvents = 'none');
                document.getElementById('prevBtn').disabled = true;
                document.getElementById('nextBtn').disabled = true;
                document.getElementById('submitBtn').disabled = true;
                
                try {
                    // Format answers according to required structure
                    const formattedAnswers = answers.map((answer, index) => ({
                        question_id: questions[index].id,
                        selected_option: answer !== null ? ['A', 'B', 'C', 'D'][answer] : null
                    }));

                    const submissionData = {
                        applicant_id: <?= $_SESSION['user']['id'] ?? 1 ?>,
                        test_attempt_id: testAttemptId,
                        answers: formattedAnswers
                    };

                    // Display data before submitting
                    console.log('Submission Data:', submissionData);

                    const response = await fetch('http://127.0.0.1:8000/api/test/submit', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(submissionData)
                    });
                    
                    const result = await response.json();
                    console.log('Submit API Response:', result);
                    
                    if (response.ok) {
                        // Display detailed results instead of simple alert
                        displayTestResults(result);
                    } else {
                        // Display error message from API
                        const errorMessage = result.message || result.error || 'Failed to submit test';
                        throw new Error(errorMessage);
                    }
                } catch (error) {
                    console.error('Error submitting test:', error);
                    
                    // Handle different types of errors
                    let displayMessage;
                    if (error.name === 'TypeError' && error.message.includes('fetch')) {
                        displayMessage = 'Network error: Unable to connect to the server. Please check your internet connection.';
                    } else {
                        displayMessage = error.message;
                    }
                    
                    showError(displayMessage, 'Submission Failed');
                    
                    // Re-enable the interface if submission fails
                    isExamSubmitted = false;
                    document.querySelectorAll('input[type="radio"]').forEach(radio => radio.disabled = false);
                    document.querySelectorAll('.option-item').forEach(item => item.style.pointerEvents = 'auto');
                    document.getElementById('prevBtn').disabled = false;
                    document.getElementById('nextBtn').disabled = false;
                    document.getElementById('submitBtn').disabled = false;
                    startTimer(); // Restart the timer
                }
            }

            // Add window unload warning
            window.addEventListener('beforeunload', function(e) {
                if (!isExamSubmitted) {
                    e.preventDefault();
                    e.returnValue = 'Are you sure you want to leave? Your progress will be lost.';
                }
            });
        });

         // Universal Modal System
         function showModal(options) {
             const {
                 type = 'info', // 'success', 'error', 'warning', 'info', 'confirm'
                 title = 'Notification',
                 message = '',
                 confirmText = 'OK',
                 cancelText = 'Cancel',
                 onConfirm = null,
                 onCancel = null,
                 showCancel = false,
                 autoClose = false,
                 autoCloseTime = 3000
             } = options;

             const modalId = 'universalModal_' + Date.now();
             const iconMap = {
                 success: '✅',
                 error: '❌',
                 warning: '⚠️',
                 info: 'ℹ️',
                 confirm: '❓'
             };

             const colorMap = {
                 success: { bg: 'linear-gradient(135deg, #4CAF50, #45a049)', color: 'white' },
                 error: { bg: 'linear-gradient(135deg, #f44336, #d32f2f)', color: 'white' },
                 warning: { bg: 'linear-gradient(135deg, #ff9800, #f57c00)', color: 'white' },
                 info: { bg: 'linear-gradient(135deg, #2196F3, #1976D2)', color: 'white' },
                 confirm: { bg: 'linear-gradient(135deg, #9C27B0, #7B1FA2)', color: 'white' }
             };

             const modalHTML = `
                 <div id="${modalId}" class="universal-modal">
                     <div class="universal-modal-content">
                         <div class="universal-modal-header ${type}">
                             <div class="modal-icon">${iconMap[type]}</div>
                             <h3>${title}</h3>
                         </div>
                         <div class="universal-modal-body">
                             <p>${message}</p>
                         </div>
                         <div class="universal-modal-footer">
                             ${showCancel ? `<button onclick="handleModalAction('${modalId}', 'cancel')" class="btn btn-secondary">${cancelText}</button>` : ''}
                             <button onclick="handleModalAction('${modalId}', 'confirm')" class="btn btn-primary">${confirmText}</button>
                         </div>
                     </div>
                 </div>
             `;

             document.body.insertAdjacentHTML('beforeend', modalHTML);
             const modal = document.getElementById(modalId);
             modal.style.display = 'flex';

             // Store callbacks
             window.modalCallbacks = window.modalCallbacks || {};
             window.modalCallbacks[modalId] = { onConfirm, onCancel };

             // Auto close if specified
             if (autoClose) {
                 setTimeout(() => {
                     closeModal(modalId);
                     if (onConfirm) onConfirm();
                 }, autoCloseTime);
             }

             return modalId;
         }

         function handleModalAction(modalId, action) {
             const callbacks = window.modalCallbacks[modalId];
             if (action === 'confirm' && callbacks.onConfirm) {
                 callbacks.onConfirm();
             } else if (action === 'cancel' && callbacks.onCancel) {
                 callbacks.onCancel();
             }
             closeModal(modalId);
         }

         function closeModal(modalId) {
             const modal = document.getElementById(modalId);
             if (modal) {
                 modal.style.animation = 'modalSlideOut 0.3s ease-in';
                 setTimeout(() => {
                     modal.remove();
                     delete window.modalCallbacks[modalId];
                 }, 300);
             }
         }

         // Enhanced alert functions
         function showSuccess(message, title = 'Success!', autoClose = true) {
             return showModal({
                 type: 'success',
                 title: title,
                 message: message,
                 autoClose: autoClose,
                 autoCloseTime: 3000
             });
         }

         function showError(message, title = 'Error') {
             return showModal({
                 type: 'error',
                 title: title,
                 message: message
             });
         }

         function showWarning(message, title = 'Warning') {
             return showModal({
                 type: 'warning',
                 title: title,
                 message: message
             });
         }

         function showInfo(message, title = 'Information') {
             return showModal({
                 type: 'info',
                 title: title,
                 message: message
             });
         }

         function showConfirm(message, title = 'Confirm Action', onConfirm = null, onCancel = null) {
             return showModal({
                 type: 'confirm',
                 title: title,
                 message: message,
                 showCancel: true,
                 confirmText: 'Yes',
                 cancelText: 'No',
                 onConfirm: onConfirm,
                 onCancel: onCancel
             });
         }

        function displayTestResults(apiResponse) {
            const data = apiResponse.data;
            const isPass = data.assessment_status === 'pass';
            
            // Create modal HTML
            const modalHTML = `
                <div id="resultsModal" class="results-modal">
                    <div class="results-modal-content">
                        <div class="results-header ${isPass ? 'pass' : 'fail'}">
                            <h2>${isPass ? '🎉 Congratulations!' : '📚 Keep Learning!'}</h2>
                            <p class="status-text">${isPass ? 'You have passed the exam!' : 'You did not pass this time, but don\'t give up!'}</p>
                        </div>
                        
                        <div class="results-body">
                            <div class="score-section">
                                <div class="score-circle ${isPass ? 'pass' : 'fail'}">
                                    <span class="score-number">${data.score}%</span>
                                </div>
                                <div class="score-details">
                                    <p><strong>Correct Answers:</strong> ${data.correct_answers} out of ${data.total_questions}</p>
                                    <p><strong>Reference Number:</strong> ${data.unique_reference_number}</p>
                                    <p><strong>Status:</strong> <span class="status ${data.assessment_status}">${data.assessment_status.toUpperCase()}</span></p>
                                </div>
                            </div>
                            
                            ${!isPass ? `
                                <div class="reschedule-section">
                                    <h3>📅 Next Appointment</h3>
                                    <p>Your next appointment has been scheduled for:</p>
                                    <div class="appointment-date">
                                        ${new Date(data.reschedule_date).toLocaleDateString('en-US', {
                                            weekday: 'long',
                                            year: 'numeric',
                                            month: 'long',
                                            day: 'numeric'
                                        })}
                                    </div>
                                    <p class="reschedule-note">Please prepare well and try again. You can do it!</p>
                                </div>
                            ` : ''}
                            
                            <div class="answers-section">
                                <h3>📊 Answer Review</h3>
                                <div class="answers-summary">
                                    <div class="answer-stats">
                                        <span class="correct-count">${data.correct_answers} Correct</span>
                                        <span class="incorrect-count">${data.total_questions - data.correct_answers} Incorrect</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="results-footer">
                            <button onclick="closeResultsModal()" class="btn btn-primary">Continue</button>
                        </div>
                    </div>
                </div>
            `;
            
            // Add modal to page
            document.body.insertAdjacentHTML('beforeend', modalHTML);
            
            // Show modal
            document.getElementById('resultsModal').style.display = 'flex';
        }

        function closeResultsModal() {
            const modal = document.getElementById('resultsModal');
            if (modal) {
                modal.remove();
            }
            // Reload page to reset exam state
            location.reload();
        }

        // Mobile menu functions
        function toggleMobileMenu() {
            const mobileNav = document.getElementById('mobileNav');
            const hamburger = document.querySelector('.hamburger');
            
            if (mobileNav.style.display === 'none' || mobileNav.style.display === '') {
                mobileNav.style.display = 'block';
                hamburger.classList.add('is-active');
            } else {
                mobileNav.style.display = 'none';
                hamburger.classList.remove('is-active');
            }
        }

        function closeMobileMenu() {
            const mobileNav = document.getElementById('mobileNav');
            const hamburger = document.querySelector('.hamburger');
            
            mobileNav.style.display = 'none';
            hamburger.classList.remove('is-active');
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const mobileNav = document.getElementById('mobileNav');
            const hamburger = document.querySelector('.hamburger');
            const headerMobile = document.querySelector('.header-mobile');
            
            if (mobileNav && mobileNav.style.display === 'block') {
                if (!headerMobile.contains(event.target)) {
                    closeMobileMenu();
                }
            }
        });
    </script>
</body>
</html> 