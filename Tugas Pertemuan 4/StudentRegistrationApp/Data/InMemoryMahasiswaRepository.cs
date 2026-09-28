using StudentRegistrationApp.Models;

namespace StudentRegistrationApp.Data
{
    // Dipakai sebagai cadangan bila SQL Server tidak dapat dihubungi.
    // Data hanya tersimpan selama aplikasi berjalan.
    public class InMemoryMahasiswaRepository : IMahasiswaRepository
    {
        private readonly List<Mahasiswa> _data = new();
        private int _nextId = 1;

        public List<Mahasiswa> GetAll()
        {
            return _data.OrderBy(m => m.Nim).ToList();
        }

        public bool NimExists(string nim, int excludeId = 0)
        {
            return _data.Any(m => m.Nim == nim && m.Id != excludeId);
        }

        public void Insert(Mahasiswa mhs)
        {
            mhs.Id = _nextId++;
            _data.Add(mhs);
        }

        public void Update(Mahasiswa mhs)
        {
            int index = _data.FindIndex(m => m.Id == mhs.Id);
            if (index >= 0)
            {
                _data[index] = mhs;
            }
        }

        public void Delete(int id)
        {
            _data.RemoveAll(m => m.Id == id);
        }
    }
}
