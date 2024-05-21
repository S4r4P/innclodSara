    $(document).ready(function() {
        
        $("#logout").on('click', function() {
            
            localStorage.removeItem('sesion');
            window.location.href = "index.php";
        });

        if (!localStorage.getItem('sesion')) {

            $(".logout").css("display","none");
            window.location.href = "index.php";
        }

        else{
            $("#logout").css({
                "position": "absolute",
                "width": "5%",
                "z-index": "2",
                "top": "45px",
                "right": "60px",
                "cursor": "pointer",
            });
        }
    });
