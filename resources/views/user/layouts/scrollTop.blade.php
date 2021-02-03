<style>
    #scroll-top
    {
        width: 50px;
        height: 50px;
        color: #3ea2b8;
        background: #fff;
        text-align: center;
        line-height: 50px;
        position: fixed;
        right: 15px;
        bottom: 10px;
        z-index: 9999;
        border-radius: 50%;
        display: none;
        cursor: pointer;
        font-size: 25px;
        box-shadow: 1px 1px 4px #999;
    }
    </style>
    
    <div id="scroll-top">
        <i class="fa fa-chevron-up"></i>
    </div>
    <script>
        $(window).on("scroll", function () {
            $(this).scrollTop() >= 500 ? $("#scroll-top").show() : $("#scroll-top").hide(); 
        });
        $("#scroll-top").on("click", function () {
            $("html, body").animate({scrollTop: 0}, $(window).scrollTop() / 2);
        });
    </script>