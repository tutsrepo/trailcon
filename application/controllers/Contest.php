<?php
class Contest extends CI_Controller {

        private $data = array();
        
        public function __construct()
        {
                parent::__construct();
                $this->load->model('contest_model');
                $this->load->helper('url_helper');

        }

        public function set_language($language)
        {
            if($language == "fr")
                $this->lang->load('contest_lang','french');
            else
            $this->lang->load('contest_lang','english');
        
            //Fetch the message from language file.
            $this->data['lang'] = $language;   
            $this->data['contest_firstname'] = $this->lang->line('contest_firstname');
            $this->data['contest_lastname'] = $this->lang->line('contest_lastname');
            $this->data['contest_email'] = $this->lang->line('contest_email');



      }


        public function set_links($lang)
        {
            if($lang=='en')
            { 
                $add_link = '/contest/details';
                $link = '/contest';
            }    
            else
            {    
                $add_link = '/concours/entree';
                $link = '/concours';
            }    
        
            $this->data['add_link'] = $add_link;
            $this->data['link'] = $link;
      }


        public function index($lang)
        {

                $this->set_language($lang);
                $this->set_links($lang);
                $data = $this->data;
                $data['contests'] = $this->contest_model->get_contests();
                $data['title'] = 'Contests archive';
                $this->load->view('templates/header', $data);
                $this->load->view('contest/index', $data);
                $this->load->view('templates/footer');        
        }

        public function contest_create($lang)
        {
                $this->set_language($lang);
                $this->set_links($lang);
                $data = $this->data;
                $this->load->helper('form');
                $this->load->library('form_validation');
                $data['title'] = 'Create a contests item';

                $this->form_validation->set_rules('firstname', 'FirstName', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[contests.email]');

                if ($this->form_validation->run() === FALSE)
                {

                    if ($this->input->post('update'))
                    {   
                        $data["contests"] = array(
                                                    "firstname"=>$this->input->post('firstname'),
                                                    "lastname"=>$this->input->post('lastname'),
                                                    "email"=>$this->input->post('email'),
                                                    "id"=>""
                                                );
                    }
                    else 
                    {
                        $data["contests"] = array("firstname"=>"","lastname"=>"","email"=>"","id"=>"");
                    }        

                        $this->load->view('templates/header', $data);
                        $this->load->view('contest/edit', $data);
                        $this->load->view('templates/footer');

                }
                else
                {
                        $this->contest_model->addContests();
                        $this->session->set_flashdata('msg', 'Contest added');
                        redirect($lang . $this->data['link'], 'location');
                }
        }

        public function contest_edit($lang, $id = 0)
        {
                $this->set_language($lang);
                $this->set_links($lang);                
                $data = $this->data;            
                
                $this->load->helper('form');
                $this->load->library('form_validation');

                $data['title'] = 'Edit Contests Item';

                if (!$this->input->post('update'))
                {   
                     $data["contests"] = $this->contest_model->get_contests($id);
                     $this->load->view('templates/header', $data);
                     $this->load->view('contest/edit', $data);                        
                     $this->load->view('templates/footer');
                }
                else
                {        
                    $original_email = $this->contest_model->get_email($id);
                    if($this->input->post('email') != $original_email) {
                        $is_unique =  '|is_unique[contests.email]';
                    } else {
                        $is_unique =  '';
                    }

                    $this->form_validation->set_rules('firstname', 'FirstName', 'required');
                    $this->form_validation->set_rules('email', 'Email', 'required|valid_email' . $is_unique);
                        
                    if ($this->form_validation->run() === FALSE)
                    {
                        $data["contests"] = array(
                                                    "firstname"=>$this->input->post('firstname'),
                                                    "lastname"=>$this->input->post('lastname'),
                                                    "email"=>$this->input->post('email'),
                                                    "id"=>$id
                                                );
                        $this->load->view('templates/header', $data);
                        $this->load->view('contest/edit', $data);
                        $this->load->view('templates/footer');

                    }
                    else
                    {
                        $this->contest_model->updateContests($id);
                        $this->session->set_flashdata('msg', 'Contest Updated');
                        redirect($lang . $this->data['link'], 'location');                        }
                    }        
                }

}