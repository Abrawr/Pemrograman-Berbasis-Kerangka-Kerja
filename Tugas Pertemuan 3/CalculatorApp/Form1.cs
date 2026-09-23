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
            if (!string.IsNullOrEmpty(txtDisplay.Text))
            {
                if (double.TryParse(txtDisplay.Text.Replace(',', '.'), NumberStyles.Any, CultureInfo.InvariantCulture, out double parsed))
                    firstNumber = parsed;
            }
            operation = button.Text;
            txtDisplay.Clear();
        }

        private void btnEquals_Click(object sender, EventArgs e)
        {
            try
            {
                if (!string.IsNullOrEmpty(txtDisplay.Text))
                {
                    if (!double.TryParse(txtDisplay.Text.Replace(',', '.'), NumberStyles.Any, CultureInfo.InvariantCulture, out secondNumber))
                        return;
                }
                else
                {
                    secondNumber = firstNumber;
                }

                switch (operation)
                {
                    case "+": result = firstNumber + secondNumber; break;
                    case "−": case "-": result = firstNumber - secondNumber; break;
                    case "×": case "*": case "x": result = firstNumber * secondNumber; break;
                    case "÷": case "/":
                        if (secondNumber == 0)
                            throw new DivideByZeroException();
                        result = firstNumber / secondNumber;
                        break;
                    default:
                        result = secondNumber;
                        break;
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
