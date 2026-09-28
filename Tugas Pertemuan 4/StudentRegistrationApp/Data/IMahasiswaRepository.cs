using StudentRegistrationApp.Models;

namespace StudentRegistrationApp.Data
{
    public interface IMahasiswaRepository
    {
        List<Mahasiswa> GetAll();
        bool NimExists(string nim, int excludeId = 0);
        void Insert(Mahasiswa mhs);
        void Update(Mahasiswa mhs);
        void Delete(int id);
    }
}
