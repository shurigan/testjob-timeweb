<?php $menu = "home"; include "layout/header.tpl.php"; ?>

        <div class="ui form blue segment" id="parse-form">
            <div class="ui error message">
                <div class="ui header">Ooops! Errors here!:</div>
                <ul class="list"></ul>
            </div>
            <div class="ui action input field">
                <input type="url" name="url" placeholder="Введите сюда урлу" value="<?php echo $url ?>" />
                <div class="ui blue left icon button"><i class="search icon"></i></div>
            </div>
            <div class="ui field right icon input hidden transition">
                <input type="text" name="text" placeholder="Что искать будем?" value="timeweb"/>
                <i class="font icon"></i>
            </div>
            <div class="ui field">
                <div class="3 fluid ui buttons">
                    <div class="ui button<?php echo ($type == "text" ? " blue active" : "") ?>" data-utype="text">text</div>
                    <div class="or"></div>
                    <div class="ui button<?php echo ($type == "images" ? " blue active" : "") ?>" data-utype="images">images</div>
                    <div class="or"></div>
                    <div class="ui button<?php echo ($type == "links" ? " blue active" : "") ?>" data-utype="links">links</div>
                </div>
            </div>
        </div>

    <div id="result" class="ui hidden message"></div>

<?php include "layout/footer.tpl.php"; ?>
