<?php include_once ('style.html'); ?>
    <body>
        <div class="contactButton">
            <button type="button" class="btn btn-success">
                <a target="popup"
                    onclick="window.open('login.php','popUpWindow','height=700,width=500,left=700,top=70,location=0,toolbar=no,menubar=no,scrollbars=yes,resizable=yes')">
                    Message us!
                </a>
            </button>
                <a class="btn btn-success"  href="adminLogIn.php"  target="_blank" STYLE="a{text-decoration: none;}">
                    Admin Page
                </a>

        </div>
<?php include_once ('script.html'); ?>