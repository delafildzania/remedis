<?php
require_once("soap.php");

class Anak {
 use soap {
  soap::umum as soap_dokter;
 }
 public function assesmen_perawat($db, $con, $common, $dataset) {
  $sc = $db->getSchema();
  $defInc = array("kd_user" => $common['kd_user']);
  $defExc = array("counter");
  $results = array();
  $anamnesis = $dataset['anamnesis'];
  $cari_query = "select counter, keluhan, rp_dahulu_keterangan, rp_dahulu, rp_keluarga, riwayat_operasi, riwayat_obat, riwayat_alergi, kd_user from {$sc['rem']}anamnesis where single_id = $1 order by tgl_entry desc limit 1";
  $ischanged = isChanged($con, $db, $common['single_id'], $cari_query, $anamnesis, $defInc, $defExc);
  if ($ischanged['state']) {
   $params = array();
   array_push($params, $common['single_id'], $ischanged['counter'], $common['tgl_sekarang'], $anamnesis['keluhan'], $anamnesis['riwayat_penyakit']['dahulu']['keterangan'], $anamnesis['riwayat_penyakit']['dahulu']['value'], $anamnesis['riwayat_penyakit']['keluarga'], $anamnesis['riwayat_operasi'], $anamnesis['riwayat_obat'], $anamnesis['riwayat_alergi'], $common['kd_user']);
   $query = "insert into {$sc['rem']}anamnesis (single_id, counter, tgl_entry, keluhan, rp_dahulu_keterangan, rp_dahulu, rp_keluarga, riwayat_operasi, riwayat_obat, riwayat_alergi, kd_user)
             values($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11)";
   $rows = $db->query($con, $query, $params);
   if (count($rows) > 0) {
    array_push($results, true);
   }else {
    array_push($results, false);
   }
  }else {
   array_push($results, true);
  }
  $defInc = array();
  $defExc = array();
  $anamnesis = $dataset['anamnesis'];
  $cari_query = "select rt_kembang, rt_kembang_ket, riwayat_kelahiran, umur_kelahiran, cara_kelahiran, riwayat_vaksinasi, tgl_vaksinasi, jenis_vaksinasi from {$sc['rem']}anamnesis_anak where single_id = $1 order by tgl_entry desc limit 1";
  $ischanged = isChanged($con, $db, $common['single_id'], $cari_query, $anamnesis, $defInc, $defExc);
  if ($ischanged['state']) {
   $params = array();
   array_push($params, $common['single_id'], $common['tgl_sekarang'], $anamnesis['rt_kembang'], $anamnesis['rt_kembang_ket'], $anamnesis['riwayat_kelahiran'], $anamnesis['umur_kelahiran'], $anamnesis['cara_kelahiran'], $anamnesis['riwayat_vaksinasi'], $anamnesis['tgl_vaksinasi'], $anamnesis['jenis_vaksinasi']);
   $query = "insert into {$sc['rem']}anamnesis_anak (single_id, tgl_entry, rt_kembang, rt_kembang_ket, riwayat_kelahiran, umur_kelahiran, cara_kelahiran, riwayat_vaksinasi, tgl_vaksinasi, jenis_vaksinasi)
             values($1, $2, $3, $4, $5, $6, $7, $8, $9, $10)";
   $rows = $db->query($con, $query, $params);
   if (count($rows) > 0) {
    array_push($results, true);
   }else {
    array_push($results, false);
   }
  }else {
   array_push($results, true);
  }
  $fisik = $dataset['pemeriksaan_fisik'];
  $params = array($common['single_id']);
  $counter_query = "select counter from {$sc['rem']}penyakit_dalam where single_id = $1 order by tgl_entry desc limit 1";
  $nextCounter = getCounter($con, $db, $common['single_id'], $counter_query);
  $params = array();
  array_push($params, $common['single_id'], $nextCounter, $common['tgl_sekarang'], $fisik['keadaan_umum'], $fisik['kesadaran'], $fisik['gcs']['mata'], $fisik['gcs']['suara'], $fisik['gcs']['gerakan'], $fisik['tanda_vital']['td_1'], $fisik['tanda_vital']['td_2'], $fisik['tanda_vital']['nadi'], $fisik['tanda_vital']['suhu'], $fisik['tanda_vital']['rr'], $common['kd_user']);
  $query = "insert into {$sc['rem']}pemeriksaan_fisik (single_id, counter, tgl_entry, keadaan_umum, kesadaran, gcs_mata, gcs_suara, gcs_gerakan, td1, td2, nadi, suhu, rr, kd_user)
            values($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13, $14)";
  $rows = $db->query($con, $query, $params);
  if (count($rows) > 0) {
   array_push($results, true);
  }else {
   array_push($results, false);
  }
  $defInc = array("kd_user" => $common['kd_user']);
  $defExc = array("counter");
  $psiko = $dataset['psikososial'];
  $cari_query = "select counter, tahu, respon, bahasa, penerjemah, asuransi, keluarga, hubungan, support, tinggal, penganiayaan, kd_user from {$sc['rem']}psikososial where single_id = $1 order by tgl_entry desc limit 1";
  $ischanged = isChanged($con, $db, $common['single_id'], $cari_query, $psiko, $defInc, $defExc);
  if ($ischanged['state']) {
   $params = array();
   array_push($params, $common['single_id'], $ischanged['counter'], $common['tgl_sekarang'], $psiko['pengetahuan'], $psiko['respon'], $psiko['bahasa'], $psiko['penerjemah'], $psiko['asuransi'], $psiko['keluarga'], $psiko['hubungan'], $psiko['support_keluarga'], $psiko['tinggal'], $psiko['penganiayaan'], $common['kd_user']);
   $query = "insert into {$sc['rem']}psikososial (single_id, counter, tgl_entry, tahu, respon, bahasa, penerjemah, asuransi, keluarga, hubungan, support, tinggal, penganiayaan, kd_user)
             values($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13, $14)";
   $rows = $db->query($con, $query, $params);
   if (count($rows) > 0) {
    array_push($results, true);
   }else {
    array_push($results, false);
   }
  }else {
   array_push($results, true);
  }
  $nyeri = $dataset['nyeri'];
  $cari_query = "select counter, skala, lokasi, lama, lama_waktu, frekuensi, menjalar, menjalar_keterangan, kd_user from {$sc['rem']}skrining_nyeri where single_id = $1 order by tgl_entry desc limit 1";
  $ischanged = isChanged($con, $db, $common['single_id'], $cari_query, $nyeri, $defInc, $defExc);
  if ($ischanged['state']) {
   $params = array();
   array_push($params, $common['single_id'], $ischanged['counter'], $common['tgl_sekarang'], $nyeri['skala'], $nyeri['lokasi'], $nyeri['lama'], $nyeri['lama_waktu'], $nyeri['frekuensi'], $nyeri['menjalar']['value'], $nyeri['menjalar']['keterangan'], $common['kd_user']);
   $query = "insert into {$sc['rem']}skrining_nyeri (single_id, counter, tgl_entry, skala, lokasi, lama, lama_waktu, frekuensi, menjalar, menjalar_keterangan, kd_user)
             values($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11)";
   $rows = $db->query($con, $query, $params);
   if (count($rows) > 0) {
    array_push($results, true);
   }else {
    array_push($results, false);
   }
  }else {
   array_push($results, true);
  }
  $defInc = array();
  $defExc = array();
  $nyeri = $dataset['nyeri'];
  $cari_query = "select flacc_wajah, flacc_kaki, flacc_aktifitas, flacc_menangis, flacc_bersuara, flacc_total from {$sc['rem']}skrining_nyeri_anak where single_id = $1 order by tgl_entry desc limit 1";
  $ischanged = isChanged($con, $db, $common['single_id'], $cari_query, $nyeri, $defInc, $defExc);
  if ($ischanged['state']) {
   $params = array();
   array_push($params, $common['single_id'], $common['tgl_sekarang'], $nyeri['flacc']['wajah'], $nyeri['flacc']['kaki'], $nyeri['flacc']['aktifitas'], $nyeri['flacc']['menangis'], $nyeri['flacc']['bersuara'], $nyeri['flacc']['total']);
   $query = "insert into {$sc['rem']}skrining_nyeri_anak (single_id, tgl_entry, flacc_wajah, flacc_kaki, flacc_aktifitas, flacc_menangis, flacc_bersuara, flacc_total)
             values($1, $2, $3, $4, $5, $6, $7, $8)";
   $rows = $db->query($con, $query, $params);
   if (count($rows) > 0) {
    array_push($results, true);
   }else {
    array_push($results, false);
   }
  }else {
   array_push($results, true);
  }
  $defInc = array("kd_user" => $common['kd_user']);
  $defExc = array("counter");
  $fungsional = $dataset['fungsional'];
  $cari_query = "select counter, aktifitas, bantuan, alat_bantu, kd_user from {$sc['rem']}status_fungsional where single_id = $1 order by tgl_entry desc limit 1";
  $ischanged = isChanged($con, $db, $common['single_id'], $cari_query, $fungsional, $defInc, $defExc);
  if ($ischanged['state']) {
   $params = array();
   array_push($params, $common['single_id'], $ischanged['counter'], $common['tgl_sekarang'], $fungsional['aktifitas']['value'], $fungsional['aktifitas']['keterangan'], $fungsional['alat_bantu'], $common['kd_user']);
   $query = "insert into {$sc['rem']}status_fungsional (single_id, counter, tgl_entry, aktifitas, bantuan, alat_bantu, kd_user)
             values($1, $2, $3, $4, $5, $6, $7)";
   $rows = $db->query($con, $query, $params);
   if (count($rows) > 0) {
    array_push($results, true);
   }else {
    array_push($results, false);
   }
  }else {
   array_push($results, true);
  }
  $jatuh = $dataset['risiko_jatuh'];
  $cari_query = "select counter, skor_umur, skor_jenis_kelamin, skor_diagnosa, skor_gangguan_kognitif, skor_faktor_lingkungan, skor_respon_obat, skor_penggunaan_obat, skor_total, kd_user from {$sc['rem']}risiko_jatuh_anak where single_id = $1 order by tgl_entry desc limit 1";
  $ischanged = isChanged($con, $db, $common['single_id'], $cari_query, $jatuh, $defInc, $defExc);
  if ($ischanged['state']) {
   $params = array();
   array_push($params, $common['single_id'], $ischanged['counter'], $common['tgl_sekarang'], $nyeri['umur'], $nyeri['jenis_kelamin'], $nyeri['diagnosa'], $nyeri['gangguan_kognitif'], $nyeri['faktor_lingkungan'], $nyeri['respon_obat'], $nyeri['penggunaan_obat'], $nyeri['total'], $common['kd_user']);
   $query = "insert into {$sc['rem']}risiko_jatuh_anak (single_id, counter, tgl_entry, skor_umur, skor_jenis_kelamin, skor_diagnosa, skor_gangguan_kognitif, skor_faktor_lingkungan, skor_respon_obat, skor_penggunaan_obat, skor_total, kd_user)
             values($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12)";
   $rows = $db->query($con, $query, $params);
   if (count($rows) > 0) {
    array_push($results, true);
   }else {
    array_push($results, false);
   }
  }else {
   array_push($results, true);
  }
  $malnutrisi = $dataset['malnutrisi'];
  $cari_query = "select counter, skor_kurus, skor_penurunan_bb, skor_kondisi, skor_penyakit, skor_total, kd_user from {$sc['rem']}skrining_malnutrisi_anak where single_id = $1 order by tgl_entry desc limit 1";
  $ischanged = isChanged($con, $db, $common['single_id'], $cari_query, $gizi, $defInc, $defExc);
  if ($ischanged['state']) {
   $params = array();
   array_push($params, $common['single_id'], $ischanged['counter'], $common['tgl_sekarang'], $malnutrisi['kurus'], $malnutrisi['penurunan_bb'], $malnutrisi['kondisi'], $malnutrisi['penyakit'], $malnutrisi['total'], $common['kd_user']);
   $query = "insert into {$sc['rem']}skrining_malnutrisi_anak (single_id, counter, tgl_entry, skor_kurus, skor_penurunan_bb, skor_kondisi, skor_penyakit, skor_total, kd_user)
             values($1, $2, $3, $4, $5, $6, $7, $8, $9)";
   $rows = $db->query($con, $query, $params);
   if (count($rows) > 0) {
    array_push($results, true);
   }else {
    array_push($results, false);
   }
  }else {
   array_push($results, true);
  }
  $edukasi = $dataset['edukasi'];
  $cari_query = "select counter, butuh, keterangan, kd_user from {$sc['rem']}edukasi where single_id = $1 order by tgl_entry desc limit 1";
  $ischanged = isChanged($con, $db, $common['single_id'], $cari_query, $edukasi, $defInc, $defExc);
  if ($ischanged['state']) {
   $params = array();
   array_push($params, $common['single_id'], $ischanged['counter'], $common['tgl_sekarang'], $edukasi['butuh']['value'], $edukasi['butuh']['keterangan'], $common['kd_user']);
   $query = "insert into {$sc['rem']}edukasi (single_id, counter, tgl_entry, butuh, keterangan, kd_user)
             values($1, $2, $3, $4, $5, $6)";
   $rows = $db->query($con, $query, $params);
   if (count($rows) > 0) {
    array_push($results, true);
   }else {
    array_push($results, false);
   }
  }else {
   array_push($results, true);
  }
  $keperawatan = $dataset['diagnosa_keperawatan'];
  $cari_query = "select counter, pilihan, kd_user from {$sc['rem']}diagnosa_keperawatan where single_id = $1 order by tgl_entry desc limit 1";
  $ischanged = isChanged($con, $db, $common['single_id'], $cari_query, $keperawatan, $defInc, $defExc);
  if ($ischanged['state']) {
   $params = array();
   array_push($params, $common['single_id'], $ischanged['counter'], $common['tgl_sekarang'], $keperawatan, $common['kd_user']);
   $query = "insert into {$sc['rem']}diagnosa_keperawatan (single_id, counter, tgl_entry, pilihan, kd_user)
             values($1, $2, $3, $4, $5)";
   $rows = $db->query($con, $query, $params);
   if (count($rows) > 0) {
    array_push($results, true);
   }else {
    array_push($results, false);
   }
  }else {
   array_push($results, true);
  }
  $rencana = $dataset['perencanaan'];
  $cari_query = "select counter, rencana, health, lainnya, kd_user from {$sc['rem']}perencanaan where single_id = $1 order by tgl_entry desc limit 1";
  $ischanged = isChanged($con, $db, $common['single_id'], $cari_query, $rencana, $defInc, $defExc);
  if ($ischanged['state']) {
   $params = array();
   array_push($params, $common['single_id'], $ischanged['counter'], $common['tgl_sekarang'], $rencana['value'], $rencana['health_education'], $rencana['lainnya'], $common['kd_user']);
   $query = "insert into {$sc['rem']}perencanaan (single_id, counter, tgl_entry, rencana, health, lainnya, kd_user)
             values($1, $2, $3, $4, $5, $6, $7)";
   $rows = $db->query($con, $query, $params);
   if (count($rows) > 0) {
    array_push($results, true);
   }else {
    array_push($results, false);
   }
  }else {
   array_push($results, true);
  }
  return $results;
 }
 public function assesmen_dokter($db, $con, $common, $dataset) {
  $sc = $db->getSchema();
  $defExcludes = array("counter");
  $results = array();
  //pemeriksaan fisik
  $pfisik = $dataset['pemeriksaan_fisik'];
  $cari_query = "select counter from {$sc['rem']}penyakit_dalam where single_id = $1 order by tgl_entry desc limit 1";
  $nextCounter = getCounter($con, $db, $common['single_id'], $cari_query);
  $params = array();
  array_push($params, $common['single_id'], $nextCounter, $common['tgl_sekarang'], $pfisik['mata'], $pfisik['tht'], $pfisik['leher'], $pfisik['torak']['value'], $pfisik['torak']['jantung'], $pfisik['torak']['paru'], $pfisik['abdomen']['value'], $pfisik['abdomen']['hepar'], $pfisik['abdomen']['lien'], $pfisik['abdomen']['status_gizi'], $pfisik['extremitas'], $common['kd_user']);
  $query = "insert into {$sc['rem']}penyakit_dalam (single_id, counter, tgl_entry, mata, tht, leher, torak, jantung, paru, abdomen, hepar, lien, status_gizi, extremitas, kd_user) values($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13, $14, $15)";
  $rows = $db->query($con, $query, $params);
  if (count($rows) > 0) {
   array_push($results, true);
  }else {
   array_push($results, false);
  }
  return $results;
 }
}
