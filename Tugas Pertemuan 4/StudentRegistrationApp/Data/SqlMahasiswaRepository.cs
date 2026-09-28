using Microsoft.Data.SqlClient;
using StudentRegistrationApp.Models;

namespace StudentRegistrationApp.Data
{
    public class SqlMahasiswaRepository : IMahasiswaRepository
    {
        private readonly string _connectionString;

        public SqlMahasiswaRepository(string connectionString)
        {
            _connectionString = connectionString;
        }

        // Membuat database dan tabel Mahasiswa jika belum ada.
        public void EnsureCreated()
        {
            var builder = new SqlConnectionStringBuilder(_connectionString);
            string databaseName = builder.InitialCatalog;

            builder.InitialCatalog = "master";
            using (var conn = new SqlConnection(builder.ConnectionString))
            {
                conn.Open();
                using var cmd = conn.CreateCommand();
                cmd.CommandText =
                    $"IF DB_ID(@db) IS NULL CREATE DATABASE [{databaseName.Replace("]", "]]")}]";
                cmd.Parameters.AddWithValue("@db", databaseName);
                cmd.ExecuteNonQuery();
            }

            using (var conn = OpenConnection())
            {
                using var cmd = conn.CreateCommand();
                cmd.CommandText = @"
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
);";
                cmd.ExecuteNonQuery();
            }
        }

        public List<Mahasiswa> GetAll()
        {
            var result = new List<Mahasiswa>();

            using var conn = OpenConnection();
            using var cmd = conn.CreateCommand();
            cmd.CommandText = @"SELECT Id, Nim, Nama, Prodi, JenisKelamin, TanggalLahir, Alamat, NoTelepon
                                FROM dbo.Mahasiswa ORDER BY Nim";

            using var reader = cmd.ExecuteReader();
            while (reader.Read())
            {
                result.Add(new Mahasiswa
                {
                    Id = reader.GetInt32(0),
                    Nim = reader.GetString(1),
                    Nama = reader.GetString(2),
                    Prodi = reader.GetString(3),
                    JenisKelamin = reader.GetString(4),
                    TanggalLahir = reader.IsDBNull(5) ? null : reader.GetDateTime(5),
                    Alamat = reader.IsDBNull(6) ? "" : reader.GetString(6),
                    NoTelepon = reader.IsDBNull(7) ? "" : reader.GetString(7)
                });
            }

            return result;
        }

        public bool NimExists(string nim, int excludeId = 0)
        {
            using var conn = OpenConnection();
            using var cmd = conn.CreateCommand();
            cmd.CommandText = "SELECT COUNT(*) FROM dbo.Mahasiswa WHERE Nim = @nim AND Id <> @id";
            cmd.Parameters.AddWithValue("@nim", nim);
            cmd.Parameters.AddWithValue("@id", excludeId);
            return (int)cmd.ExecuteScalar() > 0;
        }

        public void Insert(Mahasiswa mhs)
        {
            using var conn = OpenConnection();
            using var cmd = conn.CreateCommand();
            cmd.CommandText = @"INSERT INTO dbo.Mahasiswa
                                    (Nim, Nama, Prodi, JenisKelamin, TanggalLahir, Alamat, NoTelepon)
                                OUTPUT INSERTED.Id
                                VALUES (@nim, @nama, @prodi, @jk, @tgl, @alamat, @telp)";
            AddParameters(cmd, mhs);
            mhs.Id = (int)cmd.ExecuteScalar();
        }

        public void Update(Mahasiswa mhs)
        {
            using var conn = OpenConnection();
            using var cmd = conn.CreateCommand();
            cmd.CommandText = @"UPDATE dbo.Mahasiswa SET
                                    Nim = @nim, Nama = @nama, Prodi = @prodi, JenisKelamin = @jk,
                                    TanggalLahir = @tgl, Alamat = @alamat, NoTelepon = @telp
                                WHERE Id = @id";
            AddParameters(cmd, mhs);
            cmd.Parameters.AddWithValue("@id", mhs.Id);
            cmd.ExecuteNonQuery();
        }

        public void Delete(int id)
        {
            using var conn = OpenConnection();
            using var cmd = conn.CreateCommand();
            cmd.CommandText = "DELETE FROM dbo.Mahasiswa WHERE Id = @id";
            cmd.Parameters.AddWithValue("@id", id);
            cmd.ExecuteNonQuery();
        }

        private SqlConnection OpenConnection()
        {
            var conn = new SqlConnection(_connectionString);
            conn.Open();
            return conn;
        }

        private static void AddParameters(SqlCommand cmd, Mahasiswa mhs)
        {
            cmd.Parameters.AddWithValue("@nim", mhs.Nim);
            cmd.Parameters.AddWithValue("@nama", mhs.Nama);
            cmd.Parameters.AddWithValue("@prodi", mhs.Prodi);
            cmd.Parameters.AddWithValue("@jk", mhs.JenisKelamin);
            cmd.Parameters.AddWithValue("@tgl", (object?)mhs.TanggalLahir ?? DBNull.Value);
            cmd.Parameters.AddWithValue("@alamat", mhs.Alamat);
            cmd.Parameters.AddWithValue("@telp", mhs.NoTelepon);
        }
    }
}
