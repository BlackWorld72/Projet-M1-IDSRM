<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] .'/HTML/header.php' ?>

        <title>Consulter mes demandes</title>
   </head>
<style>
.button {

    &.dark {
        --background: #242836;
        --rectangle: #1C212E;
        --arrow: #F5F9FF;
        --text: #F5F9FF;
        --success: #2F3545;
    }
}

.button {
    --background: #275efe;
    --rectangle: #184fee;
    --success: #{mix(white, #184fee, 20%)};

    display: flex;
    overflow: hidden;
    text-decoration: none;
    -webkit-mask-image: -webkit-radial-gradient(white, black);
    background: var(--background);
    border-radius: 8px;
    box-shadow: 0 2px 8px -1px var(--shadow);
    transition: transform .2s ease, box-shadow .2s ease;
    &:active {
        transform: scale(.95);
        box-shadow: 0 1px 4px -1px var(--shadow);
    }
    ul {
        margin: 0;
        padding: 16px 40px;
        list-style: none;
        text-align: center;
        position: relative;
        backface-visibility: hidden;
        font-size: 16px;
        font-weight: 500;
        line-height: 28px;
        color: var(--text);
        li {
            &:not(:first-child) {
                top: 16px;
                left: 0;
                right: 0;
                position: absolute;
            }
            &:nth-child(2) {
                top: 76px;
            }
            &:nth-child(3) {
                top: 136px;
            }
        }
    }
    & > div {
        position: relative;
        width: 60px;
        height: 60px;
        background: var(--rectangle);
        &:before,
        &:after {
            content: '';
            display: block;
            position: absolute;
        }
        &:before {
            border-radius: 1px;
            width: 2px;
            top: 50%;
            left: 50%;
            height: 17px;
            margin: -9px 0 0 -1px;
            background: var(--arrow);
        }
        &:after {
            width: 60px;
            height: 60px;
            transform-origin: 50% 0;
            border-radius: 0 0 80% 80%;
            background: var(--success);
            top: 0;
            left: 0;
            transform: scaleY(0);
        }
        svg {
            display: block;
            position: absolute;
            width: 20px;
            height: 20px;
            left: 50%;
            top: 50%;
            margin: -9px 0 0 -10px;
            fill: none;
            z-index: 1;
            stroke-width: 2px;
            stroke: var(--arrow);
            stroke-linecap: round;
            stroke-linejoin: round;
        }
    }
   
}

@keyframes text {
    10%,
    85% {
        transform: translateY(-100%);
    }
    95%,
    100% {
        transform: translateY(-200%);
    }
}

@keyframes line {
    5%,
    10% {
        transform: translateY(-30px);
    }
    40% {
        transform: translateY(-20px);
    }
    65% {
        transform: translateY(0);
    }
    75%,
    100% {
        transform: translateY(30px);
    }
}

@keyframes svg {
    0%,
    20% {
        stroke-dasharray: 0;
        stroke-dashoffset: 0;
    }
    21%,
    89% {
        stroke-dasharray: 26px;
        stroke-dashoffset: 26px;
        stroke-width: 3px;
        margin: -10px 0 0 -10px;
        stroke: var(--checkmark);
    }
    100% {
        stroke-dasharray: 26px;
        stroke-dashoffset: 0;
        margin: -10px 0 0 -10px;
        stroke: var(--checkmark);
    }
    12% {
        opacity: 1;
    }
    20%,
    89% {
        opacity: 0;
    }
    90%,
    100% {
        opacity: 1;
    }
}

@keyframes background {
    10% {
        transform: scaleY(0);
    }
    40% {
        transform: scaleY(.15);
    }
    65% {
        transform: scaleY(.5);
        border-radius: 0 0 50% 50%;
    }
    75% {
        border-radius: 0 0 50% 50%;
    }
    90%,
    100% {
        border-radius: 0;
    }
    75%,
    100% {
        transform: scaleY(1);
    }
}

html {
    box-sizing: border-box;
    -webkit-font-smoothing: antialiased;
}

* {
    box-sizing: inherit;
    &:before,
    &:after {
        box-sizing: inherit;
    }
}

body {
    min-height: 100vh;
    display: flex;
    font-family: 'Roboto', Arial;
    justify-content: center;
    align-items: center;
    background: #E4ECFA;
    .container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        & > div {
            flex-basis: 100%;
            width: 0;
        }
        .button {
            margin: 16px;
            @media(max-width: 400px) {
                margin: 12px;
            }
        }
    }
    .dribbble {
        position: fixed;
        display: block;
        right: 20px;
        bottom: 20px;
        img {
            display: block;
            height: 28px;
        }
    }
}
</style>


<div class="container">

   

    <div></div>

    <a href="" class="button dark">
               <div>
            <svg viewBox="0 0 24 24"></svg>
        </div>
        <ul>
            <li>&#68;ownload</li>
            <li>&#68;ownloading</li>
            <li>Open File</li>
        </ul>
 
    </a>

</div>

<!-- dribbble -->

