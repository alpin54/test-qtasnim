<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Global_model extends CI_Model {

  public function __construct() {
    parent::__construct();
  }

  public function get_data($table, $sort = 0) {
    $this->db->from($table);
    // sort
    if ($sort !== 0) {
      $this->db->order_by($sort->field, $sort->order);
    }

    $q = $this->db->get();
    return $q->result_array();
  }

  public function get_data_where($table, $column, $value, $sorting = 0)
  {
    // where
    $this->db->where($column, $value);
    // sort
    if ($sorting !== 0) {
      $this->db->order_by($sorting->field, $sorting->order);
    }
    $q = $this->db->get($table);
    return $q->result_array();
  }

  public function get_data_multi_where($table, $multi_where = 0, $sorting = 0, $sort = 'DESC')
  {
    if ($multi_where !== 0) {
      foreach ($multi_where as $field => $val) {
        $this->db->where($field, $val);
      }
    }

    // short
    if ($sorting !== 0) {
      $this->db->order_by($sorting->field, $sorting->order);
      $this->db->order_by('created_date', $sort);
    }

    $q = $this->db->get($table);
    return $q->result_array();
  }

  public function get_data_multi_where_row($table, $multi_where = 0)
  {
    if ($multi_where !== 0) {
      foreach ($multi_where as $field => $val) {
        $this->db->where($field, $val);
      }
    }

    $q = $this->db->get($table);
    if($q->num_rows() > 0) {
      return $q->row();
    } else {
      return null;
    }
  }

  public function get_single_data($table, $column, $value) {
    $this->db->where($column, $value);
    $q = $this->db->get($table);
    if($q->num_rows() > 0) {
      return $q->row();
    } else {
      return null;
    }
  }

  public function add($table, $data) {
    $this->db->insert($table, $data);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function update($table, $data, $column, $value) {
    $this->db->where($column, $value);
    $this->db->update($table, $data);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function delete($table, $column, $value) {
    $this->db->where($column, $value);
    $this->db->delete($table);
    if ($this->db->affected_rows() > 0) {
      $this->db->query('ALTER TABLE '.$table.' AUTO_INCREMENT 1');
      return true;
    } else {
      return false;
    }
  }

  public function get_row_where($table, $multi_where = 0, $date_range = 0, $sorting = 0) {
    // multi where
    if ($multi_where !== 0) {
      foreach ($multi_where as $field => $val) {
        if($val !== 'All') {
          $this->db->where($field, $val);
        }
      }
    }

    // date range
    if ($date_range !== 0) {
      $this->db->where('sale_date' . ' >=', $date_range['start_date']);
      $this->db->where('sale_date' . ' <=', $date_range['end_date']);
    }

    // sorting
    if ($sorting !== 0) {
      $this->db->order_by($sorting->field, $sorting->order);
    }

    $q = $this->db->get($table);
    return $q->num_rows();
  }

  public function get_row_keyword($table, $multi_keyword = 0, $date_range = 0) {
    if ($multi_keyword !== 0) {
      if (count($multi_keyword) > 1) {
        $this->db->group_start();
        foreach (array_slice($multi_keyword, 0, 1) as $field => $val) {
          $this->db->like($field, $val);
        }
        foreach (array_slice($multi_keyword, 1) as $field => $val) {
          $this->db->or_like($field, $val);
        }
        $this->db->group_end();
      } else {
        foreach ($multi_keyword as $field => $val) {
          $this->db->like($field, $val);
        }
      }
    }

    if ($date_range !== 0) {
      $this->db->where($date_range['column'] . ' >=', $date_range['start_date']);
      $this->db->where($date_range['column'] . ' <=', $date_range['end_date']);
    }

    $q = $this->db->get($table);
    return $q->num_rows();
  }

  // get_data_page
  public function get_data_page($table, $multi_keyword = 0, $paging = 0, $date_range = 0)
  {
    if ($multi_keyword !== 0) {
      if (count($multi_keyword) > 1) {
        $this->db->group_start();
        foreach (array_slice($multi_keyword, 0, 1) as $field => $val) {
          $this->db->like($field, $val);
        }
        foreach (array_slice($multi_keyword, 1) as $field => $val) {
          $this->db->or_like($field, $val);
        }
        $this->db->group_end();
      } else {
        foreach ($multi_keyword as $field => $val) {
          $this->db->like($field, $val);
        }
      }
    }

    if ($date_range !== 0) {
      $this->db->where($date_range['column'] . ' >=', $date_range['start_date']);
      $this->db->where($date_range['column'] . ' <=', $date_range['end_date']);
    }

    if ($paging !== 0) {
      $start = $paging['start'];
      if ($start == 1) {
        $start = 0;
      }
      $this->db->limit($paging['limit'], $start);
    }

    $q = $this->db->get($table);
    return $q->result_array();
  }

  // get_data_page_where
  public function get_data_page_where($table, $multi_where = 0, $paging = 0, $date_range = 0, $sorting = 0)
  {
    // multi where
    if ($multi_where !== 0) {
      foreach ($multi_where as $field => $val) {
        if($val !== 'All') {
          $this->db->where($field, $val);
        }
      }
    }

    if ($date_range !== 0) {
      $this->db->where($date_range['column'] . ' >=', $date_range['start_date']);
      $this->db->where($date_range['column'] . ' <=', $date_range['end_date']);
    }

    if ($paging !== 0) {
      $start = $paging['start'];
      if ($start == 1) {
        $start = 0;
      }
      $this->db->limit($paging['limit'], $start);
    }

    // sorting
    if ($sorting !== 0) {
      $this->db->order_by($sorting->field, $sorting->order);
    }

    $q = $this->db->get($table);
    return $q->result_array();
  }

  // / update stock min
  function update_stock_min($sold, $product_id)
  {

    $query =  $this->db->query("
      UPDATE tb_product SET stock = stock - ($sold)
      WHERE product_id = '$product_id'
    ");

    return $query;
  }

  // update stock plus
  function update_stock_plus($sold, $product_id)
  {

    $query =  $this->db->query("
      UPDATE tb_product SET stock = stock + ($sold)
      WHERE product_id = '$product_id'
    ");

    return $query;
  }
}
