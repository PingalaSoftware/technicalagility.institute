


if($('.btn-pref .btn').length){
        $(".btn-pref .btn").on('click', function() {
        $(".btn-pref .btn").removeClass("wp-btn").addClass("btn-default");
            // $(".tab").addClass("active"); // instead of this do the below 
            $(this).removeClass("btn-default").addClass("wp-btn");
        });
    }