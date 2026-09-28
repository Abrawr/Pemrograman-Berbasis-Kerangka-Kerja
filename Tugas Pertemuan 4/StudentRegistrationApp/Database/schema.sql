-- Skrip pembuatan database untuk Student Registration App (Step 12 - Level 3)
-- Aplikasi juga membuat database & tabel ini otomatis saat pertama kali dijalankan.

IF DB_ID('StudentRegistrationDb') IS NULL
    CREATE DATABASE StudentRegistrationDb;
GO

USE StudentRegistrationDb;
GO

IF OBJECT_ID('dbo.Mahasiswa', 'U') IS NULL
CREATE TABLE dbo.Mahasiswa (
    Id           INT IDENTITY(1,1) PRIMARY KEY,
    Nim          VARCHAR(20)   NOT NULL UNIQUE,
    Nama         NVARCHAR(100) NOT NULL,
    Prodi        NVARCHAR(50)  NOT NULL,
    JenisKelamin NVARCHAR(20)  NOT NULL,
    TanggalLahir DATE          NULL,
    Alamat       NVARCHAR(255) NULL,
    NoTelepon    VARCHAR(20)   NULL
);
GO
