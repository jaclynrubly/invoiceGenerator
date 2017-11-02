<!doctype html>
<html>
    <head>
        <title>Nix Tree Services PDF Creator</title>
        
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
        <header align = 'center'>
            <img src="/nixtreecare/imgs/logo.jpg" width = "50" width = "50">
            <h1>
                Nix Tree Services
            </h1>
        </header>        
        <br>
        <div id = "input">
            <form action="pdfcreator.php" method = 'post'>
                <p>
                    <label>Customer Name:</label>
                    <br>
                    <input type='text' name='custName' />
                </p>
                <p>
                    <label>Address:</label>
                    <input type='text' name='street' />
                </p>
                <p>
                    <label>City:</label>
                    <input type='text' name='city' />
                </p>
                <p>
                    <label>Phone/ Ext:</label>
                    <input type='text' name='phone' />
                </p>
                <p>
                    <label>Email:</label>
                    <input type='text' name='email' />
                </p>
            </form>
        </div>
    </body>
</html>