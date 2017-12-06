<!DOCTYPE HTML>
<html>
 <head>
  <meta charset="utf-8">
  <title>test123</title>
   <style>

   		.wrapper {
		width:1200px;
		padding-left: 50px;
		}

	   .left { 
	    border: solid 1px black;
	    background: #ede9f7; 
	    width: 240px;
	    margin: 20px 20px;
	    float:left;
	    padding: 5px;
	   }

		.right { 
			float:right;
			width: 800px;
			margin: 20px 0px;
	   }

	   iframe{
	   	border: solid 1px black;
	   }

  </style>

  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="jquery.maskedinput.js" type="text/javascript"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">


 <script type="text/javascript">
	jQuery(function($){
		$("#tel").mask("+7 (999) 999-99-99");
	});


    function proverka(val) {
 	  var reg = [/^\D+/,/[^.,\d]+/g,/[\.,]+/,/(\d+\.\d{2}).*$/], ch = val.replace(reg[0], '').replace(reg[1], '').replace(reg[2],'.').replace(reg[3], '$1');
 		        return ch;};

</script>


 </head>
 <body>

<div class="wrapper">
<div class="left">

	<form  role="form" method="POST" action="handler.php" target="area">

	<div class="form-group">

		<br>
	    <input class="form-control" id="tel" type="text" placeholder="Телефон" name="tel">
	    <br>
	
		<div class="input-group">
	    <input class="form-control" type="text" id="amt" placeholder="Сумма" name="amount" aria-describedby="basic-addon1" oninput="this.value=proverka(this.value)" value="1" >
	    <span class="input-group-addon" id="basic-addon1">RUB</span>
	   </div>
 		
 		<br>

	    <label for="comm">Комментарий:</label>
	    <textarea class="form-control" id="comm" name="comment" cols="40" rows="2"></textarea></p>	

	    <br>

	   <input class="btn btn-warning btn-large btn-block" type="submit" value="Pay with QIWI">

	</form>

</div>
</div>


<div class="right" >
<p><iframe name="area" width="800" height="600"></iframe></p>
</div>

</div>

</body>
</html>