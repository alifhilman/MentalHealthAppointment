@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Screening and Appointment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            text-align: center;
        }
        .description {
            background-color: #e0f7fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
        .question {
            margin-bottom: 15px;
        }
        .question label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .question span {
            display: block;
            font-size: 0.9em;
            color: #555;
        }
        .options {
            display: flex;
            justify-content: space-around;
        }
        .options label {
            display: flex;
            align-items: center;
        }
        .options input {
            margin-right: 5px;
        }
        .submit {
            text-align: center;
        }
        .submit button {
            padding: 10px 20px;
            background-color: #00796b;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .submit button:hover {
            background-color: #004d40;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Patient Screening and Appointment</h1>
        <h2>Depression Anxiety Stress Test (DASS)</h2>
        <div class="description">
            Please read each statement and select a number (0, 1, 2, or 3) that indicates how much the statement applied to you over the past week.<br>
            There are no right or wrong answers. Do not spend too much time on any statement.
        </div>
        <form method="POST" action="{{ route('dass.submit') }}">
        @csrf
            <div class="question">
                <label for="q1">I found it hard to wind down*</label>
                <span>Saya dapati diri saya sukar ditenteramkan.</span>
                <div class="options">
                    <label><input type="radio" name="q1" value="0"> 0</label>
                    <label><input type="radio" name="q1" value="1"> 1</label>
                    <label><input type="radio" name="q1" value="2"> 2</label>
                    <label><input type="radio" name="q1" value="3"> 3</label>
                </div>
            </div>
            <div class="question">
                <label for="q2">I was aware of dryness of my mouth*</label>
                <span>Saya sedar mulut saya terasa kering.</span>
                <div class="options">
                    <label><input type="radio" name="q2" value="0"> 0</label>
                    <label><input type="radio" name="q2" value="1"> 1</label>
                    <label><input type="radio" name="q2" value="2"> 2</label>
                    <label><input type="radio" name="q2" value="3"> 3</label>
                </div>
            </div>
            <div class="question">
                <label for="q3">I couldn't seem to experience any positive feeling at all*</label>
                <span>Saya tidak dapat mengalami perasaan positif sama sekali.</span>
                <div class="options">
                    <label><input type="radio" name="q3" value="0"> 0</label>
                    <label><input type="radio" name="q3" value="1"> 1</label>
                    <label><input type="radio" name="q3" value="2"> 2</label>
                    <label><input type="radio" name="q3" value="3"> 3</label>
                </div>
            </div>
            <div class="question">
                <label for="q4">I experienced breathing difficulty (eg, excessively rapid breathing, breathlessness in the absence of physical exertion)*</label>
                <span>Saya mengalami kesukaran bernafas (contohnya pernafasan yang laju, tercungap-cungap walaupun tidak melakukan senaman fizikal).</span>
                <div class="options">
                    <label><input type="radio" name="q4" value="0"> 0</label>
                    <label><input type="radio" name="q4" value="1"> 1</label>
                    <label><input type="radio" name="q4" value="2"> 2</label>
                    <label><input type="radio" name="q4" value="3"> 3</label>
                </div>
            </div>
            <div class="question">
                <label for="q5">I found it difficult to work up the initiative to do things*</label>
                <span>Saya sukar untuk mendapatkan semangat bagi melakukan sesuatu perkara.</span>
                <div class="options">
                    <label><input type="radio" name="q5" value="0"> 0</label>
                    <label><input type="radio" name="q5" value="1"> 1</label>
                    <label><input type="radio" name="q5" value="2"> 2</label>
                    <label><input type="radio" name="q5" value="3"> 3</label>
                </div>
            </div>
            <div class="question">
                <label for="q6">I tended to over-react to situations*</label>
                <span>Saya cenderung untuk bertindak keterlaluan dalam sesuatu keadaan.</span>
                <div class="options">
                    <label><input type="radio" name="q6" value="0"> 0</label>
                    <label><input type="radio" name="q6" value="1"> 1</label>
                    <label><input type="radio" name="q6" value="2"> 2</label>
                    <label><input type="radio" name="q6" value="3"> 3</label>
                </div>
            </div>
            <div class="question">
                <label for="q7">I experienced trembling (eg, in the hands)*</label>
                <span>Saya rasa menggeletar (terutamanya pada tangan).</span>
                <div class="options">
                    <label><input type="radio" name="q7" value="0"> 0</label>
                    <label><input type="radio" name="q7" value="1"> 1</label>
                    <label><input type="radio" name="q7" value="2"> 2</label>
                    <label><input type="radio" name="q7" value="3"> 3</label>
                </div>
            </div>
            <div class="question">
                <label for="q8">I felt that I was using a lot of nervous energy*</label>
                <span>Saya rasa saya menggunakan banyak tenaga dalam keadaan resah.</span>
                <div class="options">
                    <label><input type="radio" name="q8" value="0"> 0</label>
                    <label><input type="radio" name="q8" value="1"> 1</label>
                    <label><input type="radio" name="q8" value="2"> 2</label>
                    <label><input type="radio" name="q8" value="3"> 3</label>
                </div>
            </div>
            <div class="question">
                <label for="q9">I was worried about situations in which I might panic and make a fool of myself*</label>
                <span>Saya bimbang keadaan di mana saya mungkin menjadi panik dan melakukan perkara yang membodohkan diri sendiri.</span>
                <div class="options">
                    <label><input type="radio" name="q9" value="0"> 0</label>
                    <label><input type="radio" name="q9" value="1"> 1</label>
                    <label><input type="radio" name="q9" value="2"> 2</label>
                    <label><input type="radio" name="q9" value="3"> 3</label>
                </div>
            </div>
            <div class="question">
                <label for="q10">I felt that I had nothing to look forward to*</label>
                <span>Saya rasa saya tidak mempunyai apa-apa untuk diharapkan.</span>
                <div class="options">
                    <label><input type="radio" name="q10" value="0"> 0</label>
                    <label><input type="radio" name="q10" value="1"> 1</label>
                    <label><input type="radio" name="q10" value="2"> 2</label>
                    <label><input type="radio" name="q10" value="3"> 3</label>
                </div>
            </div>
            <div class="question">
                <label for="q11">I found myself getting agitated*</label>
                <span>Saya dapati diri saya semakin gelisah.</span>
                <div class="options">
                    <label><input type="radio" name="q11" value="0"> 0</label>
                    <label><input type="radio" name="q11" value="1"> 1</label>
                    <label><input type="radio" name="q11" value="2"> 2</label>
                    <label><input type="radio" name="q11" value="3"> 3</label>
                </div>
            </div>
            <div class="question">
                <label for="q12">I found it difficult to relax*</label>
                <span>Saya sukar untuk relaks.</span>
                <div class="options">
                    <label><input type="radio" name="q12" value="0"> 0</label>
                    <label><input type="radio" name="q12" value="1"> 1</label>
                    <label><input type="radio" name="q12" value="2"> 2</label>
                    <label><input type="radio" name="q12" value="3"> 3</label>
                </div>
            </div>
            <div class="question">
                <label for="q13">I felt down-hearted and blue*</label>
                <span>Saya rasa sedih dan murung.</span>
                <div class="options">
                    <label><input type="radio" name="q13" value="0"> 0</label>
                    <label><input type="radio" name="q13" value="1"> 1</label>
                    <label><input type="radio" name="q13" value="2"> 2</label>
                    <label><input type="radio" name="q13" value="3"> 3</label>
                </div>
            </div>
            <div class="question">
                <label for="q14">I was intolerant of anything that kept me from getting on with what I was doing*</label>
                <span>Saya tidak dapat menahan sabar dengan perkara yang menghalang saya meneruskan apa yang saya lakukan.</span>
                <div class="options">
                    <label><input type="radio" name="q14" value="0"> 0</label>
                    <label><input type="radio" name="q14" value="1"> 1</label>
                    <label><input type="radio" name="q14" value="2"> 2</label>
                    <label><input type="radio" name="q14" value="3"> 3</label>
                </div>
            </div>
            <div class="question">
                <label for="q15">I felt I was close to panic*</label>
                <span>Saya rasa hampir-hampir menjadi panik/cemas.</span>
                <div class="options">
                    <label><input type="radio" name="q15" value="0"> 0</label>
                    <label><input type="radio" name="q15" value="1"> 1</label>
                    <label><input type="radio" name="q15" value="2"> 2</label>
                    <label><input type="radio" name="q15" value="3"> 3</label>
                </div>
            </div>
            <div class="question">
                <label for="q16">I was unable to become enthusiastic about anything*</label>
                <span>Saya tidak bersemangat dengan apa jua yang saya lakukan.</span>
                <div class="options">
                    <label><input type="radio" name="q16" value="0"> 0</label>
                    <label><input type="radio" name="q16" value="1"> 1</label>
                    <label><input type="radio" name="q16" value="2"> 2</label>
                    <label><input type="radio" name="q16" value="3"> 3</label>
                </div>
            </div>
            <div class="question">
                <label for="q17">I felt I wasn't worth much as a person*</label>
                <span>Saya tidak begitu berharga sebagai seorang individu.</span>
                <div class="options">
                    <label><input type="radio" name="q17" value="0"> 0</label>
                    <label><input type="radio" name="q17" value="1"> 1</label>
                    <label><input type="radio" name="q17" value="2"> 2</label>
                    <label><input type="radio" name="q17" value="3"> 3</label>
                </div>
            </div>
            <div class="question">
                <label for="q18">I felt that I was rather touchy*</label>
                <span>Saya rasa saya mudah tersentuh.</span>
                <div class="options">
                    <label><input type="radio" name="q18" value="0"> 0</label>
                    <label><input type="radio" name="q18" value="1"> 1</label>
                    <label><input type="radio" name="q18" value="2"> 2</label>
                    <label><input type="radio" name="q18" value="3"> 3</label>
                </div>
            </div>
            <div class="question">
                <label for="q19">I was aware of the action of my heart in the absence of physical exertion (eg, sense of heart rate increase, heart missing a beat)*</label>
                <span>Saya sedar tindakan jantung saya walaupun tidak melakukan aktiviti fizikal (contohnya kadar denyutan jantung bertambah, atau denyutan jantung berkurangan).</span>
                <div class="options">
                    <label><input type="radio" name="q19" value="0"> 0</label>
                    <label><input type="radio" name="q19" value="1"> 1</label>
                    <label><input type="radio" name="q19" value="2"> 2</label>
                    <label><input type="radio" name="q19" value="3"> 3</label>
                </div>
            </div>
            <div class="question">
                <label for="q20">I felt scared without any good reason*</label>
                <span>Saya berasa takut tanpa sebab yang munasabah.</span>
                <div class="options">
                    <label><input type="radio" name="q20" value="0"> 0</label>
                    <label><input type="radio" name="q20" value="1"> 1</label>
                    <label><input type="radio" name="q20" value="2"> 2</label>
                    <label><input type="radio" name="q20" value="3"> 3</label>
                </div>
            </div>
            <div class="question">
                <label for="q21">I felt that life was meaningless*</label>
                <span>Saya rasa hidup ini tidak bermakna.</span>
                <div class="options">
                    <label><input type="radio" name="q21" value="0"> 0</label>
                    <label><input type="radio" name="q21" value="1"> 1</label>
                    <label><input type="radio" name="q21" value="2"> 2</label>
                    <label><input type="radio" name="q21" value="3"> 3</label>
                </div>
            </div>
            <div class="submit">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>
@endsection