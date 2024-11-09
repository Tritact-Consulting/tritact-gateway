<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $file = public_path('document/H08-Job-Application-Letter.docx');
        // $phpword = new \PhpOffice\PhpWord\TemplateProcessor($file);
        // $phpword->setValue('name', 'Render Name');
        // header("Content-Disposition: attachment; filename=edited.docx");
        // $phpword->saveAs('php://output');
        return view('admin.home');
    }
}
