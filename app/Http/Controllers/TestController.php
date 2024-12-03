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
        //$path = base_path('script.js');
        //$command = "node $path $url";
        
        // Use exec() to execute the command and capture the output
       // exec($command, $output, $status);

        if (is_array($output)) {
            // Log the output to see what went wrong
            $output = implode('', $output); // Merge array into string
        }
        //dd($status, $output);
        return response($output, 200)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'attachment; filename="generated-file.pdf"')
        ->header('Content-Length', strlen($output));
        
    }
}
