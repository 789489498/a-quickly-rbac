<?php
$tabs = array(
    "tabs" => array(
        "Qihoo\MenuController@getListAction" => "列表",
        "Qihoo\MenuController@getAddAction" => "新增",
    ),
    "title" => "",
    "comment" => ""
);
?>
<?= View::get("layout.pageheader", $tabs) ?>
