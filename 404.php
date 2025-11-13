<?php
// подключение пролога Битрикс (инициализирует $APPLICATION и другие объекты)
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
// установка HTTP статуса 404
CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");
// скрывает боковую панель на странице
define("HIDE_SIDEBAR", true);
// установка заголовка страницы
$APPLICATION->SetTitle("Страница не найдена");
?>
<style>
html {
  height: 100% !important;
  width: 100% !important;
}
body {  
  height: 100% !important;
  width: 100% !important;
  background: url("https://3d-group.space/upload/bg404.jpg") no-repeat center center fixed !important;
  background-size: cover !important;
  margin: 0 !important;
  padding: 0 !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  overflow: hidden !important;
}
.app{
  background: unset;
}
.text {
  text-align: center !important;
  padding: 60px 40px !important;
  width: 90% !important;
  max-width: 1400px !important;
  margin: auto;
}
.text h1{
  color: #011718 !important;
  font-size: clamp(4em, 12vw, 12em) !important;
  text-align: center !important;
  text-shadow: -5px 5px 0px rgba(0,0,0,0.1), -10px 10px 0px rgba(0,0,0,0.1), -15px 15px 0px rgba(0,0,0,0.1) !important;
  font-family: monospace !important;
  font-weight: bold !important;
  margin: 0 !important;
  line-height: 1 !important;
}
.text h2{
  color: black !important;
  font-size: clamp(1em, 2.5vw, 1.8em) !important;
  text-shadow: -5px 5px 0px rgba(0,0,0,0.1) !important;
  text-align: center !important;
  margin: 20px auto !important;
  font-family: monospace !important;
  font-weight: bold !important;
  white-space: nowrap !important;
  overflow: visible !important;
}
.text h3{
  color: white !important;
  font-size: clamp(0.9em, 2vw, 1.6em) !important;
  text-shadow: -5px 5px 0px rgba(0,0,0,0.1) !important;
  text-align: center !important;
  margin: 20px auto !important;
  font-family: monospace !important;
  font-weight: bold !important;
  white-space: nowrap !important;
  overflow: visible !important;
}
.torch {
  margin: -150px 0 0 -150px !important;
  width: 200px !important;
  height: 200px !important;
  box-shadow: 0 0 0 9999em #000000f7 !important;
  opacity: 1 !important;
  border-radius: 50% !important;
  position: fixed !important;
  background: rgba(0,0,0,0.3) !important;
  pointer-events: none !important;
  z-index: 999 !important;
}
.torch:after {
  content: '' !important;
  display: block !important;
  border-radius: 50% !important;
  width: 100% !important;
  height: 100% !important;
  top: 0px !important;
  left: 0px !important;
  box-shadow: inset 0 0 40px 2px #000, 0 0 20px 4px rgba(13,13,10,0.2) !important;  
}
.footer {
    display: none !important;
}
.home-button {
  position: fixed !important;
  bottom: 30px !important;
  right: 30px !important;
  padding: 15px 30px !important;
  background: rgba(255, 255, 255, 0.9) !important;
  color: #011718 !important;
  text-decoration: none !important;
  font-family: monospace !important;
  font-weight: bold !important;
  font-size: clamp(0.9em, 2vw, 1.2em) !important;
  border-radius: 8px !important;
  box-shadow: -3px 3px 0px rgba(0,0,0,0.1) !important;
  transition: all 0.3s ease !important;
  z-index: 998 !important;
  cursor: pointer !important;
  display: inline-block !important;
}
.home-button:hover {
  background: rgba(255, 255, 255, 1) !important;
  transform: translate(-2px, -2px) !important;
  box-shadow: -5px 5px 0px rgba(0,0,0,0.1) !important;
}

/* Адаптация для планшетов */
@media (max-width: 768px) {
  .torch {
    width: 150px !important;
    height: 150px !important;
    margin: -75px 0 0 -75px !important;
  }
  .home-button {
    bottom: 20px !important;
    right: 20px !important;
    padding: 12px 24px !important;
  }
  .text h2,
  .text h3 {
    white-space: normal !important;
  }
}

/* Адаптация для мобильных */
@media (max-width: 480px) {
  .torch {
    width: 120px !important;
    height: 120px !important;
    margin: -60px 0 0 -60px !important;
  }
  .home-button {
    bottom: 15px !important;
    right: 15px !important;
    padding: 10px 20px !important;
  }
  .text {
    padding: 100px 20px !important;
    width: 100% !important;
  }
  .text h2,
  .text h3 {
    white-space: normal !important;
  }
}
</style>
<div class="text">
  <h1>404</h1>
  <h2>Комната 404. Вход воспрещён.</h2>
  <h3>Воспользуйтесь фонарём и найдите выход.</h3>
</div>
<a href="/" class="home-button">Выйти на главную</a>
<div class="torch"></div>
<script>
document.addEventListener('DOMContentLoaded', function() {
  document.addEventListener('mousemove', function(event) {
    var torch = document.querySelector('.torch');
    if (torch) {
      torch.style.top = event.pageY + 'px';
      torch.style.left = event.pageX + 'px';
    }
  });
});
</script>
<?$APPLICATION->IncludeComponent(
    "bitrix:form.result.new",
    "modal",
    array(
        "WEB_FORM_ID" => "2", 
        "IGNORE_CUSTOM_TEMPLATE" => "N",
        "USE_EXTENDED_ERRORS" => "Y",
        "SEF_MODE" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "LIST_URL" => "",
        "EDIT_URL" => "",
        "SUCCESS_URL" => "",
        "CHAIN_ITEM_TEXT" => "",
        "CHAIN_ITEM_LINK" => "",
        "PRIVACY_URL" => "/privacy/",
        "PERSONAL_DATA_URL" => "/personal-data/",
        "BUTTON_TEXT" => "отправить",
    ),
    false
);?>
<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>