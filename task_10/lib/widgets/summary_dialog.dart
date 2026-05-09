import 'package:flutter/material.dart';

class SummaryDialog extends StatelessWidget {
  final String nama;
  final String email;
  final String gender;
  final String? prodi;
  final String tanggal;

  const SummaryDialog({
    super.key,
    required this.nama,
    required this.email,
    required this.gender,
    required this.prodi,
    required this.tanggal,
  });

  @override
  Widget build(BuildContext context) {
    return AlertDialog(
      title: const Text("Ringkasan Data"),
      content: Column(
        mainAxisSize: MainAxisSize.min,
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text("Nama        : $nama"),
          Text("Email         : $email"),
          Text("Gender      : $gender"),
          Text("Prodi          : $prodi"),
          Text("Tgl Lahir    : $tanggal"),
        ],
      ),
      actions: [
        TextButton(
          onPressed: () => Navigator.pop(context),
          child: const Text("Tutup"),
        ),
      ],
    );
  }
}