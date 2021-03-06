<?php
    class Profile extends Controller{
        public function __construct(){
            if(!Session::Auth())
                header("Location: /");
    
            parent::__construct();
    
            if(isset($_GET['id'])) $id = $_GET['id'];
            else $id = Session::getKey('id');
    
            $this->view->id = $id;
            $this->view->css[] = "layout";
            $this->view->postjs[] = "layout";
        }
    
        public function index(){
            $this->view->css[] = "profile";
            $this->view->model = $this->model;
    
            $this->view->title = "Profile";
            $this->view->renderView(__CLASS__,__FUNCTION__);
        }
    
        public function posts() {
            $this->view->css[] = "posts";
    
            $this->view->title = "Posts";
            $this->view->renderView(__CLASS__,__FUNCTION__);
        }
    
        public function photos() {
            $this->view->css[] = "photos";
    
            $this->view->title = "Photos";
            $this->view->renderView(__CLASS__,__FUNCTION__);
        }
    
        public function album($id = NULL) {
            if(!$id) {
                $this->photos();
                return;
            }
            $this->view->css[] = "photos";
    
            $this->view->title = "Album";
            $this->view->renderView(__CLASS__,__FUNCTION__);
        }
    
        public function friends() {
            $this->view->css[] = "friends";
    
            $this->view->title = "Friends";
            $this->view->renderView(__CLASS__,__FUNCTION__);
        }
    
        public function settings() {
            $this->view->css[] = "settings";
    
            $this->view->title = "Settings";
            $this->view->renderView(__CLASS__,__FUNCTION__);
        }
    
         public function edit() {
            $this->view->id = Session::getKey("id");
            $this->view->css[] = "edit";
            $this->view->model = $this->model;
    
            $this->view->title = "Edit Profile";
            $this->view->renderView(__CLASS__,__FUNCTION__);
        }
    
        public function editSave(){
            if(isset($_POST['submit']))
            {
                $this->model->updateDetails(Session::getKey("id"), $_POST );
                header("Location: /profile"); 
            }
            else
            {
                $err = new Error(420);
                $err->index();
                return FALSE;                
            }
        }
    }
?>

