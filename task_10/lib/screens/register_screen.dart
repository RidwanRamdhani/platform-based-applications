import 'package:flutter/material.dart';
import '../constants/app_data.dart';
import '../widgets/form_fields.dart';
import '../widgets/summary_dialog.dart';

class RegistrasiScreen extends StatefulWidget {
  const RegistrasiScreen({super.key});

  @override
  State<RegistrasiScreen> createState() => _RegistrasiScreenState();
}

class _RegistrasiScreenState extends State<RegistrasiScreen> {
  final _formKey = GlobalKey<FormState>();

  final _namaController     = TextEditingController();
  final _emailController    = TextEditingController();
  final _passwordController = TextEditingController();
  final _tanggalController  = TextEditingController();

  String  _gender        = 'Laki-laki';
  String? _selectedProdi;
  bool    _setuju        = false;

  // ── Date Picker ─────────────────────────────────────────────
  Future<void> _selectDate() async {
    final picked = await showDatePicker(
      context: context,
      initialDate: DateTime.now(),
      firstDate: DateTime(1990),
      lastDate: DateTime(2100),
    );
    if (picked != null) {
      setState(() {
        _tanggalController.text =
            "${picked.day}-${picked.month}-${picked.year}";
      });
    }
  }

  // ── Submit ───────────────────────────────────────────────────
  void _submit() {
    final isValid = _formKey.currentState!.validate() && _setuju;

    if (isValid) {
      showDialog(
        context: context,
        builder: (_) => SummaryDialog(
          nama    : _namaController.text,
          email   : _emailController.text,
          gender  : _gender,
          prodi   : _selectedProdi,
          tanggal : _tanggalController.text,
        ),
      );
    } else if (!_setuju) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(
          content: Text("Centang persetujuan terlebih dahulu"),
        ),
      );
    }
  }

  // ── Build ────────────────────────────────────────────────────
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text("Form Registrasi")),
      body: Padding(
        padding: const EdgeInsets.all(16),
        child: Form(
          key: _formKey,
          child: ListView(
            children: [

              // Nama
              CustomTextFormField(
                controller: _namaController,
                label: "Nama Lengkap",
                hint: "Masukkan nama",
                validator: (v) =>
                    (v == null || v.isEmpty) ? 'Nama tidak boleh kosong' : null,
              ),
              const SizedBox(height: 20),

              // Email
              CustomTextFormField(
                controller: _emailController,
                label: "Email",
                hint: "Masukkan email",
                validator: (v) {
                  if (v == null || v.isEmpty) return 'Email tidak boleh kosong';
                  if (!RegExp(r'^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$').hasMatch(v))
                    return 'Format email tidak valid';
                  return null;
                },
              ),
              const SizedBox(height: 20),

              // Password
              CustomTextFormField(
                controller: _passwordController,
                label: "Password",
                hint: "Masukkan password",
                obscureText: true,
                validator: (v) {
                  if (v == null || v.isEmpty) return 'Password tidak boleh kosong';
                  if (v.length < 6) return 'Password minimal 6 karakter';
                  return null;
                },
              ),
              const SizedBox(height: 20),

              // Gender
              GenderRadioGroup(
                groupValue: _gender,
                onChanged: (v) => setState(() => _gender = v!),
              ),
              const SizedBox(height: 10),

              // Prodi
              ProdiDropdown(
                value: _selectedProdi,
                items: AppData.prodiList,
                onChanged: (v) => setState(() => _selectedProdi = v),
              ),
              const SizedBox(height: 20),

              // Tanggal Lahir
              CustomTextFormField(
                controller: _tanggalController,
                label: "Tanggal Lahir",
                hint: "",
                readOnly: true,
                prefixIcon: const Icon(Icons.calendar_today),
                onTap: _selectDate,
                validator: (v) =>
                    (v == null || v.isEmpty) ? 'Tanggal lahir wajib diisi' : null,
              ),
              const SizedBox(height: 20),

              // Persetujuan
              PersetujuanCheckbox(
                value: _setuju,
                onChanged: (v) => setState(() => _setuju = v!),
              ),
              const SizedBox(height: 30),

              // Tombol Daftar
              SizedBox(
                width: double.infinity,
                child: ElevatedButton(
                  onPressed: _submit,
                  child: const Text("DAFTAR"),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}