<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use App\Models\Resume;  


use Illuminate\Support\Facades\Auth;

class PDFResumeController extends Controller
{
    function __construct(){
        $this->middleware('auth');
    }

    public function viewResumePDF(Resume $resume)
    {
        $filePath = public_path('uploads/' . $resume->resume);

        if (!File::exists($filePath)) {
            return to_route("users.edit" , $resume->user)->with('error', 'Error Happend While loading resume.');
        }
    
        return Response::file($filePath, [
            'Content-Type' => 'application/pdf',
        ]);
    }

    public function downloadResumePDF(Resume $resume)
    {
        $filePath = public_path('uploads/' . $resume->resume);

        if (!File::exists($filePath)) {
            return to_route("users.edit" , $resume->user)->with('error', 'Error Happend While loading resume.');

        }
    

        return Response::download($filePath,$resume->user->name.'_Resume_better_career.pdf', [
            'Content-Type' => 'application/pdf',
        ]);
    }
    
    public function deleteResume(Resume $resume)
    {
        $resume->delete();
        return to_route("users.edit" , $resume->user)->with('success', 'Resume deleted successfully.');

    }
}
