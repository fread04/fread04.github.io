<?php
    session_start();
    
    // Уничтожение сессии
    session_destroy();

    // Перенаправление на страницу входа (или любую другую, как вы решите)
    header("Location: index.html");
    exit();
?>
