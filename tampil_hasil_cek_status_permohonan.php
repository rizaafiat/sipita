<style>
    .status-main-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        max-width: 1000px;
        margin: 40px auto;
    }
    .result-box {
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 30px;
        padding: 40px;
        width: 100%;
        max-width: 900px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        position: relative;
        z-index: 2;
    }
    .result-box h4 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #22c55e;
        margin-bottom: 25px;
        text-align: left;
    }
    .table {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        margin-bottom: 0;
    }
    .table th {
        background: #f1f5f9;
        color: #1e5091;
        font-weight: 600;
        width: 30%;
        vertical-align: middle;
    }
    .table td {
        background: #fff;
        color: #222;
        vertical-align: middle;
    }
    .badge-sudah-submit {
        background: #0ea5e9;
        color: #fff;
        border-radius: 12px;
        padding: 6px 18px;
        font-size: 1rem;
        font-weight: 600;
    }
    .badge-proses {
        background: #fbbf24;
        color: #fff;
        border-radius: 12px;
        padding: 6px 18px;
        font-size: 1rem;
        font-weight: 600;
    }
    .badge-selesai {
        background: #22c55e;
        color: #fff;
        border-radius: 12px;
        padding: 6px 18px;
        font-size: 1rem;
        font-weight: 600;
    }
    .badge-ditolak {
        background: #ef4444;
        color: #fff;
        border-radius: 12px;
        padding: 6px 18px;
        font-size: 1rem;
        font-weight: 600;
    }
    .btn-outline-secondary {
        border-radius: 25px;
        padding: 12px 28px;
        font-weight: 600;
        font-size: 1rem;
        color: #1e5091;
        border: 2px solid #1e5091;
        background: transparent;
        transition: all 0.3s;
    }
    .btn-outline-secondary:hover {
        background: #1e5091;
        color: #fff;
    }
    .btn-outline-primary {
        border-radius: 25px;
        padding: 8px 20px;
        font-weight: 600;
        font-size: 0.95rem;
        color: #0ea5e9;
        border: 2px solid #0ea5e9;
        background: transparent;
        transition: all 0.3s;
    }
    .btn-outline-primary:hover {
        background: #0ea5e9;
        color: #fff;

    .timeline-status {
    margin-top: 30px;
    padding-left: 0;
    list-style: none;
    }
    .timeline-status li {
        border-left: 3px solid #0ea5e9;
        padding-left: 15px;
        margin-bottom: 18px;
        position: relative;
    }
    .timeline-status li:before {
        content: '';
        position: absolute;
        left: -8px;
        top: 6px;
        width: 12px;
        height: 12px;
        background: #0ea5e9;
        border-radius: 50%;
    }

    }
    @media (max-width: 768px) {
        .result-box {
            padding: 30px 15px;
        }
        .table th, .table td {
            font-size: 0.95rem;
        }
        .btn-outline-secondary, .btn-outline-primary {
            width: 100%;
            justify-content: center;
        }
    }
</style>
<div class="status-main-container">
    <div class="result-box">
        <h4>
            <i class="fas fa-check-circle me-2"></i>Detail Permohonan
        </h4>
        <div class="table-responsive">
            <table class="table table-bordered mb-0">
                <tr>
                    <th>Nomor Tiket</th>
                    <td><?= htmlspecialchars($_SESSION['result']['nomor_tiket']) ?></td>
                </tr>
                <tr>
                    <th>Nama Pemohon</th>
                    <td><?= htmlspecialchars($_SESSION['result']['nama']) ?></td>
                </tr>
                <tr>
                    <th>Tanggal Permohonan</th>
                    <td><?= date('d/m/Y H:i', strtotime($_SESSION['result']['tanggal_permohonan'])) ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <?php 
                        $status = $_SESSION['result']['status_proses'];
                        $badge_class = [
                            'Submit' => 'badge-sudah-submit',
                            'Proses Sepenuhnya' => 'badge-proses',
                            'Proses Sebagian' => 'badge-proses',
                            'Selesai (Sepenuhnya)' => 'badge-selesai',
                            'Selesai (Sebagian)' => 'badge-selesai',
                            'Ditolak (Dikecualikan)' => 'badge-ditolak',
                            'Ditolak (Tidak Dikuasai)' => 'badge-ditolak',
                            'Ditolak (Bukan Kewenangan)' => 'badge-ditolak',
                        ][$status] ?? 'bg-secondary';
                        ?>
                        <span class="badge <?= $badge_class ?>"><?= $status ?></span>
                    </td>
                </tr>
                <tr>
                    <th>Rincian Permohonan</th>
                    <td><?= nl2br(htmlspecialchars($_SESSION['result']['rincian_data'])) ?></td>
                </tr>
                <tr>
                    <th>Keterangan Balasan</th>
                    <td><?= htmlspecialchars($_SESSION['result']['keterangan_proses'] ?? '') ?></td>
                </tr>
                <tr>
                    <th>Dokumen Balasan</th>
                    <td>
                        <?php if (!empty($_SESSION['result']['dokumen_proses'])): ?>
                            <a href="../uploads/balasan/<?= htmlspecialchars($_SESSION['result']['dokumen_proses']) ?>" 
                               class="btn btn-sm btn-outline-primary" target="_blank">
                                <i class="fas fa-download me-2"></i>Download
                            </a>
                        <?php else: ?>
                            <span class="text-muted">Tidak ada dokumen</span>
                        <?php endif; ?>
                    </td>
                </tr>

            </table>
        </div>

        <?php
        // Ambil id permohonan dari nomor tiket
        $permohonan_id = 0;
        if (!empty($_SESSION['result']['nomor_tiket'])) {
            $nomor_tiket = $_SESSION['result']['nomor_tiket'];
            $stmt = $conn->prepare("SELECT id FROM permohonan_informasi WHERE nomor_tiket=? LIMIT 1");
            $stmt->execute([$nomor_tiket]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $permohonan_id = $row ? $row['id'] : 0;
        }
        $logs = [];
        if ($permohonan_id) {
            $stmt = $conn->prepare("SELECT * FROM permohonan_status_log WHERE permohonan_id=? ORDER BY tanggal ASC");
            $stmt->execute([$permohonan_id]);
            $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        ?>

<!-- Timeline Status Permohonan -->
<div style="margin-top:32px;">
    <h4 style="color:#22c55e;">
        <i class="fas fa-history me-2"></i>Timeline Status Permohonan
    </h4>
    <div class="table-responsive">
        <table class="table table-bordered mb-0">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
            <?php if ($logs && count($logs) > 0): ?>
                <?php foreach($logs as $log): ?>
                    <tr>
                        <td style="font-weight:bold;"><?= htmlspecialchars($log['status']) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($log['tanggal'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="text-center text-muted">Belum ada riwayat status.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</div>