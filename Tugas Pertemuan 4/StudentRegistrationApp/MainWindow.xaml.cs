using System.IO;
using System.Text.Json;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Input;
using StudentRegistrationApp.Data;
using StudentRegistrationApp.Models;

namespace StudentRegistrationApp
{
    public partial class MainWindow : Window
    {
        private IMahasiswaRepository _repository = new InMemoryMahasiswaRepository();
        private List<Mahasiswa> _semuaMahasiswa = new();

        // Id mahasiswa yang sedang diedit (0 = mode tambah data baru)
        private int _editingId = 0;

        public MainWindow()
        {
            InitializeComponent();
        }

        // Step 12 Level 3: hubungkan ke SQL Server saat window dibuka
        private void Window_Loaded(object sender, RoutedEventArgs e)
        {
            try
            {
                var sqlRepository = new SqlMahasiswaRepository(ReadConnectionString());
                sqlRepository.EnsureCreated();
                _repository = sqlRepository;
                txtStatusDb.Text = "Database: SQL Server (terhubung)";
            }
            catch (Exception ex)
            {
                _repository = new InMemoryMahasiswaRepository();
                txtStatusDb.Text = "Database: tidak terhubung — data disimpan sementara (in-memory)";
                MessageBox.Show(
                    "Gagal terhubung ke SQL Server. Aplikasi berjalan dengan penyimpanan sementara.\n\n" + ex.Message,
                    "Peringatan",
                    MessageBoxButton.OK,
                    MessageBoxImage.Warning);
            }

            LoadData();
        }

        private static string ReadConnectionString()
        {
            string path = Path.Combine(AppContext.BaseDirectory, "appsettings.json");
            using var doc = JsonDocument.Parse(File.ReadAllText(path));
            return doc.RootElement
                      .GetProperty("ConnectionStrings")
                      .GetProperty("StudentDb")
                      .GetString()!;
        }

        private void BtnSimpan_Click(
            object sender,
            RoutedEventArgs e)
        {
            // Step 8: Validasi
            if (string.IsNullOrWhiteSpace(txtNim.Text))
            {
                MessageBox.Show("NIM harus diisi!");
                txtNim.Focus();
                return;
            }

            if (string.IsNullOrWhiteSpace(txtNama.Text))
            {
                MessageBox.Show("Nama harus diisi!");
                txtNama.Focus();
                return;
            }

            if (cmbProdi.SelectedItem == null)
            {
                MessageBox.Show("Pilih program studi!");
                return;
            }

            if (rbLaki.IsChecked != true &&
                rbPerempuan.IsChecked != true)
            {
                MessageBox.Show("Pilih jenis kelamin!");
                return;
            }

            // Validasi tambahan untuk field Level 1
            if (dpTanggalLahir.SelectedDate > DateTime.Today)
            {
                MessageBox.Show("Tanggal lahir tidak boleh di masa depan!");
                dpTanggalLahir.Focus();
                return;
            }

            string telepon = txtTelepon.Text.Trim();
            if (telepon.Length > 0 && !telepon.All(char.IsDigit))
            {
                MessageBox.Show("Nomor telepon hanya boleh berisi angka!");
                txtTelepon.Focus();
                return;
            }

            string nim = txtNim.Text.Trim();

            try
            {
                if (_repository.NimExists(nim, _editingId))
                {
                    MessageBox.Show("NIM sudah terdaftar!");
                    txtNim.Focus();
                    return;
                }

                // proses penyimpanan
                string prodi = "";

                if (cmbProdi.SelectedItem is ComboBoxItem item)
                {
                    prodi = item.Content.ToString()!;
                }

                string jenisKelamin = "";

                if (rbLaki.IsChecked == true)
                {
                    jenisKelamin = "Laki-laki";
                }
                else if (rbPerempuan.IsChecked == true)
                {
                    jenisKelamin = "Perempuan";
                }

                var mhs = new Mahasiswa
                {
                    Id = _editingId,
                    Nim = nim,
                    Nama = txtNama.Text.Trim(),
                    Prodi = prodi,
                    JenisKelamin = jenisKelamin,
                    TanggalLahir = dpTanggalLahir.SelectedDate,
                    Alamat = txtAlamat.Text.Trim(),
                    NoTelepon = telepon
                };

                string pesan;

                if (_editingId == 0)
                {
                    _repository.Insert(mhs);
                    pesan = "Data mahasiswa berhasil disimpan!";
                }
                else
                {
                    _repository.Update(mhs);
                    pesan = "Data mahasiswa berhasil diperbarui!";
                }

                LoadData();
                ResetForm();

                MessageBox.Show(
                    pesan,
                    "Informasi",
                    MessageBoxButton.OK,
                    MessageBoxImage.Information);
            }
            catch (Exception ex)
            {
                ShowDatabaseError(ex);
            }
        }

        // Step 9: Tombol Reset
        private void BtnReset_Click(
            object sender,
            RoutedEventArgs e)
        {
            ResetForm();
        }

        private void ResetForm()
        {
            txtNim.Clear();
            txtNama.Clear();

            cmbProdi.SelectedIndex = -1;

            rbLaki.IsChecked = false;
            rbPerempuan.IsChecked = false;

            dpTanggalLahir.SelectedDate = null;
            txtAlamat.Clear();
            txtTelepon.Clear();

            _editingId = 0;
            btnSimpan.Content = "Simpan";

            txtNim.Focus();
        }

        // Step 10: Tombol Hapus (+ Step 12 Level 2: konfirmasi sebelum hapus)
        private void BtnHapus_Click(
            object sender,
            RoutedEventArgs e)
        {
            if (lstMahasiswa.SelectedItem is Mahasiswa mhs)
            {
                var jawaban = MessageBox.Show(
                    $"Yakin ingin menghapus data berikut?\n\n{mhs}",
                    "Konfirmasi Hapus",
                    MessageBoxButton.YesNo,
                    MessageBoxImage.Question);

                if (jawaban != MessageBoxResult.Yes)
                {
                    return;
                }

                try
                {
                    _repository.Delete(mhs.Id);

                    if (_editingId == mhs.Id)
                    {
                        ResetForm();
                    }

                    LoadData();
                }
                catch (Exception ex)
                {
                    ShowDatabaseError(ex);
                }
            }
            else
            {
                MessageBox.Show(
                    "Pilih data yang ingin dihapus!");
            }
        }

        // Step 12 Level 2: Edit data
        private void BtnEdit_Click(
            object sender,
            RoutedEventArgs e)
        {
            if (lstMahasiswa.SelectedItem is Mahasiswa mhs)
            {
                IsiForm(mhs);
            }
            else
            {
                MessageBox.Show(
                    "Pilih data yang ingin diedit!");
            }
        }

        private void LstMahasiswa_MouseDoubleClick(
            object sender,
            MouseButtonEventArgs e)
        {
            if (lstMahasiswa.SelectedItem is Mahasiswa mhs)
            {
                IsiForm(mhs);
            }
        }

        private void IsiForm(Mahasiswa mhs)
        {
            _editingId = mhs.Id;

            txtNim.Text = mhs.Nim;
            txtNama.Text = mhs.Nama;

            cmbProdi.SelectedItem = cmbProdi.Items
                .Cast<ComboBoxItem>()
                .FirstOrDefault(i => i.Content.ToString() == mhs.Prodi);

            rbLaki.IsChecked = mhs.JenisKelamin == "Laki-laki";
            rbPerempuan.IsChecked = mhs.JenisKelamin == "Perempuan";

            dpTanggalLahir.SelectedDate = mhs.TanggalLahir;
            txtAlamat.Text = mhs.Alamat;
            txtTelepon.Text = mhs.NoTelepon;

            btnSimpan.Content = "Update";
            txtNim.Focus();
        }

        // Step 12 Level 2: Search mahasiswa
        private void TxtSearch_TextChanged(
            object sender,
            TextChangedEventArgs e)
        {
            TampilkanData();
        }

        private void LoadData()
        {
            try
            {
                _semuaMahasiswa = _repository.GetAll();
            }
            catch (Exception ex)
            {
                ShowDatabaseError(ex);
            }

            TampilkanData();
        }

        private void TampilkanData()
        {
            string keyword = txtSearch.Text.Trim();

            var hasil = string.IsNullOrEmpty(keyword)
                ? _semuaMahasiswa
                : _semuaMahasiswa.Where(m =>
                        m.Nim.Contains(keyword, StringComparison.OrdinalIgnoreCase) ||
                        m.Nama.Contains(keyword, StringComparison.OrdinalIgnoreCase) ||
                        m.Prodi.Contains(keyword, StringComparison.OrdinalIgnoreCase))
                    .ToList();

            lstMahasiswa.ItemsSource = hasil;

            // Step 12 Level 2: Counter jumlah mahasiswa
            txtJumlah.Text = string.IsNullOrEmpty(keyword)
                ? $"Jumlah Mahasiswa: {_semuaMahasiswa.Count}"
                : $"Jumlah Mahasiswa: {_semuaMahasiswa.Count} (ditampilkan: {hasil.Count})";
        }

        private static void ShowDatabaseError(Exception ex)
        {
            MessageBox.Show(
                "Terjadi kesalahan database:\n\n" + ex.Message,
                "Error",
                MessageBoxButton.OK,
                MessageBoxImage.Error);
        }
    }
}
