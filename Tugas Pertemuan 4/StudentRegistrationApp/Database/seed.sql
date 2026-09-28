-- Contoh data untuk pengujian Level 3
USE StudentRegistrationDb;

IF NOT EXISTS (SELECT 1 FROM dbo.Mahasiswa WHERE Nim = '20260001')
    INSERT INTO dbo.Mahasiswa (Nim, Nama, Prodi, JenisKelamin, TanggalLahir, Alamat, NoTelepon)
    VALUES ('20260001', N'Budi Santoso', N'Teknik Informatika', N'Laki-laki', '2005-05-01', N'Jl. Merdeka 1', '081234567890');

IF NOT EXISTS (SELECT 1 FROM dbo.Mahasiswa WHERE Nim = '20260002')
    INSERT INTO dbo.Mahasiswa (Nim, Nama, Prodi, JenisKelamin, TanggalLahir, Alamat, NoTelepon)
    VALUES ('20260002', N'Siti Aminah', N'Sistem Informasi', N'Perempuan', '2005-08-12', N'Jl. Sudirman 5', '081298765432');
