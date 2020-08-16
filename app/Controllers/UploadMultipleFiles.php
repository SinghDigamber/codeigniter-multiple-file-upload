<?php 
namespace App\Controllers;
use CodeIgniter\Controller;

class UploadMultipleFiles extends Controller
{

    public function index() {
        return view('home');
    }

    function uploadFiles() {
        helper(['form', 'url']);
 
        $database = \Config\Database::connect();
        $db = $database->table('users');
 
        $msg = 'Please select a valid files';
  
        if ($this->request->getFileMultiple('images')) {
 
             foreach($this->request->getFileMultiple('images') as $file)
             {   
 
                $file->move(WRITEPATH . 'uploads');
 
              $data = [
                'name' =>  $file->getClientName(),
                'type'  => $file->getClientMimeType()
              ];
 
              $save = $db->insert($data);
              $msg = 'Files have been successfully uploaded';
             }
        }
 
        return redirect()->to( base_url('/') )->with('msg', $msg);        
    }

}