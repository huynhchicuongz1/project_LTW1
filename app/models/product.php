<?php 
class Product extends Db
{
    public function getAllItems()
    {
        $items = $this->getLines('SELECT * FROM products');
        return $items;
    }
        
        public function addItem($item_name,$item_price,$item_desc,$item_image)
        {
            $query = parent::$connection->prepare('INSERT INTO products(product_name,product_price,product_desc,product_image) VALUE (?, ?,?,?)');
            $query->bind_param('siss', $item_name,$item_price,$item_desc,$item_image);
            return $query->execute();
        }
        
        public function getItemById($item_id) {
            $item = $this->getLines("SELECT * FROM products WHERE product_id = $item_id");
            return $item;
        }
        
        public function editItem($item_id, $item_name,$item_price,$item_desc, $item_image) {
            $query = parent::$connection->prepare('UPDATE products SET product_name=?, product_price=? ,product_desc= ? product_image=?  WHERE product_id=?');
            $query->bind_param('sissi', $item_name,$item_price,$item_desc, $item_image, $item_id);
            return $query->execute();
        }
        public function deleteItem($item_id) {
            $query = parent::$connection->prepare("DELETE FROM products WHERE  product_id = ?");
            $query->bind_param('i' ,$item_id);
            return $query->execute();
        }
}
 ?>