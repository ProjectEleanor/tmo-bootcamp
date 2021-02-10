<?php
  if(isset($_GET['svc'])) {
	  $svc=$_GET['svc'];
	  //Little cleanup between Unix/Windows/UserPref
	  $svc=strtolower(str_replace("\\","/",$svc));
	  $params=explode("/",$svc,3);
	  $op=$params[0];
	  $a=isset($params[1])?$params[1]:0;
	  $b=isset($params[2])?$params[2]:0;
	  $rslt="";
	  $status="Success";
	  if(!is_numeric($a)||!is_numeric($b)) {
		  $status="Err - Invalid Numbers";
	  } else {
		 $a=intval($a);
		 $b=intval($b);
	switch ($op) {
		case "add":
			$rslt=$a+$b;
			break;
		case "sub":
			$rslt=$a-$b;
			break;
		case "mul":
			$rslt=$a*$b;
			break;
		case "div":
			if($b=="0") {
				$status="Err - Divide By Zero";
			} else {
				$rslt=$a/$b;				
			}
			break;
		default:
		   $status="Err - Invalid Operation($op)";
	}	  }
	 $jarray=array();
	 $jarray['operation']=$op;
	 $jarray['a']=$a;
	 $jarray['b']=$b;
	 $jarray['rslt']=$rslt;
	 $jarray['status']=$status;
	 header('Content-type: application/json');
	 echo json_encode($jarray); 
	 die;
  } else {
?>  <!DOCTYPE html>
  <html>
    <head>
      <link rel="icon" href="favicon.ico" type="image/x-icon" />
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	  <link rel="stylesheet" href="css/site.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>
		<nav>
			<div class="nav-wrapper black">
			  <a href="#" class="brand-logo">Bootcamp Pre-Assessment</a>
			  <ul id="nav-mobile" class="right hide-on-med-and-down">
				<li><a target="_blank" href="https://github.com/ProjectEleanor/tmo-bootcamp">Github</a></li>
			  </ul>
			</div>
		</nav>
		<div class="container">
		  <div class="row">
			<div class="col s10">
			  <div class="card">
				<div class="card-image">
				  <img src="images/MainBanner.png">
				  <span class="card-title">Assignment</span>
				</div>
				<div class="card-content">
				  <p>Using any language or framework, create and deploy a frontend or backend application that performs any simple arithmetic operation. You have full creative freedom. No CSS or styling of any kind is required.</p>
				</div>
			  </div>
			</div>
		  </div> <!--Header Card-->
		  <div class="row">
			<div class="input-field col s1">
          		<input value="0" id="inp-a" type="number" class="validate">
          		<label for="inp-a">Value 1</label>
        	</div>
			<div class="input-field col s1">
          		<select id="inp-op">
					<option value="add" selected>+</option>
					<option value="sub">-</option>
					<option value="mul">*</option>
					<option value="div">/</option>
				</select>
				<label for="inp-op">Operation</label>
        	</div> 
			<div class="input-field col s1">
          		<input value="0" id="inp-b" type="number" class="validate">
          		<label for="inp-a">Value 2</label>
        	</div>
			<div class="input-field col s1 m1">
				<h5 class="center-align">=</h5>
        	</div>
			<div class="input-field col s1">
          		<input value="0" id="out-rslt" type="text" disabled class="validate">
          		<label for="out_rslt">Result</label>
        	</div>
			<div class="input-field col s2">
          		<button id="btn-loc" class="waves-effect waves-light pink darken-1 btn-small">Calc Local</button>
        	</div>
			<div class="input-field col s2">
          		<button id="btn-svc" class="waves-effect waves-light pink darken-1 btn-small">Calc Service</button>
        	</div>
		  </div> <!--End Math-->
		</div> <!--End Container-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
   		<script>
			document.addEventListener('DOMContentLoaded', function() {
				var elems = document.querySelectorAll('select');
				var instances = M.FormSelect.init(elems);				
				M.updateTextFields();
				document.getElementById("btn-loc").addEventListener("click", doMathLocal);
				document.getElementById("btn-svc").addEventListener("click", doMathRemote);
			});

			function doMathRemote() {
				var a=parseInt(document.getElementById("inp-a").value,10);
				var b=parseInt(document.getElementById("inp-b").value,10);
				var rslt=document.getElementById("out-rslt");
				var op=document.getElementById("inp-op").value;
				var svc=document.getElementById("svc-reply");
				$.ajax({
				  url: op+"/"+a+"/"+b,				  
				  success: function( result ) {
					rslt.value=result.rslt;
				  }
				});		
			}
			
			
			
			function doMathLocal() {
				var a=parseInt(document.getElementById("inp-a").value,10);
				var b=parseInt(document.getElementById("inp-b").value,10);
				var rslt=document.getElementById("out-rslt");
				switch(document.getElementById("inp-op").value) {
					case "sub":
					rslt.value=a-b;
					break;
					case "mul":
					rslt.value=a*b;
					break;
					case "div":
					if(b===0) {
						rslt.value="N/A";
					} else {
						rslt.value=a/b;
					}
					break;
					default:
					rslt.value=a+b;
				}
			}
			
		</script>
    </body>
  </html>

<?php
  }
?>