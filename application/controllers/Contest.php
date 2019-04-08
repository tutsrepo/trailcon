<?php
class Contest extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('contest_model');
                $this->load->helper('url_helper');
        }

        public function index()
        {
                $data['contests'] = $this->contest_model->get_contests();
                $data['title'] = 'Contests archive';
                $this->load->view('templates/header', $data);
                $this->load->view('contests/index', $data);
                $this->load->view('templates/footer');        
        }

        public function contest_create()
        {
                $this->load->helper('form');
                $this->load->library('form_validation');
                $data['title'] = 'Create a contests item';

                $this->form_validation->set_rules('firstname', 'FirstName', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[contests.email]');

                if ($this->form_validation->run() === FALSE)
                {
                        $data["contests"] = array("firstname"=>"","lastname"=>"","email"=>"","id"=>"");
                        $this->load->view('templates/header', $data);
                        $this->load->view('contests/edit', $data);
                        $this->load->view('templates/footer');

                }
                else
                {
                        $this->contest_model->addContests();
                        $this->session->set_flashdata('msg', 'Contest added');
                        redirect('contest', 'location');
                }
        }

        public function contest_edit($id = 0)
        {
                $this->load->helper('form');
                $this->load->library('form_validation');

                $data['title'] = 'Edit Contests Item';

                if (!$this->input->post('update'))
                {   
                     $data["contests"] = $this->contest_model->get_contests($id);
                     $this->load->view('templates/header', $data);
                     $this->load->view('contests/edit', $data);                        
                     $this->load->view('templates/footer');
                }
                else
                {        
                        $this->form_validation->set_rules('firstname', 'FirstName', 'required');
                        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
                        
                        if ($this->form_validation->run() === FALSE)
                        {
                              $this->load->view('templates/header', $data);
                              $this->load->view('contests/edit', $data);
                              $this->load->view('templates/footer');

                        }
                        else
                        {
                            $this->contest_model->updateContests($id);
                            $this->session->set_flashdata('msg', 'Contest Updated');
                            redirect('contest', 'location');                        }
                }        
        }

}