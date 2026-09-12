# LAPORAN TUGAS PERTEMUAN 2
## PEMROGRAMAN BERBASIS KERANGKA KERJA (PBKK) - KELAS C
### Implementasi Aplikasi Console Manajemen Data Mahasiswa Menggunakan C# dan .NET

---

### Identitas Mahasiswa
- **Nama Mahasiswa** : Abrar Maulana
- **NRP** : 5025241125
- **Mata Kuliah / Kelas** : Pemrograman Berbasis Kerangka Kerja (PBKK) - C
- **Departemen / Fakultas** : Teknik Informatika / FTEIC - Institut Teknologi Sepuluh Nopember (ITS)

---

## BAB I. PENDAHULUAN

### 1.1 Latar Belakang dan Deskripsi Tugas
Tugas pertemuan 2 pada mata kuliah Pemrograman Berbasis Kerangka Kerja (PBKK) kelas C berfokus pada pemahaman dan implementasi dasar pemrograman C# pada platform .NET. Program yang dibangun adalah sebuah aplikasi konsol interaktif bertajuk "SISTEM DATA MAHASISWA" yang mengelola data mahasiswa secara in-memory menggunakan struktur data koleksi generik.

### 1.2 Tujuan Pembelajaran
1. Memahami konsep dasar Pemrograman Berorientasi Objek (OOP) dalam C#, meliputi pembuatan class, auto-implemented property, dan constructor.
2. Menguasai penggunaan generic collection, khususnya `List<T>` dari namespace `System.Collections.Generic`, untuk menampung sekumpulan objek secara dinamis di memori utama.
3. Mengimplementasikan struktur kontrol alur interaktif berbasis loop `do-while`, percabangan `switch-case`, dan pembacaan input pengguna.
4. Menerapkan teknik validasi tipe data menggunakan `int.TryParse()` dan `double.TryParse()` untuk mencegah runtime exception akibat kesalahan input data.
5. Menyusun format tampilan antarmuka konsol yang rapi dan terstruktur menggunakan string formatting C#.

---

## BAB II. STRUKTUR PROGRAM DAN ANALISIS KODE

Program berada dalam satu namespace bernama `DataMahasiswa` dan terdiri atas dua kelas utama: `Mahasiswa` dan `Program`.

### 2.1 Kelas Mahasiswa
Kelas `Mahasiswa` berfungsi sebagai model entitas (blueprint data) yang merepresentasikan informasi setiap mahasiswa. Kelas ini memiliki 4 atribut/properti dan 1 constructor:
- **`NIM` (string)**: Menyimpan Nomor Induk Mahasiswa sebagai pengidentifikasi unik mahasiswa.
- **`Nama` (string)**: Menyimpan nama lengkap mahasiswa.
- **`Prodi` (string)**: Menyimpan program studi mahasiswa.
- **`IPK` (double)**: Menyimpan nilai Indeks Prestasi Kumulatif dalam bentuk bilangan desimal.
- **`Mahasiswa(string nim, string nama, string prodi, double ipk)`**: Constructor yang menginisialisasi keempat properti ketika objek baru diinstansiasi.

### 2.2 Kelas Program dan Variabel Koleksi
Kelas `Program` bertindak sebagai pengendali utama (entry point) aplikasi. Di dalam kelas ini didefinisikan variabel koleksi statis:
```csharp
static List<Mahasiswa> daftarMahasiswa = new List<Mahasiswa>();
```
Koleksi `List<Mahasiswa>` ini berfungsi sebagai tempat penyimpanan data sementara di memori selama program berjalan.

### 2.3 Penjelasan Method-Method Sistem
1. **`Main(string[] args)`**
   Method titik masuk yang menjalankan siklus perulangan `do-while` untuk menampilkan menu dan membaca pilihan pengguna. Input diparsing menggunakan `int.TryParse()` untuk menghindari crash jika pengguna memasukkan karakter non-angka. Pilihan dievaluasi melalui `switch-case` (opsi 1 hingga 5). Jika pengguna memilih selain 5, program menampilkan prompt "Tekan ENTER untuk melanjutkan..." sebelum kembali ke menu.
2. **`TampilkanMenu()`**
   Membersihkan layar konsol dengan `Console.Clear()`, lalu menampilkan header judul serta 5 daftar pilihan menu:
   - 1. Tambah Mahasiswa
   - 2. Tampilkan Mahasiswa
   - 3. Cari Mahasiswa
   - 4. Hapus Mahasiswa
   - 5. Keluar
3. **`TambahMahasiswa()`**
   Meminta pengguna menginputkan NIM, Nama, dan Program Studi. Untuk input IPK, diterapkan perulangan `while (true)` dengan validasi `double.TryParse()`. Input hanya diterima apabila bernilai numerik dan berada dalam rentang valid 0 sampai 4 (`ipk >= 0 && ipk <= 4`). Jika input salah, pesan peringatan "IPK harus berupa angka 0 - 4." akan muncul dan meminta input ulang. Setelah valid, objek `Mahasiswa` dibuat dan ditambahkan ke dalam `daftarMahasiswa`.
4. **`TampilkanMahasiswa()`**
   Memeriksa apakah data kosong (`daftarMahasiswa.Count == 0`). Jika kosong, ditampilkan informasi bahwa belum ada data mahasiswa. Jika ada data, program mencetak header tabel dan melakukan iterasi `foreach` untuk menampilkan seluruh data mahasiswa dengan perataan kolom terformat `{0,-12} {1,-20} {2,-20} {3,5:F2}`.
5. **`CariMahasiswa()`**
   Membaca input NIM yang dicari, kemudian menelusuri koleksi menggunakan perulangan `foreach`. Pencarian mencocokkan string NIM dengan pembanding `StringComparison.OrdinalIgnoreCase` agar pencarian bersifat case-insensitive. Jika ditemukan, detail NIM, Nama, Prodi, dan IPK ditampilkan. Jika tidak ditemukan, program memberikan notifikasi bahwa mahasiswa dengan NIM tersebut tidak ditemukan.
6. **`HapusMahasiswa()`**
   Menerima input NIM yang ingin dihapus, mencari data yang cocok pada `daftarMahasiswa`, lalu menghapus objek yang ditemukan menggunakan method `daftarMahasiswa.Remove(mahasiswaDitemukan)`. Apabila data tidak ada, program menampilkan notifikasi bahwa data tidak ditemukan.

---

## BAB III. SKENARIO PENGUJIAN DAN HASIL EKSEKUSI

Pengujian dilakukan untuk memastikan seluruh fungsionalitas program berjalan sesuai dengan logika yang dirancang:

### 3.1 Pengujian Menu Utama
Saat aplikasi dijalankan, konsol menampilkan antarmuka menu utama:
```text
========================================
         SISTEM DATA MAHASISWA
========================================
1. Tambah Mahasiswa
2. Tampilkan Mahasiswa
3. Cari Mahasiswa
4. Hapus Mahasiswa
5. Keluar
========================================
Pilihan: 
```

### 3.2 Pengujian Tambah Data Mahasiswa
- Input:
  - Menu: 1
  - NIM: 5025241125
  - Nama: Abrar Maulana
  - Program Studi: Teknik Informatika
  - IPK: 3.85
- Output:
  ```text
  Data mahasiswa berhasil ditambahkan.
  ```

### 3.3 Pengujian Validasi Input IPK
- Input:
  - Nilai pertama: 4.8
  - Nilai kedua: abc
  - Nilai ketiga: 3.85
- Output:
  ```text
  IPK : 4.8
  IPK harus berupa angka 0 - 4.
  IPK : abc
  IPK harus berupa angka 0 - 4.
  IPK : 3.85
  ```
  Sistem berhasil menahan input yang tidak valid dan hanya melanjutkan eksekusi setelah nilai yang dimasukkan benar.

### 3.4 Pengujian Menampilkan Seluruh Data Mahasiswa
- Input: Menu 2
- Output:
  ```text
  ==========================================================
                      DAFTAR MAHASISWA
  ==========================================================
  NIM          Nama                 Prodi                  IPK
  ----------------------------------------------------------
  5025241125   Abrar Maulana        Teknik Informatika    3.85
  ==========================================================
  ```

### 3.5 Pengujian Pencarian Mahasiswa Berdasarkan NIM
- Skenario Ditemukan:
  - Input: Menu 3, NIM: 5025241125
  - Output:
    ```text
    Data ditemukan!
    NIM : 5025241125
    Nama : Abrar Maulana
    Prodi : Teknik Informatika
    IPK : 3.85
    ```
- Skenario Tidak Ditemukan:
  - Input: Menu 3, NIM: 5025249999
  - Output:
    ```text
    Mahasiswa dengan NIM tersebut tidak ditemukan.
    ```

### 3.6 Pengujian Penghapusan Data Mahasiswa
- Skenario Berhasil:
  - Input: Menu 4, NIM: 5025241125
  - Output:
    ```text
    Data mahasiswa berhasil dihapus.
    ```
- Skenario Gagal (Data Tidak Ditemukan):
  - Input: Menu 4, NIM: 5025249999
  - Output:
    ```text
    Data mahasiswa tidak ditemukan.
    ```

### 3.7 Pengujian Keluar dari Program
- Input: Menu 5
- Output:
  ```text
  Terima kasih telah menggunakan program.
  ```

---

## BAB IV. SOURCE CODE LENGKAP

Berikut adalah source code lengkap dari file `Program.cs` sesuai dengan dokumen tugas apa adanya:

```csharp
using System;
using System.Collections.Generic;

namespace DataMahasiswa
{
    // Class untuk merepresentasikan data mahasiswa
    class Mahasiswa
    {
        public string NIM { get; set; }
        public string Nama { get; set; }
        public string Prodi { get; set; }
        public double IPK { get; set; }

        // Constructor
        public Mahasiswa(string nim, string nama, string prodi, double ipk)
        {
            NIM = nim;
            Nama = nama;
            Prodi = prodi;
            IPK = ipk;
        }
    }

    class Program
    {
        // List untuk menyimpan data mahasiswa
        static List<Mahasiswa> daftarMahasiswa =
            new List<Mahasiswa>();

        static void Main(string[] args)
        {
            int pilihan;

            do
            {
                TampilkanMenu();

                Console.Write("Pilihan: ");
                string input = Console.ReadLine();

                if (!int.TryParse(input, out pilihan))
                {
                    pilihan = 0;
                }

                Console.WriteLine();

                switch (pilihan)
                {
                    case 1:
                        TambahMahasiswa();
                        break;

                    case 2:
                        TampilkanMahasiswa();
                        break;

                    case 3:
                        CariMahasiswa();
                        break;

                    case 4:
                        HapusMahasiswa();
                        break;

                    case 5:
                        Console.WriteLine(
                            "Terima kasih telah menggunakan program."
                        );
                        break;

                    default:
                        Console.WriteLine(
                            "Pilihan tidak tersedia!"
                        );
                        break;
                }

                if (pilihan != 5)
                {
                    Console.WriteLine();
                    Console.WriteLine(
                        "Tekan ENTER untuk melanjutkan..."
                    );
                    Console.ReadLine();
                }

            } while (pilihan != 5);
        }

        // ==========================================
        // METHOD MENAMPILKAN MENU
        // ==========================================

        static void TampilkanMenu()
        {
            Console.Clear();

            Console.WriteLine("========================================");
            Console.WriteLine(" SISTEM DATA MAHASISWA");
            Console.WriteLine("========================================");
            Console.WriteLine("1. Tambah Mahasiswa");
            Console.WriteLine("2. Tampilkan Mahasiswa");
            Console.WriteLine("3. Cari Mahasiswa");
            Console.WriteLine("4. Hapus Mahasiswa");
            Console.WriteLine("5. Keluar");
            Console.WriteLine("========================================");
        }

        // ==========================================
        // METHOD TAMBAH MAHASISWA
        // ==========================================

        static void TambahMahasiswa()
        {
            Console.Clear();

            Console.WriteLine("========================================");
            Console.WriteLine(" TAMBAH MAHASISWA");
            Console.WriteLine("========================================");

            Console.Write("NIM : ");
            string nim = Console.ReadLine();

            Console.Write("Nama : ");
            string nama = Console.ReadLine();

            Console.Write("Program Studi : ");
            string prodi = Console.ReadLine();

            double ipk;

            while (true)
            {
                Console.Write("IPK : ");

                if (double.TryParse(
                    Console.ReadLine(),
                    out ipk))
                {
                    if (ipk >= 0 && ipk <= 4)
                    {
                        break;
                    }
                }

                Console.WriteLine(
                    "IPK harus berupa angka 0 - 4."
                );
            }

            Mahasiswa mahasiswa =
                new Mahasiswa(
                    nim,
                    nama,
                    prodi,
                    ipk
                );

            daftarMahasiswa.Add(mahasiswa);

            Console.WriteLine();
            Console.WriteLine(
                "Data mahasiswa berhasil ditambahkan."
            );
        }

        // ==========================================
        // METHOD MENAMPILKAN DATA
        // ==========================================

        static void TampilkanMahasiswa()
        {
            Console.Clear();

            Console.WriteLine("==========================================================");
            Console.WriteLine(" DAFTAR MAHASISWA");
            Console.WriteLine("==========================================================");

            if (daftarMahasiswa.Count == 0)
            {
                Console.WriteLine(
                    "Belum ada data mahasiswa."
                );

                return;
            }

            Console.WriteLine(
                "{0,-12} {1,-20} {2,-20} {3,5}",
                "NIM",
                "Nama",
                "Prodi",
                "IPK"
            );

            Console.WriteLine(
                "----------------------------------------------------------"
            );

            foreach (Mahasiswa m in daftarMahasiswa)
            {
                Console.WriteLine(
                    "{0,-12} {1,-20} {2,-20} {3,5:F2}",
                    m.NIM,
                    m.Nama,
                    m.Prodi,
                    m.IPK
                );
            }

            Console.WriteLine(
                "=========================================================="
            );
        }

        // ==========================================
        // METHOD MENCARI MAHASISWA
        // ==========================================

        static void CariMahasiswa()
        {
            Console.Clear();

            Console.WriteLine("========================================");
            Console.WriteLine(" CARI MAHASISWA");
            Console.WriteLine("========================================");

            Console.Write("Masukkan NIM: ");
            string nimCari = Console.ReadLine();

            Mahasiswa mahasiswaDitemukan = null;

            foreach (Mahasiswa m in daftarMahasiswa)
            {
                if (m.NIM.Equals(
                    nimCari,
                    StringComparison.OrdinalIgnoreCase))
                {
                    mahasiswaDitemukan = m;
                    break;
                }
            }

            Console.WriteLine();

            if (mahasiswaDitemukan != null)
            {
                Console.WriteLine("Data ditemukan!");
                Console.WriteLine(
                    "NIM : " + mahasiswaDitemukan.NIM
                );
                Console.WriteLine(
                    "Nama : " + mahasiswaDitemukan.Nama
                );
                Console.WriteLine(
                    "Prodi : " + mahasiswaDitemukan.Prodi
                );
                Console.WriteLine(
                    "IPK : " + mahasiswaDitemukan.IPK.ToString("F2")
                );
            }
            else
            {
                Console.WriteLine(
                    "Mahasiswa dengan NIM tersebut tidak ditemukan."
                );
            }
        }

        // ==========================================
        // METHOD MENGHAPUS MAHASISWA
        // ==========================================

        static void HapusMahasiswa()
        {
            Console.Clear();

            Console.WriteLine("========================================");
            Console.WriteLine(" HAPUS MAHASISWA");
            Console.WriteLine("========================================");

            Console.Write("Masukkan NIM: ");
            string nimHapus = Console.ReadLine();

            Mahasiswa mahasiswaDitemukan = null;

            foreach (Mahasiswa m in daftarMahasiswa)
            {
                if (m.NIM.Equals(
                    nimHapus,
                    StringComparison.OrdinalIgnoreCase))
                {
                    mahasiswaDitemukan = m;
                    break;
                }
            }

            if (mahasiswaDitemukan != null)
            {
                daftarMahasiswa.Remove(
                    mahasiswaDitemukan
                );

                Console.WriteLine();
                Console.WriteLine(
                    "Data mahasiswa berhasil dihapus."
                );
            }
            else
            {
                Console.WriteLine();
                Console.WriteLine(
                    "Data mahasiswa tidak ditemukan."
                );
            }
        }
    }
}

```

---

## BAB V. KESIMPULAN

1. Aplikasi konsol Sistem Data Mahasiswa berhasil mengimplementasikan operasi dasar CRUD in-memory dengan baik menggunakan bahasa pemrograman C# pada kerangka kerja .NET untuk Tugas Pertemuan 2 PBKK C.
2. Konsep Pemrograman Berorientasi Objek (OOP) terwujud melalui kelas `Mahasiswa` sebagai representasi model entitas data, serta kelas `Program` sebagai modul pengendali antarmuka dan manipulasi data.
3. Penggunaan `List<Mahasiswa>` memberikan fleksibilitas pengelolaan koleksi objek dinamis dengan method bawaan `.Add()` dan `.Remove()`.
4. Penerapan defensive programming melalui method `int.TryParse()` dan `double.TryParse()` berhasil mencegah runtime error serta menjaga integritas data masukan pengguna.
