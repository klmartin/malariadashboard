<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class System extends CI_Model
{


    public function get_any_row($table,$where,$id)	{
        return $this->db->order_by('id', 'DESC')->get_where($table,[$where=>$id])->row();
    }

    public function get_any_row_asc($table,$where,$id)  {
        return $this->db->order_by('id', 'ASC')->get_where($table,[$where=>$id])->row();
    }


    public function get_any_column($column,$table,$where,$id)  {
        return $this->db->select($column)->get_where($table,[$where=>$id])->row();
    }

    public function get_all_with($table,$where,$id)	{
        return $this->db->order_by('id', 'ASC')->get_where($table,[$where=>$id])->result();
        
    }

    public function get_all_with_two_condition($table,$where,$id,$where2,$id2) {
        return $this->db->order_by('id', 'DESC')->get_where($table,[$where=>$id],[$where2=>$id2])->result();
        
    }
    
    public function get_all_with_asy($table, $tab_id_key, $tab_id_value, $visualization_id_key, $visualization_id_value){
        return $this->db->order_by('created_at', 'DESC')->limit(7)->get_where($table,[$tab_id_key=>$tab_id_value,$visualization_id_key=>$visualization_id_value])->result();
        
    }


     public function get_all_with_dsc($table,$where,$id)    {
        return $this->db->order_by('id', 'DESC')->get_where($table,[$where=>$id])->result();
        
    }
    public function get_all($table)	{
        return $this->db->order_by('id', 'DESC')->get($table)->result();
        
    }

    public function delete_data($table,$where,$id)	{
        return ($this->db->delete($table,[$where => $id]))? True: False;
    }
    public function update_data($table,$data,$where,$id)	{
        return ($this->db->update($table,$data,[$where => $id]))? True: False;
    }

    public function create_data($table,$data)	{
        return 	$this->db->insert($table,$data);
    }

     public function create_data_returns_id($table,$data)  {
        $this->db->insert($table,$data);
        return  $this->db->insert_id();

    }

    public function get_latest_record($table,$where,$id)	{
           return $this->db->order_by('id', 'DESC')->limit(1)->get_where($table,[$where=>$id])->result();
   
    }
    public function insert_file($filename, $title, $table)   {
        $data = [
            'path'      => $filename,
            'title'         => $title
        ];
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
   



}