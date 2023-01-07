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
            display: block;
        } 
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;            
            color: black;
            font-weight: bold;      
            text-align: center;     
        }
        
       

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;         
            color: black;
            text-align: center;
            line-height: 35px;
        } 
        p{
            left: 0;
        }
        image{
            margin-left: 2cm;
        }
        h5{
            margin-top: 150px;
            color: black; 
        }   
    </style>
</head>
<body>
    <header>
        <p>          
            <img  src="{{public_path('/images/mtg.png')}}" width="90" height="90"/>
            
        </p>       
        <h1>{{$empresa}}</h1>
    </header>  
   
    <main>        
        <h5>Lima, {{$date}}</h5>
        <br>
        <p>Señor(a):</p>        
        <p>{{$inspector}}</p>
        <br>
        <p>Asunto:</p>        
        <p>Le enviamos el siguiente material de trabajo por parte de la empresa <strong>{{$empresa}}</strong> </p>
        <ol>
            <li>ariculo 1 cantidad 1</li>            
        </ol>
        <p>{{$materiales}}</p>
        <p>Sin otro particular me despido de ud.</p>
    </main>
    
    <footer>
        <p>www.motorgasperu.com</p>
    </footer>    
</body>
</html>