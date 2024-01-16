<?php
session_start();
include 'dictionary.php';

$MESSAGE = '';
if (isset($_SESSION['MESSAGE'])) {
    $MESSAGE = $_SESSION['MESSAGE'];
    unset($_SESSION['MESSAGE']);
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Bookshelf</title>
        <link rel="stylesheet" href="css/index.css" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap"
            rel="stylesheet"
        />

        <style>
            .center {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh; /* Adjust as needed */
            }

            .button-container {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 10px; /* Adjust as needed */
            }
        </style>
    </head>
    <body>
        <main class="app-content center">
            <section class="input-section">
                <?php if (isset($MESSAGE) && !empty($MESSAGE)): ?>
                    <div style="background-color: red; color: white; padding: 10px; border-radius: 10px;">
                        <?php echo htmlspecialchars($MESSAGE); ?>
                    </div>
                    <br>
                <?php endif; ?>
                <br>
                <div class="input-head">
                    <h2>Login</h2>
                </div>
                <form action="<?php echo $CURRENT_URL . '/loginController.php'; ?>" method="POST">
                    <div class="input-item col">
                        <label>Email</label>
                        <input
                            name="email"
                            type="text"
                            placeholder="Masukan Email"
                        />
                    </div>
                    <div class="input-item col">
                        <label>Password</label>
                        <input
                            type="password"
                            name="password"
                            type="text"
                            placeholder="Masukan Password"
                        />
                    </div>
                    <div class="button-container">
                        <a href="<?php echo $CURRENT_URL . '/register.php'; ?>">
                            Register
                        </a>
                        <button type="submit">Login</button>
                    </div>
                </form>
            </section>
        </main>
        <script src="js/storage.js"></script>
        <script src="js/dom.js"></script>
        <script src="js/index.js"></script>
    </body>
</html>
