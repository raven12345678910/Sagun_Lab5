<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primary_key = 'id';
    protected $fillable = ['product_name', 'description', 'price', 'quantity'];
    protected $guarded = ['id', 'created_at'];

    public function getAll()
    {
        return $this->db->table($this->table)
            ->order_by('id', 'DESC')
            ->get_all();
    }

    public function findById($id)
    {
        return $this->db->table($this->table)
            ->where('id', $id)
            ->get();
    }

    public function createProduct($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateProduct($id, $data)
    {
        return $this->db->table($this->table)
            ->where('id', $id)
            ->update($data);
    }

    public function deleteProduct($id)
    {
        return $this->db->table($this->table)
            ->where('id', $id)
            ->delete();
    }
}
