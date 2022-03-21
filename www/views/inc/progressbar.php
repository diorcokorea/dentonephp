<?php
// @LUCAS 파일 업로드시 사용할 Progressbar
?>

<div class="progressbarContainer">
    <div class="progressbarOverlay"></div>
    <canvas id="progressbar" width="300" height="300" />
</div>

<style>
    .progressbarContainer {
        width: 100%;
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        display: flex;
        z-index: 9998;
        /*animation: ${delayKeyframe} ${delay}ms;*/
        pointer-events: none;
    }

    .progressbarContainer .progressbarOverlay.active {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0.25;
        z-index: 9998;
        background-color: white;
        pointer-events: all;
    }

    #progressbar {
        display: block;
        width: 150px;
        position: fixed;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
    }
</style>

<script>
    function createProgressbar({hideWhen100Percent} = {hideWhen100Percent: true}) {
        let spinner = document.getElementById("progressbar");
        let ctx = spinner.getContext("2d");
        let width = spinner.width;
        let height = spinner.height;
        let degrees = 0;
        let new_degrees = 0;
        let difference = 0;
        let color = "#07a1e8";
        let bgcolor = "#222222";
        let text;
        let animation_loop, redraw_loop;
        const overlay = document.getElementsByClassName("progressbarOverlay")[0];

        function init() {
            ctx.clearRect(0, 0, width, height);

            // 제일 바깥쪽 바탕 라인
            ctx.beginPath();
            ctx.strokeStyle = bgcolor;
            ctx.lineWidth = 30;
            ctx.arc(width / 2, width / 2, 100, 0, Math.PI * 2, false);
            ctx.stroke();


            // 중간 원형
            ctx.beginPath();
            ctx.strokeStyle = "#4f4c4c";
            ctx.lineWidth = 20;
            ctx.arc(width / 2, width / 2, 75, 0, Math.PI * 2, false);
            ctx.stroke();


            // 가운데 원형
            ctx.beginPath();
            ctx.strokeStyle = bgcolor;
            ctx.lineWidth = 60;
            ctx.arc(width / 2, width / 2, 40, 0, Math.PI * 2, false);
            ctx.fillStyle = bgcolor;
            ctx.fill();
            ctx.stroke();


            let radians = degrees * Math.PI / 180;

            ctx.beginPath();
            ctx.strokeStyle = color;
            ctx.lineWidth = 25;
            ctx.arc(width / 2, height / 2, 100, 0 - 90 * Math.PI / 180, radians - 90 * Math.PI / 180, false);
            ctx.stroke();
            ctx.fillStyle = color;
            ctx.font = "50px arial";
            text = Math.floor(degrees / 360 * 100) + "%";
            text_width = ctx.measureText(text).width;
            ctx.fillText(text, width / 2 - text_width / 2, height / 2 + 15);
        }

        // function draw() {
        //     if (typeof animation_loop != undefined) clearInterval(animation_loop);
        //     new_degrees = 360;
        //     difference = new_degrees - degrees;
        //     animation_loop = setInterval(animate_to, 10000 / difference);
        // }

        function animate_to() {
            if (degrees == new_degrees) {
                // clearInterval(animation_loop);
            } else if (degrees < new_degrees) {
                degrees++;
            } else {
                degrees--;
            }
            init();
        }

        function reset() {
            new_degrees = 360;
            degrees = 0;
            overlay.classList.add("active");
            ctx = spinner.getContext("2d");
            animate_to(); // 0 으로 다시 그리고!!
            spinner.style.display = "block";
            degrees = 0; // 다시 0 으로 초기화
        }

        function done() {
            // console.log("animation is done.")
            if (hideWhen100Percent) {
                overlay.classList.remove("active");
                spinner.style.display = "none";
            }
        }

        function update(percent = 1) {
            const DEGREE_100 = 360;
            const DEGREE_95 = 342;
            const prevDegrees = degrees;
            degrees = 360 * (percent / 100);
            const newDegrees = degrees;

            if (!hideWhen100Percent && prevDegrees <= DEGREE_95 && newDegrees >= DEGREE_100) {
                // 너무 빨리 끝나 버리면서, 100%에도 프로그래스바를 화면에 남겨두는 경우는
                // 보통 submit 을 해서 화면에서 1~2초 대기하는 경우다, 그래서 이때는 천천히 100%를 만들도록 한다.
                const leftDegrees = DEGREE_100 - prevDegrees;
                degrees = prevDegrees; // 초기화
                // console.log('leftDegrees', leftDegrees);
                const timeout = Math.max(10, 2000 / leftDegrees);
                // console.log('timeout', timeout);
                const interval = setInterval(() => {
                    degrees += (leftDegrees / timeout);
                    if (degrees >= DEGREE_100) {
                        degrees = DEGREE_100;
                        clearInterval(interval);
                        done();
                    }
                    animate_to();
                }, timeout);
            } else {
                animate_to();
                if (percent === 100) {
                    done();
                }
            }
        }


        return [reset, update];
    }
</script>