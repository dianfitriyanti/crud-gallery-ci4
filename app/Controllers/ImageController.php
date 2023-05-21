<?php  

namespace App\Controllers;  

use App\Controllers\BaseController;  
use App\Models\ImageModel;  

class ImageController extends BaseController  
{  
    public function __construct()  
    {  
        $this->model = new ImageModel();  
        $this->helpers = ['form', 'url']; 
    }  

    public function index()  
    {  
        $data = [  
            'images' => $this->model->where([
                'owner' => session()->get('username'),
            ])->paginate(6), //Mendapatkan Session ID untuk mengambil gambar sesuai pemiliknya 
            'pager' => $this->model->pager,  
            'title' => 'Welcome to My Gallery'  
        ];

        if(is_null(session()->get('logged_in')))
        {
            return redirect()->to(base_url('login'));
        }
        else{
            return view('vw_index', $data); 
        } 
    }  

    public function create()  
    {  
        $data = [  
            'title' => 'Upload New Image'  
        ];  

        if(is_null(session()->get('logged_in')))
        {
            return redirect()->to(base_url('login'));
        }
        else{
            return view('vw_create', $data); 
        }   
    }  

    public function store()  
    {  
        if ($this->request->getMethod() !== 'post') {  
            return redirect('index');  
        }  

        $validationRule = [  
            'image' => [  
                'label' => 'Image File',  
                'rules' => 'uploaded[image]'  
                    . '|is_image[image]'  
                    . '|mime_in[image,image/jpg,image/jpeg,image/gif,image/png,image/webp]'  
                    . '|max_size[image,1000]'  
                    . '|max_dims[image,4000,4000]',  
            ],  
        ];  

        $validated = $this->validate($validationRule);  

        if ($validated) {  
            $caption = $this->request->getPost('caption');
            $owner = $this->request->getPost('owner');  
            $image = $this->request->getFile('image');  
            $filename = $image->getRandomName();  
            $image->move(ROOTPATH . 'public/uploads', $filename);  

            $uploadedImage = [  
                'caption' => $caption,
                'path' => $image->getName(),
                'owner' => $owner
            ];  

            $save = $this->model->save($uploadedImage);  
            if ($save) {  
                return redirect()->to(base_url('image'))  
                    ->with('success', 'Image uploaded');  
            } else {  
                session()->setFlashdata('error', $this->model->errors());  
                return redirect()->back();  
            }  

        }  

        session()->setFlashdata('error', $this->validator->getErrors());  
        return redirect()->back();  
    }  

    public function edit($id)
    {  
        $this->model->update($id, [
                'caption' => $this->request->getPost('caption')
            ]);

            return redirect('beranda')->with('success', 'Data Updated Successfully');
    }

    public function delete($id)
    {
        $data = $this->model->find($id);
        $imageFile = $data["path"];
        //Hapus File
        unlink(ROOTPATH . 'public/uploads/'.$imageFile);

        //Hapus Data di Basis Data
        $this->model->delete($id);
        return redirect('beranda')->with('success', 'Data Deleted Successfully');
    }
}