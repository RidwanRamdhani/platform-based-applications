import 'package:flutter/material.dart';

// ── Text Field Generik ──────────────────────────────────────────
class CustomTextFormField extends StatelessWidget {
  final TextEditingController controller;
  final String label;
  final String hint;
  final bool obscureText;
  final bool readOnly;
  final Widget? prefixIcon;
  final String? Function(String?) validator;
  final VoidCallback? onTap;

  const CustomTextFormField({
    super.key,
    required this.controller,
    required this.label,
    required this.hint,
    required this.validator,
    this.obscureText = false,
    this.readOnly = false,
    this.prefixIcon,
    this.onTap,
  });

  @override
  Widget build(BuildContext context) {
    return TextFormField(
      controller: controller,
      obscureText: obscureText,
      readOnly: readOnly,
      decoration: InputDecoration(
        labelText: label,
        hintText: hint,
        prefixIcon: prefixIcon,
        border: const OutlineInputBorder(),
      ),
      onTap: onTap,
      validator: validator,
    );
  }
}

// ── Gender Radio Group ──────────────────────────────────────────
class GenderRadioGroup extends StatelessWidget {
  final String groupValue;
  final ValueChanged<String?> onChanged;

  const GenderRadioGroup({
    super.key,
    required this.groupValue,
    required this.onChanged,
  });

  @override
  Widget build(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        const Text(
          "Gender",
          style: TextStyle(fontWeight: FontWeight.bold),
        ),
        RadioListTile<String>(
          title: const Text("Laki-laki"),
          value: "Laki-laki",
          groupValue: groupValue,
          onChanged: onChanged,
        ),
        RadioListTile<String>(
          title: const Text("Perempuan"),
          value: "Perempuan",
          groupValue: groupValue,
          onChanged: onChanged,
        ),
      ],
    );
  }
}

// ── Dropdown Program Studi ──────────────────────────────────────
class ProdiDropdown extends StatelessWidget {
  final String? value;
  final List<String> items;
  final ValueChanged<String?> onChanged;

  const ProdiDropdown({
    super.key,
    required this.value,
    required this.items,
    required this.onChanged,
  });

  @override
  Widget build(BuildContext context) {
    return DropdownButtonFormField<String>(
      decoration: const InputDecoration(
        labelText: "Program Studi",
        border: OutlineInputBorder(),
      ),
      value: value,
      items: items
          .map((e) => DropdownMenuItem(value: e, child: Text(e)))
          .toList(),
      onChanged: onChanged,
      validator: (v) => v == null ? 'Pilih Program Studi' : null,
    );
  }
}

// ── Checkbox Persetujuan ────────────────────────────────────────
class PersetujuanCheckbox extends StatelessWidget {
  final bool value;
  final ValueChanged<bool?> onChanged;

  const PersetujuanCheckbox({
    super.key,
    required this.value,
    required this.onChanged,
  });

  @override
  Widget build(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        CheckboxListTile(
          title: const Text("Saya menyetujui syarat dan ketentuan"),
          value: value,
          onChanged: onChanged,
          controlAffinity: ListTileControlAffinity.leading,
        ),
        if (!value)
          const Padding(
            padding: EdgeInsets.only(left: 12),
            child: Text(
              "Persetujuan wajib dicentang",
              style: TextStyle(color: Colors.red, fontSize: 12),
            ),
          ),
      ],
    );
  }
}