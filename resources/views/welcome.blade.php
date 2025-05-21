@extends("master.layout")

@section("title","Online Voting System")

@section("content")
<style>
        body {
            font-family: "TechFont";
        }

        .hero {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
            url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c') center/cover no-repeat;
            height: 100vh;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .features i {
            font-size: 3rem;
            color: #007bff;
        }
        .reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
    </style>


<!-- Hero Section -->
<header class="hero" id="hero">
    <div class="container">
        <h1 class="display-4">Secure & Fast Online Voting</h1>
        <p class="lead">Vote anywhere, anytime with confidence and transparency.</p>
        <a href="{{route('login')}}" class="btn btn-primary mt-4">Get Started</a>
    </div>
</header>

<!-- Features -->
<section class="py-5 bg-light" id="features">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4 reveal">
                <i class="fas fa-lock mb-3"></i>
                <h4>Secure System</h4>
                <p>End-to-end encryption and real-time audit trails ensure full transparency.</p>
            </div>
            <div class="col-md-4 reveal">
                <i class="fas fa-vote-yea mb-3"></i>
                <h4>Easy to Use</h4>
                <p>Vote with just a few clicks, from any device, anywhere in the world.</p>
            </div>
            <div class="col-md-4 reveal">
                <i class="fas fa-tachometer-alt mb-3"></i>
                <h4>Instant Results</h4>
                <p>Votes are counted immediately and accurately after the polls close.</p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="text-center py-5" id="cta">
    <div class="container">
        <h2 class="mb-4 reveal">Ready to Vote?</h2>
        <p class="mb-4 reveal">Join thousands of users participating in secure and trustworthy elections.</p>
        <a href={{route("registration")}} class="btn btn-success btn-lg reveal">Register to Vote</a>
    </div>
</section>



<!-- Scripts -->

<script>
    // Scroll reveal animation
    function reveal() {
        let elements = document.querySelectorAll(".reveal");
        for (let el of elements) {
            let windowHeight = window.innerHeight;
            let elementTop = el.getBoundingClientRect().top;
            if (elementTop < windowHeight - 100) {
                el.classList.add("active");
            }
        }
    }

    window.addEventListener("scroll", reveal);
    window.addEventListener("load", reveal);
</script>
@endsection
