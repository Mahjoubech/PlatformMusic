<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musicly - Signup</title>
    <link rel="shortcut icon" href="img/icons/purple-play-button.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap');

        @layer base {
            :root {
                --textColor: whitesmoke;
                --bg: #222;
                --logo: #ba00ff;
                --bgSoft: #333;
                --textColorSoft: lightgray;
                --border: #444;
            }

            * {
                font-family: 'Open Sans', sans-serif;
                scrollbar-width: 10px;
                scrollbar-color: var(--bgSoft) var(--bg);
            }

            ::-webkit-scrollbar {
                width: 10px;
            }

            ::-webkit-scrollbar-thumb {
                background: var(--bgSoft);
            }

            ::-webkit-scrollbar-track {
                background: var(--bg);
            }

            .alert {
                position: absolute;
                width: 100%;
                margin-top: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                opacity: 1;
                transition: opacity 0.3s ease;
                animation: hideAlert 5s linear forwards;
            }

            .alert>p {
                width: 80%;
                padding: 20px;
                border-radius: 10px;
                text-align: center;
            }

            .alert>p>span {
                font-weight: bold;
            }

            .alert>p.danger {
                background-color: rgba(255, 0, 0, 0.5);
                border: 1px solid #ff9292;
                color: #ff9292;
            }

            .alert>p.warning {
                background-color: rgba(255, 94, 0, 0.5);
                border: 1px solid #ffcc92;
                color: #ffcc92;
            }

            .alert>p.success {
                background-color: rgba(0, 255, 0, 0.5);
                border: 1px solid #85ff85;
                color: #85ff85;
            }

            @keyframes hideAlert {
                0% {
                    opacity: 1;
                }
                90% {
                    opacity: 1;
                }
                100% {
                    opacity: 0;
                    display: none;
                }
            }
        }
    </style>
</head>
<body class="bg-[var(--bg)] text-[var(--textColor)]">
    <?php
        if($showError){
            echo '
                <div class="alert">
                    <p class="danger"><span>Alert!</span> '.$errMsg.'!</p>
                </div>
            ';
        }
        if($showSuccess){
            echo '
                <div class="alert">
                    <p class="success"><span>Alert!</span> '.$errMsg.'!</p>
                </div>
            ';
        }
    ?>
    <div class="min-h-screen flex flex-col items-center justify-center gap-5">
        <div class="logo">
            <a href="" class="text-[var(--logo)] text-4xl font-bold flex items-center gap-2">
              
                Musicly
            </a>
        </div>
        <form action="" method="post" class="w-[400px] bg-[var(--bgSoft)] p-5 rounded-lg flex flex-col gap-3">
            <div class="inputItem flex items-center justify-between">
                <label for="username" class="w-[150px]">Username</label>
                <input type="text" placeholder="username" name="username" class="flex-1 bg-transparent border border-[var(--border)] text-[var(--textColorSoft)] p-2 rounded">
            </div>
            <div class="inputItem flex items-center justify-between">
                <label for="email" class="w-[150px]">Email</label>
                <input type="email" placeholder="email@example.com" name="email" class="flex-1 bg-transparent border border-[var(--border)] text-[var(--textColorSoft)] p-2 rounded">
            </div>
            <div class="inputItem flex items-center justify-between">
                <label for="password" class="w-[150px]">Password</label>
                <input type="password" placeholder="password" name="password" class="flex-1 bg-transparent border border-[var(--border)] text-[var(--textColorSoft)] p-2 rounded">
            </div>
            <div class="inputItem flex items-center justify-between">
                <label for="cpassword" class="w-[150px]">Confirm Password</label>
                <input type="password" placeholder="confirm password" name="cpassword" class="flex-1 bg-transparent border border-[var(--border)] text-[var(--textColorSoft)] p-2 rounded">
            </div>
            <button type="submit" class="bg-transparent border border-[var(--border)] text-[var(--textColor)] p-2 rounded hover:bg-[var(--bg)] transition duration-300">Signup</button>
        </form>
    </div>
</body>
</html>