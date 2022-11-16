<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ms_komunitas extends MY_Controller {
    public function __construct(){
        parent::__construct();
        // $this->login();
        $this->load->model('ms_model', '_ms');
    }

    public function index()
    {
      $data['akses'] = $this->akses_array;
      $this->load->view('v_ms_komunitas', $data);
    }

    function tambah(){
      $data['kecamatan'] = $this->db->get("tblkecamatan")->result();
      $this->load->view("v_ms_komunitas_a", $data);
    }

    public function get_kelurahan(){
      $id_kec = $this->input->post('idkec');

      $json_response = $this->db->get_where('tblkelurahan', array('id_kec'=>$id_kec))->result();
      foreach ($json_response as $rows){
          echo "<option value='$rows->id_kel'> $rows->nama </option>";
      }
    }

    public function get_image(){
      $idtbl = $this->input->post('idtbl');
      $type = $this->input->post('type');
      $lokasi = base_url()."uploads/komunitas/".$idtbl.'/';
      $x = 1;
      $json_response = $this->db->get_where('tblgalery', array('idtbl'=>$idtbl, "type" => $type))->result();
      foreach ($json_response as $rows){

          $foto = $lokasi.$rows->picture_name;
          echo  "<a class='carousel-item active' href='$foto' target='_blank'>
              	  <img src='$foto' alt='img-$x' style='width:80%;height:50%;'>
              	</a>";
          // echo "<img class='activator' src='$foto' alt='Icon'>";
          $x++;
      }

    }

    function proses_tambah(){
      $nama  = $this->input->post('nama');
      $alamat  = $this->input->post('alamat');
      $kelurahan  = $this->input->post('kelurahan');
      $kecamatan  = $this->input->post('kecamatan');
      $desa  = $this->input->post('desa');
      $masa_bakti  = $this->input->post('masa_bakti');
      $tanggal_berakhir  = date("Y-m-d", strtotime($this->input->post('tanggal_berakhir')));
      $jml_pengurus  = $this->input->post('jml_pengurus');
      $jml_anggota  = $this->input->post('jml_anggota');
      $kepemilikan_adart  = $this->input->post('kepemilikan_adart');
      $kemampuan  = $this->input->post('kemampuan');
      $tlpn_sekretariat  = $this->input->post('tlpn_sekretariat');
      $tlpn_alternative  = $this->input->post('tlpn_alternative');
      $pertemuan_rutin  = $this->input->post('pertemuan_rutin');
      $tanggal_berdiri  = date("Y-m-d", strtotime($this->input->post('tanggal_berdiri')));
      $pejabat  = $this->input->post('pejabat');
      $frex_rx  = $this->input->post('frex_rx');
      $frex_tx  = $this->input->post('frex_tx');
      $tone  = $this->input->post('tone');
      $peralatan  = $this->input->post('peralatan');
      $ket  = $this->input->post('ket');


      $data = array(
       'nama' => $nama ,
       'alamat' => $alamat ,
       'kelurahan' => $kelurahan ,
       'kecamatan' => $kecamatan ,
       'desa' => $desa ,
       'masa_bakti' => $masa_bakti ,
       'tanggal_berakhir' => $tanggal_berakhir ,
       'jml_pengurus' => $jml_pengurus ,
       'jml_anggota' => $jml_anggota ,
       'kepemilikan_adart' => $kepemilikan_adart ,
       'kemampuan' => $kemampuan ,
       'tlpn_sekretariat' => $tlpn_sekretariat ,
       'tlpn_alternative' => $tlpn_alternative ,
       'pertemuan_rutin' => $pertemuan_rutin ,
       'tanggal_berdiri' => $tanggal_berdiri ,
       'pejabat' => $pejabat ,
       'frex_rx' => $frex_rx ,
       'frex_tx' => $frex_tx ,
       'tone' => $tone ,
       'peralatan' => $peralatan ,
       'ket' => $ket ,
      );
      echo json_encode($data);
      $this->db->insert("tblkomunitas", $data);
      $id = $this->db->insert_id();

      // if(! $_FILES['foto']['size'][0] == '0' ){
  		// 	//begin upload foto
      //
      //   $this->load->library('upload');
  		// 	$path = "./uploads/komunitas/".$id;
  		// 	if(!is_dir($path)) //create the folder if it's not already exists
  		// 	{
  		// 	 mkdir($path, 0755, TRUE);
  		// 	}

  			// $files = $_FILES;
  			// $x = count($_FILES['foto']['name']);
  			// for($i = 0; $i < $x; $i++){
        //     $_FILES['foto']['name'] = $files['foto']['name'][$i];
        //     $_FILES['foto']['type'] = $files['foto']['type'][$i];
        //     $_FILES['foto']['tmp_name'] = $files['foto']['tmp_name'][$i];
        //     $_FILES['foto']['error'] = $files['foto']['error'][$i];
        //     $_FILES['foto']['size'] = $files['foto']['size'][$i];
        //
        //     $this->upload->initialize($this->set_upload_options($_FILES['foto']['name'], $id));
        //
        //     if (! $this->upload->do_upload('foto')){
  			// 			$this->session->set_flashdata('delete', $this->upload->display_errors());
        //       redirect(base_url('Ms_komunitas'));
        //     }else{
        //       $path = pathinfo($_FILES['foto']['name']);
        //       $extention = $path['extension'];
        //       $size = $_FILES['foto']['size'];
        //
        //       $this->db->insert("tblgalery", array(
        //         'idtbl' => $id,
        //         "type" => "1",
        //         'picture_name' => $files['foto']['name'][$i],
        //         'size' => $size,
        //         'create_date' => date('Y-m-d H:i:s')
        //       ));
        //     }
        //  }
  		// }
      redirect(base_url("ms_komunitas"));
    }

    function set_upload_options($judul, $folder)
      {
        //upload an image options
        $config = array();
        $config['file_name']     = $judul;
        $config['upload_path']   = './uploads/komunitas/'.$folder;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = '0';
        $config['overwrite']     = FALSE;

        $this->load->library('upload', $config);
        return $config;
      }

    function edit($id_md5){
      $data['data'] = $this->db->get_where("tblkomunitas", array("md5(idtblkomunitas)" => $id_md5) )->row_array();
      $data['picture'] = $this->db->get_where("tblgalery", array("md5(idtbl)" => $id_md5, "type" => '1'))->result();
      $data['kecamatan'] = $this->db->get("tblkecamatan")->result();
      $data['kelurahan'] = $this->db->get("tblkelurahan")->result();
      $this->load->view("v_ms_komunitas_e", $data);

    }

    function get_komunitas(){
      $search = $this->input->post("search")['value'];
      $datax = $this->_ms->get_data($search, "tblpotensi")->result();
		  $data = array(); $x = 0;

      foreach ($datax as $rows){
        $row = array();
        $x++;
        $row[] = $rows->nama;
        $row[] = $rows->alamat;
        $row[] = $rows->kelurahan;
        $row[] = $rows->kecamatan;
        $row[] = $rows->desa;
        $row[] = $rows->masa_bakti;
        $row[] = $rows->tanggal_berakhir;
        $row[] = $rows->jml_pengurus;
        $row[] = $rows->jml_anggota;
        $row[] = $rows->kepemilikan_adart;
        $row[] = $rows->kemampuan;
        $row[] = $rows->tlpn_sekretariat;
        $row[] = $rows->tlpn_alternative;
        $row[] = $rows->pertemuan_rutin;
        $row[] = $rows->tanggal_berdiri;
        $row[] = $rows->pejabat;
        $row[] = $rows->frex_rx;
        $row[] = $rows->frex_tx;
        $row[] = $rows->tone;
        $row[] = $rows->peralatan;
        $row[] = $rows->ket;
        $row[] = $rows->flag == '0' ? 'Aktif' : 'Tidak Aktif';

        $row[22] = '';
        if($this->akses_array['update'] == '1'){
          $row[22] .= '<a href="'.base_url().'ms_komunitas/edit/'.md5($rows->idtblkomunitas).'" class="blue btn-small btn " style="width:3%;"> <i class="mdi-editor-border-color right"></i></a>';
        }
        if($this->akses_array['delete'] == '1'){
          $row[22] .= '<a href="'.base_url().'ms_komunitas/delete/'.md5($rows->idtblkomunitas).'" data-nama="'.$rows->nama.'" data-status="hapus" class="btn-small btn link_delete" style="width:3%;"> <i class="right mdi-navigation-cancel"></i></a> </div>';
        }

        $data[] = $row;
			}

      $output = array(
        "data" => $data
      );

      echo json_encode($output);

    }

    function proses_edit(){
      $nama  = $this->input->post('nama');
      $alamat  = $this->input->post('alamat');
      $kelurahan  = $this->input->post('kelurahan');
      $kecamatan  = $this->input->post('kecamatan');
      $desa  = $this->input->post('desa');
      $masa_bakti  = $this->input->post('masa_bakti');
      $tanggal_berakhir  = date("Y-m-d", strtotime($this->input->post('tanggal_berakhir')));
      $jml_pengurus  = $this->input->post('jml_pengurus');
      $jml_anggota  = $this->input->post('jml_anggota');
      $kepemilikan_adart  = $this->input->post('kepemilikan_adart');
      $kemampuan  = $this->input->post('kemampuan');
      $tlpn_sekretariat  = $this->input->post('tlpn_sekretariat');
      $tlpn_alternative  = $this->input->post('tlpn_alternative');
      $pertemuan_rutin  = $this->input->post('pertemuan_rutin');
      $tanggal_berdiri  = date("Y-m-d", strtotime($this->input->post('tanggal_berdiri')));
      $pejabat  = $this->input->post('pejabat');
      $frex_rx  = $this->input->post('frex_rx');
      $frex_tx  = $this->input->post('frex_tx');
      $tone  = $this->input->post('tone');
      $peralatan  = $this->input->post('peralatan');
      $ket  = $this->input->post('ket');
      $idtblkomunitas  = $this->input->post('idtblkomunitas');


      $data = array(
       'nama' => $nama ,
       'alamat' => $alamat ,
       'kelurahan' => $kelurahan ,
       'kecamatan' => $kecamatan ,
       'desa' => $desa ,
       'masa_bakti' => $masa_bakti ,
       'tanggal_berakhir' => $tanggal_berakhir ,
       'jml_pengurus' => $jml_pengurus ,
       'jml_anggota' => $jml_anggota ,
       'kepemilikan_adart' => $kepemilikan_adart ,
       'kemampuan' => $kemampuan ,
       'tlpn_sekretariat' => $tlpn_sekretariat ,
       'tlpn_alternative' => $tlpn_alternative ,
       'pertemuan_rutin' => $pertemuan_rutin ,
       'tanggal_berdiri' => $tanggal_berdiri ,
       'pejabat' => $pejabat ,
       'frex_rx' => $frex_rx ,
       'frex_tx' => $frex_tx ,
       'tone' => $tone ,
       'peralatan' => $peralatan ,
       'ket' => $ket ,
      );

      $this->db->where("idtblkomunitas", $id);
      $this->db->update("tblkomunitas", $data);

      if(! $_FILES['foto']['size'][0] == '0' ){
  			//begin upload foto

        $this->load->library('upload');
  			$path = "./uploads/komunitas/".$id;
  			if(!is_dir($path)) //create the folder if it's not already exists
  			{
  			 mkdir($path, 0755, TRUE);
  			}

  			$files = $_FILES;
  			$x = count($_FILES['foto']['name']);
  			for($i = 0; $i < $x; $i++){
            $_FILES['foto']['name'] = $files['foto']['name'][$i];
            $_FILES['foto']['type'] = $files['foto']['type'][$i];
            $_FILES['foto']['tmp_name'] = $files['foto']['tmp_name'][$i];
            $_FILES['foto']['error'] = $files['foto']['error'][$i];
            $_FILES['foto']['size'] = $files['foto']['size'][$i];

            $this->upload->initialize($this->set_upload_options($_FILES['foto']['name'], $id));

            if (! $this->upload->do_upload('foto')){
  						$this->session->set_flashdata('delete', $this->upload->display_errors());
              redirect(base_url('Ms_komunitas'));
            }else{
              $path = pathinfo($_FILES['foto']['name']);
              $extention = $path['extension'];
              $size = $_FILES['foto']['size'];

              $this->db->insert("tblgalery", array(
                'idtbl' => $id,
                "type" => "1",
                'picture_name' => $files['foto']['name'][$i],
                'size' => $size,
                'create_date' => date('Y-m-d H:i:s')
              ));
            }
         }
  		}
      $this->session->set_flashdata('update', "Data $nama Sukses Di Perbarui");
      redirect(base_url("ms_komunitas"));
    }

    function delete($id){
      // die($id);
      $this->db->where('md5(idtblkomunitas)', $id);
      $this->db->update('tblkomunitas', array("flag" => "1"));

      $this->session->set_flashdata('delete', 'Data Sukses di hapus');
      redirect(base_url("ms_komunitas"));
    }

    function active($id){
      // die($id);
      $this->db->where('md5(idtblkomunitas)', $id);
      $this->db->update('tblkomunitas', array("flag" => "0"));

      $this->session->set_flashdata('insert', 'Data Sukses di aktivasi');
      redirect(base_url("ms_komunitas"));
    }

    function delete_pict($id, $id_md5, $name){
      // die($id_md5.'_'.$name);
      // $picture_name = $this->db->get_where("galery_detail", array('id' => $id))->row("picture_name");
      $file = './uploads/komunitas/'.$id.'/'.$name;
      if(unlink($file)){
        $this->db->where("md5(id)", $id_md5);
        $this->db->delete("tblgalery");
      }else{
        echo "gagal hapus";
      }
       echo '1';
    }


  }

?>
