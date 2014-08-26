<!DOCTYPE html>
<!-- saved from url=(0049)http://tympanus.net/Development/Stapel/index.html -->
<html lang="en" class=" js no-touch cssanimations csstransitions">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adaptive Thumbnail Pile Effect with Automatic Grouping</title>
    <meta name="description" content="Thumbnail Pile Effect with Automatic Grouping">
    <meta name="keywords" content="jquery, pile, effect, images, grid, thumbnails, css3, grouping, albums">
    <meta name="author" content="Codrops">
    <link rel="stylesheet" href="./css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="./css/bootstrap-theme.css" type="text/css">
    <style>
        .icon {
            width: 33%;
            float: left;
        }

        .icon > img {
            width: 25px;
            height: 25px;
        }

        .branch_info {
            padding: 0 0 5px 0;
        }
        .branch_info > img {
            width: 25px;
            height: 25px;
            vertical-align: middle;
        }

        .action_icon {
            font-size: x-large;
            width:24px;
            height:24px;
            opacity: 1.0;
            filter: alpha(opacity=100); /* For IE8 and earlier */
        }

        .action_icon:hover {
            opacity: 0.4;
            filter: alpha(opacity=40); /* For IE8 and earlier */
        }

        .disabled {
            opacity: 0.4;
            filter: alpha(opacity=40); /* For IE8 and earlier */
        }
        
        .minimize {
            float:right;
            color: rgb(17, 182, 24);
        }

        .flag {
            float: right;
            color: rgb(182, 17, 17);
        }

        .up {
            float: left;
            color: green;
        }

        .down {
            float: left;
            color: red;
            margin-right: 10px;
        }

        .reply_icon {
            float:left;
        }

        .reply {
            float:left;
            height: 20px;
            padding-top: 0;
            margin-top: 5px;
            margin-right:10px;
        }

        .comment_detail {
            border: 3px solid green;
            padding-bottom: 5px;
        }

        #Container .mix{
            display: none;
        }

        .controls{
            padding: 2%;
            background: #333;
            color: #eee;
        }

        label{
            font-weight: 300;
            /*margin: 0 .4em 0 0;*/
        }

        button{
            display: inline-block;
            padding: .4em .8em;
            background: #666;
            border: 0;
            color: #ddd;
            font-size: 16px;
            font-weight: 300;
            border-radius: 4px;
            cursor: pointer;
        }

        button.active{
            background: #68b8c4;
        }

        button:focus{
            outline: 0 none;
        }

        button + label{
            margin-left: 1em;
        }

        #Container > div:nth-child(odd) {
            background-color: rgb(226, 245, 213);
        }

        #Container > div:nth-child(even) {
            background-color: rgb(245, 236, 231);
        }

        #Container > .mix {
            width:33.1%;
        }

        .badge {
            float: left;
            margin: 5px 5px 0 0;
        }

        .avatar {
            width:96px;
        }

        h6 {
            margin: 0;
        }

        .row {
            margin-right:0;
            margin-left:0;
        }

        p {
            margin: 5px 0 5px;
        }

        .fav_count {
            color: #8d1e1e;
        }

        .cust_count {
            color: #048028;
        }

        .comment_detail:hover {
            opacity: 0.4;
            cursor: pointer;
            background-image: url(images/icon/search.png);
            background-size:50px;
            background-repeat: no-repeat;
            background-position: top right;
        }

        .tabs-left > .nav-tabs > li,
        .tabs-right > .nav-tabs > li {
            float: none;
        }

        .tabs-left > .nav-tabs > li > a,
        .tabs-right > .nav-tabs > li > a {
            min-width: 74px;
            margin-right: 0;
            margin-bottom: 3px;
        }

        .tabs-left > .nav-tabs {
            float: left;
            margin-right: 19px;
            border-right: 1px solid #ddd;
        }

        .tabs-left > .nav-tabs > li > a {
            margin-right: -1px;
            -webkit-border-radius: 4px 0 0 4px;
            -moz-border-radius: 4px 0 0 4px;
            border-radius: 4px 0 0 4px;
        }

        .tabs-left > .nav-tabs > li > a:hover,
        .tabs-left > .nav-tabs > li > a:focus {
            border-color: #eeeeee #dddddd #eeeeee #eeeeee;
        }

        .tabs-left > .nav-tabs .active > a,
        .tabs-left > .nav-tabs .active > a:hover,
        .tabs-left > .nav-tabs .active > a:focus {
            border-color: #ddd transparent #ddd #ddd;
            *border-right-color: #ffffff;
        }

    #translatorInfo {
        width: 85%;
        float:left;
        min-height:530px;
    }

    .modal-body {
        padding:0;
    }
    </style>
</head>
<body>

<div class="menu" style="z-index: -1;">
    <div class="right-preview">
        <div class="panel-group" id="accordion">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            <span class="glyphicon glyphicon-plus"></span>Thêm nhận xét về công ty
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="row comment_box">

                            <div class="col-md-2" style="padding:0;">
                                <img class="img-thumbnail" src="images/user/user1.jpg"/>
                            </div>
                            <div class="col-md-10">
                                <div class="col-md-8">
                                    <h4 style="color: rgb(141, 30, 30);margin:5px;">Trần Đoàn Khánh Vũ</h4>
                                </div>
                                <div id="feedback" class="col-md-4"></div>
                                <input type="text" class="form-control" placeholder="Nhập nhận xét">
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default active">
                                        <input type="checkbox" checked>Phục Vụ
                                    </label>
                                    <label class="btn btn-default">
                                        <input type="checkbox"> Giữ Xe
                                    </label>
                                    <label class="btn btn-default">
                                        <input type="checkbox"> Sản Phẩm
                                    </label>
                                </div>
                                <button type="button" class="btn btn-danger cancel_comment" style="float:right;height: 20px;padding-top: 0;margin-top: 5px;margin-left:20px">Hủy</button>
                                <button type="button" class="btn btn-success send_comment" style="float:right;height: 20px;padding-top: 0;margin-top: 5px;">Gửi</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                            Tất cả nhận xét
                        </a>
                    </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="controls">
                            <label>Lọc:</label>

                            <button class="filter" data-filter="all">Tất Cả</button>
                            <button class="filter" data-filter=".category-english">Tiếng Anh</button>
                            <button class="filter" data-filter=".category-chinese">Tiếng Hoa</button>

                            <label>Sort:</label>

                            <button class="sort" data-sort="myorder:asc">Asc</button>
                            <button class="sort" data-sort="myorder:desc">Desc</button>
                        </div>
                        <div id="Container">
                            <div class="mix category-english category-chinese" data-myorder="1">
                                <div class="comment_detail">
                                    <div class="row">
                                        <div class="col-md-4" style="padding:0;">
                                            <img class="img-thumbnail" src="images/user/user1.jpg"/>
                                        </div>
                                        <div class="col-md-8">
                                            <h4 style="color: rgb(141, 30, 30);margin:5px;">Trần Đoàn Khánh Vũ</h4>
                                            <div id="feedback1"></div>
                                            <span class="label label-primary">Tiếng Anh</span>
                                            <span class="label label-success">Tiếng Hoa</span>
                                            <p>
                                                <span class="action_icon cust_count glyphicon glyphicon-user"></span>
                                                30
                                                <span class="action_icon fav_count glyphicon glyphicon-heart"></span>
                                                15
                                            </p>
                                            <p>
                                                <time class="timeago text-primary text-nowrap" datetime="2014-08-22T09:24:17Z"></time>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mix category-english" data-myorder="2">
                                <div class="comment_detail">
                                    <div class="row">
                                        <div class="col-md-4" style="padding:0;">
                                            <img class="img-thumbnail" src="./images/user/user2.jpg"/>
                                        </div>
                                        <div class="col-md-8">
                                            <h4 style="color: rgb(141, 30, 30);margin:5px;">Nguyễn Duy Long</h4>
                                            <div id="feedback2"></div>
                                            <span class="label label-primary">Tiếng Anh</span>
                                            <p>
                                                <span class="action_icon cust_count glyphicon glyphicon-user"></span>
                                                10
                                                <span class="action_icon fav_count glyphicon glyphicon-heart"></span>
                                                5
                                            </p>
                                            <p>
                                                <time class="timeago text-primary text-nowrap" datetime="2014-08-25T09:24:17Z"></time>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mix category-chinese" data-myorder="3">
                                <div class="comment_detail">
                                    <div class="row">
                                        <div class="col-md-4" style="padding:0;">
                                            <img class="img-thumbnail" src="./images/user/user3.jpg"/>
                                        </div>
                                        <div class="col-md-8">
                                            <h4 style="color: rgb(141, 30, 30);margin:5px;">Mai Đình Anh</h4>
                                            <div id="feedback3"></div>
                                            <span class="label label-success">Tiếng Hoa</span>
                                            <p>
                                                <span class="action_icon cust_count glyphicon glyphicon-user"></span>
                                                5
                                                <span class="action_icon fav_count glyphicon glyphicon-heart"></span>
                                                2
                                            </p>
                                            <p>
                                                <time class="timeago text-primary text-nowrap" datetime="2014-08-23T09:24:17Z"></time>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /container -->

<div id="translatorPopUp" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Thông Tin: Trần Đoàn Khánh Vũ</h4>
                </div>
                <div class="modal-body">
                    <div class="tabbable tabs-left">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="active"><a href="#info" role="tab" data-toggle="tab"><span class="action_icon glyphicon glyphicon-info-sign"></span></a></li>
                            <li><a href="#calendar" role="tab" data-toggle="tab"><span class="action_icon glyphicon glyphicon-calendar"></span></a></li>
                            <li><a href="#review" role="tab" data-toggle="tab"><span class="action_icon glyphicon glyphicon-user"></span></a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content" id="translatorInfo">
                            <div class="tab-pane active" id="info">
                                <div class="row">
                                    <div class="col-md-4 text-center" style="padding:0;">
                                        <img class="img-thumbnail" src="./images/user/user1.jpg"/>
                                        <h4 style="color: rgb(141, 30, 30);margin:5px;">Trần Đoàn Khánh Vũ</h4>
                                        <div id="feedback1"></div>
                                        <span class="label label-primary">Tiếng Anh</span>
                                        <span class="label label-success">Tiếng Hoa</span>
                                        <p>
                                            <span class="action_icon cust_count glyphicon glyphicon-user"></span>
                                            30
                                            <span class="action_icon fav_count glyphicon glyphicon-heart"></span>
                                            15
                                        </p>
                                        <p>
                                            <time class="timeago text-primary text-nowrap" datetime="2014-08-22T09:24:17Z"></time>
                                        </p>
                                    </div>
                                    <div class="col-md-8">
                                        <h3>Giới Thiệu</h3>
                                        <p>Vũ hiện là sinh viên năm 3 ngành Information Systems ở National University of Singapore. Hiền lành, vui tính, thích giúp đỡ người khác và rất có trách nhiệm trong công việc</p>
                                        <p>Vũ có kinh nghiệm đi thông dịch ở các bệnh viện lớn như National University Hospital, KK Hospital, Singapore General Hospital...</p>
                                        <h3>Giá</h3>
                                        <table class="table table-striped table-hover text-center">
                                            <thead>
                                            <tr>
                                                <th style="text-align: center;">Số Giờ</th>
                                                <th style="text-align: center;">Giá/Giờ (SGD)</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>1 - 2</td>
                                                <td>30</td>
                                            </tr>
                                            <tr>
                                                <td>3 - 5</td>
                                                <td>25</td>
                                            </tr>
                                            <tr>
                                                <td>Cả Ngày</td>
                                                <td>150</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="calendar">
                                <iframe id="frame" src="about:blank" height="510px" style="width:100%;">
                                </iframe>
                            </div>
                            <div class="tab-pane" id="review">
                                <div class="row">
                                    <div class="col-md-4 text-center" style="padding:0;">
                                        <img src="images/customer/customer1.jpg" alt="..." class="img-circle img-thumbnail img-responsive"/>
                                        <h4>Trần Thanh Hùng<span class="action_icon fav_count glyphicon glyphicon-heart"></span></h4>
                                        <div id="cust_feedback1"></div>
                                        <blockquote class="text-left">
                                            <p>Vũ rất là nhiêt tình giúp đỡ mình. Cậu ấy không ngại đường xa và luôn tới đúng hẹn.</p>
                                            <footer>20/07/2014</footer>
                                        </blockquote>
                                    </div>
                                    <div class="col-md-4 text-center" style="padding:0;">
                                        <img src="images/customer/customer2.jpg" alt="..." class="img-circle img-thumbnail img-responsive"/>
                                        <h4>Nguyễn Thị Hương<span class="action_icon fav_count glyphicon glyphicon-heart"></span></h4>
                                        <div id="cust_feedback2"></div>
                                        <blockquote class="text-left">
                                            <p>Tiếng Anh của Vũ rất là tốt nên việc giao tiếp với bác sĩ rất là dễ dàng. Ngoài ra cậu ấy còn biết tiếng Hoa.</p>
                                            <footer>25/07/2014</footer>
                                        </blockquote>
                                    </div>
                                    <div class="col-md-4 text-center" style="padding:0;">
                                        <img src="images/customer/customer3.jpg" alt="..." class="img-circle img-thumbnail img-responsive"/>
                                        <h4>Trần Nhật Trung</h4>
                                        <div id="cust_feedback3"></div>
                                        <blockquote class="text-left">
                                            <p>Mình rất hài lòng với dịch vụ mà Vũ cung cấp. Vũ còn chỉ dẫn thêm cho mình các cách tiết kiệm tiền khi qua đây chữa bệnh.</p>
                                            <footer>10/08/2014</footer>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="./js/jquery.min.js"></script>
<script src="./js/modernizr.custom.63321.js"></script>
<script type="text/javascript" src="./js/rating/rating.js"></script>
<script src="http://cdn.jsdelivr.net/jquery.mixitup/latest/jquery.mixitup.min.js"></script>
<script src="./js/timeago/jquery.timeago.js" type="text/javascript"></script>
<script src="./js/bootstrap.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        $.fn.raty.defaults.path = './images/rating';

        $('#feedback').raty({
            score: 0,
            cancel: true
        });

        $('#feedback1').raty({
            readOnly: true,
            score: 5
        });

        $('#feedback2').raty({
            readOnly: true,
            score: 4.5
        });

        $('#feedback3').raty({
            readOnly: true,
            score: 4
        });

        $('#cust_feedback1').raty({
            readOnly: true,
            score: 5
        });

        $('#cust_feedback2').raty({
            readOnly: true,
            score: 4.9
        });

        $('#cust_feedback3').raty({
            readOnly: true,
            score: 4
        });

        $('#Container').mixItUp();

        $('.collapse').collapse();

        $("time.timeago").timeago();

        $("#frame").attr("src", "sample.php");
    });

    $('body').on('click', '.send_comment', function() {
        alert($(this).parent().find('input').val());
        $(this).parent().parent().remove();
    });

    $('body').on('click', '.cancel_comment', function() {
        $(this).parent().parent().remove();
    });

    $('body').on('click', '.reply', function() {
        var temp = $(this).parent().parent().parent();
        var div = temp.find('> .row:last-child');
        if (!div.hasClass('comment_box'))
            temp.append('<div class="row comment_box"><div class="col-md-11" style="margin-left:30px;"><input type="text" class="form-control" placeholder="Nhập nhận xét"><button type="button" class="btn btn-danger cancel_comment" style="float:right;height: 20px;padding-top: 0;margin-top: 5px;margin-left:20px">Hủy</button><button type="button" class="btn btn-success send_comment" style="float:right;height: 20px;padding-top: 0;margin-top: 5px;">Gửi</button></div></div>');
        else {
            div.toggle();
        }
    });

    $('body').on('click', '.minimize', function() {
        var temp = $(this).parent().parent().parent();
        //description
        temp.find('h6').toggle();

        var img = temp.parent().children().first().find('img');
        //profile pic
        img.toggle();

        //last row
        var row = temp.parent().parent().find('>.row:last-child');

        if (row.hasClass('comment_box')) {
            row.parent().find('>.row:nth-last-child(2)').toggle();

            row.css('display','none');
        }
        else row.toggle();

        $(this).toggleClass('glyphicon-minus glyphicon-plus');
    });

    $('body').on('click', '.flag', function() {
        var temp = $(this).closest('.comment_detail');

        if (temp.hasClass('post_start')) {
            temp.parent().find('.comment_detail').each(function() {
                $(this).html('You have flagged this comment as spam');
            });
        }
        else temp.html('You have flagged this comment as spam');
    });

    $('body').on('click', '.up', function() {
        changeCount(this, 1, 2);
    });

    $('body').on('click', '.down', function() {
        changeCount(this, -1, 1);
    });

    $('body').on('click', '.comment_detail', function() {
        $('#translatorPopUp').modal();
    });

    function changeCount(e, inc, index) {
        var item = $(e);
        if (!item.hasClass('disabled')) {
            var span = item.parent().find('>span');
            var temp = span.first();

            temp.html(parseInt(temp.html(), 10) + inc);
            item.addClass('disabled');
            span.eq(index).removeClass('disabled');
        }
    }
</script>

</body>
</html>