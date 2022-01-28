<!DOCTYPE html>
<html lang="zh">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Labkom99.Com - Membuat Teks Mirror Efek Bergetar Dengan HTML Dan CSS</title>
 <link href="https://fonts.googleapis.com/css?family=Montserrat:700" rel="stylesheet">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
 
<style>
body {

    display: flex;

    flex-direction: column;

    justify-content: center;

    align-items: center;

    height: 100vh;

    background-color: #000;

    overflow: hidden;

}

h2 {

    position: relative;

    font-family: 'Montserrat', Arial, sans-serif;

    font-size: calc(20px + 5vw);

    font-weight: 700;

    color: #fff;

    letter-spacing: 0.02em;

    text-transform: uppercase;

    text-shadow: 0 0 0.15em #1da9cc;

    user-select: none;

    white-space: nowrap;

    filter: blur(0.007em);

    animation: shake 2.5s linear forwards;

}

h2 span {

    position: absolute;

    top: 0;

    left: 0;

    transform: translate(-50%, -50%);

    -webkit-clip-path: polygon(10% 0%, 44% 0%, 70% 100%, 55% 100%);

            clip-path: polygon(10% 0%, 44% 0%, 70% 100%, 55% 100%);

}

h2::before,

h2::after {

    content: attr(data-text);

    position: absolute;

    top: 0;

    left: 0;

}

h2::before {

    animation: crack1 2.5s linear forwards;

    -webkit-clip-path: polygon(0% 0%, 10% 0%, 55% 100%, 0% 100%);

            clip-path: polygon(0% 0%, 10% 0%, 55% 100%, 0% 100%);

}

h2::after {

    animation: crack2 2.5s linear forwards;

    -webkit-clip-path: polygon(44% 0%, 100% 0%, 100% 100%, 70% 100%);

            clip-path: polygon(44% 0%, 100% 0%, 100% 100%, 70% 100%);

}

@keyframes shake {

    5%, 15%, 25%, 35%, 55%, 65%, 75%, 95% {

        filter: blur(0.018em);

        transform: translateY(0.018em) rotate(0deg);

    }

    10%, 30%, 40%, 50%, 70%, 80%, 90% {

        filter: blur(0.01em);

        transform: translateY(-0.018em) rotate(0deg);

    }

    20%, 60% {

        filter: blur(0.03em);

        transform: translate(-0.018em, 0.018em) rotate(0deg);

    }

    45%, 85% {

        filter: blur(0.03em);

        transform: translate(0.018em, -0.018em) rotate(0deg);

    }

    100% {

        filter: blur(0.007em);

        transform: translate(0) rotate(-0.5deg);

  }

}

@keyframes crack1 {

    0%, 95% {

        transform: translate(-50%, -50%);

    } 

    100% {

        transform: translate(-51%, -48%);

    }

}

@keyframes crack2 {

    0%, 95% {

        transform: translate(-50%, -50%);

    }

    100% {

        transform: translate(-49%, -53%);

    }

}
    </style>
</head>
<body>
 <div class="htmleaf-container">
  <header class="htmleaf-header">
   <h1>API MauPedia.com <span>Membuat Teks Mirror Efek Bergetar Dengan HTML Dan CSS</span></h1>
  </header>
 </div>
 <h2 data-text="API MauPedia.com"><span>API MauPedia.com</span></h2>
</body>
</html>