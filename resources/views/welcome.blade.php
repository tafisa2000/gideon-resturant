<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restorant App</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
    font-family: Arial, sans-serif;
    background-image: url('/storage/rest.jpg');
    background-size: cover; 
    background-position: center;
    background-repeat: no-repeat; 
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh;
    color: white;
}

        header {
            width: 100%;
            padding: 20px;
            background-color: orange; 
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: flex-end;
            position: absolute;
            top: 0;
            right: 0;
        }

        .nav-links a {
            margin-left: 10px;
            text-decoration: none;
            padding: 10px;
            color: black;
            border-radius: 5px;
            transition: 0.3s;
        }

        .nav-links a:hover {
            background-color: #ddd;
        }

        .slider-container {
            position: relative;
            width: 300px;
            height: 400px;
            overflow: hidden;
            perspective: 1000px;
            margin-top: 80px;
        }

        .card-slider {
            display: flex;
            flex-direction: column;
            transition: transform 0.8s ease-in-out;
        }

        .card {
            min-height: 300px;
            margin: 15px 0;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            overflow: hidden;
            transform-style: preserve-3d;
            transition: transform 0.8s;
            position: relative;
        }

        .card .front, .card .back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
        }

        .card .back {
            background-color: #333;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            transform: rotateY(180deg);
        }

        .card.show-front {
            transform: rotateY(180deg);
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .card h3 {
            padding: 10px 0;
            font-size: 1.2rem;
            color: #333;
        }

        .card p {
            padding: 0 10px 20px;
            font-size: 1rem;
            color: #666;
        }
    </style>
</head>
<body>
    <header>
        @if (Route::has('login'))
            <nav class="nav-links">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-black">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-black">
                        Log in
                    </a>
                @endauth
            </nav>
        @endif
    </header>

    <section class="slider-container">
        <div class="card-slider">
        @foreach ($menus as $key => $item)
            <div class="card">
                <div class="front">
                    <img src="{{ asset($item->image_url) }}" alt="Image 1">
                    <h3>{{ $item->name }}</h3>
                    <p>Price: {{ $item->price }}Tsh</p>
                </div>
                <div class="back">
                    <h3>Back of Card 1</h3>
                </div>
            </div>
        @endforeach
        </div>
    </section>

    <script>
        const slider = document.querySelector('.card-slider');
        const cards = document.querySelectorAll('.card');
        let currentSlide = 0;

        function autoSlide() {
            const totalCards = cards.length;
            cards.forEach((card, index) => {
                card.classList.remove('show-front'); 
                if (index === currentSlide) {
                    card.classList.add('show-front');
                }
            });
            currentSlide = (currentSlide + 1) % totalCards;
            slider.style.transform = `translateY(-${currentSlide * 330}px)`;
        }
        setInterval(autoSlide, 3000);
    </script>

</body>
</html>
