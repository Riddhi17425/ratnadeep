<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CertificationController extends Controller
{
    public function index()
    {
        $certificates = getActiveCertificates();

        return view('front.certifications', compact('certificates'));
    }
}
