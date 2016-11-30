<?php
class GiftsModel extends CI_Model {

        public function __construct() {
                parent::__construct();
        }

        public function get_person_by_publicid($id) {
                $this->db->where('public_id', $id);
                $query = $this->db->get('people');
                return $query->row();
        }

        public function get_gifts($id) {
                $this->db->where('owner', $id);
                $this->db->order_by('time_stamp', 'desc');
                $query = $this->db->get('gifts');
                return $query->result();
        }

        public function add_gift() {
                $data = array(
                        'owner' => $this->input->post('owner'),
                        'name' => $this->input->post('name'),
                        'url' => $this->input->post('url')
                );
                $this->db->insert('gifts', $data);
        }

        public function remove_gift() {
                $this->db->where('id', $this->input->post('id'));
                $this->db->delete('gifts'); 
        }

        private function update_availability($id) {
                $this->db->where('public_id', $id);
                $this->db->set('availability', 'availability+1', FALSE);
                $this->db->update('people');
        }

        private function choose_giftees($id) {
                if ($id == 84642) {
                        $avoid = array('public_id !=' => $id, 'public_id !=' => 53634);
                        $this->db->where($avoid);
                } else if ($id == 53634) {
                        $avoid = array('public_id !=' => $id, 'public_id !=' => 84642);
                        $this->db->where($avoid);
                } else if ($id == 92392) {
                        $avoid = array('public_id !=' => $id, 'public_id !=' => 32848);
                        $this->db->where($avoid);
                } else if ($id == 32848) {
                        $avoid = array('public_id !=' => $id, 'public_id !=' => 92392);
                        $this->db->where($avoid);
                } else {
                        $this->db->where('public_id !=', $id);
                }
                $this->db->where('availability < 1');
                $this->db->order_by('id', 'RANDOM');
                $this->db->limit(1);
                $query = $this->db->get('people');

                $this->update_availability($query->row()->public_id);
                
                return $query->row()->public_id;
        }

        public function add_giftees() {
                $id = $this->input->post('id');
                $data = array(
                        'shopping_for' => $this->choose_giftees($id)
                );
                $this->db->where('public_id', $id);
                $this->db->update('people', $data);
        }
}
?>