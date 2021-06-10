<li id="<? echo $res['id'];?>" >
    <div class="<? echo $className; ?>">
        <p class='authot'>Пользователь: <? echo $res['author']; ?></p>
        <span class='date'><? $res['date'] ?></span><br>
        <p class='message-сomment'>Комментарий: <? echo $res['textComment'];?></p>
        <?php if($hierarchy<5) {
        echo "<button id='btn" . $res['id'] . "' class='btn' onclick='addParentComment(" . $res['id'] . ");'>Ответить</button>";
        }?>
        </div>
    <?php createTree($res['id'], $hierarchy);?>
    </li>