function confirmQuit() {
    var confirmQuit = confirm("You sure you wanna quit?");
    if (confirmQuit) {
        window.location.href = '../game/QuitTheGame.php';
    }
}