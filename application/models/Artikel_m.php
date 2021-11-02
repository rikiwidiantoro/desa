<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Artikel_m extends CI_Model
{
    private $_table = "artikel";

    /*
	 * Start backend 
	 */
    public function rules()
    {
        return [
            [
                'field' => 'title',
                'label' => 'Judul',
                'rules' => 'trim|required'
            ],

            [
                'field' => 'content',
                'label' => 'Isi artikel',
                'rules' => 'trim|required'
            ]
        ];
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id" => $id])->row_array();
    }

    public function save()
    {
        $ids = $this->db->get($this->_table)->row();
        $title = htmlspecialchars($this->input->post('title', true));
        $content = $this->input->post('content', true);
        $image = $this->_uploadImage();
        $url = url_title($this->input->post('title') . '_ID' . $ids);
        $category = $this->input->post('category_id');
        $artikel = [
            'title'        => $title,
            'content'      => $content,
            'image'        => $image,
            'url'          => $url,
            'category_id'  => $category,
            'date_created' => time()
        ];
        $this->db->insert($this->_table, $artikel);
    }

    public function update()
    {
        if (!empty($_FILES["image"]["name"])) {
            $image = $this->_uploadImage();
        } else {
            $image = $this->input->post('old_image');
        }
        $ids = $this->db->get($this->_table)->row();
        $id = $this->input->post('id');
        $title = htmlspecialchars($this->input->post('title', true));
        $content = $this->input->post('content', true);
        $url = url_title($this->input->post('title') . '_ID' . $ids);
        $artikel = [
            'id'           => $id,
            'title'        => $title,
            'content'      => $content,
            'image'        => $image,
            'url'          => $url,
            'date_created' => time()
        ];
        $this->db->update($this->_table, $artikel, array('id' => $id));
    }

    public function delete($id)
    {
        $this->_deleteImage($id);
        return $this->db->delete($this->_table, array("id" => $id));
    }

    private function _uploadImage()
    {
        $config['upload_path']          = './upload_file/images/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['overwrite']            = true;
        $config['max_size']             = 1024;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            return $this->upload->data("file_name");
        }
        return "default.jpg";
    }

    private function _deleteImage($id)
    {
        $image = $this->getById($id);
        if ($image['image'] != "default.jpg") {
            $filename = explode(".", $image['image'])[0];
            return array_map('unlink', glob(FCPATH . "upload_file/images/$filename.*"));
        }
    }

    public function getAllArtikel()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get($this->_table)->result_array();
    }
    /*
	 * End backend 
	 */

    public function kabarTerkini()
    {
        $this->db->order_by('id', 'desc');
        $this->db->limit(3);
        return $this->db->get($this->_table)->result_array();
    }

    public function recentArtikel()
    {
        $this->db->order_by('id', 'desc');
        $this->db->limit(4);
        return $this->db->get($this->_table)->result_array();
    }

    public function getAll()
    {
        $this->db->order_by('id', 'desc');
        $this->db->select('
            artikel.*, category.id AS, category.category
        ');
        $this->db->join('category', 'artikel.category_id = category.id');
        $this->db->from('artikel');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function readMore($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->_table)->result_array();
    }
}
