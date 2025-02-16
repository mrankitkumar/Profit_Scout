@extends('user.master')
@section('title', 'test')
<link rel="stylesheet" href="{{ url("css/faq.css")}}" />
@section('content')

<div class="content-header bcolor">
    <div class="container-fluid">
        <div class="faq-container mt-5">
            <h1>FAQs</h1>
            @foreach ($faq as $val)
            <div class="faq-item">
                <div class="faq-question">
                    <h2>
                        {{ $val->question }}
                    </h2>
                    <img id="trans" src="{{ url('/img/user/expand_circle_down.svg') }}" alt="" />
                </div>
                <div class="faq-answer">


                    {!! $val->answer !!}

                </div>
            </div>
            @endforeach


        </div>
    </div>
</div>
<script>
    const faqQuestions = document.querySelectorAll(".faq-question");
    const userImageActive = "{{ url('/img/user/expand_circle_down.svg') }}"; // Active image
    const userImageDefault = "{{ url('/img/user/expand_circle_down.svg') }}"; // Default image
    

    faqQuestions.forEach((question) => {
        question.addEventListener("click", () => {
            const answer = question.nextElementSibling;
            const img = question.querySelector("img"); // Get the image inside the clicked question

            question.classList.toggle("active");
            answer.classList.toggle("active");

            // Toggle the image source based on the active class
            if (question.classList.contains("active")) {
                img.src = userImageActive; // Change to active image
                img.style.transform = "rotate(0deg)"; 
            } else {
                img.src = userImageDefault; 
                img.style.transform = "rotate(180deg)"; 
                
            }
        });
    });
</script>

@endsection