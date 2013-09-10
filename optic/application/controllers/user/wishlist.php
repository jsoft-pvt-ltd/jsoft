<?php class Wishlist extends CI_Controller{
     public function __construct() {
         parent::__construct();
         $this->load->model('user/wishlist_model');
     }
     function index($pid)
     {
        $this->load->helper('login_helper');
        if(IsLoggedIn()==1)
        {
            $product = $this->wishlist_model->select_product_for_wishlist($pid);
            echo $this->wishlist_model->insert_wishlist($product);
        }
        else
        {   echo "login";   }
     }
     function edit_wishlist()
     {
         $user = $this->session->userdata('userId');
         $data['page'] = "user/my_wishlist";
         $data['title'] = "My Wishlist";
         $data['wishlists'] = $this->wishlist_model->select_all_my_wishlist($user);
         $this->load->view('user/container',$data);
     }
     function delete_wishlist($wishlist_id)
     {
         $this->wishlist_model->delete_product_from_wishlist($wishlist_id);
         redirect(base_url().'user/wishlist/edit_wishlist');
     }
}

?>
