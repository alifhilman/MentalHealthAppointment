<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DASSController extends Controller
{
    public function index()
    {
        return view('dass.index');
    }

    public function submit(Request $request)
    {
        $data = $request->validate([
            'q1' => 'required|integer|min:0|max:3',
            'q2' => 'required|integer|min:0|max:3',
            'q3' => 'required|integer|min:0|max:3',
            'q4' => 'required|integer|min:0|max:3',
            'q5' => 'required|integer|min:0|max:3',
            'q6' => 'required|integer|min:0|max:3',
            'q7' => 'required|integer|min:0|max:3',
            'q8' => 'required|integer|min:0|max:3',
            'q9' => 'required|integer|min:0|max:3',
            'q10' => 'required|integer|min:0|max:3',
            'q11' => 'required|integer|min:0|max:3',
            'q12' => 'required|integer|min:0|max:3',
            'q13' => 'required|integer|min:0|max:3',
            'q14' => 'required|integer|min:0|max:3',
            'q15' => 'required|integer|min:0|max:3',
            'q16' => 'required|integer|min:0|max:3',
            'q17' => 'required|integer|min:0|max:3',
            'q18' => 'required|integer|min:0|max:3',
            'q19' => 'required|integer|min:0|max:3',
            'q20' => 'required|integer|min:0|max:3',
            'q21' => 'required|integer|min:0|max:3',
        ]);

        $stressScore = $data['q1'] + $data['q6'] + $data['q8'] + $data['q11'] + $data['q12'] + $data['q14'] + $data['q18'];
        $anxietyScore = $data['q2'] + $data['q4'] + $data['q7'] + $data['q9'] + $data['q15'] + $data['q19'] + $data['q20'];
        $depressionScore = $data['q3'] + $data['q5'] + $data['q10'] + $data['q13'] + $data['q16'] + $data['q17'] + $data['q21'];

        return view('dass.results', [
            'stressScore' => $stressScore,
            'anxietyScore' => $anxietyScore,
            'depressionScore' => $depressionScore,
            'stressResult' => $this->getResultText($stressScore),
            'anxietyResult' => $this->getResultText($anxietyScore),
            'depressionResult' => $this->getResultText($depressionScore),
        ]);
    }

    private function getResultText($score)
    {
        if ($score >= 0 && $score <= 7) return 'Normal';
        if ($score >= 8 && $score <= 9) return 'Mild';
        if ($score >= 10 && $score <= 13) return 'Moderate';
        if ($score >= 14 && $score <= 20) return 'Severe';
        return 'Extremely Severe';
    }

    public function showTestForm()
    {
        return view('dass.index');
    }
}
