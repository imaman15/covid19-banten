<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Users_model extends CI_Model
{

    private $_table = 'users';

    private function _get_datatables_query($check)
    {
        $column_order = array(null, 'date_created', null);
        $column_search = array('name', 'email', 'phone', 'desc');
        if ($check == 'active') {
            $active = 1;
            $order = ['date_update' => 'desc'];
        } elseif ($check == 'notactive') {
            $active = 0;
            $order = ['date_created' => 'asc'];
        } elseif ($check == 'blocked') {
            $active = 2;
            $order = ['date_update' => 'desc'];
        }

        $this->db->where('active', $active);
        $this->db->where_not_in('id_users', [1, 2, 3]);
        $this->db->select('*');
        $this->db->from($this->_table);

        $i = 0;
        foreach ($column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($order)) {
            $torder = $order;
            $this->db->order_by(key($torder), $torder[key($torder)]);
        }
    }

    function get_datatables($check)
    {
        $this->_get_datatables_query($check);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($check)
    {
        $this->_get_datatables_query($check);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($check)
    {
        if ($check == 'active') {
            $active = 1;
        } elseif ($check == 'notactive') {
            $active = 0;
        } elseif ($check == 'blocked') {
            $active = 2;
        }

        $this->db->where('active', $active);
        $this->db->where_not_in('id_users', [1, 2, 3]);
        $this->db->select('*');
        $this->db->from($this->_table);
        return $this->db->count_all_results();
    }
    //=======================================================

    // getData('select1,select2', ['field1' => var1, 'field2' => var2])
    public function getData($select = NULL, $where = NULL)
    {
        if ($select != NULL) {
            $this->db->select($select);
        } else {
            $this->db->select('*');
        }

        if ($where != NULL) {
            $this->db->where($where);
        }

        $this->db->from($this->_table);
        return $this->db->get();
    }

    public function dataNot($names)
    {
        $this->db->where('active', 1);
        $this->db->where_not_in('id_users', $names);
        $this->db->from($this->_table);
        return $this->db->get();
    }

    public function checkEmail($names)
    {
        $this->db->where('email', $names);
        $this->db->from($this->_table);
        return $this->db->get();
    }

    public function update($post)
    {
        $session_id = dUsers()->id_users;
        $post_id = $post["id_users"];
        if (isset($post_id)) {
            $params['id_users'] = $post_id;
        } else {
            $params['id_users'] = $session_id;
        };

        $params['email'] = $post["email"];
        $params['name'] = htmlspecialchars(ucwords($post["name"]), true);
        $params['desc'] = $post["desc"] != "" ? htmlspecialchars($post["desc"], true) : null;
        $params['phone'] = phoneNumber($post["phone"]);

        // Cek Jika ada gambar yang akan diupload
        $upload_image = $_FILES['photo']['name'];
        if ($upload_image) {
            $config['upload_path']          = './assets/img/profile/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['file_name']            = round(microtime(true) * 1000);
            $config['max_size']             = 2048; // 2MB

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('photo')) {
                $old_image = dUsers()->photo;
                if ($old_image != 'default.jpg') {
                    unlink(FCPATH . 'assets/img/profile/' . $old_image);
                }
                $params['photo'] = $this->upload->data('file_name');
            } else {
                $eror = $this->upload->display_errors();
                $this->session->set_flashdata('message', '<div class="alert alert-danger animated zoomIn" role="alert">' . $eror . '</div>');
                redirect(M_PROFILE);
            }
        }

        if (isset($post['remove_photo'])) // if remove photo checked
        {
            if (file_exists('assets/img/profile/' . $post['remove_photo']) && $post['remove_photo'])
                unlink('assets/img/profile/' . $post['remove_photo']);
            $params["photo"] = 'default.jpg';
        }
        $this->db->where(array('id_users' => $params['id_users']));
        $this->db->update($this->_table, $params);
    }

    public function changepassword($post)
    {
        $password = password_hash($post, PASSWORD_DEFAULT);
        $this->db->set('password', $password);
        $this->db->where(array('id_users' => dUsers()->id_users, 'email' => dUsers()->email));
        $this->db->update($this->_table);
    }

    public function add($post, $pass = NULL)
    {
        //$password = ($pass != NULL) ? $pass : $post["password"];

        $data['name'] = htmlspecialchars(ucwords($post["name"]), true);
        $data['phone'] = phoneNumber($post["phone"], true);
        $data['email'] = htmlspecialchars($post["email"], true);
        $data['password'] = password_hash($post["password"], PASSWORD_DEFAULT);
        $data['photo'] = 'default.jpg';
        $data['active'] = 0;
        $data['status'] = 2;
        $data['date_created'] = time();
        $this->db->insert($this->_table, $data);
    }

    public function update_active()
    {
        $post = $this->input->post(NULL, TRUE);
        $params['active'] = $post['active'];
        $this->db->where(['id_users' => $post['id_users']]);
        $this->db->update($this->_table, $params);
    }

    public function update_status()
    {
        $post = $this->input->post(NULL, TRUE);
        $params['status'] = $post['status'];
        $this->db->where(['id_users' => $post['id_users']]);
        $this->db->update($this->_table, $params);
    }

    public function update_password()
    {
        $post = $this->input->post(NULL, TRUE);
        $params['password'] = password_hash('Relawan123', PASSWORD_DEFAULT);
        $this->db->where(['id_users' => $post['id_users']]);
        $this->db->update($this->_table, $params);
    }
}

/* End of file Users_model.php */
