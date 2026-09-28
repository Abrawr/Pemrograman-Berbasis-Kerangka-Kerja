namespace StudentRegistrationApp.Models
{
    public class Mahasiswa
    {
        public int Id { get; set; }
        public string Nim { get; set; } = "";
        public string Nama { get; set; } = "";
        public string Prodi { get; set; } = "";
        public string JenisKelamin { get; set; } = "";
        public DateTime? TanggalLahir { get; set; }
        public string Alamat { get; set; } = "";
        public string NoTelepon { get; set; } = "";

        // Format tampilan di ListBox, sama seperti Step 6: nim | nama | prodi | jenisKelamin
        public override string ToString()
        {
            return $"{Nim} | {Nama} | {Prodi} | {JenisKelamin}";
        }
    }
}
