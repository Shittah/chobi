<!DOCTYPE html>
<html lang="en">
<head>
  <title>Chobi-Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="Chobi/Chobi.js"></script>
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {height: 1500px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }

    #canvas{
    	width: 100%;
    	height: auto;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height: auto;}
    }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav">
      <h3>Chobi <small>The Image Processing Library</small></h3><hr>
      <h4>
      </ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="index.php">Chobi-Home</a></li>
        <li><a data-toggle="modal" data-target="#about" href="#">About</a></li>
        <li><a href="#section3">Family</a></li>
        <li><a href="https://github.com/jayankaghosh/chobi">See on GitHub</a></li>
      </ul>
      </h4><br>
    </div>

    <div class="col-sm-9">
      	<h1>Chobi <small>The Image Processing Library</small></h1>
      	<hr>
      	<span class="btn btn-info" onclick="document.getElementById('image-chooser').click();">Upload Image</span>
      	<button class="btn btn-info" onclick="downloadImage()">Download Image</button>
      	<div class="alert alert-warning" id="error" style="display:none;">
		  <strong>Error!</strong> You didn't upload any image yet.
		</div>

      	<hr>
      	<div class="btn-group" id="filters" style="display:none;">
      		<h3>Filters:</h3>
			<button class="btn btn-success" onclick="loadImage(document.getElementById('image-chooser'))">Reset</button>
			<button class="btn btn-success" onclick="filter(0)">Black and White</button>
			<button class="btn btn-success" onclick="filter(10)">Black and White 2</button>
			<button class="btn btn-success" onclick="filter(1)">Sepia</button>
			<button class="btn btn-success" onclick="filter(2)">Negative</button>
			<button class="btn btn-success" onclick="filter(3)">Vintage</button>
			<button class="btn btn-success" onclick="filter(4)">Cross Process</button>
			<button class="btn btn-success" onclick="filter(9)">Noise</button>
			<button class="btn btn-success" onclick="filter(5)">Brightness +1</button>
			<button class="btn btn-success" onclick="filter(6)">Brightness -1</button>
			<button class="btn btn-success" onclick="filter(7)">Contrast +1</button>
			<button class="btn btn-success" onclick="filter(8)">Contrast -1</button>
			<button class="btn btn-success" onclick="filter(11)">Crayon</button>
			<button class="btn btn-success" onclick="filter(12)">Cartoonify</button>
		</div>
		<input type="file" id="image-chooser" style="display:none" onchange="loadImage(this)">
      	<canvas id="canvas" width="600" height="600" class="well"></canvas>
    </div>
  </div>
</div>

<footer class="container-fluid">
  <p style="text-align:center">&copy; 2016 Chobi-Javascript Library team (j0y)</p>
</footer>

<!-- Modal -->
<div id="about" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">About Project</h4>
      </div>
      <div class="modal-body">
      	<div class="row">
        	<div class="col-md-4"><img src="author.jpg" style="width:100%;height:auto;"><br></div>
        	<div class="col-md-8">Firstly, I would like to thank you from the bottom of my heart for considering using the Chobi image processing library. <b>Chobi</b>, is a <a href="https://en.wikipedia.org/wiki/Bengali_language">bengali</a> word, which stands for "<i>image</i>". Chobi started out as a hobby project and is completely open source. You may edit and distribute the code whichever way you want, with proper credits. For a proper documentation as well as the source code, please visit the <a href="https://github.com/jayankaghosh/chobi">GitHub for the project</a><br><br>Regards,<br><a href="https://www.linkedin.com/in/jayanka-ghosh-435a2696">Jayanka Ghosh</a></div>
        </div>
        <hr>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</body>
<script type="text/javascript">
	var imgObj = null; //global Chobi object
	function loadImage(elem){
		//you should probably check if file is image or not before passing it
		imgObj = new Chobi(elem);
		imgObj.ready(function(){
			this.canvas = document.getElementById("canvas");
			this.loadImageToCanvas();

			//show filters to users
			document.getElementById("filters").style.display = "block";
		});
	}

	function downloadImage(){
		if(imgObj == null){
			document.getElementById("error").style.display="block";
			setTimeout(function(){
				document.getElementById("error").style.display="none";
			}, 4000);
			return;
		}
		imgObj.download('demo-image');
	}


	//0 -> Black and white
	//10 -> Black and white2
	//1 -> sepia
	//2 -> negative
	//3 -> vintage
	//4 -> crossprocess
	//5 -> Brightness increase
	//6 -> Brightness decrease
	//7 -> Contrast increase
	//8 -> Contrast decrease
	//9 -> Noise Effect
	//11 -> Crayon effect
	//12 -> Cartoonify
	//filter chaining is also possible, like imgObj.brightness(-5).sepia().negative();
	function filter(id){
		if(imgObj == null){
			alert("Choose an image first!");
			return;
		}
		if(id==0){
			imgObj.blackAndWhite();
		}
		else if(id==1){
			imgObj.sepia();
		}
		else if(id==2){
			imgObj.negative();
		}
		else if(id==3){
			imgObj.vintage();
		}
		else if(id==4){
			imgObj.crossProcess();
		}
		else if(id==5){
			imgObj.brightness(1);
		}
		else if(id==6){
			imgObj.brightness(-1);
		}
		else if(id==7){
			imgObj.contrast(1);
		}
		else if(id==8){
			imgObj.contrast(-1);
		}
		else if(id==9){
			imgObj.noise();
		}
		else if(id==10){
			imgObj.blackAndWhite2();
		}
		else if(id==11){
			imgObj.crayon();
		}
		else if(id==12){
			imgObj.cartoon();
		}


		imgObj.loadImageToCanvas();
	}
</script>
</html>

