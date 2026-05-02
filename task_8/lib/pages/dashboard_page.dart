import 'package:flutter/material.dart';
import '../widgets/profil_card.dart';
import '../widgets/info_card.dart';
import '../widgets/menu_card.dart';

class DashboardPage extends StatelessWidget {
  const DashboardPage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text(
          'Aplikasi Akademik',
          style: TextStyle(fontWeight: FontWeight.bold),
        ),
        centerTitle: true,
        backgroundColor: Colors.indigo,
        foregroundColor: Colors.white,
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.stretch,
          children: [
            // 1. Card Profil Mahasiswa
            const ProfilCard(
              nama: 'Budi Santoso',
              nim: '123456789',
              prodi: 'Teknik Informatika',
            ),

            const SizedBox(height: 14),

            // 2. IPK & SKS sejajar menggunakan Expanded
            Row(
              children: const [
                Expanded(child: InfoCard(label: 'IPK', value: '3.85')),
                SizedBox(width: 12),
                Expanded(child: InfoCard(label: 'SKS Ditempuh', value: '112')),
              ],
            ),

            const SizedBox(height: 20),

            // 3. Label section menu
            const Text(
              'Menu Akademik',
              style: TextStyle(
                fontSize: 16,
                fontWeight: FontWeight.bold,
                color: Colors.indigo,
              ),
            ),

            const SizedBox(height: 10),

            // 4. GridView 4 menu
            GridView.count(
              crossAxisCount: 4,
              crossAxisSpacing: 10,
              mainAxisSpacing: 10,
              childAspectRatio: 0.85,
              shrinkWrap: true,
              physics: const NeverScrollableScrollPhysics(),
              children: const [
                MenuCard(title: 'KRS',      icon: Icons.assignment),
                MenuCard(title: 'Jadwal',   icon: Icons.schedule),
                MenuCard(title: 'Nilai',    icon: Icons.grade),
                MenuCard(title: 'Presensi', icon: Icons.checklist),
              ],
            ),
          ],
        ),
      ),
    );
  }
}