<?php include_once ('style.html'); ?>
    <body>
<!-- *****  Add this link on customer profile page Or where you think. Should shown after login  -->
        <div class="contactButton">
            <button type="button" class="btn btn-success">
                <a target="popup"
                    onclick="window.open('login.php','popUpWindow','height=700,width=500,left=700,top=70,location=0,toolbar=no,menubar=no,scrollbars=yes,resizable=yes')">
                    Message us!
                </a>
            </button>
<!--  ****** Add this link on customer profile page Or where you think. Should shown after login  -->


<!--  @@@@@@@ Add this link on Admin dashboard  Or where you think. Should shown after login or have to login again -->
                <a class="btn btn-success"  href="adminLogIn.php"  target="_blank" STYLE="a{text-decoration: none;}">
                    Admin Page
                </a>
<!--  @@@@@@@ Add this link on Admin dashboard  Or where you think. Should shown after login or have to login again -->


        </div>
<?php include_once ('script.html'); ?>