<html>
<head>
    <title>WYCTOPHP</title>
    <!-- 功能介绍JS-->
    <link href="./static/plugins/intro/introjs.css" rel="stylesheet">
    <script src="./static/plugins/intro/intro.js"></script>
    <style>
        /**{padding: 0;margin: 0}*/
        .header{
            height: 100px;
            background-color: #173B53;
        }
        .content .left{
            width: 20%;
            float: left;
            background-color: #6F1309;
            height: 500px;
        }
        .content .right{
            width: 70%;
            float: left;
            background-color: #525252;
            height: 500px;
        }
    </style>
</head>
<body>
<div class="header" data-step="1" data-intro="头部信息"></div>
<div class="content">
    <div class="left" data-step="2" data-intro="左侧导航"></div>
    <div class="right" data-step="3" data-intro="右侧内容区"></div>
</div>
<script>
    //访问引导页
    function guide() {
        introJs().setOptions({
            prevLabel: "上一步",
            nextLabel: "下一步",
            skipLabel: "跳过",
            doneLabel: "结束"
        }).oncomplete(function () {
            //点击跳过按钮后执行的事件
            alert('你干嘛');
        }).onexit(function () {
            //点击结束按钮后， 执行的事件
            alert('介绍完毕');
        }).start();
    }
    guide();
</script>
</body>
</html>
