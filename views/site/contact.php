<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4 padding-right">
                <?php if (isset($result) && $result) : ?>
                    <p>Сообщение отправлено! Мы ответим на указанный вами емейл.</p>
                <?php else : ?>
                    <?php if (isset($errors) && is_array($errors)) : ?>
                        <ul>
                            <?php foreach ($errors as $error) : ?>
                                <li> - <?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <div class="signup-form">
                        <h2>Обратная связь</h2>
                        <form action="#" method="post">
                            <p>Ваша почта</p>
                            <input type="email" name="from" placeholder="E-mail" value="<?= $from ?>">
                            <p>Сообщение</p>
                            <input type="text" name="message" placeholder="Сообщение" value="<?= $message ?>">
                            <br/>
                            <input type="submit" name="submit" class="btn btn-default" value="Отправить">
                        </form>
                    </div>
                <?php endif; ?>
                <br/>
                <br/>
            </div>
        </div>
    </div>
</section>


<?php include ROOT . '/views/layouts/footer.php'; ?>
