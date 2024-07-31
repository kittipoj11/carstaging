<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>

        <style>
        .className {
            max-width: 100%;
            max-height: 100%;
            bottom: 0;
            left: 0;
            margin: auto;
            overflow: auto;
            position: fixed;
            right: 0;
            top: 0;
            -o-object-fit: contain;
            object-fit: contain;
        }

        .bg {
            position: fixed;
            top: 0;
            left: 0;
            /* Preserve aspet ratio */
            min-width: 10%;
            min-height: 10%;
        }

        .fx {
            min-width: 10%;
            min-height: 10%;
        }
        </style>
    </head>

    <body>
        <div class="fx">

            <img src="https://i.imgur.com/HmezgW6.png" class="className" />
        </div>

        <!-- Slider to control the image width, only to make demo clearer !-->
        <input type="range" min="10" max="2000" value="276" step="10"
            oninput="document.querySelector('img').style.width = (this.value +'px')"
            style="width: 90%; position: absolute; z-index: 2;">
    </body>

</html>