<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;

class TestController extends Controller
{
    public function test(){
        $url = 'http://127.0.0.1:8000';
        $process = new Process(['node', base_path('script.js'), $url]);

        $process->setTimeout(3000);
        $process->run();

        $output = $process->getOutput();

        if (is_array($output)) {
            $output = implode('', $output); // Merge array into string
        }
        //dd($status, $output);
        return response($output, 200)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'attachment; filename="generated-file.pdf"')
        ->header('Content-Length', strlen($output));
        
    }

    public function test_render(){
        $htmlContent = view('welcome')->render();
        $process = new Process(['node', base_path('scriptrender.js'), $htmlContent]);

        $process->setTimeout(3000);
        $process->run();

        $output = $process->getOutput();

        if (is_array($output)) {
            $output = implode('', $output); // Merge array into string
        }
        //dd($status, $output);
        return response($output, 200)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'attachment; filename="generated-file.pdf"')
        ->header('Content-Length', strlen($output));
    }
}
