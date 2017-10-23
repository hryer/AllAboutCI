<?php 
		
	class Product extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model("ProductsModel");
			$this->load->library("pagination");

		}

		public function index(){
			$config=array();
			$config["base_url"]=base_url() . "Products";
			$config["per_page"]=9;
			$config["uri_segment"]=2;
			$config["total_rows"]= $this->ProductsModel->getTotalProducts();
			
			$config["full_tag_open"]="<ul>";
			$config["full_tag_close"]="</ul>";
			
			
			$config["first_tag_open"]="<li class='paging_item'>";
			$config["first_link"]="&lt;&lt;";
			$config["first_tag_close"]="</li>";

			$config["last_tag_open"]="<li class='paging_item'>";
			$config["last_link"]="&gt;&gt;";
			$config["last_tag_close"]="</li>";

			$config["prev_tag_open"]="<li class='paging_item'>";
			$config["prev_link"]="&lt;";
			$config["prev_tag_close"]="</li>";

			$config["next_tag_open"]="<li class='paging_item'>";
			$config["next_link"]="&gt;";
			$config["next_tag_close"]="</li>";

			$config["cur_tag_open"]="<li class='paging_item paging_item_active'><a href='#'>";
			$config["cur_tag_close"]="</a></li>";

			$config["num_tag_open"]="<li class='paging_item'";
			$config["num_tag_close"]="</li>";




			$this->pagination->initialize($config);

			$data["content_page"] = "product_layout";
			$data["catagories"] = $this->ProductsModel->getBrand();

			$start_data=($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
			$data["products_data"]=$this->ProductsModel->getProductsPage($start_data,$config["per_page"]);
			$this->load->view("index",$data);
		}

		public function productsBrand($brand_id){
		

			$data["content_page"] = "product_layout";
			$data["catagories"] = $this->ProductsModel->getBrand();
			$start_data=($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
			$data["products_data"]=$this->ProductsModel->getProductsBrand($brand_id);
			$this->load->view("index",$data);

	
		}

		public function productDetail($shoes_id){
			$data["content_page"] = "detail_product_layout";
			$data["product_data"]=$this->ProductsModel->getProductsDetail($shoes_id);
			$data["catagories"] = $this->ProductsModel->getBrand();
			$data["picture"] = $this->ProductsModel->getAnotherPicture($shoes_id);
			$this->load->view("index",$data);
		}

	

	}

 ?>