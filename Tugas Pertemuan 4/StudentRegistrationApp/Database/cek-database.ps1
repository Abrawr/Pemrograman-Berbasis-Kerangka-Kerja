# Mengecek koneksi ke SQL Server dan menampilkan isi tabel Mahasiswa.
# Jalankan lewat cek-database.bat (klik dua kali).

$connectionString = 'Server=.\SQLEXPRESS;Database=StudentRegistrationDb;Integrated Security=True;TrustServerCertificate=True;Connect Timeout=5'

try {
    $conn = New-Object System.Data.SqlClient.SqlConnection $connectionString
    $conn.Open()

    Write-Host ''
    Write-Host '=== KONEKSI SQL SERVER ===' -ForegroundColor Cyan
    $info = New-Object System.Data.DataTable
    $cmd = $conn.CreateCommand()
    $cmd.CommandText = "SELECT @@SERVERNAME AS Server,
                               CAST(SERVERPROPERTY('ProductVersion') AS varchar(20)) AS Versi,
                               CAST(SERVERPROPERTY('Edition') AS varchar(100)) AS Edisi,
                               DB_NAME() AS [Database]"
    $info.Load($cmd.ExecuteReader())
    $info | Format-List | Out-String | Write-Host
    Write-Host 'Status: TERHUBUNG' -ForegroundColor Green

    Write-Host ''
    Write-Host '=== SELECT * FROM dbo.Mahasiswa ===' -ForegroundColor Cyan
    $data = New-Object System.Data.DataTable
    $cmd.CommandText = "SELECT Id, Nim, Nama, Prodi, JenisKelamin,
                               CONVERT(varchar(10), TanggalLahir, 23) AS TanggalLahir,
                               Alamat, NoTelepon
                        FROM dbo.Mahasiswa ORDER BY Nim"
    $data.Load($cmd.ExecuteReader())
    $data | Format-Table -AutoSize | Out-String -Width 200 | Write-Host
    Write-Host ("Jumlah Mahasiswa: " + $data.Rows.Count) -ForegroundColor Yellow

    $conn.Close()
}
catch {
    Write-Host ''
    Write-Host 'Status: GAGAL TERHUBUNG' -ForegroundColor Red
    Write-Host $_.Exception.Message
}
