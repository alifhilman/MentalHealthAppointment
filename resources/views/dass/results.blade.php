@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASS Test Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
            position: relative; /* Ensure position relative for absolute positioning */
        }
        .results {
            margin-top: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #ffffff;
            position: relative;
        }
        .results h2 {
            margin-bottom: 10px;
        }
        .score {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            position: relative;
        }
        .score .bar {
            height: 30px; /* Increase the height of the progress bar */
            flex-grow: 1;
            background-color: #e0e0e0;
            margin-left: 10px;
            position: relative;
        }
        .score .bar span {
            position: absolute;
            height: 100%;
        }
        .color-bar {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            width: 100%;
            height: 40px; /* Increase the height of the color bar */
        }
        .color-bar .bar {
            flex-grow: 1;
            height: 100%; /* Set the bar height to match the color bar height */
            margin-right: 5px;
            position: relative;
        }
        .color-bar .bar .label {
            position: absolute;
            top: 50%; /* Center the label vertically */
            left: 50%; /* Center the label horizontally */
            transform: translate(-50%, -50%);
            color: black; /* Text color */
        }
        .color-bar .label {
            text-align: center;
        }
        .message {
            margin-top: 10px;
            font-style: italic;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Mental Health Test Results (Stress, Anxiety, Depression)</h1>
        
        <!-- Add the color bar here -->
        <div class="color-bar">
            <div class="bar" style="background-color: #9ccc65;">
                <div class="label">Low</div>
            </div>
            <div class="bar" style="background-color: #fff176;">
                <div class="label">Moderate</div>
            </div>
            <div class="bar" style="background-color: #ffb74d;">
                <div class="label">Mild</div>
            </div>
            <div class="bar" style="background-color: orange;">
                <div class="label">Severe</div>
            </div>
            <div class="bar" style="background-color: red;">
                <div class="label">Extremely Severe</div>
            </div>
        </div>
        
        <div class="results">
            <h2>Stress</h2>
            <div class="score">
                <span>Score: {{ $stressScore }}</span>
                <div class="bar">
                    <span style="width: {{ ($stressScore / 21) * 100 }}%; background-color: {{ $stressScore <= 7 ? '#9ccc65' : ($stressScore <= 9 ? '#fff176' : ($stressScore <= 13 ? '#ffb74d' : ($stressScore <= 20 ? 'orange' : 'red'))) }};"></span>
                </div>
               
            </div>
            <strong><p>Result: {{ $stressResult }}</p></strong>
            @if ($stressScore > 9)
                <p class="message">Based on your responses, there is a chance that you are currently experiencing stress. Please note, this short questionnaire is just a guide and the feelings you may be experiencing could be something other than stress. We suggest that you book an appointment with professionals in TranquilMinds platform.</p>
            @elseif ($stressScore > 0)
                <p class="message">Based on your responses, you are currently experiencing a low level of stress. </p>
            @endif
        </div>
        
        
        <div class="results">
            <h2>Anxiety</h2>
            <div class="score">
                <span>Score: {{ $anxietyScore }}</span>
                <div class="bar">
                    <span style="width: {{ ($anxietyScore / 21) * 100 }}%; background-color: {{ $anxietyScore <= 7 ? '#9ccc65' : ($anxietyScore <= 9 ? '#fff176' : ($anxietyScore <= 13 ? '#ffb74d' : ($anxietyScore <= 20 ? 'orange' : 'red'))) }};"></span>
                </div>
               
            </div>
            <strong><p>Result: {{ $anxietyResult }}</p></strong>
            @if ($anxietyScore > 9)
                <p class="message">Based on your responses, there is a chance that you are currently experiencing Anxiety. Please note, this short questionnaire is just a guide and the feelings you may be experiencing could be something other than anxiety. We suggest that you book an appointment with professionals in TranquilMinds platform.</p>
            @elseif ($anxietyScore > 0 ) 
                <p class="message">Based on your responses, you are currently experiencing a low level of Anxiety. </p>
            @endif
        </div>
        
        <div class="results">
            <h2>Depression</h2>
            <div class="score">
                <span>Score: {{ $depressionScore }}</span>
                <div class="bar">
                    <span style="width: {{ ($depressionScore / 21) * 100 }}%; background-color: {{ $depressionScore <= 7 ? '#9ccc65' : ($depressionScore <= 9 ? '#fff176' : ($depressionScore <= 13 ? '#ffb74d' : ($depressionScore <= 20 ? 'orange' : 'red'))) }};"></span>
                </div>
               
            </div>
            <strong><p>Result: {{ $depressionResult }}</p></strong>
            @if ($depressionScore > 9)
                <p class="message">Based on your responses, there is a chance that you are currently experiencing depression. Please note, this short questionnaire is just a guide and the feelings you may be experiencing could be something other than depression. We suggest that you book an appointment with professionals in TranquilMinds platform.</p>
            @elseif ($depressionScore > 0)
                <p class="message">Based on your responses, you are currently experiencing a low level of depression. </p>
            @endif
        </div>
        <div class="btn btn-primary btn-secondary">
            <a href="/">Book an Appointment Now</a>
        </div>
    </div>
    
</body>
</html>
@endsection
