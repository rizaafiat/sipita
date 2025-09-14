<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPITA - Kemendukbangga/ BKKBN Provinsi Kalimantan Selatan</title>
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .header {
            background: linear-gradient(135deg, #2a5298 0%, #1e3c72 100%);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .header-content {
            position: relative;
            z-index: 1;
        }

        .header h1 {
            font-size: 1.8rem;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .header p {
            font-size: 1rem;
            opacity: 0.9;
        }

        .form-container {
            padding: 20px;
        }

        .form-section {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #2a5298;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e0e0e0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-row.full {
            grid-template-columns: 1fr;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }

        .required {
            color: #e74c3c;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
            font-family: "Lato";
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #2a5298;
            box-shadow: 0 0 0 3px rgba(42, 82, 152, 0.1);
            transform: translateY(-2px);
        }

        select {
            cursor: pointer;
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        .radio-group {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .radio-item {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            padding: 10px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            transition: all 0.3s ease;
            background: white;
        }

        .radio-item:hover {
            border-color: #2a5298;
            background: rgba(42, 82, 152, 0.05);
        }

        .radio-item input[type="radio"] {
            width: auto;
            margin: 0;
        }

        .checkbox-group {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            padding: 5px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .checkbox-item:hover {
            background: rgba(42, 82, 152, 0.05);
        }

        .checkbox-item input[type="checkbox"] {
            width: auto;
            margin: 0;
        }

        .file-upload {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .file-input {
            width: 100%;
            padding: 12px 16px;
            border: 2px dashed #e0e0e0;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #f8f9fa;
            color: black;
        }

        .file-input:hover {
            border-color: #2a5298;
            background: rgba(42, 82, 152, 0.05);
        }

        .file-input input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 40px;
        }

        .btn {
            padding: 15px 30px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-primary {
            background: linear-gradient(135deg, #2a5298 0%, #1e3c72 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(42, 82, 152, 0.3);
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }

        .info-box {
            background: rgba(52, 152, 219, 0.1);
            border: 1px solid rgba(52, 152, 219, 0.2);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .info-box h3 {
            color: #3498db;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-box ul {
            margin-left: 20px;
            color: #666;
        }

        .info-box li {
            margin-bottom: 5px;
        }

        @media (max-width: 768px) {
            .container {
                margin: 10px;
                border-radius: 15px;
            }

            .header {
                padding: 20px;
            }

            .header h1 {
                font-size: 1.5rem;
            }

            .form-container {
                padding: 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .radio-group {
                flex-direction: column;
            }

            .buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }

        .loading {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }

        .loading-content {
            background: white;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
        }

        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #2a5298;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .error-message {
            color: #e74c3c;
            font-size: 0.9rem;
            margin-top: 8px;
            display: none;
            font-weight: bold;
        }

        .file-input.error {
            border-color: #e74c3c !important;
            background-color: #ffebee !important;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-5px); }
            40%, 80% { transform: translateX(5px); }
        }

        /* Custom style for success modal text color */
        #successModal {
            color: black;
        }

    </style>

</head>
<body>
        <header class="header">
           <div class="logo">
            <a href="https://ppid.bkkbnkalsel.online/">
                <img src="img/logo.png" class="logo-img">
           </a>
            </div>
            <div class="header-content">
                <h1>Sistem Pelayanan Informasi dan Data (SIPITA)</h1>
                <h2>Kemendukbangga/ BKKBN</h2>
                <h2>Perwakilan BKKBN Provinsi Kalimantan Selatan</h2>
            </div>
            <div class="logo">
                <img src="img/logo sipita.png" class="logo-img">
            </div>
        </header>
        
    <div class="container">
        <div class="header">
            <div class="header-content">
                <h1><i class="fas fa-file-alt"></i> Formulir Permohonan Informasi</h1>
            </div>
        </div>

        <div class="container my-5">
            <div class="card-body p-lg-5">            
                <div class="alert alert-info" role="alert">
                    <h4 class="alert-heading"><i class="fas fa-info-circle"></i> Informasi Penting</h4>
                    <ul class="mb-0">
                        <li>Formulir ini digunakan untuk mengajukan permohonan informasi publik.</li>
                        <li>Semua field yang bertanda (<span class="text-danger">*</span>) wajib diisi.</li>
                    </ul>
                </div>

                <form id="infoRequestForm" class="needs-validation" novalidate action="proses_form.php" method="POST" enctype="multipart/form-data">
                    <div class="form-section mt-5">
                        <h2 class="section-title"><i class="fas fa-user me-2"></i>Data Pemohon</h2>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama" name="nama" required placeholder="Masukkan nama lengkap anda...">
                                <div class="invalid-feedback">Nama lengkap wajib diisi.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="nik" class="form-label">NIK <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nik" name="nik" required pattern="[0-9]{16}" maxlength="16" placeholder="Masukkan 16 digit NIK Anda...">
                                <div class="invalid-feedback">NIK harus terdiri dari 16 digit angka.</div>
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label">Status Permohonan <span class="text-danger">*</span></label>
                                <div id="statusPermohonanGroup">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="status_p_1" name="status_permohonan" value="Perorangan" required>
                                            <label class="form-check-label" for="status_p_1">Perorangan</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="status_p_2" name="status_permohonan" value="Badan Hukum" required>
                                            <label class="form-check-label" for="status_p_2">Badan Hukum</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="status_p_3" name="status_permohonan" value="Kelompok Orang/LSM" required>
                                            <label class="form-check-label" for="status_p_3">Kelompok Orang/LSM</label> 
                                            <div class="invalid-feedback">Pilih salah satu status permohonan.</div>
                                        </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" required placeholder="name@example.com">
                                <div class="invalid-feedback">Format email tidak valid.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="telepon" class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" id="telepon" name="telepon" required placeholder="08xxxxxxxxxx">
                                <div class="invalid-feedback">Nomor telepon wajib diisi.</div>
                            </div>
                            <div class="col-12">
                                <label for="alamat" class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="alamat" name="alamat" required rows="3" placeholder="Masukkan alamat lengkap anda..."></textarea>
                                <div class="invalid-feedback">Alamat wajib diisi.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="pekerjaan" class="form-label">Pekerjaan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" required placeholder="Masukkan pekerjaan anda...">
                                <div class="invalid-feedback">Pekerjaan wajib diisi.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="instansi" class="form-label">Instansi/Organisasi <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="instansi" name="instansi" required placeholder="Masukkan nama instansi anda...">
                                <div class="invalid-feedback">Instansi/Organisasi wajib diisi.</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-section mt-5">
                        <h2 class="section-title"><i class="fas fa-info-circle me-2"></i>Rincian Informasi yang Diminta</h2>
                        <div class="row g-3">
                             <div class="col-12">
                                <label for="rincian_data" class="form-label">Rincian Data yang dibutuhkan <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="rincian_data" name="rincian_data" required rows="3" placeholder="Deskripsikan secara detail data yang Anda butuhkan..."></textarea>
                                <div class="invalid-feedback">Rincian data wajib diisi.</div>
                            </div>
                            <div class="col-12">
                                <label for="alasan_permohonan" class="form-label">Alasan Permohonan Data <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="alasan_permohonan" name="alasan_permohonan" required rows="3" placeholder="Deskripsikan alasan permohonan data..."></textarea>
                                <div class="invalid-feedback">Alasan permohonan wajib diisi.</div>
                            </div>
                            <div class="col-12">
                                <label for="tujuan_penggunaan" class="form-label">Tujuan Penggunaan Data <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="tujuan_penggunaan" name="tujuan_penggunaan" required rows="3" placeholder="Deskripsikan tujuan penggunaan data..."></textarea>
                                <div class="invalid-feedback">Tujuan penggunaan data wajib diisi.</div>
                            </div>
                             <div class="col-12">
                                <label class="form-label">Cara Memperoleh Informasi <span class="text-danger">*</span></label>
                                <div id="caraMemperolehGroup">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cara_memperoleh_1" name="cara_memperoleh" value="melihat">
                                        <label class="form-check-label" for="cara_memperoleh_1">Melihat/Membaca/Mendengar/Mencatat</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cara_memperoleh_2" name="cara_memperoleh" value="salinan">
                                        <label class="form-check-label" for="cara_memperoleh_2">Mendapat salinan informasi (Hardcopy/Softcopy)</label>
                                    </div>
                                    <div class="invalid-feedback">Pilih minimal satu cara memperoleh informasi.</div>
                                </div>
                            </div>
                             <div class="col-12">
                                <label class="form-label">Cara Mendapatkan Salinan Informasi <span class="text-danger">*</span></label>
                                <div id="caraSalinanGroup">
                                     <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="cara_salinan_1" name="cara_salinan" value="langsung">
                                        <label class="form-check-label" for="cara_salinan_1">Mengambil Langsung</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="cara_salinan_2" name="cara_salinan" value="kurir">
                                        <label class="form-check-label" for="cara_salinan_2">Kurir</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="cara_salinan_3" name="cara_salinan" value="pos">
                                        <label class="form-check-label" for="cara_salinan_3">Pos</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="cara_salinan_4" name="cara_salinan" value="whatsapp">
                                        <label class="form-check-label" for="cara_salinan_4">WhatsApp</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="cara_salinan_5" name="cara_salinan" value="email">
                                        <label class="form-check-label" for="cara_salinan_5">Email</label>
                                    </div>
                                    <div class="invalid-feedback">Pilih minimal satu cara mendapatkan salinan.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-section mt-5">
                        <h2 class="section-title"><i class="fas fa-upload me-2"></i>Upload Dokumen Pendukung</h2>
                        <div class="row">
                            <div class="col-12">
                                <label for="dokumen_surat_permohonan" class="form-label">Surat Permohonan <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="dokumen_surat_permohonan" name="dokumen_surat_permohonan" accept=".pdf,.jpg,.jpeg,.png" required>
                                <div class="invalid-feedback">Surat permohonan wajib diunggah.</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-section mt-5">
                        <h2 class="section-title"><i class="fas fa-check-circle me-2"></i>Pernyataan</h2>
                        <div class="row">
                            <div class="col-12" id="pernyataanGroup">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="pernyataan_data" name="pernyataan" required>
                                    <label class="form-check-label" for="pernyataan_data">Saya menyatakan bahwa data yang saya isikan adalah benar dan dapat dipertanggungjawabkan <span class="text-danger">*</span></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="pernyataan_ketentuan" name="pernyataan" required>
                                    <label class="form-check-label" for="pernyataan_ketentuan">Saya telah membaca dan menyetujui ketentuan permohonan informasi publik <span class="text-danger">*</span></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="pernyataan_konsekuensi" name="pernyataan" required>
                                    <label class="form-check-label" for="pernyataan_konsekuensi">Saya memahami konsekuensi hukum apabila data yang saya berikan tidak benar <span class="text-danger">*</span></label>
                                    <div class="invalid-feedback">Semua pernyataan harus disetujui.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center gap-3 mt-5">
                        <button type="reset" class="btn btn-secondary btn-lg"><i class="fas fa-redo me-2"></i>Reset</button>
                        <button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-paper-plane me-2"></i>Kirim Permohonan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="loadingModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="loadingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-4">
                    <div class="spinner-border text-primary mb-3" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mb-0">Sedang memproses permohonan Anda...</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="successModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel"><i class="fas fa-check-circle me-2 text-success"></i>Permohonan Berhasil Dikirim!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Permohonan Anda akan diproses dalam 10 hari kerja. Silakan simpan nomor tiket untuk melacak status permohonan Anda.</p>
                    <p class="mt-3"><strong>Nomor Tiket Anda:</strong></p>
                    <h4 class="text-center bg-light p-3 rounded"><span id="ticketNumberDisplay"></span></h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
<script>
    (() => {
        'use strict';

        const form = document.getElementById('infoRequestForm');
        const loadingModal = new bootstrap.Modal(document.getElementById('loadingModal'));
        
        // Custom validation for checkbox groups
        const validateCheckboxGroup = (groupElement, minRequired = 1) => {
            const checkboxes = groupElement.querySelectorAll('input[type="checkbox"]');
            const checkedCount = Array.from(checkboxes).filter(cb => cb.checked).length;
            const feedback = groupElement.querySelector('.invalid-feedback');
            
            if (checkedCount < minRequired) {
                feedback.style.display = 'block';
                return false;
            } else {
                feedback.style.display = 'none';
                return true;
            }
        };

        // Function to scroll to the first invalid element
        const scrollToFirstInvalid = () => {
            // Find first invalid input
            const firstInvalidInput = form.querySelector(':invalid');
            const firstInvalidFeedback = form.querySelector('.invalid-feedback[style="display: block;"]');
            
            let elementToScroll = null;
            
            // Prioritize invalid inputs first
            if (firstInvalidInput) {
                elementToScroll = firstInvalidInput;
            } 
            // Then check for invalid feedback messages
            else if (firstInvalidFeedback) {
                elementToScroll = firstInvalidFeedback.parentElement;
            }
            
            if (elementToScroll) {
                // For radio/checkbox groups, scroll to the group container
                if (elementToScroll.type === 'radio' || elementToScroll.type === 'checkbox') {
                    elementToScroll = elementToScroll.closest('div[id$="Group"]') || elementToScroll;
                }
                
                // Calculate position to scroll to
                const elementPosition = elementToScroll.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - 100; // 100px offset from top
                
                // Smooth scroll
                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
                
                // Focus the element if it's an input
                if (elementToScroll.tagName === 'INPUT' || elementToScroll.tagName === 'TEXTAREA' || elementToScroll.tagName === 'SELECT') {
                    elementToScroll.focus();
                }
            }
        };

        form.addEventListener('submit', event => {
            event.preventDefault();
            event.stopPropagation();
            
            // Perform custom validation for checkbox groups
            const isCaraMemperolehValid = validateCheckboxGroup(document.getElementById('caraMemperolehGroup'), 1);
            const isCaraSalinanValid = validateCheckboxGroup(document.getElementById('caraSalinanGroup'), 1);
            const isPernyataanValid = validateCheckboxGroup(document.getElementById('pernyataanGroup'), 3);
            
            // Add the class to show feedback for Bootstrap fields
            form.classList.add('was-validated');

            // Check Bootstrap's native validation AND our custom validation
            if (!form.checkValidity() || !isCaraMemperolehValid || !isCaraSalinanValid || !isPernyataanValid) {
                scrollToFirstInvalid();
                return;
            }

            // If form is valid, show loading modal and submit form
            loadingModal.show();
            form.submit();
        }, false);
        
        // Reset button clears validation
        form.addEventListener('reset', () => {
             form.classList.remove('was-validated');
             document.querySelectorAll('#caraMemperolehGroup .invalid-feedback, #caraSalinanGroup .invalid-feedback, #pernyataanGroup .invalid-feedback').forEach(el => {
                el.style.display = 'none';
             });
        });

    })();
</script>

</html>