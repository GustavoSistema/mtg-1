<!DOCTYPE html>
<html>
<head>    
    <title>Cargo</title>
    <style>        
        @page {
            margin: 0cm 0cm;
            font-family: sans-serif;
        }

        body {
            margin:1cm 2cm 2cm;
        }       
    </style>
</head>
<body>
    <header class="flex justify-center items-center top-0 left-0">        
        <h3>{{$title}}</h1>
    </header>
    
    <main>
        <h5>{{$date}}</h2>
        <p>{{count($materiales)}}</p>
    </main>
    
    <footer>
        <p>www.motorgasperu.com</p>
    </footer>    
</body>
</html>