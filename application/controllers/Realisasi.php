<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Realisasi extends Render_Controller
{
	public function index()
	{
		// Page Settings
		$this->title 			= 'Realisasi RAB';
		$get_cabang 			= $this->db->get_where('cabangs', ['user_id' => $this->session->userdata('data')['id']])->row_array();
		$id_cabang 				= $get_cabang['id'];
		$npsn 					= $get_cabang['kode'];
		$cabang 				= $get_cabang['nama'];

		if ($this->session->userdata('data')['level'] == 'Super Admin') {
			$this->content 			= 'realisasi-admin';
		} elseif ($this->session->userdata('data')['level'] == 'Admin Sekolah') {
			$get_status				= $this->db->get_where('rabs', ['id_cabang' => $id_cabang])->row_array();
			$this->data['status']	= $get_status['status'];
			$this->data['npsn']  	= $npsn;
			$this->data['cabang']  	= str_replace('%20', ' ', $cabang);
			$this->data['total']	= $this->realisasi->getTotalHarga($npsn);
			$this->content 			= 'realisasi';

			$this->data['id_cabang']  	= $id_cabang;
			$this->data['rabs'] 	= $this->realisasi->getAllDataDetail(null, null, null, $npsn)->result_array();
		}

		$this->navigation 			= ['Realisasi', 'RAB  ', 'Dana RAB'];
		$this->plugins 				= ['datatables', 'select2'];

		// Breadcrumb setting
		$this->breadcrumb_1 		= 'Dashboard';
		$this->breadcrumb_1_url 	= base_url() . 'dashboard';
		$this->breadcrumb_2 		= 'Realisasi';
		$this->breadcrumb_2_url 	= '#';
		$this->breadcrumb_3 		= 'RAB';
		$this->breadcrumb_3_url 	= '';

		// Send data to view
		$this->render();
	}

	// Ajax Data
	public function ajax_data()
	{
		$npsn 	= $this->input->post('npsn');
		$start 	= $this->input->post('start');
		$draw 	= $this->input->post('draw');
		$length = $this->input->post('length');
		$cari 	= $this->input->post('search');
		if (isset($cari['value'])) {
			$_cari = $cari['value'];
		} else {
			$_cari = null;
		}
		$data 	= $this->realisasi->getAllDataDetail($length, $start, $_cari, $npsn)->result_array();
		$count 	= $this->realisasi->getAllDataDetail(null, null, $_cari, $npsn)->num_rows();

		array($cari);
		echo json_encode(array('recordsTotal' => $count, 'recordsFiltered' => $count, 'draw' => $draw, 'search' => $_cari, 'data' => $data));
	}

	public function insert()
	{
		$result = true;
		$datas = json_decode($this->input->post('data'));
		$total_rupiah = $datas->rupiah;
		$total_ringgit = $datas->ringgit;
		for ($i = 0; $i < count($datas->id_rab); $i++) {
			// Input values
			$id 			= $datas->id_rab[$i];
			$id_cabang 		= $datas->id_cabang;
			$nama 			= $datas->nama;
			$keterangan 	= $datas->keterangan;
			$harga_rupiah 	= ((count($datas->id_rab) - 1) == $i) ? $total_rupiah  : $datas->rupiah_rab[$i];
			$harga_ringgit 	= ((count($datas->id_rab) - 1) == $i) ? $total_ringgit  : $datas->ringgit_rab[$i];
			$tanggal 		= $datas->tanggal;
			$gambar			= $datas->gambar;

			// Check values
			if (empty($nama)) $this->output_json(['message' => 'Nama tidak boleh kosong']);

			$r = true;
			$r = $this->realisasi->insert($id, $id_cabang, $nama, $keterangan, $harga_ringgit, $harga_rupiah, $tanggal, $gambar);

			// hitung harga real
			$total_rupiah -= $harga_rupiah;
			$total_ringgit -= $harga_ringgit;

			if ($r !== FALSE) {
				$get_saldo = $this->db->get_where('saldos', ['id_cabang' => $datas->id_cabang])->row_array();
				$total_saldo_ringgit = $get_saldo['total_ringgit'];
				$total_saldo_rupiah = $get_saldo['total_rupiah'];

				$update_saldo['total_ringgit'] = $total_saldo_rupiah - $harga_ringgit;
				$update_saldo['total_rupiah'] = $total_saldo_rupiah - $harga_rupiah;
				$this->db->where('id_cabang', $datas->id_cabang);
				$this->db->update('saldos', $update_saldo);

				//update sisa
				$data_sisa['sisa_ringgit'] = ((count($datas->id_rab) - 1) == $i) ? $datas->sisa_ringgit : 0;
				$data_sisa['sisa_rupiah'] = ((count($datas->id_rab) - 1) == $i) ? $datas->sisa_rupiah : 0;

				$this->db->where('id', $r['id']);
				$this->db->update('realisasis', $data_sisa);
			} else {
				$result = false;
			}
		}

		// //update saldo
		// $get_saldo = $this->db->get_where('saldos', ['id_cabang' => $id_cabang])->row_array();
		// $data['total_ringgit'] = $get_saldo['total_ringgit'] - $harga_ringgit;
		// $data['total_rupiah'] = $get_saldo['total_rupiah'] - $harga_rupiah;

		// $this->db->where('id_cabang', $id_cabang);
		// $this->db->update('saldos', $data);


		$this->output_json(
			[
				'result' => $result
			]
		);
	}

	public function insertUpload()
	{
		echo json_encode(['name' => $this->realisasi->uploadImage()]);
	}

	function getDetailRab()
	{
		$id = $this->input->post('id');
		$get = $this->db->select('a.*,b.kode as npsn, a.nama as nama_aktifitas')->join('cabangs b', 'b.id = a.id_cabang')->get_where('rabs a', ['a.id' => $id])->row_array();
		$this->output_json($get);
	}

	function getDetailRealisasi()
	{
		$id = $this->input->post('id');
		$get = $this->db->select('a.*, b.kode, b.nama as nama_aktifitas, b.total_harga_ringgit, b.total_harga_rupiah, c.kode as npsn, b.kode as kode')->join('rabs b', 'b.id = a.id_rab')->join('cabangs c', 'b.id_cabang = c.id')->get_where('realisasis a', ['a.id' => $id])->row_array();
		$this->output_json($get);
	}


	public function danaSisa()
	{

		// Page Settings
		$this->title 			= 'Realisasi';

		// switch by level
		if ($this->session->userdata('data')['level'] == 'Super Admin') {
			$this->content 			= 'realisasi-dana-sisa-admin';
			// $this->data['dana_sisa'] 	= $this->realisasi->getAllDataDanaSisa(null, null, null, null)->result_array();
		} elseif ($this->session->userdata('data')['level'] == 'Admin Sekolah') {
			$get_cabang 			= $this->db->get_where('cabangs', ['user_id' => $this->session->userdata('data')['id']])->row_array();
			$id_cabang 				= $get_cabang['id'];
			$npsn 					= $get_cabang['kode'];
			$cabang 				= $get_cabang['nama'];

			$get_status				= $this->db->get_where('rabs', ['id_cabang' => $id_cabang])->row_array();
			$this->data['kode']		= $this->realisasi->getAllData(null, null, null, $npsn)->result_array();
			$this->data['status']	= $get_status['status'];
			$this->data['npsn']  	= $npsn;
			$this->data['cabang']  	= str_replace('%20', ' ', $cabang);
			$this->data['total']	= $this->realisasi->getTotalHarga($npsn);
			$this->data['kodeNPSN'] = $this->realisasi->getDataKodeNPSN($id_cabang);
			$this->content 			= 'realisasi-dana-sisa';
			// query dana sisa
			$start 	= $this->input->post('start');
			$draw 	= $this->input->post('draw');
			$length = $this->input->post('length');
			$cari 	= $this->input->post('search');
			if (isset($cari['value'])) {
				$_cari = $cari['value'];
			} else {
				$_cari = null;
			}
			$this->data['id_cabang'] = $id_cabang;
			$this->data['dana_sisa'] 	= $this->realisasi->getAllDataDanaSisa($length, $start, $_cari, $npsn)->result_array();
		}
		$this->navigation 		= ['Realisasi', 'Dana Sisa'];
		$this->plugins 			= ['datatables', 'select2'];

		// Breadcrumb setting
		$this->breadcrumb_1 		= 'Dashboard';
		$this->breadcrumb_1_url 	= base_url() . 'dashboard';
		$this->breadcrumb_2 		= 'Realisasi';
		$this->breadcrumb_2_url 	= base_url() . 'realisasi';
		$this->breadcrumb_3 		= 'Dana Sisa';
		$this->breadcrumb_3_url 	= '';
		// Send data to view
		$this->render();
	}

	// Ajax Data
	public function ajax_data_dana_sisa()
	{
		$npsn 	= $this->input->post('npsn');
		$start 	= $this->input->post('start');
		$draw 	= $this->input->post('draw');
		$length = $this->input->post('length');
		$cari 	= $this->input->post('search');
		if (isset($cari['value'])) {
			$_cari = $cari['value'];
		} else {
			$_cari = null;
		}
		$data 	= $this->realisasi->getAllDataDanaSisa($length, $start, $_cari, $npsn)->result_array();
		$count 	= $this->realisasi->getAllDataDanaSisa(null, null, $_cari, $npsn)->num_rows();

		array($cari);

		echo json_encode(array('recordsTotal' => $count, 'recordsFiltered' => $count, 'draw' => $draw, 'search' => $_cari, 'data' => $data,));
	}

	public function cek_kode()
	{
		$kode = $this->input->post('kode');
		$id_cabang = $this->input->post('id_cabang');
		$data = $this->db->get_where('rabs', ['kode' => $kode, 'id_cabang' => $id_cabang])->row_array();
		echo json_encode($data);
	}

	public function dataTotalSisa()
	{
		$id_cabang = $this->input->post('id_cabang');
		$id_rab = $this->input->post('id_rab');

		$data = $this->db->get_where('realisasis', ['id_cabang' => $id_cabang, 'id_rab' => $id_rab])->row_array();

		echo json_encode($data);
	}

	public function insertSisa()
	{

		$this->load->model('rab/CabangModel', 'cabang');
		$datas = json_decode($this->input->post('data'));
		$result = true;
		$sisa_harga_ringgit = 0;
		$sisa_harga_rupiah = 0;

		for ($i = 0; $i < count($datas->id_realisasi); $i++) {
			$id_realisasi	= $datas->id_realisasi[$i];
			$id_rab 		= $datas->id_rab[$i];
			$id_cabang		= $datas->id_cabang;
			$sisa_ringgit	= $datas->sisa_ringgit[$i];
			$sisa_rupiah 	= $datas->sisa_rupiah[$i];
			$kategori 	    = $datas->kategori;
			$keterangan 	= $datas->keterangan;

			$ringgit		= $datas->ringgit;
			$rupiah			= $datas->rupiah;

			// assignment dana sisa
			$sisa_harga_ringgit += $sisa_ringgit;
			$sisa_harga_rupiah += $sisa_rupiah;

			$jumlah_ringgit	= $ringgit + $sisa_harga_ringgit;
			$jumlah_rupiah	= $rupiah + $sisa_harga_rupiah;

			// Check values
			if (empty($nama)) $this->output_json(['message' => 'Nama tidak boleh kosong']);

			$r = $this->realisasi->insertSisa($id_realisasi, $sisa_ringgit, $sisa_rupiah, $kategori, $id_rab, $jumlah_ringgit, $jumlah_rupiah, $keterangan);


			if ($r !== FALSE) {
				//update tambah sisa
				// $cek = $this->db->get_where('rabs', ['id' => $id_rab])->row_array();
				// $ringgit_awal = $cek['total_harga_ringgit'];
				// $rupiah_awal = $cek['total_harga_ringgit'];

				// $data['total_harga_ringgit'] = $ringgit_awal + $sisa_ringgit;
				// $data['total_harga_rupiah'] = $rupiah_awal + $sisa_rupiah;

				// $this->db->where('id', $id_rab);
				// $this->db->update('rabs', $data);
				// $this->db->reset_query();
				// //update saldo
				// $get_saldo = $this->db->get_where('saldos', ['id_cabang' => $id_cabang])->row_array();
				// $data_saldo['total_ringgit'] = $get_saldo['total_ringgit'] - $sisa_ringgit;
				// $data_saldo['total_rupiah'] = $get_saldo['total_rupiah'] - $sisa_rupiah;

				// $this->db->where('id_cabang', $id_cabang);
				// $this->db->update('saldos', $data_saldo);

				//update sisa
				// $cek_realisasi = $this->db->get_where('realisasis', ['id' => $id_realisasi])->row_array();
				// $dana_sisa['sisa_ringgit'] 	= 0;
				// $dana_sisa['sisa_rupiah'] 	= 0;
				// $this->db->where('id_rab', $id_realisasi);
				// $this->db->update('realisasis', $dana_sisa);

				// query manual code diatas tidak jalan
				$result = $this->db->query("UPDATE realisasis SET sisa_rupiah = '0',sisa_ringgit = '0' WHERE realisasis.id = '$id_realisasi'");
			} else {
				$result = false;
			}
		}

		if ($result) {
			if ($datas->kategori == "rab") {
				// simpan rabs baru
				$total_harga_ringgit = $sisa_harga_ringgit + $datas->ringgit;
				$total_harga_rupiah = $sisa_harga_rupiah + $datas->rupiah;
				$this->db->query("UPDATE rabs SET total_harga_ringgit = '$total_harga_ringgit',total_harga_rupiah = '$total_harga_rupiah' WHERE id = '$datas->id_rab_to'");
			} else {
				$get_status = $this->db->limit(1)->get_where('rabs', ['id_cabang' => $datas->id_cabang])->row_array();
				$id_cabang		 				= $datas->id_cabang;
				$id_aktifitas					= $datas->non_rab->id_aktifitas;
				$id_aktifitas_sub				= $datas->non_rab->id_aktifitas_sub;
				$id_aktifitas_cabang			= $datas->non_rab->id_aktifitas_cabang;
				$kode_isi_1 					= $datas->non_rab->kode_isi_1;
				$kode_isi_2 					= $datas->non_rab->kode_isi_2;
				$kode_isi_3 					= $datas->non_rab->kode_isi_3;
				$kode 							= $datas->non_rab->kode;
				$nama 							= $datas->non_rab->nama;
				$jumlah_1 						= $datas->non_rab->jumlah_1;
				$satuan_1 						= $datas->non_rab->satuan_1;
				$jumlah_2 						= $datas->non_rab->jumlah_2;
				$satuan_2 						= $datas->non_rab->satuan_2;
				$jumlah_3 						= $datas->non_rab->jumlah_3;
				$satuan_3 						= $datas->non_rab->satuan_3;
				$jumlah_4 						= $datas->non_rab->jumlah_4;
				$satuan_4 						= $datas->non_rab->satuan_4;
				$harga_ringgit 					= $datas->non_rab->harga_ringgit;
				$harga_rupiah 					= $datas->non_rab->harga_rupiah;
				$total_harga_ringgit 			= $datas->non_rab->total_harga_ringgit;
				$total_harga_rupiah				= $datas->non_rab->total_harga_rupiah;
				$prioritas 						= $datas->non_rab->prioritas;
				$status 						= $get_status['status'];
				$keterangan 					= $datas->non_rab->keterangan;
				$fungsi 						= 1;
				$result							= $this->cabang->insertDanaSisa($id_cabang, $id_aktifitas, $id_aktifitas_sub, $id_aktifitas_cabang, $kode_isi_1, $kode_isi_2, $kode_isi_3, $kode, $nama, $jumlah_1, $satuan_1, $jumlah_2, $satuan_2, $jumlah_3, $satuan_3, $jumlah_4, $satuan_4, $harga_ringgit, $harga_rupiah, $total_harga_ringgit, $total_harga_rupiah, $prioritas, $status, $keterangan, $fungsi);
			}
		}
		$this->output_json(
			[
				'result' => $result,
			]
		);
	}

	public function insertKurang()
	{

		$datas = json_decode($this->input->post('data'));
		$result = true;

		// variabel untuk rabs
		// dana yang kurang
		$sisa_harga_ringgit = 0;
		$sisa_harga_rupiah = 0;

		for ($i = 0; $i < count($datas->id_realisasi); $i++) {
			$id_realisasi	= $datas->id_realisasi[$i];
			$id_rab 		= $datas->id_rab[$i];
			$id_cabang		= $datas->id_cabang;
			$sisa_ringgit	= $datas->sisa_ringgit[$i];
			$sisa_rupiah 	= $datas->sisa_rupiah[$i];
			$kategori 	    = 'dana-kurang';
			$keterangan 	= $datas->keterangan;

			// assignment variable kurang
			$sisa_harga_ringgit += $sisa_ringgit;
			$sisa_harga_rupiah += $sisa_rupiah;

			$ringgit		= $datas->ringgit;
			$rupiah			= $datas->rupiah;

			$jumlah_ringgit	= $ringgit + $sisa_harga_ringgit;
			$jumlah_rupiah	= $rupiah + $sisa_harga_rupiah;

			// Check values
			if (empty($nama)) $this->output_json(['message' => 'Nama tidak boleh kosong']);

			$r = $this->realisasi->insertSisa($id_realisasi, $sisa_ringgit, $sisa_rupiah, $kategori, $id_rab, $jumlah_ringgit, $jumlah_rupiah, $keterangan);
			if ($r !== FALSE) {


				//update tambah sisa
				// $cek = $this->db->get_where('rabs', ['id' => $datas->id_rab_to])->row_array();
				// $ringgit_awal = $cek['total_harga_ringgit'];
				// $rupiah_awal = $cek['total_harga_rupiah'];

				// $data['total_harga_ringgit'] = $ringgit_awal - $sisa_ringgit;
				// $data['total_harga_rupiah'] = $rupiah_awal - $sisa_rupiah;
				// var_dump($data);
				// var_dump($jumlah_ringgit);
				// var_dump($jumlah_rupiah);
				// die;
				// $this->db->where('id', $datas->id_rab_to);
				// $this->db->update('rabs', $data);

				// //update saldo
				// $get_saldo = $this->db->get_where('saldos', ['id_cabang' => $id_cabang])->row_array();
				// $data_saldo['total_ringgit'] = $get_saldo['total_ringgit'] - $sisa_ringgit;
				// $data_saldo['total_rupiah'] = $get_saldo['total_rupiah'] - $sisa_rupiah;

				// $this->db->where('id_cabang', $id_cabang);
				// $this->db->update('saldos', $data_saldo);

				//update sisa
				// $cek_realisasi = $this->db->get_where('realisasis', ['id' => $id_realisasi])->row_array();
				// $dana_sisa['sisa_ringgit'] 	= 0;
				// $dana_sisa['sisa_rupiah'] 	= 0;
				// $this->db->where('id_rab', $id_realisasi);
				// $this->db->update('realisasis', $dana_sisa);

				// query manual code diatas tidak jalan
				$result = $this->db->query("UPDATE realisasis SET sisa_rupiah = '0',sisa_ringgit = '0' WHERE realisasis.id = '$id_realisasi'");
				$this->db->reset_query();
			} else {
				$result = false;
			}

			if ($result) {
				// simpan rabs baru
				$total_harga_ringgit = $sisa_harga_ringgit + $datas->ringgit;
				$total_harga_rupiah = $sisa_harga_rupiah + $datas->rupiah;
				$this->db->query("UPDATE rabs SET total_harga_ringgit = '$total_harga_ringgit',total_harga_rupiah = '$total_harga_rupiah' WHERE id = '$datas->id_rab_to'");
			}
		}
		$this->output_json(
			[
				'result' => $result,
			]
		);
	}

	function cetakexcel()
	{

		$get_cabang = $this->db->get_where('cabangs', ['user_id' => $this->session->userdata('data')['id']])->row_array();
		$id_cabang = $get_cabang['id'];
		$npsn = $get_cabang['kode'];
		$cabang = $get_cabang['nama'];

		$get_status = $this->db->get_where('rabs', ['id_cabang' => $id_cabang])->row_array();
		$data['status'] = $get_status['status'];
		$data['npsn'] = $npsn;
		$data['cabang'] = str_replace('%20', ' ', $cabang);
		$data['total'] = $this->realisasi->getTotalHarga($npsn)['total_harga_ringgit'];
		$data['data'] = $this->realisasi->getAllDataDetail(null, null, null, $npsn)->result_array();
		$this->load->view("templates/export/eksport-excel-realisasi-data", $data);
	}


	// =============================================================================================
	// dana kurang
	public function danaKurang()
	{
		// Page Settings
		$this->title 			= 'Realisasi';
		if ($this->session->userdata('data')['level'] == 'Super Admin') {
			$this->content 			= 'realisasi-dana-kurang-admin';
		} elseif ($this->session->userdata('data')['level'] == 'Admin Sekolah') {
			$get_cabang 			= $this->db->get_where('cabangs', ['user_id' => $this->session->userdata('data')['id']])->row_array();
			$id_cabang 				= $get_cabang['id'];
			$npsn 					= $get_cabang['kode'];
			$cabang 				= $get_cabang['nama'];
			$get_status				= $this->db->get_where('rabs', ['id_cabang' => $id_cabang])->row_array();

			$this->data['kode']		= $this->realisasi->getAllData(null, null, null, $npsn)->result_array();
			$this->data['status']	= $get_status['status'];
			$this->data['npsn']  	= $npsn;
			$this->data['cabang']  	= str_replace('%20', ' ', $cabang);
			$this->data['id_cabang'] = $id_cabang;
			$this->data['total']	= $this->realisasi->getTotalHarga($npsn);
			$this->data['kodeNPSN'] = $this->realisasi->getDataKodeNPSN($id_cabang);




			// data
			// $npsn 	= $this->input->post('npsn');
			// $start 	= $this->input->post('start');
			// $draw 	= $this->input->post('draw');
			// $length = $this->input->post('length');
			// $cari 	= $this->input->post('search');
			// if (isset($cari['value'])) {
			// 	$_cari = $cari['value'];
			// } else {
			// 	$_cari = null;
			// }

			$this->data['danas'] 	= $this->realisasi->getAllDataDanaKurang($npsn, $id_cabang)->result_array();
			$this->content 			= 'realisasi-dana-kurang';
		}

		$this->navigation 		= ['Realisasi', 'Dana Kurang'];
		$this->plugins 			= ['datatables', 'select2'];
		// Breadcrumb setting
		$this->breadcrumb_1 		= 'Dashboard';
		$this->breadcrumb_1_url 	= base_url() . 'dashboard';
		$this->breadcrumb_2 		= 'Realisasi';
		$this->breadcrumb_2_url 	= base_url() . 'realisasi';
		$this->breadcrumb_3 		= 'Dana Kurang';
		$this->breadcrumb_3_url 	= '#';
		// Send data to view
		$this->render();
	}

	// Ajax Data
	public function ajax_data_dana_kurang()
	{
		$npsn 	= $this->input->post('npsn');
		$start 	= $this->input->post('start');
		$draw 	= $this->input->post('draw');
		$length = $this->input->post('length');
		$cari 	= $this->input->post('search');
		if (isset($cari['value'])) {
			$_cari = $cari['value'];
		} else {
			$_cari = null;
		}
		$data 	= $this->realisasi->superAdminDanaKurang()->result_array();
		$count 	= count($data);

		array($cari);

		echo json_encode(array('recordsTotal' => $count, 'recordsFiltered' => $count, 'draw' => $draw, 'search' => $_cari, 'data' => $data));
	}
	// =============================================================================================


	// =============================================================================================
	// print realisasi dana kurang
	public function excelDanaKurang()
	{
		$cabangdetail = $this->db->get_where('cabangs', ['user_id' => $this->session->userdata('data')['id']])->row_array();
		$npsn 	= $cabangdetail['kode'];
		$start 	= $this->input->post('start');
		$draw 	= $this->input->post('draw');
		$length = $this->input->post('length');
		$cari 	= $this->input->post('search');
		if (isset($cari['value'])) {
			$_cari = $cari['value'];
		} else {
			$_cari = null;
		}
		$data 	= $this->realisasi->getAllDataDanaKurang($length, $start, $_cari, $npsn)->result_array();
		$count 	= $this->realisasi->getAllDataDanaKurang(null, null, $_cari, $npsn)->num_rows();

		array($cari);

		$data['data'] = $data;
		$data['npsn'] = $npsn;
		$data['cabang'] = $cabangdetail['nama'];

		$this->load->view("templates/export/eksport-excel-realisasi-dana-kurang", $data);
	}

	// admin realisasi
	public function admindetail($id_cabang)
	{
		$get_cabang 			= $this->db->get_where('cabangs', ['id' => $id_cabang])->row_array();
		$id_cabang 				= $get_cabang['id'];
		$npsn 					= $get_cabang['kode'];
		$cabang 				= $get_cabang['nama'];
		$get_status				= $this->db->get_where('rabs', ['id_cabang' => $id_cabang])->row_array();
		$this->data['status']	= $get_status['status'];
		$this->data['npsn']  	= $npsn;
		$this->data['cabang']  	= str_replace('%20', ' ', $cabang);
		$this->data['total']	= $this->realisasi->getTotalHarga($npsn);
		$this->data['id_cabang'] = $id_cabang;
		$this->data['rabs'] 	= $this->realisasi->getAllDataDetail(null, null, null, $npsn)->result_array();

		// setting halaman
		$this->title 			= 'Realisasi RAB';
		$this->content 			= 'realisasi';
		$this->navigation 			= ['Realisasi', 'Dana RAB'];
		$this->plugins 				= ['datatables', 'select2'];

		// Breadcrumb setting
		$this->breadcrumb_1 		= 'Dashboard';
		$this->breadcrumb_1_url 	= base_url() . 'dashboard';
		$this->breadcrumb_2 		= 'Realisasi';
		$this->breadcrumb_2_url 	= '#';
		$this->breadcrumb_3 		= 'RAB';
		$this->breadcrumb_3_url 	= '';

		// Send data to view
		$this->render();
	}

	public function admindanasisa($id_cabang)
	{
		$get_cabang 			= $this->db->get_where('cabangs', ['id' => $id_cabang])->row_array();
		$id_cabang 				= $get_cabang['id'];
		$npsn 					= $get_cabang['kode'];
		$cabang 				= $get_cabang['nama'];

		$get_status				= $this->db->get_where('rabs', ['id_cabang' => $id_cabang])->row_array();
		$this->data['kode']		= $this->realisasi->getAllData(null, null, null, $npsn)->result_array();
		$this->data['status']	= $get_status['status'];
		$this->data['npsn']  	= $npsn;
		$this->data['cabang']  	= str_replace('%20', ' ', $cabang);
		$this->data['total']	= $this->realisasi->getTotalHarga($npsn);
		$this->data['kodeNPSN'] = $this->realisasi->getDataKodeNPSN($id_cabang);
		$this->content 			= 'realisasi-dana-sisa';
		// query dana sisa
		$start 	= $this->input->post('start');
		$draw 	= $this->input->post('draw');
		$length = $this->input->post('length');
		$cari 	= $this->input->post('search');
		if (isset($cari['value'])) {
			$_cari = $cari['value'];
		} else {
			$_cari = null;
		}

		// setting halaman
		$this->title 			= 'Realisasi RAB Dana Sisa';
		$this->data['id_cabang'] = $id_cabang;
		$this->data['dana_sisa'] 	= $this->realisasi->getAllDataDanaSisa($length, $start, $_cari, $npsn)->result_array();
		$this->navigation 		= ['Realisasi', 'Dana Sisa'];
		$this->plugins 			= ['datatables', 'select2'];

		// Breadcrumb setting
		$this->breadcrumb_1 		= 'Dashboard';
		$this->breadcrumb_1_url 	= base_url() . 'dashboard';
		$this->breadcrumb_2 		= 'Realisasi';
		$this->breadcrumb_2_url 	= base_url() . 'realisasi';
		$this->breadcrumb_3 		= 'Dana Sisa';
		$this->breadcrumb_3_url 	= '';
		// Send data to view
		$this->render();
	}

	public function admindanakurang($id_cabang)
	{
		$this->title 			= 'Realisasi RAB Dana Kurang';
		// Page Settings
		$this->title 			= 'Realisasi';

		$get_cabang 			= $this->db->get_where('cabangs', ['id' => $id_cabang])->row_array();
		$id_cabang 				= $get_cabang['id'];
		$npsn 					= $get_cabang['kode'];
		$cabang 				= $get_cabang['nama'];
		$get_status				= $this->db->get_where('rabs', ['id_cabang' => $id_cabang])->row_array();

		$this->data['kode']		= $this->realisasi->getAllData(null, null, null, $npsn)->result_array();
		$this->data['status']	= $get_status['status'];
		$this->data['npsn']  	= $npsn;
		$this->data['cabang']  	= str_replace('%20', ' ', $cabang);
		$this->data['id_cabang'] = $id_cabang;
		$this->data['total']	= $this->realisasi->getTotalHarga($npsn);
		$this->data['kodeNPSN'] = $this->realisasi->getDataKodeNPSN($id_cabang);
		$this->content 			= 'realisasi-dana-kurang';
		$this->data['danas'] 	= $this->realisasi->getAllDataDanaKurang($npsn, $id_cabang)->result_array();
		$this->navigation 		= ['Realisasi', 'Dana Kurang'];
		$this->plugins 			= ['datatables', 'select2'];
		// Breadcrumb setting
		$this->breadcrumb_1 		= 'Dashboard';
		$this->breadcrumb_1_url 	= base_url() . 'dashboard';
		$this->breadcrumb_2 		= 'Realisasi';
		$this->breadcrumb_2_url 	= base_url() . 'realisasi';
		$this->breadcrumb_3 		= 'Dana Kurang';
		$this->breadcrumb_3_url 	= '#';
		// Send data to view
		$this->render();
	}

	// =============================================================================================
	function __construct()
	{
		parent::__construct();
		$this->load->model('realisasiModel', 'realisasi');
		$this->default_template = 'templates/dashboard';
		$this->load->library('plugin');
		$this->load->library('Libs', 'libs');
		$this->load->helper('url');

		// Cek session
		$this->sesion->cek_session();
	}
}

/* End of file Data.php */
/* Location: ./application/controllers/kota.php */