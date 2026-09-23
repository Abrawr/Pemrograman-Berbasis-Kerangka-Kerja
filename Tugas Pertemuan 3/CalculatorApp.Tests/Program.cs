using System;
using System.Globalization;
using CalculatorApp;

namespace CalculatorApp.Tests;

class Program
{
    static int passed = 0;
    static int failed = 0;

    static void Main(string[] args)
    {
        CultureInfo.DefaultThreadCurrentCulture = CultureInfo.InvariantCulture;
        CultureInfo.DefaultThreadCurrentUICulture = CultureInfo.InvariantCulture;

        Console.WriteLine("==================================================");
        Console.WriteLine("       CALCULATOR APPLICATION TEST SUITE          ");
        Console.WriteLine("==================================================");

        var engine = new CalculatorEngine();

        // Skenario 1: Penjumlahan 10 + 20 = 30
        AssertEqual("Skenario 1: Penjumlahan (10 + 20)", 30.0, engine.Calculate(10, 20, "+"));

        // Skenario 2: Pengurangan 30 − 12 = 18 (Unicode minus)
        AssertEqual("Skenario 2a: Pengurangan (30 − 12, Unicode −)", 18.0, engine.Calculate(30, 12, "−"));
        AssertEqual("Skenario 2b: Pengurangan (30 - 12, ASCII -)", 18.0, engine.Calculate(30, 12, "-"));

        // Skenario 3: Perkalian 6 × 7 = 42 (Unicode ×)
        AssertEqual("Skenario 3a: Perkalian (6 × 7, Unicode ×)", 42.0, engine.Calculate(6, 7, "×"));
        AssertEqual("Skenario 3b: Perkalian (6 * 7, ASCII *)", 42.0, engine.Calculate(6, 7, "*"));

        // Skenario 4: Pembagian 100 ÷ 4 = 25 (Unicode ÷)
        AssertEqual("Skenario 4a: Pembagian (100 ÷ 4, Unicode ÷)", 25.0, engine.Calculate(100, 4, "÷"));
        AssertEqual("Skenario 4b: Pembagian (100 / 4, ASCII /)", 25.0, engine.Calculate(100, 4, "/"));

        // Skenario 5: Desimal 2.5 × 4 = 10
        AssertEqual("Skenario 5: Desimal (2.5 × 4)", 10.0, engine.Calculate(2.5, 4, "×"));

        // Skenario 6: Bagi nol 10 ÷ 0 = Pesan error (DivideByZeroException)
        AssertThrows<DivideByZeroException>("Skenario 6a: Bagi Nol (10 ÷ 0)", () => engine.Calculate(10, 0, "÷"));
        AssertThrows<DivideByZeroException>("Skenario 6b: Bagi Nol (0 ÷ 0)", () => engine.Calculate(0, 0, "÷"));

        // Skenario 7: Clear
        engine.FirstNumber = 100;
        engine.SecondNumber = 50;
        engine.Operation = "+";
        engine.Result = 150;
        engine.Reset();
        AssertTrue("Skenario 7: Clear State Reset", 
            engine.FirstNumber == 0 && engine.SecondNumber == 0 && engine.Result == 0 && engine.Operation == "");

        // Edge Cases
        AssertEqual("Edge Case 1: Operasi dengan angka negatif (-5 + 15)", 10.0, engine.Calculate(-5, 15, "+"));
        AssertEqual("Edge Case 2: Hasil desimal (7 ÷ 2 = 3.5)", 3.5, engine.Calculate(7, 2, "÷"));
        AssertEqual("Edge Case 3: Perkalian dengan nol (999 × 0 = 0)", 0.0, engine.Calculate(999, 0, "×"));
        AssertEqual("Edge Case 4: Operasi angka besar (1000000 × 1000000)", 1000000000000.0, engine.Calculate(1000000, 1000000, "×"));
        AssertEqual("Edge Case 5: Operasi desimal presisi kecil (0.1 + 0.2)", 0.3, Math.Round(engine.Calculate(0.1, 0.2, "+"), 2));

        Console.WriteLine("--------------------------------------------------");
        Console.WriteLine($"TOTAL TESTS: {passed + failed} | PASSED: {passed} | FAILED: {failed}");
        Console.WriteLine("==================================================");

        if (failed > 0)
        {
            Environment.Exit(1);
        }
    }

    static void AssertEqual(string testName, double expected, double actual)
    {
        if (Math.Abs(expected - actual) < 0.0000001)
        {
            Console.WriteLine($"[PASS] {testName} -> Expected: {expected}, Got: {actual}");
            passed++;
        }
        else
        {
            Console.ForegroundColor = ConsoleColor.Red;
            Console.WriteLine($"[FAIL] {testName} -> Expected: {expected}, Got: {actual}");
            Console.ResetColor();
            failed++;
        }
    }

    static void AssertTrue(string testName, bool condition)
    {
        if (condition)
        {
            Console.WriteLine($"[PASS] {testName}");
            passed++;
        }
        else
        {
            Console.ForegroundColor = ConsoleColor.Red;
            Console.WriteLine($"[FAIL] {testName} -> Condition was false");
            Console.ResetColor();
            failed++;
        }
    }

    static void AssertThrows<T>(string testName, Action action) where T : Exception
    {
        try
        {
            action();
            Console.ForegroundColor = ConsoleColor.Red;
            Console.WriteLine($"[FAIL] {testName} -> Expected exception {typeof(T).Name} but none was thrown");
            Console.ResetColor();
            failed++;
        }
        catch (T ex)
        {
            Console.WriteLine($"[PASS] {testName} -> Successfully caught {typeof(T).Name}: {ex.Message}");
            passed++;
        }
        catch (Exception ex)
        {
            Console.ForegroundColor = ConsoleColor.Red;
            Console.WriteLine($"[FAIL] {testName} -> Expected {typeof(T).Name} but caught {ex.GetType().Name}: {ex.Message}");
            Console.ResetColor();
            failed++;
        }
    }
}
