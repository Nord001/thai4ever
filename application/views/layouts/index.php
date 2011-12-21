<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8" />
	<title>THAI FOREVER - Новости Таиланда, объявления, события, шоу и жизнь в ЮВА</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="/assets/bootstrap/bootstrap.min.css">
    <style type="text/css">
      /* Override some defaults */
      html, body {
        background-color: #eee;
      }
      body {
        padding-top: 40px; /* 40px to make the container go all the way to the bottom of the topbar */
      }
      .container > footer p {
        text-align: center; /* center align it with the container */
      }
      .container {
        width: 940px; /* downsize our container to make the content feel a bit tighter and more cohesive. NOTE: this removes two full columns from the grid, meaning you only go to 14 columns and not 16. */
      }

      /* The white background content wrapper */
      .container > .content {
        background-color: #fff;
        padding: 20px;
        margin: 0 -20px; /* negative indent the amount of the padding to maintain the grid system */
        -webkit-border-radius: 0 0 6px 6px;
           -moz-border-radius: 0 0 6px 6px;
                border-radius: 0 0 6px 6px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.15);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.15);
                box-shadow: 0 1px 2px rgba(0,0,0,.15);
      }

      /* Styles you shouldn't keep as they are for displaying this base example only */
      .content .spancontent{
        min-height: 500px;
        width: 100%;
      }

      .topbar .btn {
        border: 0;
      }
        a:active, a:focus { outline: none; }
        #search_results{ min-height: 600px; display: table; }
        a.fancybox img{
            /*border: 6px solid #EEE; margin:6px;*/
            -moz-border-radius: 50%;
            -webkit-borde-radius: 50;
            border-radius: 50%;
        }
	</style>
    <?= isset($css) ? $css : '' ?>
    <?= isset($js) ? $js : '' ?>
            
</head>
<body>

<div class="topbar">
  <div class="fill">
    <div class="container">
      <a class="brand" href="/">Thai4Ever.Новости</a>
    </div>
  </div>
</div>

<div class="container">

  <div class="content">
    <div class="row">
      <div class="span16">
        <?php echo $content; ?>              
      </div>
    </div>
  </div>

  <footer>
    <p>Page rendered in <strong>{elapsed_time}</strong> seconds | Memory usage: {memory_usage}</p>
  </footer>

</div>

</body>
</html>