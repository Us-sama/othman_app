    <!DOCTYPE html>
    <html>
    <head>
        <title>Demande pour une enquête</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 20px;
                background-color: #f3f4f6;
            }

            h1 {
                font-size: 24px;
                margin-bottom: 10px;
                color: #333;
                text-align: center;

            }

            p {
                font-size: 16px;
                margin-bottom: 5px;
                color: #666;
            }
            hr{
                color: #666;
                background: #666;
            }
            .footer{
                text-align: end;
            }
            .logo {
                max-width: 200px;
                margin-bottom: 20px;
            }
        </style>
    </head>
    <body>
        <h1>Demande pour enquête</h1>
        <div style="background: #FFFFFF ;padding:10px; border-radius: 5px;">
            <h3>{{ $demande->demandeur->Nom }}&nbsp;{{ $demande->demandeur->Prenom }}</h3>
            <p><b> CIN: </b>{{ $demande->demandeur->CIN }}</p>
            <p><b>Date de naissance: </b>{{ $demande->demandeur->birthdate }}</p>
            <p><b>Demande ID: </b>{{ $demande->id }}</p>
            <p><b>Crée le: </b>{{ $demande->created_at }}</p>
        </div>
        <hr>
        <div style="background: #FFFFFF ;padding:10px; border-radius: 5px;">
            <h2>Agent: {{Auth::user()->name}}</h2>
            <p><b>E-mail: </b>{{Auth::user()->email}}</p>
        </div>
        <div style="text-align: right; padding:25px">
            <p>signature:</p>
        </div>
    </body>
    </html>

