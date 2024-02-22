<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title"> Today's message </h4>
            <p class="card-description">
                <?php
                $messages = [
                    "Have a great day!",
                    "Stay positive and focused!",
                    "Make today amazing!",
                    "Enjoy the little things!",
                    "Spread kindness everywhere!"
                ];
                $dayOfYear = date("z");
                $messageIndex = $dayOfYear % count($messages);
                echo  $messages[$messageIndex];
                ?>
            </p>
        </div>
    </div>
</div>
