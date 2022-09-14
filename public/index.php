<?php use Samils\Handler\HandleOutPut; ?>
<!DOCTYPE html>
<html>
<head>
  <title><?= isset($title) ? $title : 'Error' ?></title>
  <style type="text/css">
    <?= HandleOutPut::publicStyleSheets() ?>
  </style>
  <?= HandleOutPut::publicMetaTags() ?>

  <script type="text/javascript">
    (function (js) {
      window.document.addEventListener ('readystatechange', function (event) {
          if (window.document.readyState === 'complete') {
            js ()
          }
      });
    }(function () {
      var contentBaseTitles = window.document.querySelectorAll ('.content-base-block-title');

      if (contentBaseTitles && contentBaseTitles.length >= 1) {
        for (var i = 0; i < contentBaseTitles.length; i++) {
          var contentBaseTitle = contentBaseTitles [i];

          contentBaseTitle.addEventListener ('click', function () {
            if (this.parentNode) {
              this.parentNode.classList.toggle ('x-content-hidden');
            }
          });
        }
      }
    }))
  </script>
</head>
<body id="Samils">
  <div class="ils-error">
    <div class="header-base">
      <h1>
        <?= isset($err) && is_object($err) && isset($err->title) ? (
          htmlentities($err->title)
        ) : 'Sami::Error' ?>
      </h1>
    </div>
    <div class="content-base">
      <!--
        Print the error message.
        Then, if there're paragraphes, print
        them as a list
      -->
      <h3 class="content-base-message">
        <?= isset($err) && is_object($err) && isset($err->message) ? (
          $err->message
        ) : 'Something went wrong..!' ?>
      </h3>

      <?php if (isset($descriptions) && is_array($descriptions) && $descriptions){ ?>
        <div class="content-base-descriptions">
          <?php foreach($descriptions as $i => $desc){ ?>
            <div class="content-base-description">
              <?= function_exists('str') ? \str($desc) : ((string)($desc)) ?>
            </div>
          <?php }?>
        </div>
      <?php } ?>

      <?php if (isset($paragraphes) && is_array($paragraphes) && $paragraphes){ ?>
        <ul class="content-base-paragraphes">
          <?php foreach($paragraphes as $p){ ?>
            <li class="content-base-paragraph"><?= function_exists('str') ? \str($p) : ((string)($p)) ?></li>
          <?php }?>
        </ul>
      <?php }?>


      <!--
        Print sent array dumps
      -->
      <?php if (isset($sources) && is_array($sources) && $sources){ ?>
        <?php foreach($sources as $t => $lines){
          if(!(is_array($lines) && $lines))
            continue;
        ?>
          <div class="content-base-block x-content-hidden">
            <div class="content-base-block-title">
              <span>
                <?= class_exists('Saml') ? nl2br(Saml::Stringify($t)) : nl2br((string)($t)) ?>
              </span>
            </div>
            <div class="content-base-block-body">
              <div class="content-base-code">

                <?php foreach($lines as $line){
                  $high = isset($lines['@high']) && $lines['@high'] ? (
                    $lines['@high']
                  ) : [];
                  if(!(is_array($line) && isset($line['num'])))
                    continue;
                  $c = isset($lines_high) && is_array($lines_high) ? (
                    in_array($line['num'], $lines_high) ? ' high' : ''
                  ) : '';

                  if (isset($line['num'])&&in_array($line['num'],$high)){
                    $c = ' high';
                  }
                ?>

                  <div class="content-base-code-line<?= $c ?>">
                    <div class="content-base-code-line-num">
                      <?= isset($line['num']) ? $line['num'] : '' ?>
                    </div>
                    <div class="content-base-code-line-txt">
                      <?= isset($line['content'])?$line['content']:'' ?>
                    </div>
                  </div>
                <?php }?>

              </div>
            </div>
          </div>
        <?php }?>
      <?php }?>

      <!--
        Print sent array dumps
      -->
      <?php if (isset($dumps) && is_array($dumps) && $dumps){ ?>
        <?php foreach($dumps as $t => $array){
          if(!(is_array($array)||is_object($array)||is_string($array)))
            continue;
        ?>
          <div class="content-base-block">
            <div class="content-base-block-title">
              <span>
                <?= class_exists('Saml') ? nl2br(Saml::Stringify($t)) : nl2br((string)($t)) ?>
              </span>
            </div>
            <div class="content-base-block-body">
              <pre><?php print_r($array);?></pre>
            </div>
          </div>
        <?php }?>
      <?php }?>
    </div>
  </div>
</body>
</html>
