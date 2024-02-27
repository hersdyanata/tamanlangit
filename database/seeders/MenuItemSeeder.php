<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Divider;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $main = Divider::create([
            'title' => 'Main',
            'order' => 1
        ]);

        Menu::create([
            'title' => 'Dashboard',
            'divider_id' => 1,
            'icon' => 'icon-home2',
            'order' => 1,
            'route' => 'dashboard'
        ]);

        // Wahana
        $wahana = Divider::create([
            'title' => 'Wahana',
            'order' => 2
        ]);

        Menu::create([
            'title' => 'Paket Wahana',
            'divider_id' => $wahana->id,
            'icon' => 'icon-images3',
            'order' => 1,
            'route' => 'wahana.paket'
        ]);

        Menu::create([
            'title' => 'Monitoring Wahana',
            'divider_id' => $wahana->id,
            'icon' => 'icon-eye4',
            'order' => 2,
            'route' => 'wahana.monitoring'
        ]);

        Menu::create([
            'title' => 'Kupon',
            'divider_id' => $wahana->id,
            'icon' => 'icon-ticket',
            'order' => 1,
            'route' => 'wahana.kupon'
        ]);

        // Manajemen Inventory
        $inventory = Divider::create([
            'title' => 'Inventory Management',
            'order' => 3
        ]);

        Menu::create([
            'title' => 'Kategori Produk',
            'divider_id' => $inventory->id,
            'icon' => 'icon-price-tags',
            'order' => 1,
            'route' => 'inventory.kategori'
        ]);

        Menu::create([
            'title' => 'Produk',
            'divider_id' => $inventory->id,
            'icon' => 'icon-stack2',
            'order' => 2,
            'route' => 'inventory.produk'
        ]);

        Menu::create([
            'title' => 'Pembelian',
            'divider_id' => $inventory->id,
            'icon' => 'icon-truck',
            'order' => 3,
            'route' => 'inventory.purchasing'
        ]);

        Menu::create([
            'title' => 'Stock',
            'divider_id' => $inventory->id,
            'icon' => 'icon-truck',
            'order' => 4,
            'route' => 'inventory.stock'
        ]);

        // CMS
        $cms = Divider::create([
            'title' => 'Content Management System',
            'order' => 4
        ]);

        $perusahaan = Menu::create([
            'title' => 'Perusahaan',
            'divider_id' => $cms->id,
            'icon' => 'icon-office',
            'order' => 1,
            'route' => '#'
        ]);

        Menu::create([
            'title' => 'Profile',
            'divider_id' => $cms->id,
            'icon' => 'icon-circle',
            'order' => 2,
            'route' => 'company.profile',
            'parent_id' => $perusahaan->id
        ]);

        Menu::create([
            'title' => 'Kontak',
            'divider_id' => $cms->id,
            'icon' => 'icon-circle',
            'order' => 2,
            'route' => 'company.contact',
            'parent_id' => $perusahaan->id
        ]);

        Menu::create([
            'title' => 'Syarat & Ketentuan',
            'divider_id' => $cms->id,
            'icon' => 'icon-circle',
            'order' => 3,
            'route' => 'company.terms',
            'parent_id' => $perusahaan->id
        ]);

        Menu::create([
            'title' => 'FAQ',
            'divider_id' => $cms->id,
            'icon' => 'icon-circle',
            'order' => 4,
            'route' => 'company.faq',
            'parent_id' => $perusahaan->id
        ]);

        Menu::create([
            'title' => 'Privacy Policy',
            'divider_id' => $cms->id,
            'icon' => 'icon-circle',
            'order' => 5,
            'route' => 'company.privacy',
            'parent_id' => $perusahaan->id
        ]);

        $blog = Menu::create([
            'title' => 'Blog',
            'divider_id' => $cms->id,
            'icon' => 'icon-magazine',
            'order' => 2,
            'route' => '#',
        ]);

        Menu::create([
            'title' => 'Kategori',
            'divider_id' => $cms->id,
            'icon' => 'icon-circle',
            'order' => 5,
            'route' => 'blog.kategori',
            'parent_id' => $blog->id
        ]);

        Menu::create([
            'title' => 'Artikel',
            'divider_id' => $cms->id,
            'icon' => 'icon-circle',
            'order' => 5,
            'route' => 'blog.post',
            'parent_id' => $blog->id
        ]);

        // Transaksi
        $transaksi = Divider::create([
            'title' => 'Transaksi',
            'order' => 5
        ]);

        Menu::create([
            'title' => 'Kasir Inventory',
            'divider_id' => $transaksi->id,
            'icon' => 'icon-printer',
            'order' => 1,
            'route' => 'transaksi.inventory',
        ]);

        Menu::create([
            'title' => 'Reservasi On-Site',
            'divider_id' => $transaksi->id,
            'icon' => 'icon-calendar22',
            'order' => 2,
            'route' => 'transaksi.reservasi',
        ]);

        Menu::create([
            'title' => 'Check-In Confirmation',
            'divider_id' => $transaksi->id,
            'icon' => 'icon-enter',
            'order' => 3,
            'route' => 'transaksi.checkin',
        ]);

        Menu::create([
            'title' => 'Check-Out Confirmation',
            'divider_id' => $transaksi->id,
            'icon' => 'icon-exit',
            'order' => 4,
            'route' => 'transaksi.checkin',
        ]);

        // Parkir
        $parkir = Divider::create([
            'title' => 'Management Parkir',
            'order' => 6
        ]);

        Menu::create([
            'title' => 'Data Parkir',
            'divider_id' => $parkir->id,
            'icon' => 'icon-grid52',
            'order' => 1,
            'route' => 'transaksi.parkir',
        ]);

        Menu::create([
            'title' => 'Kasir Parkir Masuk',
            'divider_id' => $parkir->id,
            'icon' => 'icon-circle-left2',
            'order' => 2,
            'route' => 'transaksi.parkir.masuk',
        ]);

        Menu::create([
            'title' => 'Kasir Parkir Keluar',
            'divider_id' => $parkir->id,
            'icon' => 'icon-circle-right2',
            'order' => 3,
            'route' => 'transaksi.parkir.keluar',
        ]);

        // Manajemen User
        $um = Divider::create([
            'title' => 'User Management',
            'order' => 7
        ]);

        Menu::create([
            'title' => 'User Group',
            'divider_id' => $um->id,
            'icon' => 'icon-users4',
            'order' => 1,
            'route' => 'um.group',
        ]);

        Menu::create([
            'title' => 'User',
            'divider_id' => $um->id,
            'icon' => 'icon-users2',
            'order' => 2,
            'route' => 'um.user',
        ]);

        // Laporan
        $laporan = Divider::create([
            'title' => 'Printable Report',
            'order' => 8
        ]);

        Menu::create([
            'title' => 'Income Reservasi',
            'divider_id' => $laporan->id,
            'icon' => 'icon-circle',
            'order' => 2,
            'route' => 'report.reservasi',
        ]);

        Menu::create([
            'title' => 'Income Inventory',
            'divider_id' => $laporan->id,
            'icon' => 'icon-circle',
            'order' => 2,
            'route' => 'report.inventory',
        ]);

        Menu::create([
            'title' => 'Income Pakir',
            'divider_id' => $laporan->id,
            'icon' => 'icon-circle',
            'order' => 2,
            'route' => 'report.parkir',
        ]);

        Menu::create([
            'title' => 'Expense Pembelian',
            'divider_id' => $laporan->id,
            'icon' => 'icon-circle',
            'order' => 2,
            'route' => 'report.purchasing',
        ]);
    }
}
