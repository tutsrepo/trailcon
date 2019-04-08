<?php
class Contest_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

		public function get_contests($id = FALSE)
		{
		        if ($id === FALSE)
        		{
                		$query = $this->db->get('contests');
                		return $query->result_array();
        		}

        		$query = $this->db->get_where('contests', array('id' => $id));
        		return $query->row_array();
		}

		public function addContests()
		{

    		$data = array(
        		'firstname' => $this->input->post('firstname'),
        		'lastname' => $this->input->post('lastname'),
        		'email' => $this->input->post('email')
    		);

    		return $this->db->insert('contests', $data);
		}

		public function updateContests($id=0)
		{

    		$data = array(
        		'firstname' => $this->input->post('firstname'),
        		'lastname' => $this->input->post('lastname'),
        		'email' => $this->input->post('email')
    		);

			$this->db->where('id',$id);
			$this->db->update('contests',$data);
		}

        public function get_email($id = 0)
        {
            $this->db->select('email');
            $this->db->from('contests');
            $this->db->where('id',$id);
            return $this->db->get()->row()->email;
        }
}