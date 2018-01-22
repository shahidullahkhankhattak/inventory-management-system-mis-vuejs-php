<html>
    <head>
        <title>Industrial Oil Dealer</title>
        <base href="/shahbaz_project/">
        <link rel="stylesheet" href="./css/materialize.min.css">
        <link href="./css/icons/main.css" rel="stylesheet">
        <link rel="stylesheet" href="./css/animate.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  
        <style>
            body{
                background:url("./img/background.svg");
                background-size:cover;
                background-position:fixed;
            }
            .contain{
                width:94%;
                margin-left:3%;
                margin-right:3%;
                margin-top:15px;
            }
            .card-icon{
                margin-right:3px;
            }
            body a{
                cursor:hand;
                cursor:pointer;
            }
        </style>
    </head>
    <body>
        <div id="shahbaz-app">
            <nav>
                <div class="nav-wrapper blue darken-3">
                <a href="" class="brand-logo center">Industrial Oil Dealer</a>
                </div>
            </nav>
            <router-view></router-view>
        </div>
        <div id="msgbox" class="modal">
                <div class="modal-content">
                  <h4></h4>
                  <p></p>
                </div>
                <div class="modal-footer">
                  <a class="modal-action modal-close waves-effect waves-green btn-flat">Ok</a>
                </div>
        </div>
        <script type="text/x-template" id="home-template">
            <?php 
                include('./main.html');
            ?>
        </script>
        <script type="text/x-template" id="accounts-template">
            <?php 
                include('./accounts.html');
            ?>
        </script>
        <script type="text/x-template" id="cash-template">
            <?php 
                include('./cash.html');
            ?>
        </script>
        <script type="text/x-template" id="credit-sales-template">
            <?php 
                include('./credit-sales.html');
            ?>
        </script>
        <script type="text/x-template" id="inventory-template">
            <?php 
                include('./inventory.html');
            ?>
        </script>
        <script type="text/x-template" id="recievables-template">
            <?php 
                include('./recievables.html');
            ?>
        </script>
        <script type="text/x-template" id="contacts-template">
            <?php 
                include('./contacts.html');
            ?>
        </script>
        <script type="text/x-template" id="sale-details-template">
            <?php 
                include('./sale-details.html');
            ?>
        </script>
        <script type="text/x-template" id="invoices-template">
            <?php 
                include('./invoices.html');
            ?>
        </script>
        <script type="text/x-template" id="sale-orders-template">
            <?php 
                include('./sale-orders.html');
            ?>
        </script>
        <script type="text/x-template" id="stock-template">
            <?php 
                include('./stock.html');
            ?>
        </script>
    </body>
    <script type="text/javascript" src="./js/jquery.min.js"></script>
    <script type="text/javascript" src="./js/materialize.min.js"></script>
    <script type="text/javascript" src="./js/vue.js"></script>
    <script type="text/javascript" src="./js/vue-router.js"></script>
    <script type="text/javascript" src="./js/vue-http.js"></script>
    <script type="text/javascript" src="./js/process.js"></script>
</html>