<?php
session_start();
include "db.php";

// Fetch messages in ascending order (oldest to newest)
$q = "SELECT * FROM `msg` ORDER BY id ASC"; // Replace `id` with your timestamp column if needed

if ($rq = mysqli_query($db, $q)) {

    if (mysqli_num_rows($rq) > 0) {
        $messages = [];
        while ($data = mysqli_fetch_assoc($rq)) {
            $messages[] = $data;
        }

        // Display messages
        foreach ($messages as $data) {
            if ($data["phone"] == $_SESSION["phone"]) {
                ?>
                <p class="sender">
                    <span><?= htmlspecialchars($data["phone"]) ?>:</span>
                    <?= htmlspecialchars($data["msg"]) ?>
                </p>
                <?php
            } else {
                ?>
                <p>
                    <span><?= htmlspecialchars($data["phone"]) ?>:</span>
                    <?= htmlspecialchars($data["msg"]) ?>
                </p>
                <?php
            }
        }
    } else {
        echo "<h3> Chat is empty at this moment!!</h3>";
    }
}
?>
