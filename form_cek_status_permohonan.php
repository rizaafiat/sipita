<style>
        :root {
            --primary-blue: #1e5091;
            --primary-blue-dark: #164073;
            --danger-color: #dc2626;
            --text-white: #ffffff;
            --input-bg: #f8f9fa;
            --border-radius: 25px;
        }

        * {
            box-sizing: border-box;
        }

        .main-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            max-width: 1000px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            color: white;      
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 15px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .header p {
            font-size: 1.2rem;
            opacity: 0.9;
            margin: 0;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 30px;
            padding: 40px;
            width: 100%;
            max-width: 900px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .alert {
            border: none;
            border-radius: var(--border-radius);
            padding: 15px 20px;
            margin-bottom: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            background: rgba(248, 113, 113, 0.9);
            color: white;
            backdrop-filter: blur(10px);
        }

        .form-row {
            display: flex;
            gap: 20px;
            align-items: end;
            flex-wrap: wrap;
        }

        .form-group {
            flex: 1;
            min-width: 250px;
        }

        .form-group.button-group {
            flex: 0 0 auto;
            min-width: auto;
        }

        .form-label {
            color: white;
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 10px;
            display: block;
        }

        .form-control {
            background: white;
            border: none;
            border-radius: var(--border-radius);
            padding: 15px 20px;
            font-size: 1rem;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .form-control:focus {
            outline: none;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            transform: translateY(-1px);
        }

        .form-control::placeholder {
            color: #6b7280;
            opacity: 0.7;
        }

        .btn-primary {
            background: linear-gradient(45deg, #0ea5e9, #06b6d4);
            border: none;
            border-radius: var(--border-radius);
            padding: 15px 30px;
            font-weight: 600;
            font-size: 1rem;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(14, 165, 233, 0.3);
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #0284c7, #0891b2);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(14, 165, 233, 0.4);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .text-danger {
            color: #fca5a5 !important;
        }

        .invalid-feedback {
            color: #fca5a5;
            font-size: 0.875rem;
            margin-top: 5px;
            display: none;
        }

        .form-control.is-invalid {
            border: 2px solid #f87171;
            box-shadow: 0 0 0 3px rgba(248, 113, 113, 0.2);
        }

        .form-control.is-invalid + .invalid-feedback {
            display: block;
        }

        /* Loading state */
        .btn-loading {
            position: relative;
            color: transparent;
        }

        .btn-loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin-left: -10px;
            margin-top: -10px;
            border: 2px solid transparent;
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            .header h1 {
                font-size: 2rem;
            }

            .header p {
                font-size: 1rem;
            }

            .form-container {
                padding: 30px 20px;
            }

            .form-row {
                flex-direction: column;
                gap: 15px;
            }

            .form-group {
                min-width: 100%;
            }

            .form-group.button-group {
                min-width: 100%;
            }

            .btn-primary {
                width: 100%;
                justify-content: center;
                padding: 18px 30px;
                font-size: 1.1rem;
            }
        }

        @media (max-width: 576px) {
            .form-control {
                padding: 12px 16px;
                font-size: 0.95rem;
            }

            .form-label {
                font-size: 0.9rem;
            }
        }

        /* Animation for form validation */
        .was-validated .form-control:invalid,
        .form-control.is-invalid {
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-3px); }
            20%, 40%, 60%, 80% { transform: translateX(3px); }
        }
    </style>
</head>
<body>

    <div class="main-container">
        <!-- Header -->
        <div class="header">
            <div class="header-content">
                <h1><i class="fa-solid fa-magnifying-glass"></i></i> Cek Permohonan Informasi</h1>
            </div>
        </div>

        <!-- Form Container -->
        <div class="form-container">
            <!-- Alert error server-side -->
            <?php if (isset($_SESSION['error']) && !empty($_SESSION['error'])): ?>
            <div class="alert alert-dismissible fade show" id="errorAlert">
                <i class="fas fa-exclamation-circle me-2"></i>
                <span id="errorMessage"><?php echo htmlspecialchars($_SESSION['error']); ?></span>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['error']); else: ?>
            <div class="alert alert-dismissible fade show" style="display: none;" id="errorAlert">
                <i class="fas fa-exclamation-circle me-2"></i>
                <span id="errorMessage"></span>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>
            
            <form method="POST" class="needs-validation" novalidate id="statusForm">
                <div class="form-row">
                    <div class="form-group">
                        <label for="nomor_tiket" class="form-label">
                            Nomor Tiket <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="nomor_tiket" name="nomor_tiket" 
                               placeholder="PPID-20250721-69c8c7"
                               pattern="PPID-[A-Z0-9]{4,20}-[A-Za-z0-9]{4,20}" 
                               title="Contoh: PPID-20250721-69c8c7" required>
                        <div class="invalid-feedback">
                            <i class="fas fa-exclamation-triangle me-1"></i>
                            Harap masukkan nomor tiket yang valid
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="telepon" class="form-label">
                            Nomor Telepon <span class="text-danger">*</span>
                        </label>
                        <input type="tel" class="form-control" id="telepon" name="telepon" 
                               placeholder="08xxxxxxxxxx"
                               pattern="08[0-9]{9,11}" 
                               title="Contoh: 08xxxxxxxxxx" required>
                        <div class="invalid-feedback">
                            <i class="fas fa-exclamation-triangle me-1"></i>
                            Harap masukkan nomor telepon yang valid
                        </div>
                    </div>
                    
                    <div class="form-group button-group">
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="fas fa-search"></i>
                            Cek Status
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<script>
    // Validasi form client-side
    (function () {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
        // Tampilkan alert error jika ada pesan error dari server
        var errorAlert = document.getElementById('errorAlert');
        if (errorAlert && errorAlert.querySelector('#errorMessage').textContent.trim() !== '') {
            errorAlert.style.display = '';
        }
    })()
</script>
</body>
</html>