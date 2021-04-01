<?php 
header("Content-type: text/css; charset: UTF-8");

?>

.pic-ctn{
    width: 100vw;
    height: 200px;
}

@keyframes display {
    0% {
        transform: translateX(200px);
        opacity: 0;
    }
    10% {
        transform: translateX(0);
        opacity: 1;
    }
    20% {
        transform: translateX(0);
        opacity: 1;
    }
    30% {
        transform: translateX(-200px);
        opacity: 0;
    }
    100% {
        transform: translateX(-200px);
        opacity: 0;
    }
}

.pic-ctn {
    position: relative;
    width: 277px;
    height: 300px;
    margin: 0px 0px 25px 106px;
}

.pic-ctn div {
    position: absolute;
    top: 0;
    left: calc(50% - 100px);
    opacity: 0;
    animation: display 10s infinite;
}

<!-- .pic-ctn div:nth-child(2) {
    animation-delay: 2s;
}
.pic-ctn div:nth-child(3) {
animation-delay: 4s;
}
.pic-ctn div:nth-child(4) {
animation-delay: 6s;
} -->