<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');
class Sitemodel extends CI_Model{
/*
		$table = String
		$join = Array
		$select = String
		$where = Array
		$order_by = String
*/
		function view($table, $select, $where=false, $join=false, $order_by=false, $limit=false, $start=false, $ex_select = true, $group_by=false){
			$this->db->select($select, $ex_select);
			$this->db->from($table);
			if ( $where )
				$this->db->where($where);
			
			if ( $order_by )
				$this->db->order_by($order_by);
			
			if ( $join ){
				foreach($join as $key => $value){
					$exp = explode(',', $value);
					$this->db->join($key, $exp[0], $exp[1]);
				}
			}
			
			if ( $limit ){
				if ( $start != 0) {
					$this->db->limit($limit, $start);
				}else{	
					$this->db->limit($limit);
				}
			}
			
			if ( $group_by )
				$this->db->group_by($group_by);
			
			$q = $this->db->get();
			if ( $q->num_rows() > 0 )
				return $q->result();
			else
				return '0';
		}
		
		function custom_query($sql, $where=false){
			if ( $where )
				$q = $this->db->query($sql, $where);
			else
				$q = $this->db->query($sql);
			
			if ( $q->num_rows() > 0 )
				return $q->result();
			else
				return '0';
		}
		
		function insert($table, $data){
			$this->db->insert($table, $data);
			$ret = $this->db->insert_id();
			return $ret;
		}
		
		function update($table, $data, $where){
			$this->db->trans_start();
			$this->db->where($where);
			$this->db->update($table, $data);
			$this->db->trans_complete();
			
			if ( $this->db->trans_status() === FALSE )
				return '0';
			else
				return '1';
		}
		
		function delete($table, $where){
			$this->db->trans_start();
			$this->db->where($where);
			$this->db->delete($table);
			$this->db->trans_complete();
			
			if ( $this->db->trans_status() === FALSE )
				return '0';
			else
				return '1';
		}

		function custom_delete($sql)
		{
			$this->db->trans_start();
			$q = $this->db->query($sql);
			$this->db->trans_complete();
			
			if ( $this->db->trans_status() === FALSE )
				return '0';
			else
				return '1';
		}

		function _get_datatable_query($select, $from, $order_by, $search, $order, $filter=false){
			$__order 			= $order_by;
			$__column_search 	= $search;
			$__column_order     = $order;

			$this->db->select($select);
			$this->db->from($from);
			$i = 0;
			$search_value = $this->input->post('search')['value'];
			foreach ($__column_search as $item){
				if ($search_value){
                if ($i === 0){ // looping awal
                	$this->db->group_start(); 
                	$this->db->like("UPPER({$item})", strtoupper($search_value), FALSE);
                }
                else{
                	$this->db->or_like("UPPER({$item})", strtoupper($search_value), FALSE);
                }
                if (count($__column_search) - 1 == $i) $this->db->group_end(); 
            }
            $i++;
        }

		if ($filter) {

			if ( isset($filter['flag']) ) {
				$this->db->where('booth_id', $filter['flag']);
			}

			if ( isset($filter['start_date']) && isset($filter['end_date']) ) {
				$this->db->where('DATE(addon) >=', $filter['start_date']);
				$this->db->where('DATE(addon) <=', $filter['end_date']);
			}

			if ( isset($filter['start_date_attendance']) && isset($filter['end_date_attendance']) ) {
				$this->db->where('DATE(attendance_date) >=', $filter['start_date_attendance']);
				$this->db->where('DATE(attendance_date) <=', $filter['end_date_attendance']);
			}
		}


        /* order by */
        if ($this->input->post('order') != null){
        	$this->db->order_by($__column_order[$this->input->post('order')['0']['column']], $this->input->post('order')['0']['dir']);
        } 
        else if (isset($__order)){
        	$order = $__order;
        	$this->db->order_by(key($order), $order[key($order)]);
        }

    }

    function get_datatable($select, $from, $order_by, $search, $order, $filter=false){
    	$this->_get_datatable_query($select, $from, $order_by, $search, $order, $filter);
    	if ($this->input->post('length') != -1) $this->db->limit($this->input->post('length'), $this->input->post('start'));
    	$query = $this->db->get();
    	return $query->result();
    }

    function get_datatable_count_filtered($select, $from, $order_by, $search, $order, $filter=false){
    	$this->_get_datatable_query($select, $from, $order_by, $search, $order, $filter);
    	$query = $this->db->get();
    	return $query->num_rows();
    }

    function get_datatable_count_all($from){
    	$this->db->from($from);
    	return $this->db->count_all_results();
    }
}