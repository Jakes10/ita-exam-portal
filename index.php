<!DOCTYPE html>
<?php
session_start();
?>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="ITA Exam Portal - Applicant Login">
    <meta name="author" content="ITA">
    <meta name="keywords" content="ITA Exam Portal">

    <!-- Title Page-->
    <title>Applicant Login - ITA Exam Portal</title>

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
        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
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
    </style>
</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="images/icon/logo.png" alt="ITA Exam Portal">
                            </a>
                        </div>
                        <div class="login-form">
                            <form id="loginForm" autocomplete="off">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input class="au-input au-input--full" type="text" name="fullName" value="Janessa Klocko" placeholder="Enter your full name">
                                </div>
                                <div class="form-group">
                                    <label>TRN</label>
                                    <input class="au-input au-input--full" type="text" name="trn" value="074-712-095" placeholder="Enter your TRN">
                                </div>
                                <div id="formError" class="error-message" style="display:none;"></div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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

        // Enhanced client-side validation and API submission
        const loginForm = document.getElementById('loginForm');
        loginForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            const fullNameInput = document.querySelector('input[name="fullName"]');
            const trnInput = document.querySelector('input[name="trn"]');
            const fullName = fullNameInput.value.trim();
            const trn = trnInput.value.trim();
            let isValid = true;

            // Clear previous error messages
            document.querySelectorAll('.error-message').forEach(el => el.style.display = 'none');

            // Remove previous inline errors
            document.querySelectorAll('.error-message.inline').forEach(el => el.remove());

            if (!fullName) {
                const errorDiv = document.createElement('div');
                errorDiv.className = 'error-message inline';
                errorDiv.textContent = 'Full Name is required';
                fullNameInput.parentNode.appendChild(errorDiv);
                isValid = false;
            }

            if (!trn) {
                const errorDiv = document.createElement('div');
                errorDiv.className = 'error-message inline';
                errorDiv.textContent = 'TRN is required';
                trnInput.parentNode.appendChild(errorDiv);
                isValid = false;
            }

            if (!isValid) {
                return;
            }

            // Show loading state (optional)
            const submitBtn = loginForm.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Logging in...';

            // Prepare and send API request
            try {
                const response = await fetch('http://127.0.0.1:8000/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        full_name: fullName,
                        trn: trn
                    })
                });
                const data = await response.json();
                if (response.ok) {
                    // Create session with user data

                    // alert(JSON.stringify(data)); // Or use console.log(data);
                    // console.log(JSON.stringify(data));
                    // return;
                    const userData = {
                        full_name: fullName,
                        trn: trn
                    };
                    
                    // Store user data in session via PHP
                    const sessionResponse = await fetch('create_session.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(userData)
                    });
                    
                    if (sessionResponse.ok) {
                        showSuccess('Login successful! Redirecting to dashboard...', 'Welcome!', true);
                        setTimeout(() => {
                            window.location.href = 'dashboard.php';
                        }, 1500);
                    } else {
                        showError('Session creation failed. Please try again.', 'Login Error');
                    }
                } else {
                    // Show error from API
                    let errorMsg = data.message || 'Login failed. Please check your credentials.';
                    showError(errorMsg, 'Login Failed');
                }
            } catch (err) {
                showError('Network error. Please check your internet connection and try again.', 'Connection Error');
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Login';
            }
        });
    </script>
</body>
</html> 