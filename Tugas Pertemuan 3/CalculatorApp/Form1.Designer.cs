namespace CalculatorApp
{
    partial class Form1
    {
        private System.ComponentModel.IContainer components = null;

        private Label lblTitle;
        private TextBox txtDisplay;
        private Button btn1;
        private Button btn2;
        private Button btn3;
        private Button btnDivide;
        private Button btn4;
        private Button btn5;
        private Button btn6;
        private Button btnMultiply;
        private Button btn7;
        private Button btn8;
        private Button btn9;
        private Button btnMinus;
        private Button btnClear;
        private Button btn0;
        private Button btnDecimal;
        private Button btnPlus;
        private Button btnEquals;

        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        private void InitializeComponent()
        {
            lblTitle = new Label();
            txtDisplay = new TextBox();
            btn1 = new Button();
            btn2 = new Button();
            btn3 = new Button();
            btnDivide = new Button();
            btn4 = new Button();
            btn5 = new Button();
            btn6 = new Button();
            btnMultiply = new Button();
            btn7 = new Button();
            btn8 = new Button();
            btn9 = new Button();
            btnMinus = new Button();
            btnClear = new Button();
            btn0 = new Button();
            btnDecimal = new Button();
            btnPlus = new Button();
            btnEquals = new Button();
            SuspendLayout();

            // lblTitle
            lblTitle.Font = new Font("Tahoma", 9F, FontStyle.Bold);
            lblTitle.ForeColor = Color.FromArgb(70, 80, 95);
            lblTitle.Location = new Point(12, 9);
            lblTitle.Name = "lblTitle";
            lblTitle.Size = new Size(226, 18);
            lblTitle.TabIndex = 0;
            lblTitle.Text = "Calculator";
            lblTitle.TextAlign = ContentAlignment.MiddleLeft;

            // txtDisplay
            txtDisplay.BackColor = Color.White;
            txtDisplay.BorderStyle = BorderStyle.Fixed3D;
            txtDisplay.Font = new Font("Tahoma", 14F, FontStyle.Bold);
            txtDisplay.ForeColor = Color.FromArgb(10, 10, 10);
            txtDisplay.Location = new Point(12, 30);
            txtDisplay.Name = "txtDisplay";
            txtDisplay.ReadOnly = true;
            txtDisplay.Size = new Size(226, 30);
            txtDisplay.TabIndex = 1;
            txtDisplay.Text = "0";
            txtDisplay.TextAlign = HorizontalAlignment.Right;

            // btn1
            btn1.BackColor = Color.FromArgb(248, 249, 250);
            btn1.Font = new Font("Tahoma", 11F, FontStyle.Bold);
            btn1.ForeColor = Color.FromArgb(20, 20, 20);
            btn1.Location = new Point(12, 68);
            btn1.Name = "btn1";
            btn1.Size = new Size(52, 42);
            btn1.TabIndex = 2;
            btn1.Text = "1";
            btn1.UseVisualStyleBackColor = false;
            btn1.Click += NumberButton_Click;

            // btn2
            btn2.BackColor = Color.FromArgb(248, 249, 250);
            btn2.Font = new Font("Tahoma", 11F, FontStyle.Bold);
            btn2.ForeColor = Color.FromArgb(20, 20, 20);
            btn2.Location = new Point(70, 68);
            btn2.Name = "btn2";
            btn2.Size = new Size(52, 42);
            btn2.TabIndex = 3;
            btn2.Text = "2";
            btn2.UseVisualStyleBackColor = false;
            btn2.Click += NumberButton_Click;

            // btn3
            btn3.BackColor = Color.FromArgb(248, 249, 250);
            btn3.Font = new Font("Tahoma", 11F, FontStyle.Bold);
            btn3.ForeColor = Color.FromArgb(20, 20, 20);
            btn3.Location = new Point(128, 68);
            btn3.Name = "btn3";
            btn3.Size = new Size(52, 42);
            btn3.TabIndex = 4;
            btn3.Text = "3";
            btn3.UseVisualStyleBackColor = false;
            btn3.Click += NumberButton_Click;

            // btnDivide
            btnDivide.BackColor = Color.FromArgb(230, 240, 252);
            btnDivide.Font = new Font("Tahoma", 12F, FontStyle.Bold);
            btnDivide.ForeColor = Color.FromArgb(0, 70, 160);
            btnDivide.Location = new Point(186, 68);
            btnDivide.Name = "btnDivide";
            btnDivide.Size = new Size(52, 42);
            btnDivide.TabIndex = 5;
            btnDivide.Text = "÷";
            btnDivide.UseVisualStyleBackColor = false;
            btnDivide.Click += OperatorButton_Click;

            // btn4
            btn4.BackColor = Color.FromArgb(248, 249, 250);
            btn4.Font = new Font("Tahoma", 11F, FontStyle.Bold);
            btn4.ForeColor = Color.FromArgb(20, 20, 20);
            btn4.Location = new Point(12, 116);
            btn4.Name = "btn4";
            btn4.Size = new Size(52, 42);
            btn4.TabIndex = 6;
            btn4.Text = "4";
            btn4.UseVisualStyleBackColor = false;
            btn4.Click += NumberButton_Click;

            // btn5
            btn5.BackColor = Color.FromArgb(248, 249, 250);
            btn5.Font = new Font("Tahoma", 11F, FontStyle.Bold);
            btn5.ForeColor = Color.FromArgb(20, 20, 20);
            btn5.Location = new Point(70, 116);
            btn5.Name = "btn5";
            btn5.Size = new Size(52, 42);
            btn5.TabIndex = 7;
            btn5.Text = "5";
            btn5.UseVisualStyleBackColor = false;
            btn5.Click += NumberButton_Click;

            // btn6
            btn6.BackColor = Color.FromArgb(248, 249, 250);
            btn6.Font = new Font("Tahoma", 11F, FontStyle.Bold);
            btn6.ForeColor = Color.FromArgb(20, 20, 20);
            btn6.Location = new Point(128, 116);
            btn6.Name = "btn6";
            btn6.Size = new Size(52, 42);
            btn6.TabIndex = 8;
            btn6.Text = "6";
            btn6.UseVisualStyleBackColor = false;
            btn6.Click += NumberButton_Click;

            // btnMultiply
            btnMultiply.BackColor = Color.FromArgb(230, 240, 252);
            btnMultiply.Font = new Font("Tahoma", 12F, FontStyle.Bold);
            btnMultiply.ForeColor = Color.FromArgb(0, 70, 160);
            btnMultiply.Location = new Point(186, 116);
            btnMultiply.Name = "btnMultiply";
            btnMultiply.Size = new Size(52, 42);
            btnMultiply.TabIndex = 9;
            btnMultiply.Text = "×";
            btnMultiply.UseVisualStyleBackColor = false;
            btnMultiply.Click += OperatorButton_Click;

            // btn7
            btn7.BackColor = Color.FromArgb(248, 249, 250);
            btn7.Font = new Font("Tahoma", 11F, FontStyle.Bold);
            btn7.ForeColor = Color.FromArgb(20, 20, 20);
            btn7.Location = new Point(12, 164);
            btn7.Name = "btn7";
            btn7.Size = new Size(52, 42);
            btn7.TabIndex = 10;
            btn7.Text = "7";
            btn7.UseVisualStyleBackColor = false;
            btn7.Click += NumberButton_Click;

            // btn8
            btn8.BackColor = Color.FromArgb(248, 249, 250);
            btn8.Font = new Font("Tahoma", 11F, FontStyle.Bold);
            btn8.ForeColor = Color.FromArgb(20, 20, 20);
            btn8.Location = new Point(70, 164);
            btn8.Name = "btn8";
            btn8.Size = new Size(52, 42);
            btn8.TabIndex = 11;
            btn8.Text = "8";
            btn8.UseVisualStyleBackColor = false;
            btn8.Click += NumberButton_Click;

            // btn9
            btn9.BackColor = Color.FromArgb(248, 249, 250);
            btn9.Font = new Font("Tahoma", 11F, FontStyle.Bold);
            btn9.ForeColor = Color.FromArgb(20, 20, 20);
            btn9.Location = new Point(128, 164);
            btn9.Name = "btn9";
            btn9.Size = new Size(52, 42);
            btn9.TabIndex = 12;
            btn9.Text = "9";
            btn9.UseVisualStyleBackColor = false;
            btn9.Click += NumberButton_Click;

            // btnMinus
            btnMinus.BackColor = Color.FromArgb(230, 240, 252);
            btnMinus.Font = new Font("Tahoma", 12F, FontStyle.Bold);
            btnMinus.ForeColor = Color.FromArgb(0, 70, 160);
            btnMinus.Location = new Point(186, 164);
            btnMinus.Name = "btnMinus";
            btnMinus.Size = new Size(52, 42);
            btnMinus.TabIndex = 13;
            btnMinus.Text = "−";
            btnMinus.UseVisualStyleBackColor = false;
            btnMinus.Click += OperatorButton_Click;

            // btnClear
            btnClear.BackColor = Color.FromArgb(253, 236, 236);
            btnClear.Font = new Font("Tahoma", 11F, FontStyle.Bold);
            btnClear.ForeColor = Color.FromArgb(180, 25, 25);
            btnClear.Location = new Point(12, 212);
            btnClear.Name = "btnClear";
            btnClear.Size = new Size(52, 42);
            btnClear.TabIndex = 14;
            btnClear.Text = "C";
            btnClear.UseVisualStyleBackColor = false;
            btnClear.Click += btnClear_Click;

            // btn0
            btn0.BackColor = Color.FromArgb(248, 249, 250);
            btn0.Font = new Font("Tahoma", 11F, FontStyle.Bold);
            btn0.ForeColor = Color.FromArgb(20, 20, 20);
            btn0.Location = new Point(70, 212);
            btn0.Name = "btn0";
            btn0.Size = new Size(52, 42);
            btn0.TabIndex = 15;
            btn0.Text = "0";
            btn0.UseVisualStyleBackColor = false;
            btn0.Click += NumberButton_Click;

            // btnDecimal
            btnDecimal.BackColor = Color.FromArgb(248, 249, 250);
            btnDecimal.Font = new Font("Tahoma", 12F, FontStyle.Bold);
            btnDecimal.ForeColor = Color.FromArgb(20, 20, 20);
            btnDecimal.Location = new Point(128, 212);
            btnDecimal.Name = "btnDecimal";
            btnDecimal.Size = new Size(52, 42);
            btnDecimal.TabIndex = 16;
            btnDecimal.Text = ".";
            btnDecimal.UseVisualStyleBackColor = false;
            btnDecimal.Click += btnDecimal_Click;

            // btnPlus
            btnPlus.BackColor = Color.FromArgb(230, 240, 252);
            btnPlus.Font = new Font("Tahoma", 12F, FontStyle.Bold);
            btnPlus.ForeColor = Color.FromArgb(0, 70, 160);
            btnPlus.Location = new Point(186, 212);
            btnPlus.Name = "btnPlus";
            btnPlus.Size = new Size(52, 42);
            btnPlus.TabIndex = 17;
            btnPlus.Text = "+";
            btnPlus.UseVisualStyleBackColor = false;
            btnPlus.Click += OperatorButton_Click;

            // btnEquals
            btnEquals.BackColor = Color.FromArgb(220, 236, 252);
            btnEquals.Font = new Font("Tahoma", 13F, FontStyle.Bold);
            btnEquals.ForeColor = Color.FromArgb(0, 70, 160);
            btnEquals.Location = new Point(12, 260);
            btnEquals.Name = "btnEquals";
            btnEquals.Size = new Size(226, 42);
            btnEquals.TabIndex = 18;
            btnEquals.Text = "=";
            btnEquals.UseVisualStyleBackColor = false;
            btnEquals.Click += btnEquals_Click;

            // Form1
            AutoScaleDimensions = new SizeF(7F, 14F);
            AutoScaleMode = AutoScaleMode.Font;
            BackColor = Color.FromArgb(236, 233, 216);
            ClientSize = new Size(250, 314);
            Controls.Add(lblTitle);
            Controls.Add(txtDisplay);
            Controls.Add(btn1);
            Controls.Add(btn2);
            Controls.Add(btn3);
            Controls.Add(btnDivide);
            Controls.Add(btn4);
            Controls.Add(btn5);
            Controls.Add(btn6);
            Controls.Add(btnMultiply);
            Controls.Add(btn7);
            Controls.Add(btn8);
            Controls.Add(btn9);
            Controls.Add(btnMinus);
            Controls.Add(btnClear);
            Controls.Add(btn0);
            Controls.Add(btnDecimal);
            Controls.Add(btnPlus);
            Controls.Add(btnEquals);
            Font = new Font("Tahoma", 9F, FontStyle.Regular);
            FormBorderStyle = FormBorderStyle.FixedSingle;
            MaximizeBox = false;
            Name = "Form1";
            StartPosition = FormStartPosition.CenterScreen;
            Text = "Calculator";
            ResumeLayout(false);
            PerformLayout();
        }

        #endregion
    }
}
