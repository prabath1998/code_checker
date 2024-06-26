<?php

namespace App\Http\Controllers;

use App\Http\Requests\DebugRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DebugController extends Controller
{

    function index(DebugRequest $request)
    {
        $isValidCode = $this->checkSyntax($request->code);
        if($isValidCode){
            return redirect('/')->with('success', 'Your code has no errors! 😍');
        }else{
            return redirect('/')->with('error', 'Your code has syntax errors! 😩');
        }
    }

    // Check if the code has a bracket or quote mismatching error
    // public function checkSyntax($data)
    // {

    //     $stack = [];
    //     $openBrackets = ['(', '{', '['];
    //     $closeBrackets = [')', '}', ']'];
    //     $bracketsMap = [')' => '(', '}' => '{', ']' => '['];

    //     $string = preg_replace('/\s+/', '', $data);

    //     $doubleQuoteCount = substr_count($string, '"');
    //     $singleQuoteCount = substr_count($string, "'");

    //     if ($doubleQuoteCount % 2 != 0 || $singleQuoteCount % 2 != 0) {
    //         return false;
    //     }

    //     try {
    //         for ($i = 0; $i < strlen($string); $i++) {
    //             $char = $string[$i];

    //             if (in_array($char, $openBrackets)) {
    //                 array_push($stack, $char);
    //             } elseif (in_array($char, $closeBrackets)) {
    //                 if (empty($stack)) {
    //                     return false;
    //                 }
    //                 $top = array_pop($stack);
    //                 if ($bracketsMap[$char] !== $top) {
    //                     return false;
    //                 }
    //             }
    //         }

    //         if (empty($stack)) {
    //             return true;
    //         } else {
    //             return false;
    //         }
    //     } catch (\Exception $e) {
    //         Log::error($e->getMessage());
    //         return false;
    //     }
    // }
    public function checkSyntax($data)
    {
        $stack = [];
        $openBrackets = ['(', '{', '['];
        $closeBrackets = [')', '}', ']'];
        $bracketsMap = [')' => '(', '}' => '{', ']' => '['];
        $escaped = false;


        for ($i = 0; $i < strlen($data); $i++) {
            $char = $data[$i];

            if ($escaped) {
                $escaped = false;
                continue;
            }

            if ($char === '\\') {
                $escaped = true;
                continue;
            }

            // Handle quotes
            if ($char === '"' || $char === "'") {
                $quote = $char;
                $endPos = strpos($data, $quote, $i + 1);
                if ($endPos === false) {
                    return false;
                }
                $i = $endPos;
                continue;
            }

            // Handle brackets
            if (in_array($char, $openBrackets)) {
                array_push($stack, $char);
            } elseif (in_array($char, $closeBrackets)) {
                if (empty($stack)) {
                    return false;
                }
                $top = array_pop($stack);
                if ($bracketsMap[$char] !== $top) {
                    return false;
                }
            }
        }

        return empty($stack); 
    }
}
