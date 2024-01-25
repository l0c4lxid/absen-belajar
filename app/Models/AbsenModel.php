<?php

namespace App\Models;

use CodeIgniter\Model;

class AbsenModel extends Model
{
    protected $table = 'tbl_absen';
    protected $primaryKey = 'id_absen';
    protected $allowedFields = ['id_user', 'berita_acara', 'jam_masuk', 'jam_keluar', 'keterangan', 'masuk_telat', 'keluar_telat'];
    public function getAbsenByUserId($id_user, $bulan = null, $tahun = null)
    {
        $builder = $this->where('id_user', $id_user);

        // Perform filtering based on bulan and tahun if they are provided
        if ($bulan !== null && $tahun !== null) {
            $builder->where('MONTH(jam_keluar)', $bulan);
            $builder->where('YEAR(jam_keluar)', $tahun);
        }

        return $builder->findAll();
    }
    public function getAbsenSatu()
    {
        $results = $this->select('tbl_absen.*, user.username, user.password, user.nama, user.alamat, user.no_telp')
            ->join('tbl_user as user', 'user.id_user = tbl_absen.id_user')
            ->join('tbl_devisi as devisi', 'devisi.id_devisi = user.id_devisi')
            ->where('user.level_user', 2)
            ->findAll();

        // Memisahkan tanggal dan waktu untuk setiap data
        foreach ($results as &$absen) {
            if (isset($absen['jam_masuk'])) {
                $absen['tanggal_masuk'] = date('Y-m-d', strtotime($absen['jam_masuk']));
                $absen['waktu_masuk'] = date('H:i:s', strtotime($absen['jam_masuk']));
            } else {
                $absen['tanggal_masuk'] = '';
                $absen['waktu_masuk'] = '';
            }

            if (isset($absen['jam_keluar'])) {
                $absen['tanggal_keluar'] = date('Y-m-d', strtotime($absen['jam_keluar']));
                $absen['waktu_keluar'] = date('H:i:s', strtotime($absen['jam_keluar']));
            } else {
                $absen['tanggal_keluar'] = '';
                $absen['waktu_keluar'] = '';
            }
        }

        return $results;
    }
    public function getAbsenDua()
    {
        $results = $this->select('tbl_absen.*, user.username, user.password, user.nama, user.alamat, user.no_telp')
            ->join('tbl_user as user', 'user.id_user = tbl_absen.id_user')
            ->join('tbl_devisi as devisi', 'devisi.id_devisi = user.id_devisi')
            ->where('user.level_user', 3)
            ->findAll();

        // Memisahkan tanggal dan waktu untuk setiap data
        foreach ($results as &$absen) {
            if (isset($absen['jam_masuk'])) {
                $absen['tanggal_masuk'] = date('Y-m-d', strtotime($absen['jam_masuk']));
                $absen['waktu_masuk'] = date('H:i:s', strtotime($absen['jam_masuk']));
            } else {
                $absen['tanggal_masuk'] = '';
                $absen['waktu_masuk'] = '';
            }

            if (isset($absen['jam_keluar'])) {
                $absen['tanggal_keluar'] = date('Y-m-d', strtotime($absen['jam_keluar']));
                $absen['waktu_keluar'] = date('H:i:s', strtotime($absen['jam_keluar']));
            } else {
                $absen['tanggal_keluar'] = '';
                $absen['waktu_keluar'] = '';
            }
        }

        return $results;
    }
}