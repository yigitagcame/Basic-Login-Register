<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900&display=swap" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="<?= View::asset('css/style.css'); ?>">
</head>

<body>

<div class="viewport">

    <?php if (isset($_SESSION["message"])){ ?>
    <div class="message success">
        <?=$_SESSION["message"];?>
    </div>
    <?php } ?>

    <div class="container">

        <div class="blackBox nonSplit"></div>

        <div class="whiteBox full">

            <div class="headLiner">

                    <h2> Welcome <?=$_SESSION["name"] ?> </h2>
                    <a class="logoutLink" href="<?=URL;?>/auth/logout">Logout</a>
            </div>

            <hr class="hr">

            <div class="titleField">
                <h2>Attribute</h2>
                <h2>Value</h2>
            </div>

            <!-- Profile Form -->
            <form method="post" action="<?=URL ?>/user/update">

                <div id="fields">


                <?php foreach ($params["attrs"] as $attr ){ ?>
                <div id="<?=$attr["id"]; ?>" class="inputField">
                    <input type="text" name="fields[]" value="<?= $attr["field"]?>" required="required">
                    <input type="text" name="values[]" value="<?= $attr["value"]?>" required="required">
                    <input type="hidden" name="ids[]" value="<?= $attr["id"]; ?>">
                    <button type="button" class="button action delete" name="delete" onclick="app.removeAttr(<?= $attr["id"]; ?>)">DELETE</button>
                </div>
                <?php } ?>
                </div>

                <div class="submitField">
                    <button name="add" class="button action" type="button" onclick="app.appendInputs()">ADD FIELD</button>
                    <button name="save" class="button submit" type="submit">SAVE</button>
                </div>

            </form>
            <!-- Profile From -->


        </div>

    </div>

</div>


<script src="<?=View::asset("js/app.js") ?>"></script>
<script src="<?=View::asset("js/animation.js") ?>"></script>
<script>
    animation.messageHide();
</script>
</body>

</html>