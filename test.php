<?php
$link = mysqli_connect("localhost", "root", "") or die("not connected");
mysqli_select_db($link, "trade") or die("no db found");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script> 
      $(document).ready(function(){
        $("#flip").click(function(){
          $("#panel,#scribble").slideToggle("slow");
        });
      });
      </script>

    <style>

.container{
    width: fit-content;
    margin-left:810px;
          display:flex;
          flex-direction: column;
          align-items: baseline;
      }

            .but{
                font-family:'Nunito',sans-serif;
        font-size: 13px;
    font-weight: 500;
    background: #f08377;
    color: #f5f5f5;
    cursor: pointer;
    padding: 0 20px 0 20px;
    margin: 0 0 0 0;
    margin-bottom: 10px;
    border: none;
    border-radius: 3px;
    letter-spacing: 1px;
    line-height: 32px;
    height: 32px;
    text-transform: uppercase;
    outline:none;
      }
      textarea{
        font-family:'Nunito',sans-serif;
          font-size: 24px;
        padding:25px 25px 40px;
  margin:0 20px 20px 0;
  width:250px;
  height:250px;
  outline: none; 
  position: relative;
  display: none;
  background: linear-gradient(#F9EFAF, #F7E98D);
  
      }
      #scribble{
        display: none;
      }
      /* width */
.text::-webkit-scrollbar {
  width: 20px;
  cursor: pointer;
}

/* Track */
.text::-webkit-scrollbar-track {
    background: #fff;
  box-shadow: inset 0 0 5px grey; 
  border-radius: 10px;
}
 
/* Handle */
.text::-webkit-scrollbar-thumb {
  background: #f08377; 
  border-radius: 10px;
  cursor: pointer;
}

/* Handle on hover */
.text::-webkit-scrollbar-thumb:hover {
  background: #ee7163; 
  
}
    </style>
</head>
<body>
    
    <div class="container">
    <button class="but" id="flip" onclick="changename()">
        Scribble
    </button>
    <form action="test.php" method="post">
        <textarea name="field" class="text" id="panel" >
        <?php        
$view = "SELECT * FROM sticky";
$result = mysqli_query($link, $view);
while ($Datarows = mysqli_fetch_array($result)) {
    $detail = $Datarows['field'];
        echo $detail;} ?>
        </textarea>
        <input type="submit" value="Save" name="submit" class="but" id="scribble">
        
        </form>
    </div>    
</body>
</html>
<?php
if (isset($_POST['submit'])) {
	$field = $_POST['field'];
if ( empty($field)) {
		echo " <script>alert('nothing to save')</script>";
	} else {
		$query = " UPDATE sticky set field='$field'";

		if (mysqli_query($link, $query)) {
            echo "<script type='text/javascript'> alert('Saved Sucessfully!!!') </script>";
            header("Location:test.php");
		}
	}
}
?>