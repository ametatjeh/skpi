<?php
function parseStatus($status)
{
    if (empty($status)) return 'Aktif (empty)';
    
    $status = strtolower(trim((string) $status));
    
    if (strpos($status, 'lulus') !== false) return 'Lulus';
    if (strpos($status, 'aktif') !== false) return 'Aktif';
    if (strpos($status, 'cuti') !== false) return 'Cuti';
    if (strpos($status, 'do') !== false || strpos($status, 'drop') !== false) return 'DO';
    if (strpos($status, 'pindah') !== false) return 'Mengundurkan Diri';
    if (strpos($status, 'keluar') !== false || strpos($status, 'mengundurkan') !== false) return 'Mengundurkan Diri';
    
    return 'Aktif (fallback)';
}

echo "Testing 'Mengundurkan Diri': " . parseStatus("Mengundurkan Diri") . "\n";
echo "Testing 'DO': " . parseStatus("DO") . "\n";
