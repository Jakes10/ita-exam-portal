<?php
session_start();

// For now, we'll create a simple admin check - you can enhance this later
// if (!isset($_SESSION['admin'])) {
//     header('Location: admin-login.php');
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="ITA Exam Portal - Admin Search">
    <meta name="author" content="ITA">
    <meta name="keywords" content="ITA Exam Portal Admin">

    <!-- Title Page-->
    <title>ITA Exam Portal - Admin Search</title>

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
        .search-container {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .search-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            border-radius: 15px 15px 0 0;
            text-align: center;
            margin: -2rem -2rem 2rem -2rem;
        }

        .search-header h2 {
            margin: 0;
            font-size: 2rem;
            font-weight: 600;
        }

        .search-header p {
            margin: 0.5rem 0 0 0;
            opacity: 0.9;
            font-size: 1.1rem;
        }

        .search-form {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .search-input {
            flex: 1;
            padding: 1rem 1.5rem;
            border: 2px solid #e9ecef;
            border-radius: 50px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .search-input:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .search-btn {
            padding: 1rem 2rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            min-width: 150px;
        }

        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .search-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .results-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: none;
        }

        .results-header {
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white;
            padding: 1.5rem 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .results-header.not-found {
            background: linear-gradient(135deg, #f44336, #d32f2f);
        }

        .results-icon {
            font-size: 2rem;
        }

        .results-title {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .applicant-details {
            padding: 2rem;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .detail-card {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 10px;
            border-left: 4px solid #667eea;
            transition: all 0.3s ease;
        }

        .detail-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .detail-label {
            font-size: 0.9rem;
            color: #6c757d;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }

        .detail-value {
            font-size: 1.2rem;
            color: #333;
            font-weight: 600;
        }

        .status-badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-pass {
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white;
        }

        .status-fail {
            background: linear-gradient(135deg, #f44336, #d32f2f);
            color: white;
        }

        .status-pending {
            background: linear-gradient(135deg, #ff9800, #f57c00);
            color: white;
        }

        .score-circle.pending {
            background: linear-gradient(135deg, #ff9800, #f57c00);
        }

        .score-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
            margin: 0 auto 1rem auto;
        }

        .score-circle.pass {
            background: linear-gradient(135deg, #4CAF50, #45a049);
        }

        .score-circle.fail {
            background: linear-gradient(135deg, #f44336, #d32f2f);
        }

        .no-results {
            text-align: center;
            padding: 3rem 2rem;
            color: #6c757d;
        }

        .no-results-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .loading-spinner {
            display: none;
            text-align: center;
            padding: 2rem;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #667eea;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 1rem auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .search-form {
                flex-direction: column;
            }

            .search-btn {
                width: 100%;
            }

            .detail-grid {
                grid-template-columns: 1fr;
            }

            .search-header h2 {
                font-size: 1.5rem;
            }
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
            border: none;
            cursor: pointer;
        }

        .universal-modal-footer .btn-primary {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
        }

        .universal-modal-footer .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        /* Table status styles */
        .status--process {
            background: #4CAF50;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status--denied {
            background: #f44336;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Table responsive improvements */
        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .table th {
            border: none;
            padding: 1rem;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table td {
            border: none;
            padding: 1rem;
            vertical-align: middle;
            font-size: 0.95rem;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(102, 126, 234, 0.05);
        }

        .table tbody tr:hover {
            background-color: rgba(102, 126, 234, 0.1);
            transition: all 0.3s ease;
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
                        <img src="https://ui-avatars.com/api/?name=Admin+User&color=7F9CF5&background=EBF4FF" alt="Admin Avatar" />
                    </div>
                    <h4 class="name">Admin User</h4>
                    <a href="logout.php">Sign out</a>
                </div>
                <nav class="navbar-sidebar2">
                    <ul class="list-unstyled navbar__list">
                        <li class="active">
                            <a href="#search">
                                <i class="fas fa-search"></i>Recipient Search</a>
                        </li>
                        <!-- <li>
                            <a href="#reports">
                                <i class="fas fa-chart-line"></i>Reports</a>
                        </li>
                        <li>
                            <a href="#settings">
                                <i class="fas fa-cog"></i>Settings</a>
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
                             
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="https://ui-avatars.com/api/?name=Admin+User&color=7F9CF5&background=EBF4FF" alt="Admin User" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">Admin User</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="account-dropdown__footer">
                                                <a href="logout.php">
                                                    <i class="fas fa-sign-out-alt"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                                <a href="#">Admin</a>
                                            </li>
                                            <li class="list-inline-item seprate">
                                                <span>/</span>
                                            </li>
                                            <li class="list-inline-item">Search Records</li>
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
                        <!-- Search Container -->
                        <div class="search-container">
                            <div class="search-header">
                                <h2>🔍 Applicant Search</h2>
                                <p>Search for applicant records using TRN or Unique Reference Number</p>
                            </div>
                            
                            <form id="searchForm">
                                <div class="search-form">
                                    <input 
                                        type="text" 
                                        id="searchInput" 
                                        class="search-input" 
                                        placeholder="Enter TRN (e.g., 123-456-789) or Reference Number (e.g., TEST-ABC12345)"
                                        required
                                    >
                                    <button type="submit" id="searchBtn" class="search-btn">
                                        <i class="fas fa-search"></i> Search
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Loading Spinner -->
                        <div id="loadingSpinner" class="loading-spinner">
                            <div class="spinner"></div>
                            <p>Searching records...</p>
                        </div>

                        <!-- Results Container -->
                        <div id="resultsContainer" class="results-container">
                            <!-- Results will be populated here -->
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
        // Universal Modal System
        function showModal(options) {
            const {
                type = 'info',
                title = 'Notification',
                message = '',
                confirmText = 'OK',
                onConfirm = null,
                autoClose = false,
                autoCloseTime = 3000
            } = options;

            const modalId = 'universalModal_' + Date.now();
            const iconMap = {
                success: '✅',
                error: '❌',
                warning: '⚠️',
                info: 'ℹ️'
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
            window.modalCallbacks[modalId] = { onConfirm };

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

        function showInfo(message, title = 'Information') {
            return showModal({
                type: 'info',
                title: title,
                message: message
            });
        }

        // Search functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchForm = document.getElementById('searchForm');
            const searchInput = document.getElementById('searchInput');
            const searchBtn = document.getElementById('searchBtn');
            const loadingSpinner = document.getElementById('loadingSpinner');
            const resultsContainer = document.getElementById('resultsContainer');

            searchForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                const searchTerm = searchInput.value.trim();
                if (!searchTerm) {
                    showError('Please enter a TRN or Reference Number to search.', 'Search Required');
                    return;
                }

                await performSearch(searchTerm);
            });

            async function performSearch(searchTerm) {
                // Show loading state
                searchBtn.disabled = true;
                searchBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Searching...';
                loadingSpinner.style.display = 'block';
                resultsContainer.style.display = 'none';

                try {
                    // Determine search type (TRN or Reference Number)
                    const isTRN = /^\d{3}-\d{3}-\d{3}$/.test(searchTerm);
                    
                    console.log(`Searching by ${isTRN ? 'TRN' : 'Reference Number'}: ${searchTerm}`);

                    // Make API call using the new records search endpoint
                    let apiUrl;
                    if (isTRN) {
                        apiUrl = `http://127.0.0.1:8000/api/records/search?trn=${encodeURIComponent(searchTerm)}`;
                    } else {
                        apiUrl = `http://127.0.0.1:8000/api/records/search?unique_reference_number=${encodeURIComponent(searchTerm)}`;
                    }

                    const response = await fetch(apiUrl, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json'
                        }
                    });

                    const result = await response.json();
                    console.log('Search result:', result);

                    if (response.ok && result.status === 'success') {
                        displayResults(result.data, isTRN);
                    } else {
                        displayNoResults(result.message || 'No records found for the provided search term.');
                    }

                } catch (error) {
                    console.error('Search error:', error);
                    showError('Network error occurred while searching. Please check your connection and try again.', 'Search Error');
                } finally {
                    // Reset button state
                    searchBtn.disabled = false;
                    searchBtn.innerHTML = '<i class="fas fa-search"></i> Search';
                    loadingSpinner.style.display = 'none';
                }
            }

            function displayResults(data, isTRNSearch) {
                const applicant = data.applicant;
                
                // Handle TRN search (multiple test results) vs Reference Number search (single test result)
                const testResults = isTRNSearch ? data.test_results : [data.test_result];
                const totalAttempts = isTRNSearch ? data.total_attempts : 1;
                
                // Create applicant info section
                const appointmentDate = applicant.appointment_date ? new Date(applicant.appointment_date).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' }) : 'Not scheduled';
                
                let applicantInfoHTML = `
                    <div class="results-header">
                        <i class="fas fa-user-check results-icon"></i>
                        <h3 class="results-title">Record Found - ${totalAttempts} Test Attempt${totalAttempts > 1 ? 's' : ''}</h3>
                    </div>
                    <div class="applicant-details">
                        <h4 style="color: #667eea; margin-bottom: 1.5rem;">📋 Applicant Information</h4>
                        <div class="detail-grid">
                            <div class="detail-card">
                                <div class="detail-label">Full Name</div>
                                <div class="detail-value">${applicant.full_name}</div>
                            </div>
                            <div class="detail-card">
                                <div class="detail-label">TRN</div>
                                <div class="detail-value">${applicant.trn}</div>
                            </div>
                            <div class="detail-card">
                                <div class="detail-label">Appointment Date</div>
                                <div class="detail-value">${appointmentDate}</div>
                            </div>
                        </div>
                        
                        <h4 style="color: #667eea; margin: 2rem 0 1.5rem 0;">📊 Test Results</h4>
                        <div class="table-responsive m-b-40">
                            <table class="table table-borderless table-striped">
                                <thead>
                                    <tr style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                                        <th style="color: white; font-weight: 600;">Test ID</th>
                                        <th style="color: white; font-weight: 600;">Status</th>
                                        <th style="color: white; font-weight: 600;">Score</th>
                                        <th style="color: white; font-weight: 600;">Reference Number</th>
                                        <th style="color: white; font-weight: 600;">Test Date</th>
                                        <th style="color: white; font-weight: 600;">End Time</th>
                                        <th style="color: white; font-weight: 600;">Reschedule Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                `;

                // Create test results table rows
                testResults.forEach((testResult, index) => {
                    if (!testResult) return; // Skip null results
                    
                    // Handle different assessment statuses
                    let statusClass = 'status--process';
                    let statusText = 'PENDING';
                    
                    if (testResult.assessment_status) {
                        switch (testResult.assessment_status) {
                            case 'pass':
                                statusClass = 'status--process';
                                statusText = 'PASSED';
                                break;
                            case 'fail':
                                statusClass = 'status--denied';
                                statusText = 'FAILED';
                                break;
                            case 'in_progress':
                                statusClass = 'status--process';
                                statusText = 'IN PROGRESS';
                                break;
                            default:
                                statusClass = 'status--process';
                                statusText = testResult.assessment_status ? testResult.assessment_status.toUpperCase() : 'PENDING';
                        }
                    }

                    const score = testResult.score !== null ? testResult.score + '%' : 'N/A';
                    const referenceNumber = testResult.unique_reference_number || 'Not assigned';
                    
                    // Format dates using F j, Y format (e.g., "January 15, 2025")
                    const formatDate = (dateString) => {
                        const date = new Date(dateString);
                        return date.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
                    };
                    
                    const formatDateTime = (dateString) => {
                        const date = new Date(dateString);
                        const formattedDate = date.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
                        const formattedTime = date.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
                        return formattedDate + '<br><small>' + formattedTime + '</small>';
                    };
                    
                    const testDate = testResult.test_date ? formatDateTime(testResult.test_date) : 'Not started';
                    const endTime = testResult.end_time ? formatDateTime(testResult.end_time) : 'Not completed';
                    const rescheduleDate = testResult.reschedule_date ? formatDate(testResult.reschedule_date) : '-';

                    applicantInfoHTML += `
                        <tr>
                            <td><strong>#${testResult.id}</strong></td>
                            <td><span class="${statusClass}">${statusText}</span></td>
                            <td><strong style="color: ${testResult.assessment_status === 'pass' ? '#4CAF50' : testResult.assessment_status === 'fail' ? '#f44336' : '#ff9800'};">${score}</strong></td>
                            <td><code>${referenceNumber}</code></td>
                            <td>${testDate}</td>
                            <td>${endTime}</td>
                            <td>${rescheduleDate !== '-' ? '<span style="color: #ff9800; font-weight: bold;">' + rescheduleDate + '</span>' : rescheduleDate}</td>
                        </tr>
                    `;
                });

                applicantInfoHTML += `
                                </tbody>
                            </table>
                        </div>
                `;

                applicantInfoHTML += `</div>`;

                resultsContainer.innerHTML = applicantInfoHTML;
                resultsContainer.style.display = 'block';
                
                // Smooth scroll to results
                resultsContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }

            function displayNoResults(message) {
                const noResultsHTML = `
                    <div class="results-header not-found">
                        <i class="fas fa-user-times results-icon"></i>
                        <h3 class="results-title">No Record Found</h3>
                    </div>
                    <div class="no-results">
                        <div class="no-results-icon">🔍</div>
                        <h4>No matching records found</h4>
                        <p>${message}</p>
                        <p>Please check the TRN or Reference Number and try again.</p>
                    </div>
                `;

                resultsContainer.innerHTML = noResultsHTML;
                resultsContainer.style.display = 'block';
                
                // Smooth scroll to results
                resultsContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });

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