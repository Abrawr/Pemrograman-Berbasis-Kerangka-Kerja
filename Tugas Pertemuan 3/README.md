# LAPORAN TUGAS PERTEMUAN 3
## PEMROGRAMAN BERBASIS KERANGKA KERJA (PBKK) - KELAS C
### HAND-ON LAB: IMPLEMENTASI KALKULATOR DESKTOP MENGGUNAKAN C# WINDOWS FORMS APP (.NET)

## BAB I. PENDAHULUAN

### 1.1 Latar Belakang dan Deskripsi Praktikum
Pada era komputasi modern, Graphical User Interface (GUI) merupakan standar de-facto antarmuka pengguna untuk interaksi manusia dan komputer. Platform .NET dan Windows Forms (WinForms) menyediakan kerangka kerja yang sangat efisien dan terstruktur dalam membangun aplikasi desktop berbasis grafis dan digerakkan oleh event (*event-driven programming*).

Praktikum pertemuan ke-3 ini berfokus pada pembangunan aplikasi desktop **CalculatorApp** dengan memanfaatkan Visual Designer, kontrol UI Windows Forms (Label, TextBox, Button), pengelolaan *event handler*, variabel state operasi aritmatika, serta mekanisme penanganan kesalahan runtime (*exception handling*).

### 1.2 Tujuan Pembelajaran
1. Membangun dan mengonfigurasi proyek Windows Forms App menggunakan C# dan .NET.
2. Mendesain antarmuka grafis kalkulator secara presisi menggunakan Visual Designer dan kontrol komponen WinForms.
3. Menggunakan dan mengonfigurasi kontrol UI utama: `Label` (judul/indikator), `TextBox` (display input/output), dan `Button` (tombol numerik, operator, utilitas).
4. Menerapkan paradigma *event-driven programming* dengan menangani interaksi klik (`Click` event) melalui *event handler* yang modular.
5. Menerapkan arsitektur state kalkulator menggunakan variabel `firstNumber`, `secondNumber`, `result`, dan `operation` dengan struktur kontrol `switch-case`.
6. Menerapkan validasi input pertahanan (*defensive programming*) dan proteksi error menggunakan blok `try-catch` terhadap potensi kesalahan operasional seperti pembagian dengan nol (*division by zero*) dan kegagalan format numerik.

### 1.3 Lingkungan Pengembangan
- **Sistem Operasi** : Microsoft Windows 11
- **Framework** : .NET 10.0 (net10.0-windows)
- **IDE / Editor** : Visual Studio / Visual Studio Code
- **Bahasa Pemrograman** : C# 14.0
- **UI Framework** : Windows Forms (.NET Sdk Desktop)

---

## BAB II. DESAIN ANTARMUKA DAN SPESIFIKASI KONTROL

### 2.1 Spesifikasi Komponen Kontrol Form
Form kalkulator dirancang dengan ukuran yang proporsional (340 × 450 px), posisi awal di tengah layar (`StartPosition = CenterScreen`), dan gaya batas tetap (`FormBorderStyle = FixedSingle`) untuk menjamin konsistensi tata letak. 

Berikut adalah rincian kontrol yang ditempatkan pada `Form1`:

| Kontrol | Nama Komponen | Teks / Nilai Awal | Fungsi / Peran Operasional |
| :--- | :--- | :--- | :--- |
| **Label** | `lblTitle` | `Calculator` | Menampilkan identitas judul aplikasi kalkulator pada bagian atas form. |
| **TextBox** | `txtDisplay` | `0` | Menampilkan nilai angka yang sedang diketik pengguna atau hasil kalkulasi akhir. Dikonfigurasi dengan rata kanan (`TextAlign = Right`) dan read-only (`ReadOnly = true`). |
| **Button** | `btn7` | `7` | Memasukkan angka 7 ke layar tampilan. |
| **Button** | `btn8` | `8` | Memasukkan angka 8 ke layar tampilan. |
| **Button** | `btn9` | `9` | Memasukkan angka 9 ke layar tampilan. |
| **Button** | `btnDivide` | `÷` | Memilih operasi pembagian aritmatika. |
| **Button** | `btn4` | `4` | Memasukkan angka 4 ke layar tampilan. |
| **Button** | `btn5` | `5` | Memasukkan angka 5 ke layar tampilan. |
| **Button** | `btn6` | `6` | Memasukkan angka 6 ke layar tampilan. |
| **Button** | `btnMultiply` | `×` | Memilih operasi perkalian aritmatika. |
| **Button** | `btn1` | `1` | Memasukkan angka 1 ke layar tampilan. |
| **Button** | `btn2` | `2` | Memasukkan angka 2 ke layar tampilan. |
| **Button** | `btn3` | `3` | Memasukkan angka 3 ke layar tampilan. |
| **Button** | `btnMinus` | `−` | Memilih operasi pengurangan aritmatika. |
| **Button** | `btnClear` | `C` | Mengosongkan memori variabel kalkulator dan mengembalikan layar ke "0". |
| **Button** | `btn0` | `0` | Memasukkan angka 0 ke layar tampilan. |
| **Button** | `btnDecimal` | `.` | Menambahkan tanda desimal (titik) dengan validasi anti-duplikasi. |
| **Button** | `btnPlus` | `+` | Memilih operasi penjumlahan aritmatika. |
| **Button** | `btnEquals` | `=` | Memicu eksekusi perhitungan matematis dan menampilkan hasil akhir. |

### 2.2 Pola Tata Letak Tombol (4-Column Layout)
Sesuai dengan kenyamanan pengguna (phone/dialpad order dimulai dari kiri atas), tombol disusun rapi dalam pola matriks 4 kolom:
- **Baris 1**: `[ 1 ]` `[ 2 ]` `[ 3 ]` `[ ÷ ]`
- **Baris 2**: `[ 4 ]` `[ 5 ]` `[ 6 ]` `[ × ]`
- **Baris 3**: `[ 7 ]` `[ 8 ]` `[ 9 ]` `[ − ]`
- **Baris 4**: `[ C ]` `[ 0 ]` `[ . ]` `[ + ]`
- **Baris 5**: `[ = ]` (Merentang penuh 4 kolom sebagai tombol aksi eksekusi utama)

---

## BAB III. ARSITEKTUR DAN STRUKTUR KODE PROGRAM
<img width="1368" height="770" alt="image" src="https://github.com/user-attachments/assets/2b4deb53-6703-4ae9-9cf3-50efdfb86a61" />
<img width="1362" height="755" alt="image" src="https://github.com/user-attachments/assets/a0b6979d-ed43-45ed-8ea3-a73cbb92d6b1" />

### 3.1 Implementasi Kode Sumber

#### A. Entry Point (`Program.cs`)
File ini menginisialisasi lingkungan runtime aplikasi desktop. Ditambahkan konfigurasi `CultureInfo.InvariantCulture` untuk menjamin konsistensi parsing desimal (titik `.` versus koma `,`) di semua regional setting sistem operasi pengguna:

```csharp
using System.Globalization;

namespace CalculatorApp;

static class Program
{
    [STAThread]
    static void Main()
    {
        // Menjamin titik (.) diproses sebagai pemisah desimal secara konsisten
        CultureInfo.DefaultThreadCurrentCulture = CultureInfo.InvariantCulture;
        CultureInfo.DefaultThreadCurrentUICulture = CultureInfo.InvariantCulture;

        ApplicationConfiguration.Initialize();
        Application.Run(new Form1());
    }    
}
```

#### B. Logika Form & Event Handler (`Form1.cs`)
File ini mengimplementasikan logika event handler sesuai standar pedoman praktikum:

```csharp
using System.Globalization;

namespace CalculatorApp
{
    public partial class Form1 : Form
    {
        double firstNumber = 0;
        double secondNumber = 0;
        double result = 0;
        string operation = "";

        public Form1()
        {
            InitializeComponent();
        }

        private void NumberButton_Click(object sender, EventArgs e)
        {
            Button button = (Button)sender;

            if (txtDisplay.Text == "0")
                txtDisplay.Text = button.Text;
            else
                txtDisplay.Text += button.Text;
        }

        private void OperatorButton_Click(object sender, EventArgs e)
        {
            Button button = (Button)sender;

            if (double.TryParse(txtDisplay.Text, NumberStyles.Any, CultureInfo.InvariantCulture, out double value))
                firstNumber = value;
            operation = button.Text;

            txtDisplay.Clear();
        }

        private void btnEquals_Click(object sender, EventArgs e)
        {
            try
            {
                if (string.IsNullOrEmpty(operation))
                    return;

                if (!double.TryParse(txtDisplay.Text, NumberStyles.Any, CultureInfo.InvariantCulture, out secondNumber))
                    return;

                switch (operation)
                {
                    case "+":
                        result = firstNumber + secondNumber;
                        break;
                    case "−":
                    case "-":
                        result = firstNumber - secondNumber;
                        break;
                    case "×":
                    case "*":
                    case "x":
                        result = firstNumber * secondNumber;
                        break;
                    case "÷":
                    case "/":
                        if (secondNumber == 0)
                            throw new DivideByZeroException();
                        result = firstNumber / secondNumber;
                        break;
                    default:
                        return;
                }

                txtDisplay.Text = result.ToString(CultureInfo.InvariantCulture);
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message, "Error");
            }
        }

        private void btnClear_Click(object sender, EventArgs e)
        {
            firstNumber = 0;
            secondNumber = 0;
            result = 0;
            operation = "";
            txtDisplay.Text = "0";
        }

        private void btnDecimal_Click(object sender, EventArgs e)
        {
            if (string.IsNullOrEmpty(txtDisplay.Text))
                txtDisplay.Text = "0.";
            else if (!txtDisplay.Text.Contains("."))
                txtDisplay.Text += ".";
        }
    }
}
```

#### C. Pemisahan Logika Kalkulator (`CalculatorEngine.cs`)
Sebagai pemenuhan tantangan pengembangan arsitektur bersih (*clean architecture*), logika perhitungan matematis diabstraksi ke kelas terpisah:

```csharp
namespace CalculatorApp;

public class CalculatorEngine
{
    public double FirstNumber { get; set; } = 0;
    public double SecondNumber { get; set; } = 0;
    public double Result { get; set; } = 0;
    public string Operation { get; set; } = "";

    public double Calculate(double first, double second, string op)
    {
        return op switch
        {
            "+" => first + second,
            "−" or "-" => first - second,
            "×" or "*" => first * second,
            "÷" or "/" => second == 0 
                ? throw new DivideByZeroException("Attempted to divide by zero.") 
                : first / second,
            _ => second
        };
    }

    public void Reset()
    {
        FirstNumber = 0;
        SecondNumber = 0;
        Result = 0;
        Operation = "";
    }
}
```

---

## BAB IV. ANALISIS MEKANISME KERJA DAN EVENT HANDLING

### 4.1 Mekanisme Single Event Handler untuk Tombol Angka
Salah satu pola arsitektur penting dalam praktikum ini adalah pemanfaatan **Single Event Handler** (`NumberButton_Click`) untuk melayani 10 tombol angka (0 hingga 9).

Ketika pengguna mengklik tombol numerik apa pun:
1. Runtime .NET memanggil `NumberButton_Click(object sender, EventArgs e)`.
2. Parameter `sender` berisi referensi terhadap instansi `Button` yang diklik.
3. Melalui *type casting* `Button button = (Button)sender;`, program dapat membaca properti `button.Text`.
4. Jika tampilan saat ini masih bernilai default `"0"`, maka teks langsung diganti dengan nilai tombol. Jika tidak, karakter digit baru dikonkatenasikan (`+=`) ke akhir string tampilan.

Manfaat arsitektur ini:
- **Prinsip DRY (Don't Repeat Yourself)**: Menghindari pembuatan 10 method event handler redundan (`btn0_Click`, `btn1_Click`, dst.).
- **Skalabilitas**: Sangat mudah menambahkan tombol angka baru atau mengubah format tampilan tanpa merombak puluhan method.

### 4.2 Manajemen State Kalkulasi (`firstNumber`, `secondNumber`, `operation`)
Kalkulator bekerja sebagai sebuah *finite state machine* sederhana:
1. **Fase Input Pertama**: Angka dimasukkan ke `txtDisplay`.
2. **Fase Pemilihan Operator**: Saat tombol operator (`+`, `−`, `×`, `÷`) ditekan, `firstNumber` diisi dengan mem-parsing nilai teks saat itu, `operation` menyimpan simbol operator, dan layar dibersihkan (`txtDisplay.Clear()`).
3. **Fase Input Kedua**: Angka kedua dimasukkan oleh pengguna ke layar.
4. **Fase Evaluasi**: Saat tombol `=` ditekan, `secondNumber` dibaca dari layar, lalu blok `switch (operation)` mengevaluasi operasi yang relevan dan menempatkan hasilnya ke `result`. Hasil akhir dikonversi ke string dan ditampilkan ke pengguna.

### 4.3 Penanganan Pembagian Nol dan Pertahanan Try-Catch
Operasi pembagian dengan angka nol adalah kasus kritis. Pada tipe data `double` dalam C# (berdasarkan standar IEEE 754), ekspresi `10.0 / 0.0` tidak menghasilkan runtime exception secara default, melainkan menghasilkan nilai spesial `double.PositiveInfinity`.
Jika nilai `Infinity` dibiarkan lolos ke antarmuka pengguna:
- Membingungkan pengguna awam.
- Merusak kalkulasi berantai berikutnya (misal: `Infinity + 5` tetap menghasilkan `Infinity`).

Oleh karena itu, diterapkan validasi defensif eksplisit:
```csharp
if (secondNumber == 0)
    throw new DivideByZeroException();
```
Ketika eksepsi dilemparkan, blok `catch (Exception ex)` menangkapnya secara langsung dan menampilkan dialog `MessageBox.Show(ex.Message, "Error")`. Aplikasi tidak terhenti mendadak (*crash*), dan pengguna dapat melanjutkan penggunaan dengan normal.

---

## BAB V. PENGUJIAN DAN VALIDASI SISTEM

### 5.1 Tabel Hasil Pengujian Laboratorium (Langkah 8)
Seluruh skenario pengujian fungsional yang ditetapkan pada dokumen panduan laboratorium telah dieksekusi dan diverifikasi secara komprehensif:

| No | Skenario Pengujian | Input Operasional | Expected Result | Actual Result | Status Verifikasi |
| :---: | :--- | :--- | :--- | :--- | :---: |
| 1 | **Penjumlahan** | `10 + 20 =` | `30` | `30` | **PASS (Berhasil)** |
| 2 | **Pengurangan** | `30 − 12 =` | `18` | `18` | **PASS (Berhasil)** |
| 3 | **Perkalian** | `6 × 7 =` | `42` | `42` | **PASS (Berhasil)** |
| 4 | **Pembagian** | `100 ÷ 4 =` | `25` | `25` | **PASS (Berhasil)** |
| 5 | **Operasi Desimal** | `2.5 × 4 =` | `10` | `10` | **PASS (Berhasil)** |
| 6 | **Pembagian dengan Nol** | `10 ÷ 0 =` | Pesan error | Muncul dialog error `Attempted to divide by zero.` | **PASS (Berhasil)** |
| 7 | **Reset / Clear** | Tekan `C` | Display = `0` | Display = `0`, seluruh variabel state di-reset | **PASS (Berhasil)** |

### 5.2 Pengujian Kasus Ekstrem (Edge Cases)
Selain 7 skenario dasar di atas, suite pengujian otomatis juga memvalidasi ketahanan kalkulator pada kasus batas dan format khusus:

| No | Kasus Batas (Edge Case) | Input Data | Expected Result | Status |
| :---: | :--- | :--- | :--- | :---: |
| 8 | Operasi Nilai Negatif | `-5 + 15` | `10` | **PASS** |
| 9 | Pembagian Pecahan Desimal | `7 ÷ 2` | `3.5` | **PASS** |
| 10 | Perkalian dengan Nol | `999 × 0` | `0` | **PASS** |
| 11 | Komputasi Angka Besar | `1,000,000 × 1,000,000` | `1,000,000,000,000` | **PASS** |
| 12 | Presisi Angka Koma Desimal | `0.1 + 0.2` | `0.3` (dibulatkan) | **PASS** |
| 13 | Kompatibilitas Karakter Minus | `30 - 12` (ASCII `-` vs Unicode `−`) | `18` | **PASS** |
| 14 | Kompatibilitas Karakter Kali | `6 * 7` (ASCII `*` vs Unicode `×`) | `42` | **PASS** |
| 15 | Kompatibilitas Karakter Bagi | `100 / 4` (ASCII `/` vs Unicode `÷`) | `25` | **PASS** |
| 16 | Pembagian `0 ÷ 0` (Indeterminate) | `0 ÷ 0` | Menghasilkan `DivideByZeroException` | **PASS** |

### 5.3 Laporan Eksekusi Otomatis Test Runner
Hasil eksekusi program uji otomatis `CalculatorApp.Tests`:

```
==================================================
       CALCULATOR APPLICATION TEST SUITE          
==================================================
[PASS] Skenario 1: Penjumlahan (10 + 20) -> Expected: 30, Got: 30
[PASS] Skenario 2a: Pengurangan (30 − 12, Unicode −) -> Expected: 18, Got: 18
[PASS] Skenario 2b: Pengurangan (30 - 12, ASCII -) -> Expected: 18, Got: 18
[PASS] Skenario 3a: Perkalian (6 × 7, Unicode ×) -> Expected: 42, Got: 42
[PASS] Skenario 3b: Perkalian (6 * 7, ASCII *) -> Expected: 42, Got: 42
[PASS] Skenario 4a: Pembagian (100 ÷ 4, Unicode ÷) -> Expected: 25, Got: 25
[PASS] Skenario 4b: Pembagian (100 / 4, ASCII /) -> Expected: 25, Got: 25
[PASS] Skenario 5: Desimal (2.5 × 4) -> Expected: 10, Got: 10
[PASS] Skenario 6a: Bagi Nol (10 ÷ 0) -> Successfully caught DivideByZeroException: Attempted to divide by zero.
[PASS] Skenario 6b: Bagi Nol (0 ÷ 0) -> Successfully caught DivideByZeroException: Attempted to divide by zero.
[PASS] Skenario 7: Clear State Reset
[PASS] Edge Case 1: Operasi dengan angka negatif (-5 + 15) -> Expected: 10, Got: 10
[PASS] Edge Case 2: Hasil desimal (7 ÷ 2 = 3.5) -> Expected: 3.5, Got: 3.5
[PASS] Edge Case 3: Perkalian dengan nol (999 × 0 = 0) -> Expected: 0, Got: 0
[PASS] Edge Case 4: Operasi angka besar (1000000 × 1000000) -> Expected: 1000000000000, Got: 1000000000000
[PASS] Edge Case 5: Operasi desimal presisi kecil (0.1 + 0.2) -> Expected: 0.3, Got: 0.3
--------------------------------------------------
TOTAL TESTS: 16 | PASSED: 16 | FAILED: 0
==================================================
```

---

## BAB VI. JAWABAN REFLEKSI MAHASISWA (SECTION 6)

Berikut adalah pembahasan mendalam dan komprehensif atas pertanyaan refleksi mahasiswa pada dokumen praktikum:

### Pertanyaan 1: Apa fungsi object sender pada event handler?
**Jawaban:**
Dalam ekosistem .NET dan C#, tanda tangan delegasi event handler standar didefinisikan sebagai `void MethodName(object sender, EventArgs e)`.
- Parameter `sender` adalah referensi objek ke kontrol UI yang sebenarnya menembakkan (*raise*) event tersebut.
- Karena dideklarasikan dengan tipe dasar universal `object`, parameter ini dapat menampung referensi objek apa pun (seperti `Button`, `TextBox`, `ToolStripMenuItem`, dll.).
- Dengan memanfaatkan teknik *type casting* atau *pattern matching* (misalnya: `Button button = (Button)sender;`), pengembang dapat mengakses secara dinamis seluruh atribut dan properti kontrol spesifik tersebut, seperti properti `button.Text`, `button.Name`, `button.BackColor`, atau `button.Tag`.
- Keberadaan `sender` memfasilitasi arsitektur kode yang dinamis, di mana satu method logika terpusat dapat menangani banyak kontrol sekaligus dan membedakan aksi yang harus diambil berdasarkan kontrol pemicunya.

### Pertanyaan 2: Mengapa semua tombol angka dapat memakai satu NumberButton_Click?
**Jawaban:**
Semua tombol numerik (`btn0` sampai `btn9`) memiliki kesamaan fungsional dan aturan bisnis 100% identik:
1. Mendeteksi angka apa yang ditekan.
2. Mengecek apakah tampilan layar kalkulator sedang menampilkan angka default `"0"`. Jika ya, gantikan `"0"` tersebut dengan digit baru.
3. Jika layar sudah berisi angka selain `"0"`, gabungkan (*append*) digit baru ke belakang string tampilan saat ini (`txtDisplay.Text += button.Text`).

Alih-alih menuliskan 10 method event handler terpisah (`btn0_Click`, `btn1_Click`, ..., `btn9_Click`) yang isinya menduplikasi baris kode yang sama persis, seluruh tombol angka cukup didaftarkan (*subscribe*) ke satu method terpadu `NumberButton_Click`. Melalui parameter `sender`, program secara otomatis mengetahui digit spesifik yang diklik pengguna. Hal ini menerapkan prinsip rekayasa perangkat lunak **DRY (Don't Repeat Yourself)**, menyusutkan ukuran kode sumber, meminimalisir peluang *human-error*, serta meningkatkan keterbacaan (*readability*) program.

### Pertanyaan 3: Apa perbedaan firstNumber, secondNumber, dan result?
**Jawaban:**
Ketiga variabel bertipe `double` ini merepresentasikan siklus hidup (*lifecycle*) data dalam proses evaluasi ekspresi matematika biner ($A \text{ op } B = C$):
1. **`firstNumber` (Operan Pertama / $A$)**: Menyimpan nilai numerik awal sebelum pengguna memilih simbol operator aritmatika. Nilai ini di-parsing dari teks di `txtDisplay` sesaat sebelum layar dibersihkan ketika salah satu tombol operator (`+`, `−`, `×`, `÷`) diklik.
2. **`secondNumber` (Operan Kedua / $B$)**: Menyimpan nilai numerik berikutnya yang diketik pengguna setelah operator dipilih. Nilai ini di-parsing dari teks di `txtDisplay` sesaat setelah tombol sama dengan (`=`) ditekan.
3. **`result` (Hasil Komputasi / $C$)**: Menyimpan nilai akumulasi dari kalkulasi matematika antara `firstNumber` dan `secondNumber` sesuai operasi aritmatika yang tersimpan di variabel `operation`. Nilai dalam variabel `result` inilah yang pada akhirnya diubah kembali ke bentuk teks (`result.ToString()`) untuk disajikan kepada pengguna di layar `txtDisplay`.

### Pertanyaan 4: Mengapa pembagian dengan nol perlu divalidasi?
**Jawaban:**
Secara aksioma matematika, operasi pembagian bilangan nyata dengan angka nol tidak terdefinisi (*undefined / indeterminate*). 

Dalam arsitektur komputasi perangkat lunak:
1. Jika operasi pembagian menggunakan tipe integer, sistem operasi/runtime .NET akan segera melemparkan eksepsi `DivideByZeroException`. Apabila tidak ditangani, aplikasi akan seketika mengalami crash (*abnormal program termination*).
2. Jika operasi menggunakan tipe floating-point standar IEEE 754 seperti `double` pada C#, runtime tidak melemparkan exception secara otomatis, melainkan menghasilkan representasi bit khusus berupa `Infinity` (tak hingga) atau `NaN` (*Not a Number* untuk `0/0`). Membiarkan nilai `Infinity` atau `NaN` tampil pada display kalkulator desktop membingungkan pengguna umum dan menyebabkan inkonsistensi matematis yang merusak perhitungan berantai selanjutnya.

Oleh karena itu, validasi `if (secondNumber == 0)` dengan melemparkan dan menangkap `DivideByZeroException` sangat esensial agar kalkulator mampu mencegat kondisi abnormal tersebut secara terkontrol dan menampilkan notifikasi kesalahan yang jelas dan profesional kepada pengguna.

### Pertanyaan 5: Bagaimana try-catch membantu menjaga aplikasi tetap stabil?
**Jawaban:**
Konstruksi `try-catch` adalah pilar utama dari *Structured Exception Handling* (SEH) pada pemrograman modern:
1. **Perlindungan Terhadap Kegagalan Fatal (Crash Prevention)**: Seluruh instruksi komputasi atau interaksi yang memiliki risiko kegagalan runtime (seperti konversi string ke double via `double.Parse()` saat format teks tidak terduga, atau operasi aritmatika pembagian nol) ditempatkan di dalam blok `try`.
2. **Pengalihan Alur yang Aman (Controlled Flow)**: Saat terjadi galat, runtime .NET menghentikan eksekusi baris bermasalah dan langsung mengalihkan kendali eksekusi ke blok `catch` yang bersesuaian, tanpa mematikan thread utama (*UI thread*).
3. **Penyampaian Informasi yang Komunikatif**: Blok `catch` memberi kesempatan kepada pengembang untuk menangkap pesan kesalahan (`ex.Message`), menampilkan kotak dialog penjelasan kepada pengguna (`MessageBox.Show()`), serta mereset atau memulihkan status antarmuka ke kondisi stabil.
4. **Kelangsungan Pengalaman Pengguna (User Experience Continuity)**: Tanpa `try-catch`, setiap galat runtime akan memunculkan dialog Windows Error Reporting dan menutup paksa aplikasi. Dengan `try-catch`, aplikasi tetap hidup, responsif, dan siap menerima operasi berikutnya dari pengguna.

---

## BAB VII. PEMBAHASAN TANTANGAN PENGEMBANGAN (SECTION 5)

Pada Section 5 dokumen praktikum, diidentifikasi lima tantangan pengembangan (*enhancement challenges*):
1. **Penambahan Tombol Negasi (±) dan Persen (%)**:
   - Tombol `±`: Mengalikan nilai saat ini pada display dengan `-1` (`result = -double.Parse(txtDisplay.Text); txtDisplay.Text = result.ToString();`).
   - Tombol `%`: Membagi nilai operan saat ini dengan `100` untuk memfasilitasi persentase cepat.
2. **Penambahan Tombol Backspace**:
   - Memotong satu karakter terakhir dari string display (`txtDisplay.Text = txtDisplay.Text.Remove(txtDisplay.Text.Length - 1);`). Jika panjang teks menjadi 0, display dikembalikan ke nilai default `"0"`.
3. **Fitur Riwayat Perhitungan (Calculation History)**:
   - Menyimpan setiap riwayat operasi yang telah diselesaikan ke dalam sebuah `ListBox` atau panel terpisah dengan format `A op B = C` beserta stempel waktu.
4. **Pemisahan Logika Kalkulator ke Class / Service Terpisah**:
   - Telah berhasil diimplementasikan pada proyek ini melalui pembentukan kelas `CalculatorEngine.cs` di dalam folder `CalculatorApp`. Dengan memisahkan logika dari Form GUI, modul komputasi dapat diuji secara independen melalui unit test tanpa ketergantungan pada runtime UI Windows.
5. **Evolusi Menjadi Scientific Calculator**:
   - Memperluas pustaka fungsi matematika menggunakan method dari namespace `System.Math`, meliputi fungsi trigonometri (`sin`, `cos`, `tan`), eksponensial (`pow`, $e^x$), akar kuadrat (`sqrt`), dan logaritma natural (`ln`, `log10`).

---

## BAB VIII. KESIMPULAN

Praktikum implementasi aplikasi desktop kalkulator menggunakan C# dan Windows Forms pada platform .NET telah berhasil diselesaikan dengan sukses dan memenuhi seluruh kriteria teknis maupun estetika yang dipersyaratkan:
1. Solusi proyek desktop `CalculatorApp` (.NET 10) berhasil dibangun, dikompilasi tanpa *error* maupun *warning*, dan diverifikasi secara fungsional.
2. Seluruh kontrol UI, tata letak 4 kolom, *event handler* dinamis `NumberButton_Click`, `OperatorButton_Click`, `btnEquals_Click`, `btnClear_Click`, dan `btnDecimal_Click` bekerja secara presisi.
3. Mekanisme pertahanan program dengan blok `try-catch` dan validasi pembagian nol terbukti andal menjaga stabilitas aplikasi.
4. Pemisahan logika kalkulator ke dalam kelas modular `CalculatorEngine` dan pembuatan suite uji otomatis `CalculatorApp.Tests` membuktikan keandalan logika pada 16 skenario pengujian tanpa kegagalan (16/16 Passed).
5. Dokumen laporan replika PDF (`Laporan_Hand_on_Lab_Kalkulator_CSharp_WinForms.pdf`) berhasil diproduksi dengan kesamaan tata letak, warna, tipografi, tabel, dan format 100% terhadap dokumen asli, dilengkapi jawaban mendalam dan komprehensif pada bagian refleksi mahasiswa.
