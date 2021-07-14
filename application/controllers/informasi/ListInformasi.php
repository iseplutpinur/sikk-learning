<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ListInformasi extends Render_Controller
{

	public function index()
	{
		// Page Settings
		$this->title = 'Informasi - List Informasi';
		$this->navigation = ['Informasi', "List Informasi"];
		$this->plugins = ['datatables'];

		// Breadcrumb setting
		$this->breadcrumb_1 = 'Dashboard';
		$this->breadcrumb_1_url = base_url();
		$this->breadcrumb_2 = 'Informasi';
		$this->breadcrumb_2_url = '#';
		$this->breadcrumb_3 = 'List Informasi';
		$this->breadcrumb_3_url = '#';

		// content
		$this->content      = 'informasi/list';

		// Send data to view
		$this->render();
	}

	// Ajax Data
	public function ajax_data()
	{
		$order = ['order' => $this->input->post('order'), 'columns' => $this->input->post('columns')];
		$start = $this->input->post('start');
		$draw = $this->input->post('draw');
		$draw = $draw == null ? 1 : $draw;
		$length = $this->input->post('length');
		$cari = $this->input->post('search');

		if (isset($cari['value'])) {
			$_cari = $cari['value'];
		} else {
			$_cari = null;
		}

		$data = $this->model->getAllData($draw, $length, $start, $_cari, $order)->result_array();
		$count = $this->model->getAllData(null, null, null, $_cari, $order, null)->num_rows();

		$this->output_json(['recordsTotal' => $count, 'recordsFiltered' => $count, 'draw' => $draw, 'search' => $_cari, 'data' => $data]);
	}

	public function delete()
	{
		$id = $this->input->post("id");
		$result = $this->model->delete($id);
		$code = $result ? 200 : 500;
		$this->output_json(["data" => $result], $code);
	}

	public function tambah()
	{
		// Page Settings
		$this->title = 'Informasi - List Informasi';
		$this->title_show = false;
		$this->navigation = ['Informasi', "List Informasi"];
		$this->plugins = ['summernote'];

		// Breadcrumb setting
		$this->breadcrumb_1 = 'Dashboard';
		$this->breadcrumb_1_url = base_url();
		$this->breadcrumb_2 = 'Informasi';
		$this->breadcrumb_2_url = '#';
		$this->breadcrumb_3 = 'List Informasi';
		$this->breadcrumb_3_url = base_url('informasi/listInformasi');
		$this->breadcrumb_4 = 'Tambah';
		$this->breadcrumb_4_url = '#';

		// content
		$this->content      = 'informasi/list-tambah';

		// data
		$this->data['kategori'] = $this->model->getListKategori();
		$this->data['informasi'] = $this->model->newInformasi();

		// Send data to view
		$this->render();
	}

	public function insert()
	{
		$gambars = $this->input->post('gambar');
		$folder = $this->input->post('folder');
		$id = $this->input->post('id');
		$judul = $this->input->post('judul');
		$kategori = $this->input->post('kategori');
		$penulis = $this->input->post('penulis');
		$deskripsi = $this->input->post('deskripsi', false);
		$tanggal = $this->input->post('tanggal');
		$thumbnail = $this->input->post('thumbnail');

		// list gambar yang dikirim
		$gambars = $gambars == null ? [] : $gambars;
		$list_gambar = $thumbnail . '|';
		foreach ($gambars as $gambar) {
			$list_gambar .= ($list_gambar == '') ? $gambar : ('|' . $gambar);
		}
		// hapus gambar yang tidak terpakai
		$this->insertDeleteImage($gambars, $folder);

		// insert
		$exe = $this->model->input($id, $judul, $kategori, $penulis, $tanggal, $deskripsi, $list_gambar);
		$this->output_json(["status" => $exe]);
	}

	public function insertUpload()
	{
		$id = $this->input->post('folder');
		$file_name = $this->model->uploadImage('./' . $this->path, $id);
		$this->output_json([
			'name' =>
			$file_name
		]);
	}

	private function insertDeleteImage($gambars, $folder)
	{
		$folder = $folder == null ? '' : ($folder . '/');
		$this->load->helper('directory');
		$path = './' . $this->path . $folder;
		$files = directory_map($path, FALSE, TRUE);
		if ($files) {
			foreach ($files as $file) {
				if (!in_array($file, $gambars)) {
					$this->deleteImage($path . $file);
				}
			}
		}

		// jika tidak ada gambar maka folder akan dihapus
		if ($files == false || $gambars == false) {
			if (is_dir($path)) {
				rmdir($path);
			}
		}
	}

	public function uploadImage()
	{
		$folder = $this->input->post('folder');
		$folder = $folder == null ? '' : ($folder . '/');
		$path = './' . $this->path . $folder;
		// cek directory
		if (!is_dir($path)) {
			mkdir($path, 0755, TRUE);
		}

		$config['upload_path']          = $path;
		$config['allowed_types']        = 'gif|jpg|png|jpeg|JPG|PNG|JPEG';
		$config['overwrite']            = false;
		$config['max_size']             = 8024;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$result = $this->upload->do_upload('image');
		if ($result) {
			$file_name = $this->upload->data("file_name");
			$url = base_url($this->path) . $folder . $file_name;
			$this->output_json([
				'url' => [
					'status' => 1,
					'path' => $url,
					'file_name' => $file_name
				]
			]);
		} else {
			$this->output_json([
				'url' => [
					'status' => 0,
					'message' => $this->upload->display_errors()
				]
			], 500);
		}
	}

	private function deleteImage($path)
	{
		if (file_exists($path)) {
			$result = unlink($path);
		}
		return $result;
	}

	function __construct()
	{
		parent::__construct();
		// model
		$this->sesion->cek_session();
		if ($this->session->userdata('data')['level'] != 'Administrator') {
			redirect('login', 'refresh');
		}

		$this->load->model("informasi/ListModel", 'model');
		$this->default_template = 'templates/dashboard';
		$this->load->library('plugin');
		$this->load->helper('url');

		// path
		$this->path = 'images/informasi/list/';
	}
}

/* End of file Pengguna.php */
/* Location: ./application/controllers/pengaturan/Pengguna.php */