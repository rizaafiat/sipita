<style>
    .container-informasi {
        max-width: 1200px;
        margin: 40px auto;
        background: rgba(255,255,255,0.97);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        overflow: hidden;
        padding: 0.5rem;
    }
    .header-informasi {
        background: linear-gradient(135deg, #2a5298 0%, #1e3c72 100%);
        color: white;
        padding: 30px;
        text-align: center;
        position: relative;
        overflow: hidden;
        border-radius: inherit;
    }
    .header-content {
        position: relative;
        z-index: 1;
    }
    .header-informasi h1 {
        font-size: 1.8rem;
        margin-bottom: 10px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }
    .header-informasi p {
        font-size: 1rem;
        opacity: 0.95;
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
    label {
        font-weight: 500;
        color: #333;
    }
    .form-check-label {
        font-weight: 400;
        color: #222;
    }
    .form-check {
        margin-bottom: 8px;
    }
    .form-check-input:checked {
        background-color: #2a5298;
        border-color: #2a5298;
    }
    textarea.form-control {
        min-height: 90px;
    }
    .btn-primary {
        background: linear-gradient(135deg, #2a5298 0%, #1e3c72 100%);
        border: none;
        font-weight: 600;
        padding: 12px 30px;
        border-radius: 8px;
        letter-spacing: 0.5px;
        transition: all 0.2s;
    }
    .btn-primary:hover {
        background: #1e3c72;
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(42, 82, 152, 0.15);
    }
    @media (max-width: 768px) {
        .container-informasi { margin: 10px; border-radius: 15px; }
        .header-informasi { padding: 20px; }
        .header-informasi h1 { font-size: 1.5rem; }
        .form-section { padding: 10px 0; }
    }

        .star-rating {
        direction: rtl;
        display: inline-flex;
        font-size: 4rem;
        gap: 0.2em;
    }
    .star-rating input[type="radio"] {
        /* display: none; */
        position: absolute;
        opacity: 0;
        width: 1em;
        height: 1em;
    }
    .star-rating label {
        color: #ccc;
        cursor: pointer;
        transition: color 0.2s;
    }
    .star-rating input[type="radio"]:checked ~ label,
    .star-rating label:hover,
    .star-rating label:hover ~ label {
        color: #f7b731;
    }
</style>
<div class="container-informasi">
    <div class="header-informasi">
        <div class="header-content">
            <h1><i class="fas fa-poll"></i> Survei Hasil Pelayanan</h1>
        </div>
    </div>
    <div class="form-container p-lg-5">
        <div class="alert alert-info" role="alert">
                    <ul class="mb-0">
                        <li>Survei Kepuasan Pelayanan Permintaan Data BKKBN Kalimantan Selatan menanyakan pendapat Bapak/Ibu/ Saudara/i selaku pengguna data mengenai pengalaman dalam memperoleh pelayanan dari PPID Kalimantan Selatan.</li>
                        <li>Berdasarkan pendapat yang dikumpulkan melalui survei ini, kami berharap mendapatkan gambaran untuk meningkatkan pelayanan yang diberikan.</li>
                        <li>Jawaban hanya akan dipergunakan untuk kepentingan survei. dimohon agar Bapak/ Ibu/Sdr/i berkenan untuk berpartisipasi dalam survei ini.Terima kasih.</li>
                        <li>Semua field yang bertanda (<span class="text-danger">*</span>) wajib diisi.</li>
                    </ul>
                </div>
        <form method="post">
            <div class="form-section">
                <h2 class="section-title"><i class="fas fa-database me-2"></i>Jenis Data atau Informasi yang Diperoleh <span class="text-danger">*</span></h2>
                <div class="checkbox-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="jenis_data[]" id="data1" value="Data Pendataan Keluarga (PK)">
                        <label class="form-check-label" for="data1">Data Pendataan Keluarga (PK)</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="jenis_data[]" id="data2" value="Data SIGA">
                        <label class="form-check-label" for="data2">Data SIGA</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="jenis_data[]" id="data3" value="Data Pengendalian Lapangan (DALLAP)">
                        <label class="form-check-label" for="data3">Data Pengendalian Lapangan (DALLAP)</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="jenis_data[]" id="data4" value="Data Pelayanan KB (Yan KB)">
                        <label class="form-check-label" for="data4">Data Pelayanan KB (Yan KB)</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="jenis_data[]" id="data5" value="Data Keluarga Berisiko Stunting (KRS)">
                        <label class="form-check-label" for="data5">Data Keluarga Berisiko Stunting (KRS)</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="jenis_data[]" id="data6" value="Data Elsimil">
                        <label class="form-check-label" for="data6">Data Elsimil</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="jenis_data[]" id="data7" value="Informasi Program Bangga Kencana">
                        <label class="form-check-label" for="data7">Informasi Program Bangga Kencana</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="jenis_data[]" id="data8" value="Informasi Stunting">
                        <label class="form-check-label" for="data8">Informasi Stunting</label>
                    </div>
                        <div class="invalid-feedback" style="display:none">Pilih minimal satu jenis data.</div>
                </div>
            </div>

            <div class="form-section">
                <h2 class="section-title"><i class="fas fa-shapes me-2"></i>Bentuk Data atau Informasi yang Diperoleh <span class="text-danger">*</span></h2>
                <div class="checkbox-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="bentuk_data[]" id="bentuk1" value="Data Agregat (Data kelompok)">
                        <label class="form-check-label" for="bentuk1">Data Agregat (Data kelompok)</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="bentuk_data[]" id="bentuk2" value="Data By Name by Address (Data individu)">
                        <label class="form-check-label" for="bentuk2">Data By Name by Address (Data individu)</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="bentuk_data[]" id="bentuk3" value="Lainnya">
                        <label class="form-check-label" for="bentuk3">Lainnya</label>
                    </div>
                       <div class="invalid-feedback" style="display:none">Pilih minimal satu bentuk data.</div>
                </div>
            </div>

            <div class="form-section">
                <h2 class="section-title"><i class="fas fa-tasks me-2"></i>Apakah persyaratan dan prosedur pelayanan dapat dipenuhi dengan mudah? <span class="text-danger">*</span></h2>
                    <div class="star-rating">
                        <input type="radio" id="star4_persyaratandanprosedur" name="persyaratandanprosedur" value="4" required /><label for="star4_persyaratandanprosedur" title="Sangat Memuaskan">&#9733;</label>
                        <input type="radio" id="star3_persyaratandanprosedur" name="persyaratandanprosedur" value="3" /><label for="star3_persyaratandanprosedur" title="Memuaskan">&#9733;</label>
                        <input type="radio" id="star2_persyaratandanprosedur" name="persyaratandanprosedur" value="2" /><label for="star2_persyaratandanprosedur" title="Tidak Memuaskan">&#9733;</label>
                        <input type="radio" id="star1_persyaratandanprosedur" name="persyaratandanprosedur" value="1" /><label for="star1_persyaratandanprosedur" title="Sangat Tidak Memuaskan">&#9733;</label>
                    </div>
                <div class="small text-muted mt-1">
                    1 = Sangat Tidak Memuaskan, 2 = Tidak Memuaskan, 3 = Memuaskan, 4 = Sangat Memuaskan
                </div>
            </div>

            <div class="form-section">
                <h2 class="section-title"><i class="fas fa-smile me-2"></i>Apakah petugas pelayanan responsif dan berkompeten dalam memberikan pelayanan? <span class="text-danger">*</span></h2>
                    <div class="star-rating">
                        <input type="radio" id="star4_responsifdankompeten" name="responsifdankompeten" value="4" required /><label for="star4_responsif" title="Sangat Memuaskan">&#9733;</label>
                        <input type="radio" id="star3_responsifdankompeten" name="responsifdankompeten" value="3" /><label for="star3_responsifdankompeten" title="Memuaskan">&#9733;</label>
                        <input type="radio" id="star2_responsifdankompeten" name="responsifdankompeten" value="2" /><label for="star2_responsifdankompeten" title="Tidak Memuaskan">&#9733;</label>
                        <input type="radio" id="star1_responsifdankompeten" name="responsifdankompeten" value="1" /><label for="star1_responsifdankompeten" title="Sangat Tidak Memuaskan">&#9733;</label>
                    </div>
                <div class="small text-muted mt-1">
                    1 = Sangat Tidak Memuaskan, 2 = Tidak Memuaskan, 3 = Memuaskan, 4 = Sangat Memuaskan
                </div>
            </div>

            <div class="form-section">
                <h2 class="section-title"><i class="fas fa-user-check me-2"></i>Apakah Pelayanan yang diberikan sudah sesuai dengan yang dibutuhkan? <span class="text-danger">*</span></h2>
                    <div class="star-rating">
                        <input type="radio" id="star4_sesuaikebutuhan" name="sesuaikebutuhan" value="4" required /><label for="star4_sesuaikebutuhan" title="Sangat Memuaskan">&#9733;</label>
                        <input type="radio" id="star3_sesuaikebutuhan" name="sesuaikebutuhan" value="3" /><label for="star3_sesuaikebutuhan" title="Memuaskan">&#9733;</label>
                        <input type="radio" id="star2_sesuaikebutuhan" name="sesuaikebutuhan" value="2" /><label for="star2_sesuaikebutuhan" title="Tidak Memuaskan">&#9733;</label>
                        <input type="radio" id="star1_sesuaikebutuhan" name="sesuaikebutuhan" value="1" /><label for="star1_sesuaikebutuhan" title="Sangat Tidak Memuaskan">&#9733;</label>
                    </div>
                <div class="small text-muted mt-1">
                    1 = Sangat Tidak Memuaskan, 2 = Tidak Memuaskan, 3 = Memuaskan, 4 = Sangat Memuaskan
                </div>
            </div>

            <div class="form-section">
                <h2 class="section-title"><i class="fas fa-smile me-2"></i>Apakah pelayanan yang saudara peroleh memuaskan? <span class="text-danger">*</span></h2>
                    <div class="star-rating">
                        <input type="radio" id="star4_kepuasanpelayanan" name="kepuasanpelayanan" value="4" required /><label for="star4_kepuasanpelayanan" title="Sangat Memuaskan">&#9733;</label>
                        <input type="radio" id="star3_kepuasanpelayanan" name="kepuasanpelayanan" value="3" /><label for="star3_kepuasanpelayanan" title="Memuaskan">&#9733;</label>
                        <input type="radio" id="star2_kepuasanpelayanan" name="kepuasanpelayanan" value="2" /><label for="star2_kepuasanpelayanan" title="Tidak Memuaskan">&#9733;</label>
                        <input type="radio" id="star1_kepuasanpelayanan" name="kepuasanpelayanan" value="1" /><label for="star1_kepuasanpelayanan" title="Sangat Tidak Memuaskan">&#9733;</label>
                    </div>
                <div class="small text-muted mt-1">
                    1 = Sangat Tidak Memuaskan, 2 = Tidak Memuaskan, 3 = Memuaskan, 4 = Sangat Memuaskan
                </div>
            </div>

            <div class="form-section">
                <h2 class="section-title"><i class="fas fa-comment-dots me-2"></i>Kritik dan Saran untuk pelayanan PPID BKKBN Kalimantan Selatan</h2>
                <textarea name="saran" class="form-control" placeholder="Silahkan tulis kritik dan saran Anda" required></textarea>
            </div>

            <div class="d-flex justify-content-center gap-3 mt-5">
                <button type="reset" class="btn btn-secondary btn-lg"><i class="fas fa-redo me-2"></i>Reset</button>
                <button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-paper-plane me-2"></i>Submit</button>
            </div>
        </form>
    </div>
</div>
</div>
<script>
(() => {
    'use strict';

    const form = document.querySelector('form');
    // Checkbox group validation
    const validateCheckboxGroup = (groupElement, minRequired = 1) => {
        const checkboxes = groupElement.querySelectorAll('input[type="checkbox"]');
        const checkedCount = Array.from(checkboxes).filter(cb => cb.checked).length;
        const feedback = groupElement.querySelector('.invalid-feedback');
        if (checkedCount < minRequired) {
            if (feedback) feedback.style.display = 'block';
            return false;
        } else {
            if (feedback) feedback.style.display = 'none';
            return true;
        }
    };

    // Scroll to first invalid input or feedback
    const scrollToFirstInvalid = () => {
        const firstInvalidInput = form.querySelector(':invalid');
        const firstInvalidFeedback = form.querySelector('.invalid-feedback[style="display: block;"]');
        let elementToScroll = null;
        if (firstInvalidInput) {
            elementToScroll = firstInvalidInput;
        } else if (firstInvalidFeedback) {
            elementToScroll = firstInvalidFeedback.parentElement;
        }
        if (elementToScroll) {
            const elementPosition = elementToScroll.getBoundingClientRect().top;
            const offsetPosition = elementPosition + window.pageYOffset - 100;
            window.scrollTo({
                top: offsetPosition,
                behavior: 'smooth'
            });
            if (elementToScroll.tagName === 'INPUT' || elementToScroll.tagName === 'TEXTAREA' || elementToScroll.tagName === 'SELECT') {
                elementToScroll.focus();
            }
        }
    };

    form.addEventListener('submit', event => {
        event.preventDefault();
        event.stopPropagation();

        // Validasi minimal 1 checkbox pada dua group
        const isJenisDataValid = validateCheckboxGroup(document.querySelector('.checkbox-group'), 1);
        const isBentukDataValid = validateCheckboxGroup(document.querySelectorAll('.checkbox-group')[1], 1);

        form.classList.add('was-validated');

        if (!form.checkValidity() || !isJenisDataValid || !isBentukDataValid) {
            scrollToFirstInvalid();
            return;
        }

        // Jika valid, submit form
        form.submit();
    }, false);

    // Reset button clears validation
    form.addEventListener('reset', () => {
        form.classList.remove('was-validated');
        document.querySelectorAll('.invalid-feedback').forEach(el => {
            el.style.display = 'none';
        });
    });
})();
</script>