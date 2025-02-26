<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;

class AcceptAnswerController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Answer $answer)
    {
        // dd("test");
        $this->authorize('accept',$answer);
        $answer->question->acceptBestAnswer($answer);
        return back();
    }
}
