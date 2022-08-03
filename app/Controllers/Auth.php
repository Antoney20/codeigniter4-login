<?php

namespace App\Controllers;
use App\Libraries\Hash;
use App\Controllers\BaseController;
use App\Models\UsersModel;

class Auth extends BaseController
{
        // enabling features 
   public function __construct()
   {
        helper(['url', 'form']);
    }
    public function register()
    {
        return view('auth/register');
    }
    public function index(){
        return view('auth/login');
    }

    //***********//
   // ***** USER REGISTRATION METHOD ***//
   //*********//
    public function Save(){
               //validate user input
         //  $validated = $this->validate([
         //   'name'=> 'required',
        //    'email' => 'required|valid_email',
        //   'password' => 'required|min_length[5]|max_length[20]',
        //  'cpassword'=> 'required|min_length[5]|max_length[20]|matches[password]'
        //]);
          
         $validated =$this->validate([
            'name' => [
               'rules' => 'required',
               'errors' => [
                 'required' => 'Your full name is required', 
               ]
           ],
            'email'=> [
            'rules' => 'required|valid_email',
                  'errors' => [
                   'required' => 'Your email is required', 
                    'valid_email' => 'Enter a valid email.',
                ]
            ],
            'password'=> [
                'rules' => 'required|min_length[5]|max_length[20]',
                'errors' => [
                    'required' => 'Your password is required', 
                    'min_length' => 'Password must be 5 charectars long',
                    'max_length' => 'Password cannot be longer than 20 charectars'
                ]
            ],
            'cpassword'=> [
                'rules' => 'required|min_length[5]|max_length[20]|matches[password]',
                'errors' => [
                    'required' => 'Your confirm password is required', 
                    'min_length' => 'Password must be 5 charectars long',
                    'max_length' => 'Password cannot be longer than 20 charectars',
                    'matches' => 'Confirm password must match the password',
                ]
            ],
          ]);
      if(!$validated)
         {
              return view('auth/register', ['validation' => $this->validator]);
          }
        else {
            //echo'fORM VALIDATED SUCCESFULLY';
            // INSERTING THE USER DATA INTO  THE DATABASE  /// Here we save the user.
             $name = $this->request->getPost('name');
             $email = $this->request->getPost('email');
             $password = $this->request->getPost('password');
             $cpassword = $this->request->getPost('cpass');

             
             $data = [
            'name' => $name,
            'email' => $email,
            'password' => Hash::encrypt($password),
         ];

                   // Storing data 

         $userModel = new \App\Models\UsersModel();
         /// QUERY THAT INSERTS USER / DATA TO THE DATABASE
         $query = $userModel->insert($data);
          //DISPLAYING ERROR MESSAGES IF IT FAILS 
          if(!$query)
             {
                   return redirect()->back()->with('fail', 'Saving user failed');
              }
         else
           {
              return redirect()->to('auth/register')->with('success', 'Registered successfully');
           }
        }
    }
    /**
      * User login method.
      */
      public function Check()
      {
        // Validating user input.

        $validated = $this->validate([
            'email'=> [
                'rules' => 'required|valid_email|is_not_unique[users.email]',
                'errors' => [
                    'required' => 'Your email is required', 
                    'valid_email' => 'Email is already used.',
                    'is_not_unique' => 'Your email is not registered',
                ]
            ],
            'password'=> [
                'rules' => 'required|min_length[5]|max_length[20]',
                'errors' => [
                    'required' => 'Your password is required', 
                    'min_length' => 'Password must be 5 charectars long',
                    'max_length' => 'Password cannot be longer than 20 charectars',
                  
                    
                ]
            ],
        ]);

        if(!$validated)
        {
            return view('auth/login', ['validation' => $this->validator]);
        }

        else {        
        
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');  
            $usersModel = new \App\Models\UsersModel();
            //$userModel = new UsersModel();
            $user_info = $usersModel->where('email', $email)->first();
            $checkPassword = Hash::checkp($password, $user_info['password']);
            echo'success login '; 
            
            if(!$checkPassword)
            {
                session()->setFlashdata('fail', 'Incorrect password provided');
                return redirect()->to('/auth')->withInput();
            }
           else {
            $userId = $user_info['id'];

            session()->set('loggedInUser', $userId);
            return redirect()->to('/dashboard');

           }
        }

    }
}